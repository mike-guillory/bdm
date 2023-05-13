<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cd_model extends CI_Model {

	function __construct() {

		parent::__construct();
	}

	function get_cd_table() {
		$cd_table = "cd";
		return $cd_table;
	}

	function get_song_table() {
		$song_table = "song";
		return $song_table;
	}

	function get_cd() {

		$this->db->order_by('release_date desc');
		$cd_table = $this->get_cd_table();
		$cds = $this->db->get($cd_table);
		$cds_result = $cds->result_array();
		
		$this->db->order_by('song_number asc');
		$songs = $this->db->get('song');
		$songs_result = $songs->result_array();
		
		$results = array();
		
		foreach ($cds_result as $row){
			
			$results[$row['cd_id']] = array(
				
				'cd_id' 			=> $row['cd_id'],
				'cd_title' 			=> $row['cd_title'],
				'total_songs' 		=> $row['total_songs'],
				'description'		=> $row['description'],
				'image_name'		=> $row['image_name'],
				'price'				=> $row['price'],
				'release_date'		=> $row['release_date']
			);
		}
		
		foreach($songs_result as $row){
			
			array_push($results[$row['cd_id']], array(
					
						'song_title'	=> $row['song_title'],
						'song_number'	=> $row['song_number'],
						'clip_name'		=> $row['clip_name']				
				)				
			);		
		}

		return $results;
	}

	function _insert_cd($image_data) {

		// Get the input from POST
		$image_name		= $image_data['file_name'];
		$cd_title 		= $this->input->post('title');
		$price 			= $this->input->post('price');
		$release_date 	= $this->input->post('release_date');
		$total_songs 	= $this->input->post('total_songs');
		$description 	= $this->input->post('description');

		$song_data = array();
		for($i = 0; $i < $total_songs; $i++)
		{
			$song_title = $this->input->post('song_'.($i + 1));
			$song_number = ($i + 1);
			$clip_name = $_FILES['song_clip_'.($i + 1)]['name'];

 			$song_data[$i] = array(

 				'song_title' 	=> (!empty($song_title)) ? $song_title : null,
 				'song_number'	=> (!empty($song_number)) ? $song_number : null,
 				'clip_name'		=> (!empty($clip_name)) ? $clip_name : null
			);
		}

		$cd_data = array(

			// If the input is empty set it to null or there will be an empty
			// entry in the database.
			'image_name'	=> (!empty($image_name)) ? $image_name : null,
			'cd_title'		=> (!empty($cd_title)) ? $cd_title : null,
			'price'			=> (!empty($price)) ? $price : null,
			'release_date'	=> (!empty($release_date)) ? $release_date : null,
			'total_songs'	=> (!empty($total_songs)) ? $total_songs : null,
			'description'	=> (!empty($description)) ? $description : null
		);

		$cd_table = $this->get_cd_table();
		$song_table = $this->get_song_table();

		$this->db->trans_start();

			$this->db->insert($cd_table, $cd_data);

			$cd_id = $this->db->insert_id();

			foreach($song_data as $row){

				$row['cd_id'] = $cd_id;	
				$this->db->insert($song_table, $row);
			}

		$this->db->trans_complete();

		if($this->db->trans_status() === FALSE)
		{
			unlink(FCPATH. "images/cds/". $image_name);
			return false;
		}
		else
		{
			return true;
		}
	}

	function _update_cd($id, $data) {
		$cd_table = $this->get_cd_table();
		$this->db->where('id', $id);
		$this->db->update($cd_table, $data);
	}

	function _delete_cd($id) {
		$cd_table = $this->get_cd_table();
		$this->db->where('id', $id);
		$this->db->delete($cd_table);
	}
}