<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Store extends CI_Controller{

	public function index()
	{
		$data['title'] = "Purchase Brian's Music";
		$this->load->model('store_model');
		$data['cds'] = $this->store_model->getCds();
		$this->load->view('header_view', $data);
		$this->load->view('store_view');
	}
}