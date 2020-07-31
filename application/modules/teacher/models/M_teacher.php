<?php

/**
* Model teacher
*/
class M_teacher extends CI_Model
{
	var $table = 'teacher';
  var $column_order 	= array(
  								'teacher_name',
  								'teacher_nohp',
                  'teacher_email', 
                  'teacher_last_education',
  								'teacher_majors',
                  'teacher_graduation_year', 
                  'created_date' 
  							); 
  var $column_search 	= array(
  								'teacher_name',
                  'teacher_nohp',
                  'teacher_email', 
                  'teacher_last_education',
                  'teacher_majors',
                  'teacher_graduation_year', 
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
    $this->db->from("teacher");
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
        "teacher_name"          => $post['teacher_name'],
        "teacher_gender"        => $post['teacher_gender'],
        "teacher_brithplace"    => $post['teacher_brithplace'],
        "teacher_brithdate"     => $post['teacher_brithdate'],
        "teacher_address"       => $post['teacher_address'],
        "teacher_nohp"          => $post['teacher_nohp'],
        "teacher_email"         => $post['teacher_email'],
        "teacher_last_education"=> $post['teacher_last_education'],
        "teacher_majors"        => $post['teacher_majors'],
        "teacher_universitas"   => $post['teacher_universitas'],
        "teacher_graduation_year"       => $post['teacher_graduation_year'],
        "teacher_institution_name"      => $post['teacher_institution_name'],
        "teacher_longtime_teaching"   => $post['teacher_longtime_teaching'],
				"created_by"				=> $users_id, 
				"created_date"			=> $datenow, 
			);
		
			$this->db->set("teacher_uuid", "UUID()", FALSE); 
			$saved = $this->db->insert("teacher", $data);
			
			return $saved;
		} 
	}

  public function edit($teacher_uuid="")
  {
    $result   = array();
    if ($teacher_uuid !="") 
    {
      $this->db->where("teacher_uuid", $teacher_uuid);
      $this->db->where("deleted", config("NOT_DELETED"));
      $query    = $this->db->get("teacher");
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
				"teacher_name"          => $post['teacher_name'],
        "teacher_gender"        => $post['teacher_gender'],
        "teacher_brithplace"    => $post['teacher_brithplace'],
        "teacher_brithdate"     => $post['teacher_brithdate'],
        "teacher_address"       => $post['teacher_address'],
        "teacher_nohp"          => $post['teacher_nohp'],
        "teacher_email"         => $post['teacher_email'],
        "teacher_last_education"=> $post['teacher_last_education'],
        "teacher_majors"        => $post['teacher_majors'],
        "teacher_universitas"   => $post['teacher_universitas'],
        "teacher_graduation_year"       => $post['teacher_graduation_year'],
        "teacher_institution_name"      => $post['teacher_institution_name'],
        "teacher_longtime_teaching"     => $post['teacher_longtime_teaching'],
				"modified_by"				      => $users_id, 
				"modified_date"			      => $datenow, 
			);
      
      $this->db->where("teacher_uuid", $post['teacher_uuid']);
      $update = $this->db->update("teacher", $data);
      
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
      $this->db->where("teacher_uuid", $uuid);
      $delete   = $this->db->update("teacher");

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