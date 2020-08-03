<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');


class Guru extends CI_Controller 
{
    public function __construct() 
    {
      parent::__construct();

      is_login();

      // library and model
      $this->load->model("M_guru");
      $this->load->helper('global');
      $this->load->helper('config');
      $this->load->library('session');
      $this->load->library('uuid');

      // session 
      $this->sess['users_id']    = $this->session->userdata('users_id');
      $this->sess['users_email']      = $this->session->userdata('users_email');
      $this->sess['users_level']      = $this->session->userdata('users_level');
    }
 
    public function index()
    {
      $data["page"]      = "Guru";
      $data["content"]   = "guru/v_index";
      $this->load->view("app_template", $data);
    } 

    public function ajax_list()
    {
      $list = $this->M_guru->getData();
      
      
      $data = array();
      $no   = $_POST['start'];
      foreach ($list as $key => $row) 
      {
          $no++;
          $content = array();

          $uuid     = $row['uuid'];
          $nama     = $row['nama'];

          $content[] = "<a href='".base_url('guru/detail/'.$uuid)."'>".$nama."</a>";
          $content[] = $row['nip'];
          $content[] = ($row['jk'] == "M") ? "Laki-laki" : "Perempuan";
          $content[] = $row['email'];
          $content[] = $row['pendidikan_terakhir'];
          $content[] = date("d-m-Y H:i", strtotime($row['dibuat_tgl']));

          
          $btn = "
                  <a class='table-action hover-primary' href='".base_url('guru/edit/'.$uuid)."'><i class='ti-pencil'></i> Edit </a> | 
                  <a class='table-action hover-danger' href='".base_url('guru/delete/'.$uuid)."' onclick='return confirm(\"HAPUS DATA ?\")'><i class='ti-trash'></i> Del</a>
                ";
          $content[]  = $btn;

          $data[] = $content;
      }

      $output = array(
                      "draw" => $_POST['draw'],
                      "recordsTotal" => $this->M_guru->count_all(),
                      "recordsFiltered" => $this->M_guru->count_filtered(),
                      "data" => $data,
              );
      echo json_encode($output);
    }

    public function create()
    {
      $data["page"]       = "Create";
      $data["content"]    = "guru/v_create";
      $data["list_ajar"]= $this->M_guru->listBidangAjar();
      
      $this->load->view("app_template", $data);
    }

    public function save()
    {
      $post   = $this->input->post();
      
      $msg  = "Failed, try again!";
      $url  = "guru";

      if (count($post) > 0) 
      {
        $process  = $this->M_guru->save($post, $this->sess['users_id']);
        if ($process > 0) 
        {
          $msg      = "Data saved successfully";
        }
      }

      $this->session->set_flashdata("msg", $msg);  
      redirect(base_url($url));
    }

    public function detail($guru_uuid="") 
    {
      $rowData            = $this->M_guru->edit($guru_uuid);
      $data["page"]       = "Detail ".$rowData['nama'];
      $data["content"]    = "guru/v_detail";

      if (count($rowData) > 0) 
      {
        $data["data"]       = $this->M_guru->detail($rowData);
        
        $this->load->view("app_template", $data); 
      }
      else 
      {
        redirect(base_url('guru'));  
      }
    }

    public function edit($guru_uuid="")
    {
      if ($guru_uuid != "") 
      {
        $data["page"]       = "Edit";
        $data["content"]    = "guru/v_create";
        $data["row"]        = $this->M_guru->edit($guru_uuid);
        $data["list_ajar"]  = $this->M_guru->listBidangAjar();


        $this->load->view("app_template", $data);
      }
      else
      {
        $this->session->set_flashdata("msg", "Data not found");
        return redirect(base_url("guru"));
      }
    }

    public function update()
    {
      $post   = $this->input->post();
      
      $msg  = "Failed, try again!";
      $url  = "guru";

      if (count($post) > 0) 
      {
        $process  = $this->M_guru->update($post, $this->sess['users_id']);
        if ($process > 0) 
        {
          $msg      = "Data has been changed";
        }
      }

      $this->session->set_flashdata("msg", $msg);  
      redirect(base_url($url));
    }

    public function delete($guru_uuid="")
    {
      if ($guru_uuid != "") 
      {
        $process = $this->M_guru->delete($guru_uuid);
        if ($process == TRUE) 
        {
          $msg = "Data deleted";
        }else
        {
          $msg = "Data failed to delete, try again!";
        }
      }
      else
      {
        $msg = "No Data available";
      }

      $this->session->set_flashdata("danger", $msg);
      return redirect(base_url("guru"));
    }    
    /* END CRUD */
    


 
}