<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model{
	
		function __construct()
		{

		}

		public function verifyUser($userName, $password)
		{
			$query = $this->db->get_where('user', array('userName' => $userName, 'password' => sha1($password)));	

			if($query->num_rows() == 1)
			{
				return true;
			}
			return false;
		}					
	}