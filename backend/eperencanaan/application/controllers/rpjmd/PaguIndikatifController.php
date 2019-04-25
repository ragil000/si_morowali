<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PaguIndikatifController extends CI_Controller {

    private $level, $akun;
	public function __construct()
    {
		parent::__construct();
        $this->load->library('MyConfig');
        $this->load->model('rpjmd/PaguIndikatifModel');
        $this->level = 1;
        $this->akun = 2;
    }

    public function getData($page = 1, $save = ''){

        
        $jumDataAll = 0;
        $status = false;
        $session = $this->myconfig->getSession($this->input->post('session'), $this->level, $this->akun);
        if(@$session['status']){
            $status = $session['status'];
        }
        // echo "sdf";
        // die();
        // // echo "sdf";
		if($status){
            $search = '';
            if(@$this->input->post('search')){
                $search = $this->input->post('search');
            }

            $post = $this->input->post();
            $post['user_id'] = $session['id'];

            if($save != ''){
                $post['all'] = true;
            }

            $data = $this->PaguIndikatifModel->getAll($page, $search, $post);
            
            $dataAll = array();
            $no=0;
            $temp = 0;
            foreach($data as $key){
                if($temp != $key['Kd_Urusan']){
                    $temp = $key['Kd_Urusan'];
                    $dataAll[$no] = $key;
                    $no++;
                }
                $dataAll[$no] = $key;

                $no++;
            }

            // $dataAll
            $jumDataAll = $this->PaguIndikatifModel->getCount($search, $post);
            $jumlahDatainPage = $this->PaguIndikatifModel->getJumlahInPage();
            $jumlahPage = ceil($jumDataAll/$jumlahDatainPage);
            $dataTambah =array();
            $this->load->model('rpjmd/DataModel');
            $dataUrusan = $this->DataModel->getUrusan();

		}else{
            $dataAll = array();
            $dataUrusan = array();
            $jumlahPage = 1;
            $dataTambah = '';
        }
        
        
		$kirim = array(
            'jumlahAll' => $jumDataAll,
            'jumlahPage' => $jumlahPage,
            'dataTambah'=>$dataTambah,
            'dataUrusan'=>$dataUrusan,
			'data' => $dataAll,
			'status' => $status,
        );
        
        if($save == 'pdf'){
            $this->load->library('M_pdf');
            $this->m_pdf->getPdf('pagu-indikatif', 'rpjmd/pagu-indikatif', $kirim);
        }else if($save == 'excel'){
            $this->exportExcel('pagu-indikatif', $kirim['data']);
        }else{
            echo json_encode($kirim);
        }
    }
    
    public function create(){
        $status = false;
        $session = $this->myconfig->getSession($this->input->post('session'), $this->level, $this->akun);
        if(@$session['status']){
            $status = $session['status'];
        }
        $pesan = "Gagal Memasukkan data";
        // print_r($this->input->post());
        if($status){
            $post = $this->input->post();
            $post['user_id'] = $session['id'];
            // print_r($post);
            $status = $this->PaguIndikatifModel->create($post);
            if($status)
                $pesan = "Berhasil Memasukkan Data";
        }
        // print_r($post['foto']);
        $kirim = array(
            'pesan' => $pesan,
			'status' => $status
		);
		echo json_encode($kirim);

    }

    public function update(){
        $status = false;
        $session = $this->myconfig->getSession($this->input->post('session'), $this->level, $this->akun);
        if(@$session['status']){
            $status = $session['status'];
        }
        // echo "sd";
        $pesan = "Gagal Mengubah data";
        // print_r($this->input->post());
        if($status){
            $post = $this->input->post();
            $post['user_id'] = $session['id'];
            // print_r($_FILES);
            $status = $this->PaguIndikatifModel->update($post);
            if($status)
                $pesan = "Berhasil Mengubah Data";
        }

        $kirim = array(
            'pesan' => $pesan,
			'status' => $status
		);
		echo json_encode($kirim);

    }

    public function delete(){
        $status = false;
        $session = $this->myconfig->getSession($this->input->post('session'), $this->level, $this->akun);
        if(@$session['status']){
            $status = $session['status'];
        }
        $pesan = "Gagal Menghapus data";
        // print_r($this->input->post());
        if($status){
            $post = $this->input->post();
            $post['user_id'] = $session['id'];
            $status = $this->PaguIndikatifModel->delete($post);
            if($status)
                $pesan = "Berhasil Menghapus Data";
        }

        $kirim = array(
            'pesan' => $pesan,
			'status' => $status
		);
		echo json_encode($kirim);
    }

    function exportExcel($name='data', $data)
    {
        $this->load->library("excel");

        $fileName = $name."-".time();

        $object = new PHPExcel();

        $object->setActiveSheetIndex(0);

        $table_columns = array(
            array(
                "Kode",
                "Urusan Penunjang",
                "Prakiraan Pagu Indikatif",
                "",
                "",
                "",
                "",
            ),
            array(
                "",
                "",
                "Tahun 1",
                "Tahun 2",
                "Tahun 3",
                "Tahun 4",
                "Tahun 5",
            )

        );

        $column = 0;
        $row = 1;
        foreach($table_columns as $field)
        {
            $column = 0;
            foreach($field as $field2){
                $object->getActiveSheet()->setCellValueByColumnAndRow($column, $row, $field2);
                $column++;
            }
            $row++;            
        }

        $kd_Urusan_old = 0;
        $excel_row = $row;
        $nomor = 1;
        // print_r($data);
        foreach($data as $row)
        {
            
            if($row['Kd_Urusan'] != $kd_Urusan_old){
                $kd_Urusan_old = $row['Kd_Urusan'];
                
                $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row['Kd_Urusan']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['Nm_Urusan']);

            }else{
                $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row['Kd_Urusan']." ".$row['Kd_Bidang']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['Nm_Bidang']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['tahun1']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row['tahun2']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row['tahun3']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row['tahun4']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row['tahun5']);
            }
            
            $excel_row++;
            $nomor++;
        }

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$fileName.'.xls"');
        $object_writer->save('php://output');

    }
}