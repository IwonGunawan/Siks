<?php

/**
* Model guru
*/
class M_guru extends CI_Model
{

	var $table = 'guru';
  var $column_order 	= array(
  								'nama',
  								'nip',
                  'jk', 
                  'email',
  								'pendidikan_terakhir' 
  							); 
  var $column_search 	= array(
  								'nama',
                  'nip',
                  'jk', 
                  'email',
                  'pendidikan_terakhir' 
  							);
  var $order = array('dibuat_tgl' => 'DESC'); // default order 




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
    $this->db->select("*");
    $this->db->from("guru");
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
        "nama"            => $post['nama'],
        "nip"             => $post['nip'],
        "jk"              => $post['jk'],
        "tempat_lahir"    => $post['tempat_lahir'],
        "tgl_lahir"       => $post['tgl_lahir'],
        "alamat"          => $post['alamat'],
        "email"           => $post['email'],
        "nohp"            => $post['nohp'],
        "pendidikan_terakhir"   => $post['pendidikan_terakhir'],
        "bidang_ajar"     => json_encode($post['bidang_ajar']),
				"dibuat_oleh"			=> $users_id, 
				"dibuat_tgl"			=> $datenow, 
			);
		
			$this->db->set("uuid", "UUID()", FALSE); 
			$saved = $this->db->insert("guru", $data);
			
			return $saved; 
		} 
	}

  public function edit($guru_uuid="")
  {
    $result   = array();
    if ($guru_uuid !="") 
    {
      $this->db->where("uuid", $guru_uuid);
      $this->db->where("deleted", config("NOT_DELETED"));
      $query    = $this->db->get("guru");
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
				"nama"            => $post['nama'],
        "nip"             => $post['nip'],
        "jk"              => $post['jk'],
        "tempat_lahir"    => $post['tempat_lahir'],
        "tgl_lahir"       => $post['tgl_lahir'],
        "alamat"          => $post['alamat'],
        "email"           => $post['email'],
        "nohp"            => $post['nohp'],
        "pendidikan_terakhir"   => $post['pendidikan_terakhir'],
        "bidang_ajar"     => json_encode($post['bidang_ajar']),
				"diubah_oleh"     => $users_id, 
				"diubah_tgl"      => $datenow, 
			);
      
      $this->db->where("uuid", $post['uuid']);
      $update = $this->db->update("guru", $data);
      
      return $update;
    }
  }

  public function detail($rowData=array())
  {
  	
  	if (count($rowData) > 0) 
  	{
  		$rowData['dibuat_oleh']		= $this->changeBy($rowData['dibuat_oleh']);
  		$rowData['diubah_oleh']	  = ($rowData['diubah_oleh'] == null) ? "" : $this->changeBy($rowData['diubah_oleh']);
  	}

  	return $rowData;
  }

  public function delete($uuid="")
  {
    if ($uuid != "") 
    {
      $this->db->set("deleted", 1);
      $this->db->where("uuid", $uuid);
      $delete   = $this->db->update("guru");

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