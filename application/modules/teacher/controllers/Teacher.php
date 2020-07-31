<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');


class Teacher extends CI_Controller 
{
    public function __construct() 
    {
      parent::__construct();

      is_login();

      // library and model
      $this->load->model("M_teacher");
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
      $data["page"]      = "Teacher";
      $data["content"]   = "teacher/v_index";
      $this->load->view("app_template", $data);
    } 

    public function ajax_list()
    {
      $list = $this->M_teacher->getData();
      
      
      $data = array();
      $no   = $_POST['start'];
      foreach ($list as $key => $row) 
      {
          $no++;
          $content = array();


          $teacher_uuid = $row['teacher_uuid'];
          $teacher_name = $row['teacher_name'];

          $content[] = "<a href='".base_url('teacher/detail/'.$teacher_uuid)."'>".$teacher_name."</a>";
          $content[] = $row['teacher_nohp'];
          $content[] = $row['teacher_email'];
          $content[] = $row['teacher_last_education'];
          $content[] = $row['teacher_majors'];
          $content[] = date("Y-m-d H:i:s", strtotime($row['created_date']));

          
          $btn = "
                  <a class='table-action hover-primary' href='".base_url('teacher/edit/'.$teacher_uuid)."'><i class='ti-pencil'></i> Edit </a> | 
                  <a class='table-action hover-danger' href='".base_url('teacher/delete/'.$teacher_uuid)."' onclick='return confirm(\"DELETE DATA ?\")'><i class='ti-trash'></i> Del</a>
                ";
          $content[]  = $btn;

          $data[] = $content;
      }

      $output = array(
                      "draw" => $_POST['draw'],
                      "recordsTotal" => $this->M_teacher->count_all(),
                      "recordsFiltered" => $this->M_teacher->count_filtered(),
                      "data" => $data,
              );
      echo json_encode($output);
    }

    public function create()
    {
      $data["page"]       = "Create";
      $data["content"]    = "teacher/v_create";
      
      $this->load->view("app_template", $data);
    }

    public function save()
    {
      $post   = $this->input->post();
      
      $msg  = "Failed, try again!";
      $url  = "teacher";

      if (count($post) > 0) 
      {
        $process  = $this->M_teacher->save($post, $this->sess['users_id']);
        if ($process > 0) 
        {
          $msg      = "Data saved successfully";
        }
      }

      $this->session->set_flashdata("msg", $msg);  
      redirect(base_url($url));
    }

    public function detail($teacher_uuid="") 
    {
      $rowData            = $this->M_teacher->edit($teacher_uuid);
      $data["page"]       = "Detail ".$rowData['teacher_name'];
      $data["content"]    = "teacher/v_detail";

      if (count($rowData) > 0) 
      {
        $data["data"]       = $this->M_teacher->detail($rowData);
        
        $this->load->view("app_template", $data); 
      }
      else 
      {
        redirect(base_url('teacher'));  
      }
    }

    public function edit($teacher_uuid="")
    {
      if ($teacher_uuid != "") 
      {
        $data["page"]       = "Edit";
        $data["content"]    = "teacher/v_create";
        $data["row"]        = $this->M_teacher->edit($teacher_uuid);

        $this->load->view("app_template", $data);
      }
      else
      {
        $this->session->set_flashdata("msg", "Data not found");
        return redirect(base_url("teacher"));
      }
    }

    public function update()
    {
      $post   = $this->input->post();
      
      $msg  = "Failed, try again!";
      $url  = "teacher";

      if (count($post) > 0) 
      {
        $process  = $this->M_teacher->update($post, $this->sess['users_id']);
        if ($process > 0) 
        {
          $msg      = "Data has been changed";
        }
      }

      $this->session->set_flashdata("msg", $msg);  
      redirect(base_url($url));
    }

    public function delete($teacher_uuid="")
    {
      if ($teacher_uuid != "") 
      {
        $process = $this->M_teacher->delete($teacher_uuid);
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
      return redirect(base_url("teacher"));
    }    
    /* END CRUD */
    


 
}