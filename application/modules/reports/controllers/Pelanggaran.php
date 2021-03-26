<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
 

class Pelanggaran extends CI_Controller 
{
  public function __construct() 
  {
    parent::__construct();
    is_login();

    //library and model
    $this->load->library('session');
    $this->load->model("reports/M_pelanggaran");
    $this->load->helper("config");

    $this->users_id    = $this->session->userdata("users_id");
    $this->users_email = $this->session->userdata("users_email");
    $this->users_level = $this->session->userdata("users_level");
  }
 
  public function index()
  {
    $data["page"]      = "Laporan Pencatatan Sanksi";
    $data["content"]   = "reports/v_pelanggaran";
    $data["curr_month"]      = $this->_curr_month();
    $data["curr_login"]      = $this->users_level;

    if ($this->users_level == config("LEVEL_SANTRI")) 
    {
      $data['graph_data']     = json_encode($this->M_pelanggaran->view_per_santri($this->users_email));
    } 
    else 
    {
      $data["graph_data"]     = json_encode($this->M_pelanggaran->view_avg_all());
    }

    $this->load->view("app_template", $data);
  } 


  public function view_avg_class(){
    $view_by  = $_GET['view_by'];
    $data     = array();

    if ($view_by == "all") 
    {
      $data   = $this->M_pelanggaran->view_avg_all();
    }
    else{
      $data   = $this->M_pelanggaran->view_avg_class($view_by);
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