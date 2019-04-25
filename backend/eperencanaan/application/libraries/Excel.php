<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 *  ======================================= 
 *  Author     : Team Tech Arise 
 *  License    : Protected 
 *  Email      : info@techarise.com 
 * 
 *  ======================================= 
 */
require_once APPPATH . "/third_party/PHPExcel.php";
class Excel extends PHPExcel {
    public function __construct() {
        parent::__construct();
    }

    function export($name='data')
    {
        // $this->load->model("DataModel");
        
        $data = array();
        $data[0] = array( 'id' => 1, 'nama'=>'aku' );
        $data[1] = array( 'id' => 2, 'nama'=>'aku' );
        $data[2] = array( 'id' => 3, 'nama'=>'aku' );
        $data[3] = array( 'id' => 4, 'nama'=>'aku' );

        // print_r($data);
        // $this->load->library("excel");

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
?>