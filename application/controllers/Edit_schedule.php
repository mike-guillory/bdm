<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Edit_schedule extends CI_Controller {

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
		$data['title'] = "Edit Schedule";
		$this->load->view('admin_header_view', $data);
		$this->load->model('Schedule_model');
		$upcomingPerformanceData['performances'] = $this->Schedule_model->get_performance('date');
		$this->load->view('edit_schedule_view', $upcomingPerformanceData);
	}

	function insert_performance()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('performance_date', 'Date', 'required');
		$this->form_validation->set_rules('performance_city', 'City', 'required');
		$this->form_validation->set_rules('performance_venue', 'Place', 'required');
		$this->form_validation->set_rules('performance_address', 'Address', 'required');
		$this->form_validation->set_rules('performance_time', 'Time', 'required');

		if($this->form_validation->run() !== false)
		{
			$this->load->model('schedule_model');
			$this->schedule_model->_insert_performance();
		}
		else
		{
			$_SESSION['errors'] = validation_errors();
			$_SESSION['date'] = $this->input->post('performance_date');
			$_SESSION['city'] = $this->input->post('performance_city');
			$_SESSION['venue'] = $this->input->post('performance_venue');
			$_SESSION['address'] = $this->input->post('performance_address');
			$_SESSION['time'] = $this->input->post('performance_time');
			$_SESSION['details'] = $this->input->post('performance_details');
		}

		redirect('edit_schedule');
	}

	function update_performance()
	{
		$this->load->model('Schedule_model');
		$this->Schedule_model->_update_performance();
	}

	function delete_performance()
	{
		$id = $_POST['id'];
		$this->load->model('Schedule_model');
		$this->Schedule_model->_delete_performance($id);
	}

	function test(){
		
		$response = "success";

		echo $response;
	}
}