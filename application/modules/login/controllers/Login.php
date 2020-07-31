<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
 


class Login extends CI_Controller 
{
    public function __construct() 
    {
      parent::__construct();

      //library and model
      $this->load->helper('global');
      $this->load->helper("config");
      $this->load->model("M_login");
    }
 
    public function index()
    {
      $this->load->view("v_login");
    } 
    
    public function process()
    {
      // defined variable
      $users_email    = $this->input->post("users_email");
      $users_password = $this->input->post("users_password");

      $this->checkLogin($users_email, $users_password);

    }

    public function checkLogin($users_email="", $users_password="")
    {
      $check = $this->M_login->check_login($users_email, $users_password);
    

      if (count($check) == 0) 
      {
        $users_status   = "error";
        $msg      = "Please check your email address!";        
      }
      else if (!password_verify($users_password, $check['users_password'])) 
      {
        $users_status   = "error";
        $msg      = "Your password is incorrect";
      }
      else if ($check['deleted'] == config("DELETED")) 
      {
        $users_status   = "error";
        $msg      = "Account has been deleted";
      }
      else if ($check['users_status'] == config("STATUS_DEACTIVE")) 
      {
        $users_status   = "error";
        $msg      = "Account deactive, please contact your admin";
      }
      else
      {
        $data_session = array(
            'users_id'        => $check['users_id'],
            'users_name'      => $check['users_name'],
            'users_email'     => $check['users_email'], 
            'users_level'     => $check['users_level'], 
            'users_status'    => $check['users_status'],
        );
        $this->session->set_userdata($data_session);


        redirect(base_url("home"));

      }

      $this->session->set_flashdata($users_status, $msg);
      redirect(base_url("login"));
    }

    public function logout()
    {
      $array_items = array('users_id', 'users_name', 'users_email', 'users_level', 'users_status');
      $this->session->unset_userdata($array_items);

      $msg = $this->session->flashdata("error");
      if ($msg == "login_no_access") 
      {
        $this->session->set_flashdata("error", "No Access, please login");
      }


      redirect(base_url("login"));
    }

    public function not_found()
    {
      $this->load->view("404");
    }


 
}