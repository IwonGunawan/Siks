<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');



class Tahfidz extends CI_Controller 
{
    public function __construct() 
    {
      parent::__construct();

      is_login();

      // library and model
      $this->load->model("M_tahfidz");
      $this->load->model("santri/M_santri");
      $this->load->helper('global');
      $this->load->helper('config');
      $this->load->library('session');

      // session 
      $this->sess['users_id']    = $this->session->userdata('users_id');
      $this->sess['users_email']      = $this->session->userdata('users_email');
      $this->sess['users_level']      = $this->session->userdata('users_level');
    }
 
    public function index()
    {
      $data["page"]      = "Tahfidz";
      $data["content"]   = "tahfidz/v_index"; // i am here
      $this->load->view("app_template", $data);
    } 

    public function ajax_list()
    {
      $list = $this->M_tahfidz->getData();

      $data = array();
      $no   = $_POST['start'];
      foreach ($list as $key => $row) 
      {
          $no++;
          $content = array();

          $uuid  = $row['tahfidz_uuid'];

          $content[] = "<a href='".base_url('tahfidz/detail/'.$uuid)."'>".$row['nama']."</a>";
          $content[] = $row['kelas'];
          $content[] = $this->_tahfidz_waktu($row['tahfidz_waktu']);
          $content[] = $row['tahfidz_juz']." - ".$row['tahfidz_surat']." - ".$row['tahfidz_ayat'];
          $content[] = $row['tahfidz_nilai'];
          $content[] = $row['users_name'];
          $content[] = date("M d,Y H:i", strtotime($row['created_date']));

          
          $btn = "
                  <a class='table-action hover-primary' href='".base_url('tahfidz/edit/'.$uuid)."'><i class='ti-pencil'></i> Edit </a> | 
                  <a class='table-action hover-danger' href='".base_url('tahfidz/delete/'.$uuid)."' onclick='return confirm(\"HAPUS DATA ?\")'><i class='ti-trash'></i> Del</a>
                ";
          $content[]  = $btn;

          $data[] = $content;
      }

      $output = array(
                      "draw" => $_POST['draw'],
                      "recordsTotal" => $this->M_tahfidz->count_all(),
                      "recordsFiltered" => $this->M_tahfidz->count_filtered(),
                      "data" => $data,
              );

      echo json_encode($output);
    }

    public function create()
    {
      $data["page"]       = "Create";
      $data["content"]    = "tahfidz/v_create";
      $data["santriList"] = $this->M_santri->santriList();
      
      $this->load->view("app_template", $data);
    }

    public function save()
    {
      $post   = $this->input->post();
      
      $msg  = "Failed, try again!";
      $url  = "tahfidz";

      if (count($post) > 0) 
      {
        $process  = $this->M_tahfidz->save($post, $this->sess['users_id']);
        if ($process > 0) 
        {
          $msg      = "Data saved successfully";
        }
      }

      $this->session->set_flashdata("msg", $msg);  
      redirect(base_url($url));
    }

    public function detail($tahfidz_uuid="") 
    {
      $rowData            = $this->M_tahfidz->edit($tahfidz_uuid);
      $data["page"]       = "Detail Tahfidz Santri : ".$rowData['nama'];
      $data["content"]    = "tahfidz/v_detail";

      if (count($rowData) > 0) 
      {
        $data["data"]       = $this->M_tahfidz->detail($rowData);
        $this->load->view("app_template", $data); 
      }
      else 
      {
        redirect(base_url('tahfidz'));  
      }
    }

    public function edit($tahfidz_uuid="")
    {
      if ($tahfidz_uuid != "") 
      {
        $data["page"]       = "Edit";
        $data["content"]    = "tahfidz/v_create";
        $data["santriList"] = $this->M_santri->santriList();
        $data["row"]        = $this->M_tahfidz->edit($tahfidz_uuid);

        $this->load->view("app_template", $data);
      }
      else
      {
        $this->session->set_flashdata("msg", "Data not found");
        return redirect(base_url("tahfidz"));
      }
    }

    public function update()
    {
      $post   = $this->input->post();
      
      $msg  = "Failed, try again!";
      $url  = "tahfidz";

      if (count($post) > 0) 
      {
        $process  = $this->M_tahfidz->update($post, $this->sess['users_id']);
        if ($process > 0) 
        {
          $msg      = "Data has been changed";
        }
      }

      $this->session->set_flashdata("msg", $msg);  
      redirect(base_url($url));
    }

    public function delete($tahfidz_uuid="")
    {
      if ($tahfidz_uuid != "") 
      {
        $process = $this->M_tahfidz->delete($tahfidz_uuid);
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
      return redirect(base_url("tahfidz"));
    }    
    /* END CRUD */

    function _tahfidz_waktu($index=0)
    {
      $data = array("Pagi", "Siang", "Sore");

      return $data[$index];
    }
    

 
}