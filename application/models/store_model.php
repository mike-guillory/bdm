<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Store_model extends CI_Model{

	function __construct()
	{

	}

	public function getCds()
	{
		$this->db->order_by('id');
		$query = $this->db->get('cd');

		$cds = array();

		foreach ($query->result() as $cd) {
			$cds[] = array(
				'path'		=> $cd->image_path,
				'title'		=> $cd->title,
				'price'		=> $cd->price
			);
			
		}
		return $cds;
	}
}