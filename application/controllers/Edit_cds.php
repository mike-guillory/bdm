<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Edit_cds extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		session_start();
		if(!isset($_SESSION['userName']))
		{
			redirect('admin');
		}		
	}

	public function index()
	{		
		$data['title'] = "Edit CDs";
		$this->load->model('cd_model');
		$data['cds'] = $this->cd_model->get_cd();
		$this->load->view('admin_header_view', $data);
		$this->load->view('edit_cds_view');
	}

	function insert_cd()
	{
		// Unset previous errors if there were any, so if there are none ////////////////////
		// this time, there won't be errors carried over in $_SESSION. //////////////////////
		/////////////////////////////////////////////////////////////////////////////////////
		unset($_SESSION['errors']);
		unset($_SESSION['title']);
		unset($_SESSION['price']);
		unset($_SESSION['release_date']);
		unset($_SESSION['description']);

		$num_songs = $this->input->post('total_songs');

		for($i = 1; $i <= $num_songs; $i++)
		{
			unset($_SESSION['song_'.$i]);
		}

		unset($_SESSION['total_songs']);
		/////////////////////////////////////////////////////////////////////////////////////
		/////////////////////////////////////////////////////////////////////////////////////

		// Set rules for all form input alidation////////////////////////////////////////////
		/////////////////////////////////////////////////////////////////////////////////////
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'The Title', 'required');
		$this->form_validation->set_rules('price', 'The Price', 'required');
		$this->form_validation->set_rules('release_date', 'The Release Date', 'required');
		$this->form_validation->set_rules('total_songs', 'The Total Number of Songs', 'required|numeric');
		$this->form_validation->set_rules('description', 'The Description', 'required');

		for($i = 1; $i <= $num_songs; $i++)
		{
			$this->form_validation->set_rules('song_'.$i, 'Song '.$i. " Title", 'required');

			if(empty($_FILES['song_clip_'.$i]['name']))
			{
				$this->form_validation->set_rules('song_clip_'.$i, 'Song Clip '.$i, 'required');
			}
		}

		// The CI 'userfile' never validates, so I have to check $_FILES['userfile']['name'] and only set the 
		// validation rule for 'userfile' (or in this case, cd_image) if $_FILES['userfile']['name']) is empty.
		// The Library function 'upload' does its own validation, but I want to display all
		// errors to the user at once, and this happens before the image upload.
		if(empty($_FILES['cd_image']['name']))
		{
			$this->form_validation->set_rules('cd_image', 'An Image of the CD', 'required');
			$this->form_validation->set_message('required', '%s is required.');
		}

 		// If the form vaildates, insert the CD information. Image first ////////////////////
 		/////////////////////////////////////////////////////////////////////////////////////
		if($this->form_validation->run())
		{

			$uploadConfig = array(
				'image_library' => 'GD2',
				'upload_path'	=> 'images/cds/',
				'allowed_types'	=> 'gif|jpg|jpeg|png'
			);

			$this->load->library('upload', $uploadConfig);

			if($this->upload->do_upload('cd_image'))
			{
				// I need the image data to get the name of the CD image after it is uploaded.
				// I could get it from the POST, but if for some reason the user uploads an
				// image with the same name as one already in the images folder, the new image
				// will have a 1 added to the name which will make the "<image src=" incorrect. 
				$image_data = $this->upload->data();

				$this->load->model('cd_model');

				if(!$this->cd_model->_insert_cd($image_data))
				{
					$_SESSION['errors'] = "There was a problem adding the CD. Please contact the Website Administrator.";
				}
			}
			else
			{
				$_SESSION['errors'] = $this->upload->display_errors();
			}
		}
		else // If the form doesn't validate, set an errors var in $_SESSION. /////////////
		{
			$_SESSION['errors'] = validation_errors();
		}

		if($_SESSION['errors'])
		{
			$_SESSION['title'] = $this->input->post('title');
			$_SESSION['price'] = $this->input->post('price');
			$_SESSION['release_date'] = $this->input->post('release_date');
			$_SESSION['total_songs'] = $this->input->post('total_songs');

			for($i = 1; $i <= $num_songs; $i++)
			{
				$_SESSION['song_'.$i] = $this->input->post('song_'.$i);
			}

			$_SESSION['description'] = $this->input->post('description');
		}

		redirect('edit_cds');
	}
}