<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
 

class Tahfidz extends CI_Controller 
{
  public function __construct() 
  {
    parent::__construct();
    is_login();

    //library and model
    $this->load->library('session');
    $this->load->model("reports/M_tahfidz");
    $this->load->helper("config");

    $this->sess['users_id']    = $this->session->userdata("users_id");
  }
 
  public function index()
  {
    $data["page"]      = "Laporan Nilai Tahfidz";
    $data["content"]   = "reports/v_tahfidz";
    $data["curr_month"]      = $this->_curr_month();
    $data["graph_data"]      = json_encode($this->M_tahfidz->view_avg_all());

    $this->load->view("app_template", $data);
  } 


  public function view_avg_class(){
    $view_by  = $_GET['view_by'];
    $data     = array();

    if ($view_by == "all") 
    {
      $data   = $this->M_tahfidz->view_avg_all();
    }
    else{
      $data   = $this->M_tahfidz->view_avg_class($view_by);
    }
    
    echo json_encode($data);
  }


  function _curr_month()
  {
    $month      = date("m");
    $month_arr  = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

    return $month_arr[$month - 1]; 
  }
 
}