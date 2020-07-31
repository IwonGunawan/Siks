<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
 


class Home extends CI_Controller 
{
    public function __construct() 
    {
      parent::__construct();

      is_login();

      //library and model
      $this->load->model("M_home");
      $this->load->helper('global');
      $this->load->library('session');

      //session 
      $this->sess['users_id']     = $this->session->userdata('users_id');
      $this->sess['users_email']  = $this->session->userdata('users_email');
      $this->sess['users_level']  = $this->session->userdata('users_level');
    }
 
    public function index()
    {
      $data["page"]      = "Home";
      $data["content"]   = "home/v_home";
      $this->load->view("app_template", $data);
    }     


 
}