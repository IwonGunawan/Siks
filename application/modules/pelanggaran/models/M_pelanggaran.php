<?php

/**
* Model pelanggaran
*/
class M_pelanggaran extends CI_Model
{

	var $table = 'pelanggaran';
  var $column_order 	= array(
  								'b.nama'
  							); 
  var $column_search 	= array(
                  'a.created_date', 
                  'b.nama', 
                  'b.kelas',
                  'c.users_name',
                  "d.jp_judul",
  							);
  var $order = array('a.pelanggaran_id' => 'DESC'); // default order 




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
    $fields = array(
        "a.pelanggaran_id",
        "a.pelanggaran_uuid",
        "a.created_by",
        "a.created_date",
        "b.nama",
        "b.kelas",
        "c.users_name",
        "d.jp_judul"
    );

    return implode(",", $fields);
  }

	public function _query()
  {
    $this->db->select($this->_selected());
    $this->db->from("pelanggaran as a");
    $this->db->join("santri as b", "a.santri_id=b.id", "LEFT");
    $this->db->join("users as c", "a.created_by=c.users_id", "LEFT");
    $this->db->join("jp as d", "a.pelanggaran_peristiwa=d.jp_id", "LEFT");
    $this->db->where("a.deleted", config("NOT_DELETED"));

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
				"santri_id"                   => $post['santri_id'], 
        "pelanggaran_peristiwa"       => $post['pelanggaran_peristiwa'], 
        'pelanggaran_kronologi'       => $post['pelanggaran_kronologi'], 
        'pelanggaran_motif'           => $post['pelanggaran_motif'],
        "pelanggaran_solusi"          => $post['pelanggaran_solusi'],
				"created_by"			=> $users_id, 
				"created_date"		  => $datenow, 
			);

			$this->db->set("pelanggaran_uuid", "UUID()", FALSE); 
			$saved = $this->db->insert("pelanggaran", $data);
			
			return $saved;
		}
	}

  public function edit($uuid="")
  {
    $result   = array();
    if ($uuid !="") 
    {
      $this->db->select("pelanggaran.*, santri.id, santri.nama, santri.kelas, jp.jp_judul");
      $this->db->from("pelanggaran");
      $this->db->join("santri", "pelanggaran.santri_id=santri.id", "LEFT");
      $this->db->join("jp", "pelanggaran.pelanggaran_peristiwa=jp.jp_id", "LEFT");
      $this->db->where("pelanggaran.pelanggaran_uuid", $uuid);
      $this->db->where("pelanggaran.deleted", config("NOT_DELETED"));
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
				"santri_id"                   => $post['santri_id'], 
        "pelanggaran_peristiwa"       => $post['pelanggaran_peristiwa'], 
        'pelanggaran_kronologi'       => $post['pelanggaran_kronologi'], 
        'pelanggaran_motif'           => $post['pelanggaran_motif'],
        "pelanggaran_solusi"          => $post['pelanggaran_solusi'],
				"modified_by"			=> $users_id, 
				"modified_date"			=> $datenow, 
			);
      
      $this->db->where("pelanggaran_uuid", $post['pelanggaran_uuid']);
      $update = $this->db->update("pelanggaran", $data);
      
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
      $this->db->where("pelanggaran_uuid", $uuid);
      $delete   = $this->db->update("pelanggaran");

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

  function jpList()
  {
    $this->db->select("a.jp_id, a.jp_judul, a.jp_grup_id, b.jp_grup_judul");
    $this->db->from("jp as a");
    $this->db->join("jp_grup as b", "a.jp_grup_id=b.jp_grup_id", "LEFT");
    $this->db->where("a.isActive", 0);
    $query = $this->db->get();

    return $query->result_array();
  }

	
}