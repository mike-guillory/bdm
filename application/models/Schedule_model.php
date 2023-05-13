<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Schedule_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function get_table() {
		$table = "upcomingperformance";
		return $table;
	}

	function get_performance($order_by) {
		$table = $this->get_table();
		$this->db->order_by($order_by);
		$this->db->where('date >=', date('Y-m-d'));
		$query = $this->db->get($table);
		$results = $query->result_array(); // I had to add this to make it work now. It was just returning $query. I guess it's a mysqli/new-CI-version issue
		return $results;
	}

	function _insert_performance() {

		$data = array(
			'date'				=> $this->input->post('performance_date'),
			'time'				=> $this->input->post('performance_time'),
			'am_pm'				=> $this->input->post('am_pm'),
			'details'			=> $this->input->post('performance_details'),
			'venue'				=> $this->input->post('performance_venue'),
			'street_address'	=> $this->input->post('performance_address'),
			'city_province'		=> $this->input->post('performance_city'),
		);

		$table = $this->get_table();
		$this->db->insert($table, $data);
	}

	function _update_performance() {

		$id = $this->input->post('post_id');

		$data = array(
			'date'				=> $this->input->post('post_date'),
			'time'				=> $this->input->post('post_time'),
			'am_pm'				=> $this->input->post('post_am_pm'),
			'details'			=> $this->input->post('post_details'),
			'venue'				=> $this->input->post('post_venue'),
			'street_address'	=> $this->input->post('post_address'),
			'city_province'		=> $this->input->post('post_city_province'),
		);

		$table = $this->get_table();
		$this->db->where('id', $id);
		$this->db->update($table, $data);
		
		$varify = $this->db->get_where('id', $id);
		//$row = $varify->row();
		//echo json_encode($row);
		echo $this->db->affected_rows();

		
	}

	function _delete_performance($id) {
		$table = $this->get_table();
		$this->db->where('id', $id);
		$this->db->delete($table);

		if($this->db->affected_rows() > 0){
			echo $id;
		}
		else{
			echo $this->db->affected_rows();
		}
	}
}