<?php

/**
* Model Ustadz
*/
class M_ustadz extends CI_Model
{

	var $table = 'ustadz';
  var $column_order 	= array(
  								'ustadz_nama',
  								'ustadz_nik',
                  'ustadz_jk', 
  							); 
  var $column_search 	= array(
  								'ustadz_nama',
                  'ustadz_nik',
                  'ustadz_jk', 
  							);
  var $order = array('created_date' => 'DESC'); // default order 




  public function __construct()
  {
      parent::__construct();
      $this->load->database();
  }

	/* CRUD DATA */
  public function getData()
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
    $this->db->select("ustadz_uuid, ustadz_nik, ustadz_nama, ustadz_jk, created_date");
    $this->db->from("ustadz");
    $this->db->where("deleted", config("NOT_DELETED"));

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


  public function count_all()
  {
    $this->db->from($this->table);
    return $this->db->count_all_results();
  }

  public function count_filtered()
  {
    $this->_query();
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function save($post=array(), $users_id=0)
	{
		if (count($post) > 0) 
		{
			//var defined
			$datenow 	= date("Y-m-d H:i:s");

			$data 	= array(
        "ustadz_nama"            => $post['ustadz_nama'],
        "ustadz_nik"             => $post['ustadz_nik'],
        "ustadz_jk"              => $post['ustadz_jk'],
        "ustadz_alamat"          => $post['ustadz_alamat'],
        "bidang_ajar_id"         => json_encode($post['bidang_ajar_id']),
				"created_by"			 => $users_id, 
				"created_date"			=> $datenow, 
			);
		
			$this->db->set("ustadz_uuid", "UUID()", FALSE); 
			$saved = $this->db->insert("ustadz", $data);
			
			return $saved; 
		} 
	}

  public function edit($ustadz_uuid="")
  {
    $result   = array();
    if ($ustadz_uuid !="") 
    {
      $this->db->where("ustadz_uuid", $ustadz_uuid);
      $this->db->where("deleted", config("NOT_DELETED"));
      $query    = $this->db->get("ustadz");
      $result   = $query->row_array();
    }

    return $result;
  }

  public function update($post=array(), $users_id=0)
  {
    if (count($post) > 0) 
    {
      //var defined
      $datenow  = date("Y-m-d H:i:s");

      $data 	= array(
				"ustadz_nama"            => $post['ustadz_nama'],
        "ustadz_nik"             => $post['ustadz_nik'],
        "ustadz_jk"              => $post['ustadz_jk'],
        "ustadz_alamat"          => $post['ustadz_alamat'],
        "bidang_ajar_id"         => json_encode($post['bidang_ajar_id']),
				"created_by"     => $users_id, 
				"created_date"      => $datenow, 
			);
      
      $this->db->where("ustadz_uuid", $post['ustadz_uuid']);
      $update = $this->db->update("ustadz", $data);
      
      return $update;
    }
  }

  public function detail($rowData=array())
  {
  	
  	if (count($rowData) > 0) 
  	{
  		$rowData['created_by']		= $this->changeBy($rowData['created_by']);
  		$rowData['modified_by']	  = ($rowData['modified_by'] == null) ? "" : $this->changeBy($rowData['modified_by']);
  	}

  	return $rowData;
  }

  public function delete($ustadz_uuid="")
  {
    if ($ustadz_uuid != "") 
    {
      $this->db->set("deleted", 1);
      $this->db->where("ustadz_uuid", $ustadz_uuid);
      $delete   = $this->db->update("ustadz");

      return TRUE;
    }

    return FALSE;
  }
	/* END CRUD DATA */

  public function changeBy($users_id=0)
  {
  	$result = "";
  	if ($users_id != null && $users_id > 0) 
  	{
  		$this->db->select("users_name");
  		$this->db->from("users");
  		$this->db->where("users_id", $users_id);
  		$query = $this->db->get()->row_array();

  		$result = $query['users_name'];
  	}

  	return $result;
  }

  public function listBidangAjar() {
    $this->db->select("id, judul");
    $this->db->from("bidang_ajar");
    $this->db->where("deleted", config("NOT_DELETED"));
    $get = $this->db->get();

    $result = $get->result_array();
    return $result;
  }

	
}