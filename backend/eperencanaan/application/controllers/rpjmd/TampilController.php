<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TampilController extends CI_Controller {

    private $level, $akun;
	public function __construct()
    {
		parent::__construct();
        $this->load->library('MyConfig');
        $this->level = 1;
        $this->akun = 2;
		
    }

    public function getStrategi($page = 1){

        $this->load->model('rpjmd/TampilModel');
        $jumDataAll = 0;
        $status = false;
        $session = $this->myconfig->getSession($this->input->post('session'), $this->level, $this->akun);
        if(@$session['status']){
            $status = $session['status'];
        }
        
		if($status){
            $search = '';
            if(@$this->input->post('search')){
                $search = $this->input->post('search');
            }

            $post = $this->input->post();

            $data = $this->TampilModel->getAll($page, $search, $session['id'], $post);
            
            // $dataAll
            $jumDataAll = $this->TampilModel->getCount($search, $session['id'], $post);
            $jumlahDatainPage = $this->TampilModel->getJumlahInPage();
            $jumlahPage = ceil($jumDataAll/$jumlahDatainPage);
            $dataTambah ='';
            $this->load->model('rpjmd/DataModel');
            $dataTambah = $this->DataModel->getUrusan();

		}else{
            $data = array();
            $jumlahPage = 1;
            $dataTambah = '';
        }
        
        
		$kirim = array(
            'jumlahAll' => $jumDataAll,
            'jumlahPage' => $jumlahPage,
            'dataTambah'=>$dataTambah,
			'data' => $data,
			'status' => $status,
        );
        
        echo json_encode($kirim);
    }

    public function getKebijakan($page = 1){

        $this->load->model('rpjmd/TampilKebijakanModel');
        $jumDataAll = 0;
        $status = false;
        $session = $this->myconfig->getSession($this->input->post('session'), $this->level, $this->akun);
        if(@$session['status']){
            $status = $session['status'];
        }
        $dataKirim = array();
        $tahun1 = array();
        $tahun2 = array();
        $tahun3 = array();
        $tahun4 = array();
        $tahun5 = array();
		if($status){
            $search = '';
            if(@$this->input->post('search')){
                $search = $this->input->post('search');
            }

            $post = $this->input->post();

            $data = $this->TampilKebijakanModel->getAll($page, $search, $session['id'], $post);
            $temp = 0;
            $no = 0;
            foreach($data as $key){
                
                if($key['urusan']!=$temp){
                    $temp = $key['urusan'];
                    $dataKirim[$no] = $key;
                    $no++;
                }
                $dataKirim[$no] = $key;
                if($key['tahun1'] == null){
                    $dataKirim[$no]['tahun1'] = 0;
                }
                if($key['tahun2'] == null){
                    $dataKirim[$no]['tahun2'] = 0;
                }
                if($key['tahun3'] == null){
                    $dataKirim[$no]['tahun3'] = 0;
                }
                if($key['tahun4'] == null){
                    $dataKirim[$no]['tahun4'] = 0;
                }
                if($key['tahun5'] == null){
                    $dataKirim[$no]['tahun5'] = 0;
                }

                // $tahun1[$key['Kd_Urusan']][$key['Kd_Bidang'] ]= $dataKirim[$no]['tahun1'];
                // $tahun2[$key['Kd_Urusan']][$key['Kd_Bidang'] ]= $dataKirim[$no]['tahun2'];
                // $tahun3[$key['Kd_Urusan']][$key['Kd_Bidang'] ]= $dataKirim[$no]['tahun3'];
                // $tahun4[$key['Kd_Urusan']][$key['Kd_Bidang'] ]= $dataKirim[$no]['tahun4'];
                // $tahun5[$key['Kd_Urusan']][$key['Kd_Bidang'] ]= $dataKirim[$no]['tahun5'];

                $no++;
            }
            
            // $dataAll
            $jumDataAll = $this->TampilKebijakanModel->getCount($search, $session['id'], $post);
            $jumlahDatainPage = $this->TampilKebijakanModel->getJumlahInPage();
            $jumlahPage = ceil($jumDataAll/$jumlahDatainPage);

		}else{
            $data = array();
            $jumlahPage = 1;
        }
        
        
		$kirim = array(
            'jumlahAll' => $jumDataAll,
            'jumlahPage' => $jumlahPage,
            // 'tahun1'=>$tahun1,
            // 'tahun2'=>$tahun2,
            // 'tahun3'=>$tahun3,
            // 'tahun4'=>$tahun4,
            // 'tahun5'=>$tahun5,
			'data' => $dataKirim,
			'status' => $status,
        );
        
        echo json_encode($kirim);
    }

    public function getKebijakanUpdate(){
        $this->load->model('rpjmd/TampilKebijakanModel');
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
            $status = $this->TampilKebijakanModel->update($post);
            if($status)
                $pesan = "Berhasil Mengubah Data";
        }

        $kirim = array(
            'pesan' => $pesan,
			'status' => $status
		);
		echo json_encode($kirim);
    }

}