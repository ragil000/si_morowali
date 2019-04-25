<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class ImportTest extends CI_Controller {
    // construct
    public function __construct() {
        parent::__construct();
        $this->load->library('MyConfig');
        $this->load->model("DataModel");
    }    

    function export($name='data')
    {
        // $session = $this->myconfig->getSession($this->input->post('session'), 0 , true);

        if(@$session['status'] || true){
            $this->load->model("DataModel");

            $jenis = $this->input->post('jenis');

            if($jenis == 'kelurahan'){
                $post['grup_id'] =  $this->input->post('id');
                $post['user_id'] = $session['id'];
                $post['table'] = 'ref_musrenbang';
            }else if($jenis == 'kecamatan'){
                $post['grup_id'] =  $this->input->post('id');
                $post['user_id'] = $session['id'];
                $post['table'] = 'ref_musrenbang_kecamatan';
            }else if($jenis == 'pokir'){
                $post['grup_id'] =  $this->input->post('id');
                $post['user_id'] = $session['id'];
                $post['table'] = 'ref_musrenbang_pokir';
            }
            
    
            $data = array();
            $data[0] = array( 'id' => 1, 'nama'=>'aku' );
            $data[1] = array( 'id' => 2, 'nama'=>'aku' );
            $data[2] = array( 'id' => 3, 'nama'=>'aku' );
            $data[3] = array( 'id' => 4, 'nama'=>'aku' );
    
            // print_r($data);
            $this->load->library("excel");
    
            $fileName = $name."-".time();
    
            $object = new PHPExcel();
    
            $object->setActiveSheetIndex(0);
    
            $table_columns = array(
                "ID",
                "Nama"
            );
    
            $column = 0;
    
            foreach($table_columns as $field)
            {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $column++;
            }
    
            
            $excel_row = 2;
    
            foreach($data as $row)
            {
            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row['id']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['nama']);
            $excel_row++;
            }
    
            $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'.$fileName.'.xls"');
            $object_writer->save('php://output');
        }

        
    }

    public function viewImport(){
        echo '<form action="importRek" method="POST"  enctype="multipart/form-data">
            <input type="file" name="file" />
            <input type="submit"  />
            </form>';
        
    }

    function importRek()
    {
        // $session = $this->myconfig->getSession($this->input->post('session'), 0 , true);
        // print_r($_POST);
        $this->load->library("excel");
        $pesan = "Gagal mengimport data";
        $status = false;
        if(isset($_FILES["file"]["name"]))
        {
        $path = $_FILES["file"]["tmp_name"];
        $object = PHPExcel_IOFactory::load($path);
        foreach($object->getWorksheetIterator() as $worksheet)
        {
            $highestRow = $worksheet->getHighestRow();
            $highestColumn = $worksheet->getHighestColumn();
            for($row=2; $row<=$highestRow; $row++)
            {
                

                for ($i=0; $i < 27; $i++) { 
                    $set[$i] = $worksheet->getCellByColumnAndRow($i, $row)->getValue();

                }

                $kirim = array(
                    // "user_id" => (int)$set[0], 
                    "Kd_Urusan" => (string)$set[1], 
                    "Kd_Bidang" => (string)$set[2], 
                    "Kd_Unit" => (string)$set[3], 
                    "Kd_Sub" => (int)$set[4], 
                    // "Nm_Rek_5" => (string)$set[5],
                    // "nama" => (string)$set[2],
                    // "alasan" => (string)$set[3],
                    // "lokasi" => (string)$set[4],
                    // "volume" => (string)$set[5],
                    // "satuan_id" => (int)$set[6],
                    // "kategori_id" => (int)$set[7],
                    // "pagu" => (string)$set[8],
                    // "pengusul" => (string)$set[9],
                    // "manfaat" => (string)$set[10],
                );
                // echo "<pre>";
                // print_r($kirim);
                // echo "</pre>";
                $status = $this->db->insert('ref_opd_visi', $kirim);
                 
                
                $pesan = "Berhasil menyimpan data";
            $status = true;
            }
        }
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        //    $this->excel_import_model->insert();
        // echo 'Data Imported successfully';
        } 
        $kirim = array(
            'status'=>$status,
            'pesan'=>$pesan
        );

        echo json_encode($kirim);
    }


    public function getPdf($name = 'asb')
  	{
        // $status = $this->myconfig->check($this->input->post('session'), $this->level);
        if(@$status || true){
            ini_set('max_execution_time', 0); 
            ini_set('memory_limit','2048M');
            //load mPDF library
            $this->load->library('M_pdf');
            
            // $paran = "miring";
            $paran = NULL;

            //load tampilan
            $html = $this->load->view('kecamatan/'.$jenis,$data, true); 
            // $this->load->view('kelurahan/'.$jenis,$data); 
           
            //nama file
            $pdfFilePath =$name."-".time()."-download.pdf";
         
            
            //actually, you can pass mPDF parameter on this load() function
            $pdf = $this->m_pdf->load($paran);
    
    
            $pdf->mirrorMargins = 1; // Use different Odd/Even headers and footers and mirror margins
    
            $pdf->defaultheaderfontsize = 10; /* in pts */
            $pdf->defaultheaderfontstyle = B; /* blank, B, I, or BI */
        //    $pdf->defaultheaderline = 1;  /* 1 to include line below header/above footer */

            $pdf->defaultfooterfontsize = 9; /* in pts */
            $pdf->defaultfooterfontstyle = I; /* blank, B, I, or BI */
            //$pdf->defaultfooterline = 1;  /* 1 to include line below header/above footer */

            $pdf->SetHeader('Dicetak dari: e-Perencanaan Kab. Morowali pada '.date("d").'-'.date("m").'-'.date("Y"));
            $pdf->SetFooter('Halaman {PAGENO}'); /* defines footer for Odd and Even Pages - placed at Outer margin */
            
            $pdf->AddPage('', // L - landscape, P - portrait 
                '', '', '', '',
                10, // margin_left
                10, // margin right
               20, // margin top
               20, // margin bottom
                0, // margin header
                0
            );
    
            //generate the PDF!
            $pdf->WriteHTML($html,2);
    
            //offer it to user via browser download! (The PDF won't be saved on your server HDD)
            $pdf->Output($pdfFilePath, "D");
        }else{
            echo "Download Gagal";
        }
  		
     
      
  	}

}
?>