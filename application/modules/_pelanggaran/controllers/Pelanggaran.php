<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');



class Pelanggaran extends CI_Controller 
{
    public function __construct() 
    {
      parent::__construct();

      is_login();

      // library and model
      $this->load->model("M_pelanggaran");
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
      $data["page"]      = "Pelanggaran";
      $data["content"]   = "pelanggaran/v_index"; // i am here
      $this->load->view("app_template", $data);
    } 

    public function ajax_list()
    {
      $list = $this->M_pelanggaran->getData();
     
      $data = array();
      $no   = $_POST['start'];
      foreach ($list as $key => $row) 
      {
          $no++;
          $content = array();

          $uuid  = $row['uuid'];

          $content[] = "<a href='".base_url('pelanggaran/detail/'.$uuid)."'>".$row['santri_nama']."</a>";
          $content[] = $row['kelas'];
          $content[] = $row['peristiwa'];
          $content[] = $row['solusi'];
          $content[] = date("d/m/Y H:i", strtotime($row['dibuat_tgl']));

          
          $btn = "
                  <a class='table-action hover-primary' href='".base_url('pelanggaran/edit/'.$uuid)."'><i class='ti-pencil'></i> Edit </a> | 
                  <a class='table-action hover-danger' href='".base_url('pelanggaran/delete/'.$uuid)."' onclick='return confirm(\"HAPUS DATA ?\")'><i class='ti-trash'></i> Del</a>
                ";
          $content[]  = $btn;

          $data[] = $content;
      }

      $output = array(
                      "draw" => $_POST['draw'],
                      "recordsTotal" => $this->M_pelanggaran->count_all(),
                      "recordsFiltered" => $this->M_pelanggaran->count_filtered(),
                      "data" => $data,
              );

      echo json_encode($output);
    }

    public function create()
    {
      $data["page"]       = "Create";
      $data["content"]    = "pelanggaran/v_create";
      $data["santriList"] = $this->M_santri->santriList();
      
      $this->load->view("app_template", $data);
    }

    public function save()
    {
      $post   = $this->input->post();
      
      $msg  = "Failed, try again!";
      $url  = "pelanggaran";

      if (count($post) > 0) 
      {
        $process  = $this->M_pelanggaran->save($post, $this->sess['users_id']);
        if ($process > 0) 
        {
          $msg      = "Data saved successfully";
        }
      }

      $this->session->set_flashdata("msg", $msg);  
      redirect(base_url($url));
    }

    public function detail($pelanggaran_uuid="") 
    {
      $rowData            = $this->M_pelanggaran->edit($pelanggaran_uuid);
      $data["page"]       = "Detail ".$rowData['santri_nama'];
      $data["content"]    = "pelanggaran/v_detail";

      if (count($rowData) > 0) 
      {
        $data["data"]       = $this->M_pelanggaran->detail($rowData);
        $this->load->view("app_template", $data); 
      }
      else 
      {
        redirect(base_url('pelanggaran'));  
      }
    }

    public function edit($pelanggaran_uuid="")
    {
      if ($pelanggaran_uuid != "") 
      {
        $data["page"]       = "Edit";
        $data["content"]    = "pelanggaran/v_create";
        $data["santriList"] = $this->M_santri->santriList();
        $data["row"]        = $this->M_pelanggaran->edit($pelanggaran_uuid);

        $this->load->view("app_template", $data);
      }
      else
      {
        $this->session->set_flashdata("msg", "Data not found");
        return redirect(base_url("pelanggaran"));
      }
    }

    public function update()
    {
      $post   = $this->input->post();
      
      $msg  = "Failed, try again!";
      $url  = "pelanggaran";

      if (count($post) > 0) 
      {
        $process  = $this->M_pelanggaran->update($post, $this->sess['users_id']);
        if ($process > 0) 
        {
          $msg      = "Data has been changed";
        }
      }

      $this->session->set_flashdata("msg", $msg);  
      redirect(base_url($url));
    }

    public function delete($pelanggaran_uuid="")
    {
      if ($pelanggaran_uuid != "") 
      {
        $process = $this->M_pelanggaran->delete($pelanggaran_uuid);
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
      return redirect(base_url("pelanggaran"));
    }    
    /* END CRUD */
    

 
}