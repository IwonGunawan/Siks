<?php

/**
* Model santri
*/
class M_santri extends CI_Model
{

	var $table = 'santri';
  var $column_order 	= array(
  								'no_induk',
  								'nisn',
                  'nama', 
                  'jk',
  								'tempat_lahir',
                  'tgl_lahir',
                  'ayah', 
                  'ibu',
                  'wali', 
                  'created_date' 
  							); 
  var $column_search 	= array(
  								'no_induk',
                  'nisn',
                  'nama', 
                  'jk',
                  'tempat_lahir',
                  'tgl_lahir',
                  'ayah', 
                  'ibu',
                  'wali'
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
    $this->db->select("*");
    $this->db->from("santri");
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
				"no_induk"        => $post['no_induk'], 
				"nisn"            => $post['nisn'], 
				"nama"            => $post['nama'],
        "jk"              => $post['jk'],
        "tempat_lahir"    => $post['tempat_lahir'], 
				"tgl_lahir"		    => $post['tgl_lahir'], 
        "agama"           => $post['agama'], 
        "status"          => $post['status'], 
        "anak_ke"         => $post['anak_ke'], 
        "alamat"          => $post['alamat'], 
        "asal_sekolah"    => $post['asal_sekolah'],
        "diterima_dikelas"  => $post['diterima_dikelas'], 
        "tgl_terima"      => ($post['tgl_terima'] != "") ? $post['tgl_terima'] : null,
        "ayah"            => $post['ayah'], 
        "ayah_pekerjaan"  => $post['ayah_pekerjaan'],
        "ibu"             => $post['ibu'], 
        "ibu_pekerjaan"   => $post['ibu_pekerjaan'], 
        "wali"            => $post['wali'],
        "wali_pekerjaan"  => $post['wali_pekerjaan'],
				"created_by"			=> $users_id, 
				"created_date"		  => $datenow, 
			);
		 
			$this->db->set("uuid", "UUID()", FALSE); 
			$saved = $this->db->insert("santri", $data);
			
			return $saved;
		}
	}

  public function edit($uuid="")
  {
    $result   = array();
    if ($uuid !="") 
    {
      $this->db->where("uuid", $uuid);
      $this->db->where("deleted", config("NOT_DELETED"));
      $query    = $this->db->get("santri");
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
				"no_induk"        => $post['no_induk'], 
        "nisn"            => $post['nisn'], 
        "nama"            => $post['nama'],
        "jk"              => $post['jk'],
        "tempat_lahir"    => $post['tempat_lahir'], 
        "tgl_lahir"       => $post['tgl_lahir'], 
        "agama"           => $post['agama'], 
        "status"          => $post['status'], 
        "anak_ke"         => $post['anak_ke'], 
        "alamat"          => $post['alamat'], 
        "asal_sekolah"    => $post['asal_sekolah'],
        "diterima_dikelas"  => $post['diterima_dikelas'], 
        "tgl_terima"      => $post['tgl_terima'],
        "ayah"            => $post['ayah'], 
        "ayah_pekerjaan"  => $post['ayah_pekerjaan'],
        "ibu"             => $post['ibu'], 
        "ibu_pekerjaan"   => $post['ibu_pekerjaan'], 
        "wali"            => $post['wali'],
        "wali_pekerjaan"  => $post['wali_pekerjaan'],
				"modified_by"			=> $users_id, 
				"modified_date"			=> $datenow, 
			);
      
      $this->db->where("uuid", $post['uuid']);
      $update = $this->db->update("santri", $data);
      
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
      $this->db->where("uuid", $uuid);
      $delete   = $this->db->update("santri");

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

  public function exportAll($limit=0)
  {
    $this->db->from("santri");
    $this->db->where("deleted", config("NOT_DELETED"));
    
    if ($limit > 1) 
    {
      $this->db->limit($limit, 0);
    }

    $query  = $this->db->get();
    $result = $query->result_array();

    return $result;
  }

  public function exportSave($data=array())
  {
    $this->db->insert_batch('santri', $data);
  }


  /* ======================== GLOBAL ======================== */
  public function santriList() 
  {
    $this->db->select("id as santri_id, uuid as santri_uuid, nama as santri_nama, no_induk");
    $this->db->from("santri");
    $this->db->where("deleted", config("NOT_DELETED"));
    $this->db->order_by("nama", "ASC");

    $query = $this->db->get();
    $result = $query->result_array();

    return $result;
  }

	
}