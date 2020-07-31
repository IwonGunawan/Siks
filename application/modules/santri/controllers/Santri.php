<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

// Export
require('./application/third_party/phpoffice/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class Santri extends CI_Controller 
{
    public function __construct() 
    {
      parent::__construct();

      is_login();

      // library and model
      $this->load->model("M_santri");
      $this->load->helper('global');
      $this->load->helper('config');
      $this->load->library('session');
      $this->load->library('excel'); // Import excel
      $this->load->library('uuid');

      // session 
      $this->sess['users_id']    = $this->session->userdata('users_id');
      $this->sess['users_email']      = $this->session->userdata('users_email');
      $this->sess['users_level']      = $this->session->userdata('users_level');
    }
 
    public function index()
    {
      $data["page"]      = "Santri";
      $data["content"]   = "santri/v_index";
      $this->load->view("app_template", $data);
    } 

    public function ajax_list()
    {
      $list = $this->M_santri->getData();
      
      
      $data = array();
      $no   = $_POST['start'];
      foreach ($list as $key => $row) 
      {
          $no++;
          $content = array();

          $santri_uuid = $row['santri_uuid'];
          $santri_name = $row['santri_first_name']." ".$row['santri_last_name'];
          $birthdate   = $row['santri_birthplace'].", ".date("Y-m-d", strtotime($row['santri_birthdate']));

          $content[] = "<a href='".base_url('santri/detail/'.$santri_uuid)."'>".$santri_name."</a>";
          $content[] = ($row['santri_gender'] == "F") ? "Wanita" : "Pria";
          $content[] = $birthdate;
          $content[] = $row['santri_father_name'];
          $content[] = $row['santri_mother_name'];
          $content[] = date("Y-m-d H:i:s", strtotime($row['created_date']));

          
          $btn = "
                  <a class='table-action hover-primary' href='".base_url('santri/edit/'.$santri_uuid)."'><i class='ti-pencil'></i> Edit </a> | 
                  <a class='table-action hover-danger' href='".base_url('santri/delete/'.$santri_uuid)."' onclick='return confirm(\"DELETE DATA ?\")'><i class='ti-trash'></i> Del</a>
                ";
          $content[]  = $btn;

          $data[] = $content;
      }

      $output = array(
                      "draw" => $_POST['draw'],
                      "recordsTotal" => $this->M_santri->count_all(),
                      "recordsFiltered" => $this->M_santri->count_filtered(),
                      "data" => $data,
              );
      echo json_encode($output);
    }

    public function create()
    {
      $data["page"]       = "Create";
      $data["content"]    = "santri/v_create";
      
      $this->load->view("app_template", $data);
    }

    public function save()
    {
      $post   = $this->input->post();
      
      $msg  = "Failed, try again!";
      $url  = "santri";

      if (count($post) > 0) 
      {
        $process  = $this->M_santri->save($post, $this->sess['users_id']);
        if ($process > 0) 
        {
          $msg      = "Data saved successfully";
        }
      }

      $this->session->set_flashdata("msg", $msg);  
      redirect(base_url($url));
    }

    public function detail($santri_uuid="") 
    {
      $rowData            = $this->M_santri->edit($santri_uuid);
      $data["page"]       = "Detail ".$rowData['santri_first_name'];
      $data["content"]    = "santri/v_detail";

      if (count($rowData) > 0) 
      {
        $data["data"]       = $this->M_santri->detail($rowData);
        
        $this->load->view("app_template", $data); 
      }
      else 
      {
        redirect(base_url('santri'));  
      }
    }

    public function edit($santri_uuid="")
    {
      if ($santri_uuid != "") 
      {
        $data["page"]       = "Edit";
        $data["content"]    = "santri/v_create";
        $data["row"]        = $this->M_santri->edit($santri_uuid);

        $this->load->view("app_template", $data);
      }
      else
      {
        $this->session->set_flashdata("msg", "Data not found");
        return redirect(base_url("santri"));
      }
    }

    public function update()
    {
      $post   = $this->input->post();
      
      $msg  = "Failed, try again!";
      $url  = "santri";

      if (count($post) > 0) 
      {
        $process  = $this->M_santri->update($post, $this->sess['users_id']);
        if ($process > 0) 
        {
          $msg      = "Data has been changed";
        }
      }

      $this->session->set_flashdata("msg", $msg);  
      redirect(base_url($url));
    }

    public function delete($santri_uuid="")
    {
      if ($santri_uuid != "") 
      {
        $process = $this->M_santri->delete($santri_uuid);
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
      return redirect(base_url("santri"));
    }    
    /* END CRUD */
    

    public function export() 
    {
      $data["page"]       = "Export";
      $data["content"]    = "santri/v_export";
      
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
      $list = $this->M_santri->exportAll($limit);
     
      $spreadsheet = new Spreadsheet;

      $spreadsheet->setActiveSheetIndex(0)
                  ->setCellValue('A1', 'No')
                  ->setCellValue('B1', 'Nama Depan')
                  ->setCellValue('C1', 'Nama Belakang')
                  ->setCellValue('D1', 'JK')
                  ->setCellValue('E1', 'Tempat Lahir')
                  ->setCellValue('F1', 'Tanggal Lahir')
                  ->setCellValue('G1', 'Alamat')
                  ->setCellValue('H1', 'No Hp')
                  ->setCellValue('I1', 'Nama Ayah')
                  ->setCellValue('J1', 'Pekerjaan Ayah')
                  ->setCellValue('K1', 'Nama Ibu')
                  ->setCellValue('L1', 'Pekerjaan Ibu');

      $column = 2;
      $number = 1;
      foreach($list as $row) 
      {
         $spreadsheet->setActiveSheetIndex(0)
                     ->setCellValue('A' . $column, $number)
                     ->setCellValue('B' . $column, $row['santri_first_name'])
                     ->setCellValue('C' . $column, $row['santri_last_name'])
                     ->setCellValue('D' . $column, $row['santri_gender'])
                     ->setCellValue('E' . $column, $row['santri_birthplace'])
                     ->setCellValue('F' . $column, $row['santri_birthdate'])
                     ->setCellValue('G' . $column, $row['santri_address'])
                     ->setCellValue('H' . $column, $row['santri_nohp'])
                     ->setCellValue('I' . $column, $row['santri_father_name'])
                     ->setCellValue('J' . $column, $row['santri_father_job'])
                     ->setCellValue('K' . $column, $row['santri_mother_name'])
                     ->setCellValue('L' . $column, $row['santri_mother_job']);

           $column++;
           $number++;

      }

      $writer = new Xlsx($spreadsheet);

      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="santri.xlsx"');
      header('Cache-Control: max-age=0');

      $writer->save('php://output');
    }


    public function import() 
    {
      $data["page"]       = "Import";
      $data["content"]    = "santri/v_import";
      
      $this->load->view("app_template", $data);
    }

    public function importSubmit()
    {
      if(isset($_FILES["file_santri"]["name"]))
      {
        $path = $_FILES["file_santri"]["tmp_name"];

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
                        <th>Nama Depan</th>
                        <th>Nama Belakang</th>
                        <th>JK</th>
                        <th>Tmp Lahir</th>
                        <th>Tgl Lahir</th>
                        <th>Alamat</th>
                        <th>No HP</th>
                        <th>Nama Ayah</th>
                        <th>Pekerjaan Ayah</th>
                        <th>Nama Ibu</th>
                        <th>Pekerjaan Ibu</th>
                     </tr>';

                    for($row=2; $row<=$highestRow; $row++)
                    {

                       $first_name      = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                       $last_name       = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                       $gender          = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                       $birthplace      = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                       $birthdate       = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                       $address         = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                       $nohp            = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                       $father_name     = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                       $father_job      = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                       $mother_name     = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                       $mother_job      = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                       
                       $data[] = array(
                                'santri_uuid'    => $this->uuid->v4(),
                                'santri_first_name'    => $first_name,
                                'santri_last_name'   => $last_name,
                                'santri_gender'  => $gender,
                                'santri_birthplace' => $birthplace, 
                                'santri_birthdate' => $birthdate, 
                                'santri_address' => $address, 
                                'santri_nohp' => $nohp, 
                                'santri_father_name' => $father_name, 
                                'santri_father_job' => $father_job, 
                                'santri_mother_name' => $mother_name, 
                                'santri_mother_job' => $mother_job
                              );

          $output .= '
                      <tr>
                        <td>'.$first_name.'</td>
                        <td>'.$last_name.'</td>
                        <td>'.$gender.'</td>
                        <td>'.$birthplace.'</td>
                        <td>'.$birthdate.'</td>
                        <td>'.$address.'</td>
                        <td>'.$nohp.'</td>
                        <td>'.$father_name.'</td>
                        <td>'.$father_job.'</td>
                        <td>'.$mother_name.'</td>
                        <td>'.$mother_job.'</td>
                        </tr>
                        ';
                    } // end for
        }

    
        $output .= '</table>';


        $result = array(
                "table" => $output, 
                "data"  => json_encode($data),
                "link"  => base_url("santri/importSave/".json_encode($data))
              );

        echo json_encode($result);
      }
    }

    public function importSave($data="")
    {
      $list = $this->input->post("text_santri");
      $listDecode = json_decode($list, TRUE);

      if (count($listDecode) > 0) 
      {
        $this->M_santri->exportSave($listDecode);
        $this->session->set_flashdata("msg", "Import data has been saved!");
      }
      else
      {
        $this->session->set_flashdata("danger", "No data available, try again!");
      }

      return redirect(base_url("santri"));
    }

 
}