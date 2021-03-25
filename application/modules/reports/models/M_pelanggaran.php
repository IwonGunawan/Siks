<?php

/**
* Model Pelanggaran
*/
class M_pelanggaran extends CI_Model
{ 
  public function __construct()
  {
      parent::__construct();
      $this->load->database();
  }

  function view_avg_all()
  {
    /**
    STEP BY STEP
    1. dibuat rata-rata per santri
    2. dibuat rata-rata semua santri dari hasil rata" santri
    **/

    $class_vii    = $this->_get_avg_all("VII");
    $class_viii   = $this->_get_avg_all("VIII");
    $class_ix     = $this->_get_avg_all("IX");

    // count average
    $avg1         = count($class_vii) > 0 ? array_sum($class_vii) / count($class_vii) : 0;
    $avg2         = count($class_viii) > 0 ? array_sum($class_viii) / count($class_viii) : 0;
    $avg3         = count($class_ix) > 0 ? array_sum($class_ix) / count($class_ix) : 0;

    $result       = array(
                      array(
                        "name"    => "Kelas VII", 
                        "y"       => $this->rounding($avg1)),
                      array(
                        "name"    => "Kelas VIII", 
                        "y"       => $this->rounding($avg2)),
                      array(
                        "name"    => "Kelas IX", 
                        "y"       => $this->rounding($avg3)),
                  );

    return $result;
  }

  function view_avg_class($santri_kelas="")
  {
    $result = $this->_get_avg_class($santri_kelas);

    if (count($result) > 0) 
    {
      foreach ($result as $key => $row) 
      {
        $result[$key] = array("name" => $row[0], "y" => $row[1]);
      }
    }

    
    return $result;
  }


  function _avg_query($santri_kelas="")
  {
    $monthly  = $this->monthly();

    $this->db->select("b.id, b.nama, b.kelas, a.pelanggaran_peristiwa");
    $this->db->from("pelanggaran as a");
    $this->db->join("santri as b", "a.santri_id=b.id", "LEFT");
    $this->db->where("a.created_date >=", $monthly[0]);
    $this->db->where("a.created_date <=", $monthly[1]);
    $this->db->where("b.kelas", $santri_kelas);
    $this->db->where("a.deleted", config("NOT_DELETED"));
    $this->db->order_by("b.id", "ASC");

    $query      = $this->db->get();
    $result = $query->result_array();

    return $result;
  }


  function _get_avg_all($santri_kelas="")
  {
    $result     = array();
    $arr_result = $this->_avg_query($santri_kelas);


    if (count($arr_result) > 0) 
    {
      $container_avg_santri   = array(); 
      $per_santri_temp        = array();
      foreach ($arr_result as $key => $row) 
      {
        if ($key == 0) 
        {
          array_push($per_santri_temp, $row['pelanggaran_peristiwa']); // first
        }
        else
        {
          if ($key == (count($arr_result) - 1)) // last looping
          {
            if ($row['id'] == $arr_result[$key - 1]['id']) 
            {
              array_push($per_santri_temp, $row['pelanggaran_peristiwa']);
            }else 
            {
              // 1. count per santri
              $count_per_santri     = array_sum($per_santri_temp);
              $avg_santri = array_push($container_avg_santri, $count_per_santri);

              // 2. reset per_santri_temp
              $per_santri_temp = array();

              // last
              array_push($per_santri_temp, $row['pelanggaran_peristiwa']);
            }

            // 3. count last santri
            $count_per_santri     = array_sum($per_santri_temp);
            $avg_santri = array_push($container_avg_santri, $count_per_santri);


            // print_r($container_avg_santri);
            // echo "end looping";
          }
          else if ($row['id'] == $arr_result[$key - 1]['id']) // group per santri
          {
            array_push($per_santri_temp, $row['pelanggaran_peristiwa']);
          }
          else
          {
            // 1. count per santri
            $count_per_santri     = array_sum($per_santri_temp);
            $avg_santri = array_push($container_avg_santri, $count_per_santri);

            // 2. reset per_santri_temp
            $per_santri_temp = array();

            // 3. set first again
            array_push($per_santri_temp, $row['pelanggaran_peristiwa']);
          }
        }
      }

      $result = $container_avg_santri;
    }

    return $result;
  }

  function _get_avg_class($santri_kelas="")
  {
    $result     = array();
    $arr_result = $this->_avg_query($santri_kelas);


    if (count($arr_result) > 0) 
    {
      $container_avg_santri   = array(); 
      $per_santri_temp        = array();
      foreach ($arr_result as $key => $row) 
      {
        if ($key == 0) 
        {
          array_push($per_santri_temp, $row['pelanggaran_peristiwa']); // first
        }
        else
        {
          if ($key == (count($arr_result) - 1)) // last looping
          {
            if ($row['id'] == $arr_result[$key - 1]['id']) 
            {
              array_push($per_santri_temp, $row['pelanggaran_peristiwa']);
            }else 
            {
              // 1. count per santri
              $count_per_santri     = array_sum($per_santri_temp);
              $avg_santri = array_push($container_avg_santri, array($arr_result[$key - 1]['nama'], $this->rounding($count_per_santri)) );

              // 2. reset per_santri_temp
              $per_santri_temp = array();

              // last
              array_push($per_santri_temp, $row['pelanggaran_peristiwa']);
            }

            // 3. count last santri
            $count_per_santri     = array_sum($per_santri_temp);
            $avg_santri = array_push($container_avg_santri, array($arr_result[$key]['nama'], $this->rounding($count_per_santri)) );


            // print_r($container_avg_santri);
            // echo "end looping";
          }
          else if ($row['id'] == $arr_result[$key - 1]['id']) // group per santri
          {
            array_push($per_santri_temp, $row['pelanggaran_peristiwa']);
          }
          else
          {
            // 1. count per santri
            $count_per_santri     = array_sum($per_santri_temp);
            $avg_santri = array_push($container_avg_santri, array($arr_result[$key - 1]['nama'], $this->rounding($count_per_santri)) );

            // 2. reset per_santri_temp
            $per_santri_temp = array();

            // 3. set first again
            array_push($per_santri_temp, $row['pelanggaran_peristiwa']);
          }
        }
      }

      $result = $container_avg_santri;
    }

    return $result;
  }

  function rounding($val=0)
  {
    return round($val, 1);
  }


  function weekly()
  {
    $monday = strtotime("last monday");
    $monday = date('w', $monday)==date('w') ? $monday+7*86400 : $monday;

    $sunday = strtotime(date("Y-m-d",$monday)." +6 days");

    $date_from  = date("Y-m-d",$monday);
    $date_to    = date("Y-m-d",$sunday);

    return array($date_from, $date_to);
   }
   
  function monthly()
  {
    $tday     = "01";
    $tmonth   = date("m");
    $tyear    = date("Y");

    $date_from  = date("Y-m-d", strtotime($tmonth.'/'.$tday.'/'.$tyear.' 00:00:00'));
    $date_to    = date("Y-m-d", strtotime('-1 second',strtotime('+1 month',strtotime($tmonth.'/'.$tday.'/'.$tyear.' 00:00:00'))));

    return array($date_from, $date_to);
  }

  
}