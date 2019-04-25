<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IsuStrategiController extends CI_Controller {

    private $level, $akun;
	public function __construct()
    {
		parent::__construct();
        $this->load->library('MyConfig');
        $this->load->model('rpjmd/IsuStrategiModel');
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

            $data = $this->IsuStrategiModel->getAll($page, $search, $post);
            
            // $dataAll
            $jumDataAll = $this->IsuStrategiModel->getCount($search, $post);
            $jumlahDatainPage = $this->IsuStrategiModel->getJumlahInPage();
            $jumlahPage = ceil($jumDataAll/$jumlahDatainPage);
            $dataTambah ='';
            $this->load->model('rpjmd/DataModel');
            $dataTambah = $this->DataModel->getMisi($post);
            $dataUrusan = $this->DataModel->getUrusan();

            

		}else{
            $data = array();
            $dataUrusan = array();
            $jumlahPage = 1;
            $dataTambah = '';
        }
        
        
		$kirim = array(
            'jumlahAll' => $jumDataAll,
            'jumlahPage' => $jumlahPage,
            'dataTambah'=>$dataTambah,
            'dataUrusan'=>$dataUrusan,
			'data' => $data,
			'status' => $status,
        );
        
        if($save == 'pdf'){
            $this->load->library('M_pdf');
            $this->m_pdf->getPdf('isu-strategi', 'rpjmd/isu-strategi', $kirim);
        }else if($save == 'excel'){
            $this->exportExcel('isu-strategi', $kirim['data']);
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
            $status = $this->IsuStrategiModel->create($post);
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
            $status = $this->IsuStrategiModel->update($post);
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
            $status = $this->IsuStrategiModel->delete($post);
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
                "Nomor",
                "Misi",
                "Isu Strategi Urusan",
                "Kajian Kebijakan",
                "",
                "",
                "",
                "Isu Strategi RPJMD",
                "Urusan",
                "Bidang",
            ),
            array(
                "",
                "",
                "",
                "RPJPD",
                "RTRW",
                "RPJMN/RPJMD PROVINSI",
                "DINAMIKA INTERNASIONAL",
                "",
                "",
                "",
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

        
        $excel_row = $row;
        $nomor = 1;
        foreach($data as $row)
        {
            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $nomor);
            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['misi_nama']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['isu_strategi_urusan']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row['isu_strategi_rpjpd']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row['isu_strategi_rtrw']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row['isu_strategi_rpjmn']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row['isu_strategi_dinamika']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row['isu_strategi_rpjmd']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $row['Nm_Urusan']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $row['Nm_Bidang']);
            $excel_row++;
            $nomor++;
        }

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$fileName.'.xls"');
        $object_writer->save('php://output');

    }

}