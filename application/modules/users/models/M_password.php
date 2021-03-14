<?php

/**
* Model Change Password
*/
class M_password extends CI_Model
{ 
  public function __construct()
  {
      parent::__construct();
      $this->load->database();
  }

  function changePass($users_id="", $new_pass="")
  {
    $pass_hash  = password_hash($new_pass, PASSWORD_DEFAULT);

    $this->db->set("users_password", $pass_hash);
    $this->db->where("users_id", $users_id);
    $this->db->update("users");

    return TRUE;
  }

  
}