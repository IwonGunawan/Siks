<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
 

class Password extends CI_Controller 
{
  public function __construct() 
  {
    parent::__construct();
    is_login();

    //library and model
    $this->load->library('session');
    $this->load->model("M_password");
    $this->load->helper("config");

    $this->sess['users_id']    = $this->session->userdata("users_id");
  }
 
  public function index()
  {
    $data["page"]      = "Ubah Password";
    $data["content"]    = "users/v_password";
    $this->load->view("app_template", $data);
  } 

  public function change()
  {
    // defined variable
    $current_password   = $this->input->post("current_password");
    $new_password1      = $this->input->post("new_password1");
    $new_password2      = $this->input->post("new_password2");

    // processing 
    $user               = $this->db->get_where("users", array('users_id' => $this->sess['users_id']))->row_array();

    if (!password_verify($current_password, $user['users_password'])) // check current password
    {
      $this->session->set_flashdata("error", "Password saat ini salah");
      redirect("users/password");          
    }
    else if ($new_password1 !== $new_password2)  // check new password and repeat password
    {
      $this->session->set_flashdata("error", "Password baru tidak sama");
      redirect("users/password");  
    }
    else if ($current_password == $new_password1) 
    {
      $this->session->set_flashdata("error", "Password baru tidak boleh sama dengan password lama");
      redirect("users/password"); 
    }
    else
    {
      // reset password
      $process  = $this->M_password->changePass($this->sess['users_id'], $new_password1);
      if ($process == TRUE) 
      {
        $this->session->set_flashdata("msg", "Password berhasil di rubah");
        redirect("users/password");
      }
    }
  }
 
}