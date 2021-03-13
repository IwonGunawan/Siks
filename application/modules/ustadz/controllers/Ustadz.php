<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');


class Ustadz extends CI_Controller 
{
    public function __construct() 
    {
      parent::__construct();

      is_login();

      // library and model
      $this->load->model("M_ustadz");
      $this->load->helper('global');
      $this->load->helper('config');
      $this->load->library('session');
      $this->load->library('uuid');

      // session 
      $this->sess['users_id']         = $this->session->userdata('users_id');
      $this->sess['users_email']      = $this->session->userdata('users_email');
      $this->sess['users_level']      = $this->session->userdata('users_level');
    }
 
    public function index()
    {
      $data["page"]      = "Ustadz";
      $data["content"]   = "ustadz/v_index";
      $this->load->view("app_template", $data);
    } 

    public function ajax_list()
    {
      $list = $this->M_ustadz->getData();
      
      
      $data = array();
      $no   = $_POST['start'];
      foreach ($list as $key => $row) 
      {
          $no++;
          $content = array();

          $uuid     = $row['ustadz_uuid'];
          $nik      = $row['ustadz_nik'];

          $content[] = "<a href='".base_url('ustadz/detail/'.$uuid)."'>".$nik."</a>";
          $content[] = $row['ustadz_nama'];
          $content[] = ($row['ustadz_jk'] == "P") ? "Perempuan" : "Laki-laki";
          $content[] = date("M d, Y", strtotime($row['created_date']));

          
          $btn = "
                  <a class='table-action hover-primary' href='".base_url('ustadz/edit/'.$uuid)."'><i class='ti-pencil'></i> Edit </a> | 
                  <a class='table-action hover-danger' href='".base_url('ustadz/delete/'.$uuid)."' onclick='return confirm(\"HAPUS DATA ?\")'><i class='ti-trash'></i> Del</a>
                ";
          $content[]  = $btn;

          $data[] = $content;
      }

      $output = array(
                      "draw" => $_POST['draw'],
                      "recordsTotal" => $this->M_ustadz->count_all(),
                      "recordsFiltered" => $this->M_ustadz->count_filtered(),
                      "data" => $data,
              );
      echo json_encode($output);
    }

    public function create()
    {
      $data["page"]       = "Create";
      $data["content"]    = "ustadz/v_create";
      $data["list_ajar"]= $this->M_ustadz->listBidangAjar();
      
      $this->load->view("app_template", $data);
    }

    public function save()
    {
      $post   = $this->input->post();
      
      $msg  = "Failed, try again!";
      $url  = "ustadz";

      if (count($post) > 0) 
      {
        $process  = $this->M_ustadz->save($post, $this->sess['users_id']);
        if ($process > 0) 
        {
          $msg      = "Data saved successfully";
        }
      }

      $this->session->set_flashdata("msg", $msg);  
      redirect(base_url($url));
    }

    public function detail($ustadz_uuid="") 
    {
      $rowData            = $this->M_ustadz->edit($ustadz_uuid);
      $data["page"]       = "Detail ".$rowData['ustadz_nama'];
      $data["content"]    = "ustadz/v_detail";

      if (count($rowData) > 0) 
      {
        $data["data"]       = $this->M_ustadz->detail($rowData);
        
        $this->load->view("app_template", $data); 
      }
      else 
      {
        redirect(base_url('ustadz'));  
      }
    }

    public function edit($ustadz_uuid="")
    {
      if ($ustadz_uuid != "") 
      {
        $data["page"]       = "Edit";
        $data["content"]    = "ustadz/v_create";
        $data["row"]        = $this->M_ustadz->edit($ustadz_uuid);
        $data["list_ajar"]  = $this->M_ustadz->listBidangAjar();


        $this->load->view("app_template", $data);
      }
      else
      {
        $this->session->set_flashdata("msg", "Data not found");
        return redirect(base_url("ustadz"));
      }
    }

    public function update()
    {
      $post   = $this->input->post();
      
      $msg  = "Failed, try again!";
      $url  = "ustadz";

      if (count($post) > 0) 
      {
        $process  = $this->M_ustadz->update($post, $this->sess['users_id']);
        if ($process > 0) 
        {
          $msg      = "Data has been changed";
        }
      }

      $this->session->set_flashdata("msg", $msg);  
      redirect(base_url($url));
    }

    public function delete($ustadz_uuid="")
    {
      if ($ustadz_uuid != "") 
      {
        $process = $this->M_ustadz->delete($ustadz_uuid);
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
      return redirect(base_url("ustadz"));
    }    
    /* END CRUD */
    


 
}