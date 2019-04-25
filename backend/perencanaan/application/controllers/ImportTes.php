<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class ImportTes extends CI_Controller {
    // construct
    public function __construct() {
        parent::__construct();
        $this->load->library('MyConfig');
        $this->load->model("DataModel");
    }    

    function export($name='data')
    {
        $session = $this->myconfig->getSession($this->input->post('session'), 0 , true);

        if($session['status']){
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
            
    
            $data = $this->DataModel->getDataAll($post);
    
            // print_r($data);
            $this->load->library("excel");
    
            $fileName = $name."-".time();
    
            $object = new PHPExcel();
    
            $object->setActiveSheetIndex(0);
    
            $table_columns = array(
                "user_id", 
                "grup_id",
                "nama",
                "alasan",
                "lokasi",
                "volume",
                "satuan_id",
                "kategori_id",
                "pagu",
                "pengusul",
                "manfaat",
                "file",
                "berkas_ba",
                "berkas_usulan",
                "tgl_input",
                "asal",
                "skor_keterdesakan",
                "skor_pertumbuhan",
                "skor_potensi",
                "skor_kemiskinan",
                "skor_manfaat",
                "skor_partisipasi",
                "skor_pelaksanaan",
                "skor_dokumen",
                "skor_total",
                "opd_user_id",
                "kd_asal",
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
            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row['user_id']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['grup_id']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['nama']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row['alasan']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row['lokasi']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row['volume']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row['satuan_id']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row['kategori_id']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $row['pagu']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $row['pengusul']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $row['manfaat']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $row['file']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, $row['berkas_ba']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, $row['berkas_usulan']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(14, $excel_row, $row['tgl_input']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(15, $excel_row, $row['asal']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(16, $excel_row, $row['skor_keterdesakan']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(17, $excel_row, $row['skor_pertumbuhan']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(18, $excel_row, $row['skor_potensi']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(19, $excel_row, $row['skor_kemiskinan']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(20, $excel_row, $row['skor_manfaat']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(21, $excel_row, $row['skor_partisipasi']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(22, $excel_row, $row['skor_pelaksanaan']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(23, $excel_row, $row['skor_dokumen']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(24, $excel_row, $row['skor_total']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(25, $excel_row, $row['opd_user_id']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(26, $excel_row, $row['kd_asal']);
            $excel_row++;
            }
    
            $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'.$fileName.'.xls"');
            $object_writer->save('php://output');
        }

        
    }

    public function viewImport(){
        echo '<form action="import" method="POST"  enctype="multipart/form-data">
            <input type="file" name="file" />
            <input type="submit"  />
            </form>';
        
    }

    function fetch()
    {
        $data = array(
            array('nama'=> 'aka', 'age'=> 19),
            array('nama'=> 'aka', 'age'=> 19),
            array('nama'=> 'aka', 'age'=> 19),
            array('nama'=> 'aka', 'age'=> 19),
        );
        $output = '
        <h3 align="center">Total Data - </h3>
        <table class="table table-striped table-bordered">
        <tr>
            <th>Customer Name</th>
            <th>Address</th>
            <th>City</th>
            <th>Postal Code</th>
            <th>Country</th>
        </tr>
        ';
        foreach($data as $row)
        {
        $output .= '
        <tr>
            <td>'.$row['nama'].'</td>
            <td>'.$row['age'].'</td>
        </tr>
        ';
        }
        $output .= '</table>';
        echo $output;
    }


    function import()
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
                    "user_id" => (int)$set[0], 
                    "grup_id" => (int)$set[1],
                    "nama" => (string)$set[2],
                    "alasan" => (string)$set[3],
                    "lokasi" => (string)$set[4],
                    "volume" => (string)$set[5],
                    "satuan_id" => (int)$set[6],
                    "kategori_id" => (int)$set[7],
                    "pagu" => (string)$set[8],
                    "pengusul" => (string)$set[9],
                    "manfaat" => (string)$set[10],
                    "file" => (string)$set[11],
                    "berkas_ba" => (string)$set[12],
                    "berkas_usulan" => (string)$set[13],
                    "tgl_input" => (string)$set[14],
                    "asal" => (int)$set[15],
                    "skor_keterdesakan" => (float)$set[16],
                    "skor_pertumbuhan" => (float)$set[17],
                    "skor_potensi" => (float)$set[18],
                    "skor_kemiskinan" => (float)$set[19],
                    "skor_manfaat" => (float)$set[20],
                    "skor_partisipasi" => (float)$set[21],
                    "skor_pelaksanaan" => (float)$set[22],
                    "skor_dokumen" => (float)$set[23],
                    "skor_total" => (float)$set[24],
                    "opd_user_id" => (int)$set[25],
                    "kd_asal" => (string)$set[26],
                );
                
                // $result = $this->DataModel->getDataAll($kirim);


                // if(@$this->input->post('jenis') == 'kecamatan'){

                //     if($row == 2){
                //         $grup_id = $kirim['grup_id'];
                //         $this->db->where('grup_id', $kirim['grup_id']);
                //         $cek = $this->db->get('ref_musrenbang_kecamatan');
                //         if(count($cek) != 0){
                //             $this->load->model("KecamatanModel");
                //             $grup_id = $this->KecamatanModel->createGrup($kirim['tgl_input'], (string)$session['id'])->id;
                //             $this->db->where('id', $grup_id);
                //             $this->db->update('ref_grup_musrenbang', ['user_kel'=>$kirim['user_id']]);
                //             $kirim['grup_id'] = $grup_id;
                //         }
                //     }
                    
                //     $kirim['grup_id'] = $grup_id;
                //     $status = $this->db->insert('ref_musrenbang_kecamatan', $kirim);
                    
                // }else{
                //     $status = $this->db->insert('ref_musrenbang_opd', $kirim);
                // }
                // $kirim['user_id'] = 1;
                $jenis = 2;
                if($jenis == 1){
                    $hilang = 'dusun';
                    $kirim['grup_id'] = 1;
                    $kirim['asal'] = 2;
    
                    $kirim['file'] = 'no-image.png';
    
                    $kirim['skor_keterdesakan'] = 1;
                    $kirim['skor_pertumbuhan'] = 44;
                    $kirim['skor_potensi'] = 11;
                    $kirim['skor_kemiskinan'] = 16;
                    $kirim['skor_manfaat'] = 21;
                    $kirim['skor_partisipasi'] = 49;
                    $kirim['skor_pelaksanaan'] = 31;
                    $kirim['skor_dokumen'] = 41;
                    $kirim['skor_total'] = 0.95;
    
                    
                    $username = $kirim['lokasi'];
                    
                    $this->db->where("username", "$username", 'after');
                    $cek = $this->db->get('user')->result_array();
                    
                    if(count($cek) == 0){
                        $username = str_replace("-"," ",$kirim['lokasi']);
                        $this->db->where("username", "$username", 'after');
                        $cek = $this->db->get('user')->result_array();
                    }
    
                    if(count($cek) == 0){
                        $username = str_replace("-","",$kirim['lokasi']);
                        $this->db->where("username", "$username");
                        $cek = $this->db->get('user')->result_array();
                    }
                    
                    if(count($cek) > 0){
                        print_r($kirim);
                        $indexKirim = count($cek)-1;
                        echo "<br>id =>".$cek[$indexKirim]['id']."<br>";
                        $kirim['user_id'] = $cek[$indexKirim]['id'];
                    }
                }
                
                $status = $this->db->insert('ref_musrenbang_opd', $kirim);
                
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

}
?>