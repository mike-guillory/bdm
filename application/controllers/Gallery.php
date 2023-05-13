<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends CI_Controller {

	public function index()
	{
		$data['title'] = "Brian Dorsey Photo Gallery";
		$this->load->view('header_view', $data);
		$this->load->view('gallery_view');

		$this->load->view('footer_view');
	}
}