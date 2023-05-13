<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Buy extends CI_Controller {

	public function index()
	{
		$data['title'] = "Purchase Brian Dorsey's Music";
		$this->load->model('cd_model');
		$data['cds'] = $this->cd_model->get_cd();
		$this->load->view('header_view', $data);
		$this->load->view('buy_view');
		$this->load->view('footer_view');
	}
}