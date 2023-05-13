<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$data['title'] = "Brian Dorsey Minstries";
		$this->load->view('header_view', $data);

		$this->load->model('Schedule_model');
		$upcomingPerformanceData['performances'] = $this->Schedule_model->get_performance('date');
		$this->load->view('home_view', $upcomingPerformanceData);

		$this->load->view('footer_view');
	}
}