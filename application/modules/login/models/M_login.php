<?php

/**
* Model Login
*/
class M_login extends CI_Model
{

  public function __construct()
  {
      parent::__construct();
      $this->load->database();
  }

	function check_login($users_email="", $users_pass="")
	{
		$this->db->select($this->_selected());
		$this->db->from("users");
		$this->db->where("users_email", $users_email);

		$query 	= $this->db->get();
		$result	= $query->row_array();

		return $result;
		
	}

	function _selected()
	{
		$result = array(
					"users.users_id", 
					"users.users_name", 
					"users.users_password",
					"users.users_email", 
					"users.users_level", 
					"users.users_status", 
					"users.deleted",
		);

		return $result;
	}



	
}