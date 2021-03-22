<?php

/**
* Model tahfidz
*/



class M_tahfidz extends CI_Model
{

	var $table = 'tahfidz';
  var $column_order 	= array(
  								'santri.nama',
                  'santri.kelas',
                  'tahfidz.tahfidz_waktu',
                  'tahfidz.tahfidz_nilai', 
                  'tahfidz.created_by',
                  'tahfidz.created_date' 
  							); 
  var $column_search 	= array(
  								'santri.nama',
                  'santri.kelas',
                  'tahfidz.tahfidz_waktu',
                  'tahfidz.tahfidz_nilai', 
                  'tahfidz.created_by',
                  'tahfidz.created_date' 
  							);
  var $order = array('tahfidz_id' => 'DESC'); // default order 




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

  function _selected()
  {
    $fields =  array(
            "santri.id",
            "santri.nama",
            "santri.kelas", 
            "tahfidz.tahfidz_uuid", 
            "tahfidz.tahfidz_waktu",
            "tahfidz.tahfidz_juz", 
            "tahfidz.tahfidz_surat", 
            "tahfidz.tahfidz_ayat", 
            "tahfidz.tahfidz_nilai",
            "tahfidz.created_date", 
            "tahfidz.created_by",
            "users.users_name"
    );

    return implode(",", $fields);
  }

	public function _query()
  {
    $this->db->select($this->_selected());
    $this->db->from("tahfidz");
    $this->db->join("santri", "tahfidz.santri_id=santri.id", "LEFT");
    $this->db->join("users", "tahfidz.created_by=users.users_id", "LEFT");
    $this->db->where("tahfidz.deleted", config("NOT_DELETED"));

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
				"santri_id"       => $post['santri_id'], 
        "tahfidz_waktu"   => $post['tahfidz_waktu'],
        "tahfidz_juz"     => $post['tahfidz_juz'], 
        "tahfidz_surat"   => $post['tahfidz_surat'],
        "tahfidz_ayat"    => $post['tahfidz_ayat'], 
        "tahfidz_status"  => $post['tahfidz_status'],
        "tahfidz_nilai"   => $post['tahfidz_nilai'],
        "tahfidz_catatan" => $post['tahfidz_catatan'],
				"created_by"			=> $users_id, 
				"created_date"		  => $datenow, 
			);

			$this->db->set("tahfidz_uuid", "UUID()", FALSE); 
			$saved = $this->db->insert("tahfidz", $data);
			
			return $saved;
		}
	}

  public function edit($uuid="")
  {
    $result   = array();
    if ($uuid !="") 
    {
      $this->db->select("tahfidz.*, santri.id, santri.nama, santri.kelas");
      $this->db->from("tahfidz");
      $this->db->join("santri", "santri.id=tahfidz.santri_id", "LEFT");
      $this->db->where("tahfidz.tahfidz_uuid", $uuid);
      $this->db->where("tahfidz.deleted", config("NOT_DELETED"));
      $query    = $this->db->get();
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
				"santri_id"       => $post['santri_id'], 
        "tahfidz_waktu"   => $post['tahfidz_waktu'],
        "tahfidz_juz"     => $post['tahfidz_juz'], 
        "tahfidz_surat"   => $post['tahfidz_surat'],
        "tahfidz_ayat"    => $post['tahfidz_ayat'], 
        "tahfidz_status"  => $post['tahfidz_status'],
        "tahfidz_nilai"   => $post['tahfidz_nilai'],
        "tahfidz_catatan" => $post['tahfidz_catatan'],
				"modified_by"			=> $users_id, 
				"modified_date"			=> $datenow, 
			);
      
      $this->db->where("tahfidz_uuid", $post['tahfidz_uuid']);
      $update = $this->db->update("tahfidz", $data);
      
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

  public function delete($uuid="")
  {
    if ($uuid != "") 
    {
      $this->db->set("deleted", 1);
      $this->db->where("tahfidz_uuid", $uuid);
      $delete   = $this->db->update("tahfidz");

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

	
}