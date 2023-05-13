<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

	class Admin extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			session_set_cookie_params(0);
			session_start();
		}

		public function index()
		{
			// session_set_cookie_params(0);
			// session_start();

			$data['title'] = "BDM Admin";

			if(isset($_SESSION['userName']))
			{
				$this->load->view('admin_header_view', $data);
				$this->load->view('admin_home_view');
			}
			else
			{
				//echo sha1('myPassword'); die(); // This echos the word 'mypassword' as it looks after sha1 encryption
				$this->load->library('form_validation');
				$this->form_validation->set_rules('userName', 'User Name', 'required');
				$this->form_validation->set_rules('password', 'Password', 'required|min_length[10]');

				if($this->form_validation->run() !== false)
				{
					$this->load->model('admin_model');
					$credentials = $this->admin_model->verifyUser(
								$this->input->post('userName'), 
								$this->input->post('password')
							);

					if($credentials)
					{
						$_SESSION['userName'] = $this->input->post('userName');
						$this->load->view('admin_header_view', $data);
						$this->load->view('admin_home_view');
					}
					else // If the form doesn't validate, reload the view so validation_errors() can be shown.
					{
						$data['loginFailed'] = "Login Failed. Please try again.";
						$this->load->view('login_view', $data);
					}
					
				}
				else 
				{
					$this->load->view('login_view');
				}
			}
		}

		public function logout()
		{
			session_destroy();
			redirect(''); // leave empty to redirect to homepage
		}
	}