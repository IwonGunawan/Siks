<?php

/**
* Model Tahfidz
*/
class M_tahfidz extends CI_Model
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
                      array("Kelas VII", $this->rounding($avg1)),
                      array("Kelas VIII", $this->rounding($avg2)),
                      array("Kelas IX", $this->rounding($avg3)),
                  );

    return $result;
  }

  function view_avg_class($tahfidz_kelas="")
  {
    $result = $this->_get_avg_class($tahfidz_kelas);

    return $result;
  }

  function view_per_santri($users_email="")
  {
    $result = array();
    if ($users_email != "") 
    {
      // change users_email to santri_id
      $santri_id = $this->changeEmailToSantriID($users_email);
      if ($santri_id > 0) 
      {
          $content = $this->_get_avg_per_santri($santri_id);

          // set daily
          $daily = $this->daily();
          for ($i=$daily[0]; $i <= $daily[1] ; $i++) 
          { 
            $result[] = array(strval($i), 0);
          }

          // set content to daily
          foreach ($content as $key => $row) 
          {
            $date   = $row[0];
            $nilai  = $row[1];
            $result[$date - 1] = array($date, $nilai);
          }
      }
    }

    return $result;
  }

  function _get_avg_all($tahfidz_kelas="")
  {
    $result     = array();
    $arr_result = $this->_avg_query($tahfidz_kelas);


    if (count($arr_result) > 0) 
    {
      $container_avg_santri   = array(); 
      $per_santri_temp        = array();
      foreach ($arr_result as $key => $row) 
      {
        if ($key == 0) 
        {
          array_push($per_santri_temp, $row['tahfidz_nilai']); // first
        }
        else
        {
          if ($key == (count($arr_result) - 1)) // last looping
          {
            if ($row['id'] == $arr_result[$key - 1]['id']) 
            {
              array_push($per_santri_temp, $row['tahfidz_nilai']);
            }else 
            {
              // 1. count per santri
              $count_per_santri     = array_sum($per_santri_temp) / count($per_santri_temp);
              $avg_santri = array_push($container_avg_santri, $count_per_santri);

              // 2. reset per_santri_temp
              $per_santri_temp = array();

              // last
              array_push($per_santri_temp, $row['tahfidz_nilai']);
            }

            // 3. count last santri
            $count_per_santri     = array_sum($per_santri_temp) / count($per_santri_temp);
            $avg_santri = array_push($container_avg_santri, $count_per_santri);


            // print_r($container_avg_santri);
            // echo "end looping";
          }
          else if ($row['id'] == $arr_result[$key - 1]['id']) // group per santri
          {
            array_push($per_santri_temp, $row['tahfidz_nilai']);
          }
          else
          {
            // 1. count per santri
            $count_per_santri     = array_sum($per_santri_temp) / count($per_santri_temp);
            $avg_santri = array_push($container_avg_santri, $count_per_santri);

            // 2. reset per_santri_temp
            $per_santri_temp = array();

            // 3. set first again
            array_push($per_santri_temp, $row['tahfidz_nilai']);
          }
        }
      }

      $result = $container_avg_santri;
    }

    return $result;
  }

  function _get_avg_class($tahfidz_kelas="")
  {
    $result     = array();
    $arr_result = $this->_avg_query($tahfidz_kelas);


    if (count($arr_result) > 0) 
    {
      $container_avg_santri   = array(); 
      $per_santri_temp        = array();
      foreach ($arr_result as $key => $row) 
      {
        if ($key == 0) 
        {
          array_push($per_santri_temp, $row['tahfidz_nilai']); // first
        }
        else
        {
          if ($key == (count($arr_result) - 1)) // last looping
          {
            if ($row['id'] == $arr_result[$key - 1]['id']) 
            {
              array_push($per_santri_temp, $row['tahfidz_nilai']);
            }else 
            {
              // 1. count per santri
              $count_per_santri     = array_sum($per_santri_temp) / count($per_santri_temp);
              $avg_santri = array_push($container_avg_santri, array($arr_result[$key - 1]['nama'], $this->rounding($count_per_santri)) );

              // 2. reset per_santri_temp
              $per_santri_temp = array();

              // last
              array_push($per_santri_temp, $row['tahfidz_nilai']);
            }

            // 3. count last santri
            $count_per_santri     = array_sum($per_santri_temp) / count($per_santri_temp);
            $avg_santri = array_push($container_avg_santri, array($arr_result[$key]['nama'], $this->rounding($count_per_santri)) );


            // print_r($container_avg_santri);
            // echo "end looping";
          }
          else if ($row['id'] == $arr_result[$key - 1]['id']) // group per santri
          {
            array_push($per_santri_temp, $row['tahfidz_nilai']);
          }
          else
          {
            // 1. count per santri
            $count_per_santri     = array_sum($per_santri_temp) / count($per_santri_temp);
            $avg_santri = array_push($container_avg_santri, array($arr_result[$key - 1]['nama'], $this->rounding($count_per_santri)) );

            // 2. reset per_santri_temp
            $per_santri_temp = array();

            // 3. set first again
            array_push($per_santri_temp, $row['tahfidz_nilai']);
          }
        }
      }

      $result = $container_avg_santri;
    }

    return $result;
  }

  function _get_avg_per_santri($santri_id=0)
  {
    $result     = array();
    $arr_result = $this->_avg_query_per_santri($santri_id);

    if (count($arr_result) > 0) 
    {
      $container_avg_santri   = array(); 
      $per_santri_temp        = array();
      foreach ($arr_result as $key => $row) 
      {
        if ($key == 0) 
        {
          array_push($per_santri_temp, $row['tahfidz_nilai']); // first
        }
        else
        {
          if ($key == (count($arr_result) - 1)) // last looping
          {
            if ($row['created_date'] == $arr_result[$key - 1]['created_date']) 
            {
              array_push($per_santri_temp, $row['tahfidz_nilai']);
            }else 
            {
              // 1. count per santri
              $count_per_santri     = array_sum($per_santri_temp) / count($per_santri_temp);
              array_push($container_avg_santri, array($this->dayFormat($arr_result[$key - 1]['created_date']), $this->rounding($count_per_santri)) );

              // 2. reset per_santri_temp
              $per_santri_temp = array();

              // last
              array_push($per_santri_temp, $row['tahfidz_nilai']);
            }

            // 3. count last santri
            $count_per_santri     = array_sum($per_santri_temp) / count($per_santri_temp);
            array_push($container_avg_santri, array($this->dayFormat($arr_result[$key]['created_date']), $this->rounding($count_per_santri)) );


            // print_r($container_avg_santri);
            // echo "end looping";
          }
          else if ($row['created_date'] == $arr_result[$key - 1]['created_date']) // group per santri
          {
            array_push($per_santri_temp, $row['tahfidz_nilai']);
          }
          else
          {
            // 1. count per santri
            $count_per_santri     = array_sum($per_santri_temp) / count($per_santri_temp);
            array_push($container_avg_santri, array($this->dayFormat($arr_result[$key - 1]['created_date']), $this->rounding($count_per_santri)) );

            // 2. reset per_santri_temp
            $per_santri_temp = array();

            // 3. set first again
            array_push($per_santri_temp, $row['tahfidz_nilai']);
          }
        }
      }

      $result = $container_avg_santri;
    }

    return $result;
  }

  function _avg_query($tahfidz_kelas="")
  {
    $monthly  = $this->monthly();

    $this->db->select("b.id, b.nama, b.kelas, a.tahfidz_nilai");
    $this->db->from("tahfidz as a");
    $this->db->join("santri as b", "a.santri_id=b.id", "LEFT");
    $this->db->where("a.created_date >=", $monthly[0]);
    $this->db->where("a.created_date <=", $monthly[1]);
    $this->db->where("b.kelas", $tahfidz_kelas);
    $this->db->where("a.deleted", config("NOT_DELETED"));
    $this->db->order_by("b.id", "ASC");

    $query      = $this->db->get();
    $result = $query->result_array();

    return $result;
  }

  function _avg_query_per_santri($santri_id=0)
  {
    $monthly  = $this->monthly();

    $this->db->select("santri_id, tahfidz_nilai, DATE_FORMAT(created_date, '%Y-%m-%d') as created_date");
    $this->db->from("tahfidz");
    $this->db->where("created_date >=", $monthly[0]);
    $this->db->where("created_date <=", $monthly[1]);
    $this->db->where("santri_id", $santri_id);
    $this->db->where("deleted", config("NOT_DELETED"));
    $this->db->order_by("created_date", "ASC");

    $query      = $this->db->get();
    $result = $query->result_array();

    return $result;
  }

  function rounding($val=0)
  {
    return round($val, 1);
  }

  function dayFormat($created_date)
  {
    return date("d", strtotime($created_date));
  }

  function changeEmailToSantriID($users_email="")
  {
    $this->db->select("id as santri_id");
    $this->db->from("santri");
    $this->db->where("nisn", $users_email);
    $this->db->where("deleted", config("NOT_DELETED"));

    $query = $this->db->get();
    $result= $query->row_array();
    if (isset($result['santri_id'])) 
    {
      return $result['santri_id'];
    }

    return 0;
  }

  function daily()
  {
    $tday     = "01";
    $tmonth   = date("m");
    $tyear    = date("Y");

    $date_from  = 1;
    $date_to    = date("d", strtotime('-1 second',strtotime('+1 month',strtotime($tmonth.'/'.$tday.'/'.$tyear.' 00:00:00'))));

    return array($date_from, $date_to);
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