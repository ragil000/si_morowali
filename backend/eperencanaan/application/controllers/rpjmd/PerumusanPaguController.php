<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PerumusanPaguController extends CI_Controller {

    private $level, $akun;
	public function __construct()
    {
		parent::__construct();
        $this->load->library('MyConfig');
        $this->load->model('rpjmd/PerumusanPaguModel');
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
            $this->load->model('rpjmd/DataModel');
            $search = '';
            if(@$this->input->post('search')){
                $search = $this->input->post('search');
            }

            $post = $this->input->post();
            $post['user_id'] = $session['id'];

            if($save != ''){
                $post['all'] = true;
            }

            $data = $this->PerumusanPaguModel->getAll($page, $search, $post);

            $dataAll = array();
            $no = 0;

            foreach($data as $key){
                $dataAll[$no] = $key;
                // $dataAll[$no]['opd']
                $dataAll[$no]['target1_satuan_nama'] = $this->DataModel->selectSatuan($key['target1_satuan'])[0]['Uraian'];
                $dataAll[$no]['target2_satuan_nama'] = $this->DataModel->selectSatuan($key['target2_satuan'])[0]['Uraian'];
                $dataAll[$no]['target3_satuan_nama'] = $this->DataModel->selectSatuan($key['target3_satuan'])[0]['Uraian'];
                $dataAll[$no]['target4_satuan_nama'] = $this->DataModel->selectSatuan($key['target4_satuan'])[0]['Uraian'];
                $dataAll[$no]['target5_satuan_nama'] = $this->DataModel->selectSatuan($key['target5_satuan'])[0]['Uraian'];

                if(@$key['Kd_Sub'] && @$key['Kd_Unit']){
                    $dataAll[$no]['Nm_Sub_Unit'] = $dataTambah = $this->DataModel->selectOpd($key['Kd_Urusan'], $key['Kd_Bidang'], $key['Kd_Sub'], $key['Kd_Unit'])[0]['Nm_Sub_Unit'];
                }

                $no++;
            }
            
            // $dataAll
            $jumDataAll = $this->PerumusanPaguModel->getCount($search, $post);
            $jumlahDatainPage = $this->PerumusanPaguModel->getJumlahInPage();
            $jumlahPage = ceil($jumDataAll/$jumlahDatainPage);
            $dataTambah =array();
            
            // $dataTambah = $this->DataModel->getOpd();
            

		}else{
            $data = array();
            $jumlahPage = 1;
            $dataTambah = '';
        }
        
        
		$kirim = array(
            'jumlahAll' => $jumDataAll,
            'jumlahPage' => $jumlahPage,
            'dataTambah'=>$dataTambah,
			'data' => $dataAll,
			'status' => $status,
        );
        
        if($save == 'pdf'){
            $this->load->library('M_pdf');
            $this->m_pdf->getPdf('perumusan-pagu', 'rpjmd/perumusan-pagu', $kirim);
        }else if($save == 'excel'){
            $this->exportExcel('perumusan-pagu', $kirim['data']);
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
            $status = $this->PerumusanPaguModel->create($post);
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
            $status = $this->PerumusanPaguModel->update($post);
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
            $status = $this->PerumusanPaguModel->delete($post);
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
                "Program",
                "Indikator Kinerka (Outcome)",
                "Kondisi Kinerja pada Awal RPJMD (Tahun 0)",
                "Capaian Kerja",
                "",
                "",
                "",
                "",
                "",
                "",
                "",
                "",
                "",
                "",
                "",
                "",
                "",
                "",
                "",
                "",
                "Penanggung Jawab",
            ),
            array(
                "",
                "",
                "",
                "",
                "Tahun 1",
                "",
                "",
                "Tahun 2",
                "",
                "",
                "Tahun 3",
                "",
                "",
                "Tahun 4",
                "",
                "",
                "Tahun 5",
                "",
                "",
                "Kondisi Kinerja Akhir Periode",
                "",
                "",
            ),
            array(
                "",
                "",
                "",
                "",
                "Target",
                "Rp",
                "Lokasi",
                "Target",
                "Rp",
                "Lokasi",
                "Target",
                "Rp",
                "Lokasi",
                "Target",
                "Rp",
                "Lokasi",
                "Target",
                "Rp",
                "Lokasi",
                "Target",
                "Rp",
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
        // print_r($data);
        foreach($data as $row)
        {
            
            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row['Kd_Urusan'].".".$row['Kd_Bidang'].".".$row['Kd_Prog']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['Ket_Program']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['outcome']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row['kondisi_awal']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row['target1_tahun']." ".$row['target1_satuan_nama']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row['target1_harga']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row['target1_lokasi']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $row['target2_tahun']." ".$row['target2_satuan_nama']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $row['target2_harga']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $row['target2_lokasi']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $row['target3_tahun']." ".$row['target3_satuan_nama']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, $row['target3_harga']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, $row['target3_lokasi']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(14, $excel_row, $row['target4_tahun']." ".$row['target4_satuan_nama']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(15, $excel_row, $row['target4_harga']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(16, $excel_row, $row['target4_lokasi']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(17, $excel_row, $row['target5_tahun']." ".$row['target5_satuan_nama']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(18, $excel_row, $row['target5_harga']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(19, $excel_row, $row['target5_lokasi']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(20, $excel_row, $row['akhir_target']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(21, $excel_row, $row['target1_harga']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(22, $excel_row, $row['Nm_Sub_Unit']);

            $excel_row++;
        }

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$fileName.'.xls"');
        $object_writer->save('php://output');

    }

}