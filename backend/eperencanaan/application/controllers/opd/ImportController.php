<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class ImportController extends CI_Controller {

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
            
            $this->load->model('opd/RenstraKabModel');
            $data = $this->RenstraKabModel->getAll(1, '', $post, true);
            // $data = $this->DataModel->getDataAll($post);
    
            // print_r($data);
            $this->load->library("excel");
    
            $fileName = $name."-".time();
    
            $object = new PHPExcel();
    
            $object->setActiveSheetIndex(0);

            
            $table_columns = array(
                "outcome", 
            );
            $column = 0;
    
            foreach($table_columns as $field)
            {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $column++;
            }
    
            
            // $excel_row = 2;
    
            // foreach($data as $row)
            // {
            // $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row['user_id']);
            // $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['grup_id']);
            // $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['nama']);
            // $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row['alasan']);
            // $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row['lokasi']);
            // $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row['volume']);
            // $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row['satuan_id']);
            // $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row['kategori_id']);
            // $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $row['pagu']);
            // $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $row['pengusul']);
            // $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $row['manfaat']);
            // $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $row['file']);
            // $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, $row['berkas_ba']);
            // $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, $row['berkas_usulan']);
            // $object->getActiveSheet()->setCellValueByColumnAndRow(14, $excel_row, $row['tgl_input']);
            // $object->getActiveSheet()->setCellValueByColumnAndRow(15, $excel_row, $row['asal']);
            // $object->getActiveSheet()->setCellValueByColumnAndRow(16, $excel_row, $row['skor_keterdesakan']);
            // $object->getActiveSheet()->setCellValueByColumnAndRow(17, $excel_row, $row['skor_pertumbuhan']);
            // $object->getActiveSheet()->setCellValueByColumnAndRow(18, $excel_row, $row['skor_potensi']);
            // $object->getActiveSheet()->setCellValueByColumnAndRow(19, $excel_row, $row['skor_kemiskinan']);
            // $object->getActiveSheet()->setCellValueByColumnAndRow(20, $excel_row, $row['skor_manfaat']);
            // $object->getActiveSheet()->setCellValueByColumnAndRow(21, $excel_row, $row['skor_partisipasi']);
            // $object->getActiveSheet()->setCellValueByColumnAndRow(22, $excel_row, $row['skor_pelaksanaan']);
            // $object->getActiveSheet()->setCellValueByColumnAndRow(23, $excel_row, $row['skor_dokumen']);
            // $object->getActiveSheet()->setCellValueByColumnAndRow(24, $excel_row, $row['skor_total']);
            // $object->getActiveSheet()->setCellValueByColumnAndRow(25, $excel_row, $row['opd_user_id']);
            // $object->getActiveSheet()->setCellValueByColumnAndRow(26, $excel_row, $row['kd_asal']);
            // $excel_row++;
            // }
    
            $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'.$fileName.'.xls"');
            $object_writer->save('php://output');
        }

        
    }
    
}