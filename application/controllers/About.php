<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class About extends CI_Controller {

	public function index()
	{
		$data['title'] = "About Brian Dorsey Minstries";
		$this->load->view('header_view', $data);
		$this->load->view('about_view');

		$this->load->view('footer_view');
	}
}