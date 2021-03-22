<?php

/**
* Model Users
*/
class M_users extends CI_Model
{
  var $table = 'users';
  var $column_order   = array(
                        'users_name', 
                        'users_email', 
                        'users_level', 
                        'users_status'
                      );
  var $column_search  = array(
                        'users_name', 
                        'users_email', 
                        'users_level', 
                        'users_status'
                      ); 
  var $order          = array('users_id' => 'DESC'); // default order 

  public function __construct()
  {
      parent::__construct();
      $this->load->database();
  }

  /* CRUD DATA */
  public function listData()
  {
    $this->_query();

    if($_POST['length'] != -1)
    {
      $this->db->limit($_POST['length'], $_POST['start']);
    }
    $query = $this->db->get();
    
    return $query->result_array();
  }

  public function _query()
  {
    $this->db->where("deleted", config("NOT_DELETED"));
    $this->db->from($this->table);

    $i = 0;
 
    foreach ($this->column_search as $item) // loop column 
    {
      if($_POST['search']['value']) // if datatable send POST for search
      {
        if($i===0) // first loop
        {
            $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
            $this->db->like($item, $_POST['search']['value']);
        }
        else
        {
            $this->db->or_like($item, $_POST['search']['value']);
        }

        if(count($this->column_search) - 1 == $i) //last loop
            $this->db->group_end(); //close bracket
      }
      $i++;
    }
     
    if(isset($_POST['order'])) // here order processing
    {
        $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    } 
    else if(isset($this->order))
    {
        $order = $this->order;
        $this->db->order_by(key($order), $order[key($order)]);
    }
  }

  public function listDataCount()
  {
    $this->db->where("deleted", config('NOT_DELETED'));
    $this->db->from($this->table);
    return $this->db->count_all_results();
  }

  public function listDataFilter()
  {
    $this->_query();
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function save($post=array(), $users_name=0)
  {
    if (count($post) > 0) 
    {
      //var defined
      $result       = "";
      $datenow      = date("Y-m-d H:i:s");
      $random_pass  = $this->_randomPass();

      // 1. saved table users
      $data   = array(
        "users_name"      => $post['users_name'],
        "users_password"  => password_hash($random_pass, PASSWORD_DEFAULT), 
        "users_email"     => $post['users_email'], 
        "users_level"     => $post['users_level'], // 0=admin | 1=ustadz | 2=santri
        "users_status"    => $post['users_status'],  
        "created_date"    => $datenow, 
        "created_by"      => $users_name, 
      );
    
      $this->db->set("users_uuid", "UUID()", FALSE); 
      $this->db->insert("users", $data);
      $saved = $this->db->insert_id();

      if ($saved > 0) 
      {
        $result = $random_pass;
      }
    }

    return $result;
  }

  public function edit($users_uuid="")
  {
    $result   = array();
    if ($users_uuid !="") 
    {
      $this->db->where("users_uuid", $users_uuid);
      $this->db->where("deleted", config("NOT_DELETED"));

      $query    = $this->db->get("users");
      $result   = $query->row_array();
    }

    return $result;
  }

  public function update($post=array(), $users_name=0)
  {
    if (count($post) > 0) 
    {
      //var defined
      $datenow  = date("Y-m-d H:i:s");

      // 1. saved table users
      $data   = array(
        "users_name"      => $post['users_name'],
        "users_email"     => $post['users_email'], 
        "users_status"    => $post['users_status'], 
        "users_level"     => $post['users_level'],
        "modified_date"    => $datenow, 
        "modified_by"      => $users_name, 
      );
      
      $this->db->where("users_uuid", $post['users_uuid']);
      $this->db->update("users", $data);
     
      return TRUE;
    }

    return FALSE;
  }

  public function delete($users_uuid="", $users_name="")
  {
    if ($users_uuid != "") 
    {
      //var defined
      $datenow  = date("Y-m-d H:i:s");

      $this->db->set("deleted", config("DELETED"));
      $this->db->set("modified_date", $datenow);
      $this->db->set("modified_by", $users_name);
      $this->db->where("users_uuid", $users_uuid);
      $delete   = $this->db->update("users");

      return TRUE;
    }

    return FALSE;
  }
  /* END CRUD DATA */


  public function checkEmail($users_email="")
  {
    $this->db->from("users");
    $this->db->where("users_email", $users_email);
    $this->db->where("deleted", config("NOT_DELETED"));

    $query = $this->db->get();

    return $query->num_rows();
  }

  public function resetPass($users_uuid="")
  {
    $result       = "";
    $random_pass  = $this->_randomPass();
    
    $this->db->set("users_password", password_hash($random_pass, PASSWORD_DEFAULT));
    $this->db->where("users_uuid", $users_uuid);

    $query = $this->db->update("users");
  
    if ($query == 1) 
    {
      $result = $random_pass;
    }

    return $result;
  }

  function _randomPass() 
  {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass     = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) 
    {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }

    return implode($pass); //turn the array into a string
  }

  function accessList($users_uuid="")
  {
    $result = array();
    if ($users_uuid != "") 
    {
      // 1. get id
      $users_id = $this->getIdByUUID($users_uuid);

      // 2. main process
      $this->db->from("users_module");
      $this->db->where("users_id", $users_id);
      $query = $this->db->get()->result_array();

      if (count($query) > 0) 
      {
        foreach ($query as $key => $row) 
        {
          $module_id = $row['module_id'];
          // array_push($result, $module_id);
          $result[$key+1] = $module_id;
        }
      }
    }

    return $result;
  }

  function checkUserModule($users_id=0)
  {
    $result = 0;
    if ($users_id > 0) 
    {
      $this->db->from("users_module");
      $this->db->where("users_id", $users_id);

      $query = $this->db->get();
      $result = $query->num_rows();
    }

    return $result;
  }

  function saveUsersModule($data=array())
  {
    $result = FALSE;
    if (count($data) > 0) 
    {
      $saved = $this->db->insert_batch("users_module", $data);
      if ($saved) {
        return TRUE;
      }
    }

    return $result;
  }

  function deleteUserModule($users_id=0)
  {
    if ($users_id > 0) 
    {
      $this->db->where("users_id", $users_id);
      $this->db->delete("users_module");

      return TRUE;
    }

    return FALSE;
  }


  /* ================================ GLOBAL ================================ */
  public function getIdByUUID($users_uuid="")
  {
    $result = 0;
    if ($users_uuid != "") 
    {
      $this->db->select("users_id");
      $this->db->from("users");
      $this->db->where("users_uuid", $users_uuid);
      $this->db->where("deleted", config("NOT_DELETED"));

      $query = $this->db->get()->row_array();
      if (isset($query['users_id'])) 
      {
        $result = $query['users_id'];
      }
    }

    return $result;
  }

  public function moduleList()
  {
    $this->db->select("module_id, module_name, module_label");
    $this->db->from("module");
    $this->db->where("module_status", config("STATUS_ACTIVE"));
    $this->db->order_by("module_id", "ASC");

    $query = $this->db->get();
    $result = $query->result_array();

    return $result;
  }
  
}