<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');



class Tahfidz extends CI_Controller 
{
    public function __construct() 
    {
      parent::__construct();

      is_login();

      // library and model
      $this->load->model("M_tahfidz");
      $this->load->helper('global');
      $this->load->helper('config');
      $this->load->library('session');

      // session 
      $this->sess['users_id']    = $this->session->userdata('users_id');
      $this->sess['users_email']      = $this->session->userdata('users_email');
      $this->sess['users_level']      = $this->session->userdata('users_level');
    }
 
    public function index()
    {
      $data["page"]      = "Tahfidz";
      $data["content"]   = "tahfidz/v_index"; // i am here
      $this->load->view("app_template", $data);
    } 

    public function ajax_list()
    {
      $list = $this->M_tahfidz->getData();
     
      $data = array();
      $no   = $_POST['start'];
      foreach ($list as $key => $row) 
      {
          $no++;
          $content = array();

          $uuid  = $row['uuid'];
          $ttl   = $row['tempat_lahir'].", ".date("Y-m-d", strtotime($row['tgl_lahir']));


          $content[] = "<a href='".base_url('tahfidz/detail/'.$uuid)."'>".$row['nama']."</a>";
          $content[] = $row['no_induk'];
          $content[] = $row['nisn'];
          $content[] = ($row['jk'] == "F") ? "Wanita" : "Pria";
          $content[] = $ttl;
          $content[] = $row['ayah'];
          $content[] = $row['ibu'];
          $content[] = date("d/m/Y H:i", strtotime($row['dibuat_tgl']));

          
          $btn = "
                  <a class='table-action hover-primary' href='".base_url('tahfidz/edit/'.$uuid)."'><i class='ti-pencil'></i> Edit </a> | 
                  <a class='table-action hover-danger' href='".base_url('tahfidz/delete/'.$uuid)."' onclick='return confirm(\"HAPUS DATA ?\")'><i class='ti-trash'></i> Del</a>
                ";
          $content[]  = $btn;

          $data[] = $content;
      }

      $output = array(
                      "draw" => $_POST['draw'],
                      "recordsTotal" => $this->M_tahfidz->count_all(),
                      "recordsFiltered" => $this->M_tahfidz->count_filtered(),
                      "data" => $data,
              );

      echo json_encode($output);
    }

    public function create()
    {
      $data["page"]       = "Create";
      $data["content"]    = "tahfidz/v_create";
      
      $this->load->view("app_template", $data);
    }

    public function save()
    {
      $post   = $this->input->post();
      
      $msg  = "Failed, try again!";
      $url  = "tahfidz";

      if (count($post) > 0) 
      {
        $process  = $this->M_tahfidz->save($post, $this->sess['users_id']);
        if ($process > 0) 
        {
          $msg      = "Data saved successfully";
        }
      }

      $this->session->set_flashdata("msg", $msg);  
      redirect(base_url($url));
    }

    public function detail($tahfidz_uuid="") 
    {
      $rowData            = $this->M_tahfidz->edit($tahfidz_uuid);
      $data["page"]       = "Detail ".$rowData['nama'];
      $data["content"]    = "tahfidz/v_detail";

      if (count($rowData) > 0) 
      {
        $data["data"]       = $this->M_tahfidz->detail($rowData);
        
        $this->load->view("app_template", $data); 
      }
      else 
      {
        redirect(base_url('tahfidz'));  
      }
    }

    public function edit($tahfidz_uuid="")
    {
      if ($tahfidz_uuid != "") 
      {
        $data["page"]       = "Edit";
        $data["content"]    = "tahfidz/v_create";
        $data["row"]        = $this->M_tahfidz->edit($tahfidz_uuid);

        $this->load->view("app_template", $data);
      }
      else
      {
        $this->session->set_flashdata("msg", "Data not found");
        return redirect(base_url("tahfidz"));
      }
    }

    public function update()
    {
      $post   = $this->input->post();
      
      $msg  = "Failed, try again!";
      $url  = "tahfidz";

      if (count($post) > 0) 
      {
        $process  = $this->M_tahfidz->update($post, $this->sess['users_id']);
        if ($process > 0) 
        {
          $msg      = "Data has been changed";
        }
      }

      $this->session->set_flashdata("msg", $msg);  
      redirect(base_url($url));
    }

    public function delete($tahfidz_uuid="")
    {
      if ($tahfidz_uuid != "") 
      {
        $process = $this->M_tahfidz->delete($tahfidz_uuid);
        if ($process == TRUE) 
        {
          $msg = "Data deleted";
        }else
        {
          $msg = "Data failed to delete, try again!";
        }
      }
      else
      {
        $msg = "No Data available";
      }

      $this->session->set_flashdata("danger", $msg);
      return redirect(base_url("tahfidz"));
    }    
    /* END CRUD */
    

    public function export() 
    {
      $data["page"]       = "Export";
      $data["content"]    = "tahfidz/v_export";
      
      $this->load->view("app_template", $data);
    }

    public function exportSubmit()
    {
      $limit = $this->input->post("limit");
      if ($limit > 0 && $limit <=500) 
      {
        $this->exportProcess($limit);
      }
      else
      {
        echo "max limit export";
      }
    }

    public function exportProcess($limit=0)
    {
      $list = $this->M_tahfidz->exportAll($limit);
     
      $spreadsheet = new Spreadsheet;

      $spreadsheet->setActiveSheetIndex(0)
                  ->setCellValue('A1', 'No')
                  ->setCellValue('B1', 'Nama Lengkap')
                  ->setCellValue('C1', 'No Induk')
                  ->setCellValue('D1', 'NISN')
                  ->setCellValue('E1', 'JK')
                  ->setCellValue('F1', 'Tempat Lahir')
                  ->setCellValue('G1', 'Tanggal Lahir')
                  ->setCellValue('H1', 'Agama')
                  ->setCellValue('I1', 'Status dlm Keluarga')
                  ->setCellValue('J1', 'Anak ke-')
                  ->setCellValue('K1', 'Alamat')
                  ->setCellValue('L1', 'Asal Sekolah')
                  ->setCellValue('M1', 'Diterima dikelas')
                  ->setCellValue('N1', 'Tgl diterima')
                  ->setCellValue('O1', 'Ayah')
                  ->setCellValue('P1', 'Pekerjaan Ayah')
                  ->setCellValue('Q1', 'Ibu')
                  ->setCellValue('R1', 'Pekerjaan Ibu')
                  ->setCellValue('S1', 'Wali')
                  ->setCellValue('T1', 'Pekerjaan Wali');
                  

      $column = 2;
      $number = 1;
      foreach($list as $row) 
      {
         $spreadsheet->setActiveSheetIndex(0)
                     ->setCellValue('A' . $column, $number)
                     ->setCellValue('B' . $column, $row['nama'])
                     ->setCellValue('C' . $column, $row['no_induk'])
                     ->setCellValue('D' . $column, $row['nisn'])
                     ->setCellValue('E' . $column, $row['jk'])
                     ->setCellValue('F' . $column, $row['tempat_lahir'])
                     ->setCellValue('G' . $column, $row['tgl_lahir'])
                     ->setCellValue('H' . $column, $row['agama'])
                     ->setCellValue('I' . $column, $row['status'])
                     ->setCellValue('J' . $column, $row['anak_ke'])
                     ->setCellValue('K' . $column, $row['alamat'])
                     ->setCellValue('L' . $column, $row['asal_sekolah'])
                     ->setCellValue('M' . $column, $row['diterima_dikelas'])
                     ->setCellValue('N' . $column, $row['tgl_terima'])
                     ->setCellValue('O' . $column, $row['ayah'])
                     ->setCellValue('P' . $column, $row['ayah_pekerjaan'])
                     ->setCellValue('Q' . $column, $row['ibu'])
                     ->setCellValue('R' . $column, $row['ibu_pekerjaan'])
                     ->setCellValue('S' . $column, $row['wali'])
                     ->setCellValue('T' . $column, $row['wali_pekerjaan']);

           $column++;
           $number++;

      }

      $writer = new Xlsx($spreadsheet);

      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="tahfidz.xlsx"');
      header('Cache-Control: max-age=0');

      $writer->save('php://output');
    }


    public function import() 
    {
      $data["page"]       = "Import";
      $data["content"]    = "tahfidz/v_import";
      
      $this->load->view("app_template", $data);
    }

    public function importSubmit()
    {
      if(isset($_FILES["file_tahfidz"]["name"]))
      {
        $path = $_FILES["file_tahfidz"]["tmp_name"];

        $object = PHPExcel_IOFactory::load($path);

        foreach($object->getWorksheetIterator() as $worksheet)
        {
          $highestRow     = $worksheet->getHighestRow();

          $highestColumn  = $worksheet->getHighestColumn();

          // show data excel in table 
          $rowTotal   = $highestRow - 1;
          $output = '
                    <h3 align="center">Preview Data</h3>
                    <small>Total Data: '.$rowTotal.'</small>
                    <table class="table table-striped table-bordered">
                     <tr>
                        <th>Nama Lengkap</th>
                        <th>No Induk</th>
                        <th>NISN</th>
                        <th>JK</th>
                        <th>Tmp Lahir</th>
                        <th>Tgl Lahir</th>
                        <th>Agama</th>
                        <th>Status dlm Keluarga</th>
                        <th>Anak ke-</th>
                        <th>Alamat</th>
                        <th>Asal Sekolah</th>
                        <th>Diterima dikelas</th>
                        <th>Tgl diterima</th>
                        <th>Ayah</th>
                        <th>Pekerjaan Ayah</th>
                        <th>Ibu</th>
                        <th>Pekerjaan Ibu</th>
                        <th>Wali</th>
                        <th>Pekerjaan Wali</th>
                     </tr>';

                    for($row=2; $row<=$highestRow; $row++)
                    {

                       $nama          = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                       $no_induk      = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                       $nisn          = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                       $jk            = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                       $tempat_lahir  = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                       $tgl_lahir     = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                       $agama         = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                       $status        = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                       $anak_ke       = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                       $alamat        = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                       $asal_sekolah  = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                       $diterima_dikelas          = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                       $tgl_terima    = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                       $ayah          = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                       $ayah_pekerjaan            = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                       $ibu           = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
                       $ibu_pekerjaan = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
                       $wali          = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
                       $wali_pekerjaan            = $worksheet->getCellByColumnAndRow(18, $row)->getValue();
                       
                       $data[] = array(
                                'uuid'    => $this->uuid->v4(),
                                'nama'          => $nama,
                                'no_induk'      => $no_induk,
                                'nisn'          => $nisn,
                                'jk'            => $jk, 
                                'tempat_lahir'  => $tempat_lahir, 
                                'tgl_lahir'     => $tgl_lahir, 
                                'agama'         => $agama, 
                                'status'        => $status, 
                                'anak_ke'       => $anak_ke, 
                                'alamat'        => $alamat,
                                'asal_sekolah'  => $asal_sekolah, 
                                'diterima_dikelas'    => $diterima_dikelas, 
                                'tgl_terima'    => $tgl_terima, 
                                'ayah'          => $ayah, 
                                'ayah_pekerjaan'      => $ayah_pekerjaan, 
                                'ibu'           => $ibu, 
                                'ibu_pekerjaan' => $ibu_pekerjaan, 
                                'wali'          => $wali, 
                                'wali_pekerjaan'      => $wali_pekerjaan, 
                                'dibuat_tgl'    => date("Y-m-d H:i:s"), 
                                'dibuat_oleh'   => $this->sess['users_id']
                              );

          $output .= '
                      <tr>
                        <td>'.$nama.'</td>
                        <td>'.$no_induk.'</td>
                        <td>'.$nisn.'</td>
                        <td>'.$jk.'</td>
                        <td>'.$tempat_lahir.'</td>
                        <td>'.$tgl_lahir.'</td>
                        <td>'.$agama.'</td>
                        <td>'.$status.'</td>
                        <td>'.$anak_ke.'</td>
                        <td>'.$alamat.'</td>
                        <td>'.$asal_sekolah.'</td>
                        <td>'.$diterima_dikelas.'</td>
                        <td>'.$tgl_terima.'</td>
                        <td>'.$ayah.'</td>
                        <td>'.$ayah_pekerjaan.'</td>
                        <td>'.$ibu.'</td>
                        <td>'.$ibu_pekerjaan.'</td>
                        <td>'.$wali.'</td>
                        <td>'.$wali_pekerjaan.'</td>
                        </tr>
                        ';
                    } // end for
        }

    
        $output .= '</table>';


        $result = array(
                "table" => $output, 
                "data"  => json_encode($data),
                "link"  => base_url("tahfidz/importSave/".json_encode($data))
              );

        echo json_encode($result);
      }
    }

    public function importSave($data="")
    {
      $list = $this->input->post("text_tahfidz");
      $listDecode = json_decode($list, TRUE);

      if (count($listDecode) > 0) 
      {
        $this->M_tahfidz->exportSave($listDecode);
        $this->session->set_flashdata("msg", "Import data has been saved!");
      }
      else
      {
        $this->session->set_flashdata("danger", "No data available, try again!");
      }

      return redirect(base_url("tahfidz"));
    }

 
}