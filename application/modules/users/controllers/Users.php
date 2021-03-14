<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
 

class Users extends CI_Controller 
{
    public function __construct() 
    {
      parent::__construct();

      is_login();

      //library and model
      $this->load->library('session');
      $this->load->model("M_users");

      //session 
      $this->sess['users_id']     = $this->session->userdata('users_id');
      $this->sess['users_name']  = $this->session->userdata('users_name');
    }
 
    function index()
    {
      $data["page"]      = "Users";
      $data["content"]    = "users/v_index";

      $this->load->view("app_template", $data);
    } 

    function ajax_list()
    {
      $list = $this->M_users->listData();
      
      $data = array();
      $no   = $_POST['start'];
      foreach ($list as $key => $row) 
      {
          // defined var
          $no++;
          $content         = array();
          $users_uuid      = $row['users_uuid'];
          $users_status    = '<span class="badge badge-success">Aktif</span>';

          if ($row['users_status'] == 1) {
            $users_status  = '<span class="badge badge-danger">Tidak Aktif</span>';
          }

          $btn = "";
          $users_name = $row['users_name'];
          if ($row['users_level'] == 1 || $row['users_level'] == 2) 
          {
            $btn = "
                    <a class='table-action hover-primary' href='".base_url('users/users/edit/'.$users_uuid)."'><i class='fas fa-pencil-alt'></i> </a> | 
                    <i class='fas fa-key' data-toggle='modal' data-target='.bd-example-modal-sm' data-uuid='".$users_uuid."' data-name='".$row['users_name']."'></i> | 
                    <a class='table-action hover-danger' href='".base_url('users/users/delete/'.$users_uuid)."' onclick='return confirm(\"DELETE DATA ?\")'><i class='fas fa-trash-alt'></i> </a>
            ";  

            $users_name = $row['users_name'];
          }


          $content[] = $users_name;
          $content[] = $row['users_email'];
          $content[] = $this->lblUserLevel($row['users_level']);
          $content[] = $users_status;


          $content[]  = $btn;
          $data[]     = $content;
      }

      $output = array(
                      "draw"            => $_POST['draw'],
                      "recordsTotal"    => $this->M_users->listDataCount(),
                      "recordsFiltered" => $this->M_users->listDataFilter(),
                      "data"            => $data,
              );
      echo json_encode($output);
    }

    function create()
    {
      $data["page"]      = "Create User";
      $data["content"]    = "users/v_create";

      $this->load->view("app_template", $data);
    }

    function save()
    {
      $post   = $this->input->post();
      
      $msg    = "Gagal, silakan ulangi kembali!";
      $url    = "users/users";

      $check  = $this->M_users->checkEmail($post['users_email']);

      if (count($post) > 0 && $check == 0) 
      {
        $process  = $this->M_users->save($post, $this->sess['users_name']);
        if ($process !== "") 
        {
          $msg      = "User berhasil dibuat dengan password <b>".$process."</b>";
          $this->session->set_flashdata("msg", $msg);  
        }
      }
      else if ($check == 1) 
      {
        $msg   = "Email sudah terdaftar, silakan gunakan email lain";
        $this->session->set_flashdata("danger", $msg);  
      }

      redirect(base_url($url));
    }

    function edit($users_uuid="")
    {
      $data["page"]      = "Edit";
      $data["content"]    = "users/v_create";
      $data["data"]       = $this->M_users->edit($users_uuid);

      $this->load->view("app_template", $data);
    }

    function update()
    {
      $post   = $this->input->post();
      
      $msg  = "Gagal, silakan ulangi kembali!";

      if (count($post) > 0) 
      {
        $process  = $this->M_users->update($post, $this->sess['users_name']);
        if ($process == TRUE) 
        {
          $msg      = "Data berhasil diupdate";
        }
      }

      $this->session->set_flashdata("msg", $msg);  
      redirect(base_url("users"));
    }

    function delete($users_uuid="")
    {      
      $msg  = "Gagal, silakan ulangi kembali!";
      $url  = "users/users";

      if ($users_uuid !== "") 
      {
        $process  = $this->M_users->delete($users_uuid, $this->sess['users_name']);
        if ($process == TRUE) 
        {
          $msg      = "User telah di hapus";
        }
      }

      $this->session->set_flashdata("danger", $msg);  
      redirect(base_url($url));
    }

    function reset_pass()
    {
      $post = $this->input->post();
      $users_uuid   = $post['users_uuid'];

      $status = "danger";
      $msg    = "failed reset password";
      if ($users_uuid != "") 
      {
        $process  = $this->M_users->resetPass($users_uuid);
        if ($process !== "") 
        {
          $status = "msg";
          $msg    = "Reset password menjadi = <b>".$process."</b>";
        }
      }

      $this->session->set_flashdata($status, $msg);
      redirect(base_url("users"));
    }

    function access($users_uuid="")
    {
      $data["page"]      = "User Access";
      $data["content"]   = "users/v_access";
      $data["users_uuid"]   = $users_uuid;
      $data["module"]       = $this->M_users->moduleList();
      $data["access_list"]  = $this->M_users->accessList($users_uuid);

      $this->load->view("app_template", $data);
    }


    function access_submit()
    {
      $post = $this->input->post();
      
      $msg = "failed, try again";
      if (isset($post['users_uuid'])) 
      {
        $msg = "gagal, silakan pilih module";
        if (isset($post['selected']) && count($post['selected']) > 0) 
        {
          $users_id = $this->M_users->getIdByUUID($post['users_uuid']);
          $selected = $post['selected'];

          /*
          cekk berdasarkan users_id 
          jika ada => update
          jikda tidak => save
          */
          $check  = $this->M_users->checkUserModule($users_id);
          if ($check > 0) 
          {
              // remove date
              $this->M_users->deleteUserModule($users_id);

              // insert data
              $this->_insertUserModule($users_id, $selected);
          } 
          else 
          {
              // save data
              $this->_insertUserModule($users_id, $selected);
          }

          $this->session->set_flashdata("msg", "Berhasil");
          redirect(base_url("users"));

        }
      }
      
      $this->session->set_flashdata("danger", $msg);
      redirect(base_url("users"));
    }

    function _insertUserModule($users_id=0, $selected=array())
    {
      $data = array();
      foreach ($selected as $key => $row) 
      {
        $data[] = array("users_id" => $users_id, "module_id" => $row);
      }
      $process = $this->M_users->saveUsersModule($data);

      // clear array
      $data = array();

      return TRUE;
    }

    function lblUserLevel($level)
    {
      $arr_level = array("Admin", "Ustadz", "Santri");

      return $arr_level[$level];
    }

 
}