<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApiController extends CI_Controller {

    private $level;
	public function __construct()
    {
		parent::__construct();
		$this->load->library('MyConfig');
        $this->load->model('AdminModel');
        $this->level = 5;
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header('Access-Control-Allow-Origin: *');
    }

    

    public function getKiriman($page = 1){

        $jumDataAll = 0;
        // $status = $this->myconfig->check($this->input->post('session'), $this->level);
        // $session = $this->myconfig->getSession($this->input->post('session'), $this->level);
        // // $getToken = $this->AdminModel->getGrupToken($this->input->post('token'));
        // if(!@$session['status'] || !$session['status'] ){
        //     $status = false;
        // }
        $status = true;
		if($status){
            $search = '';
            if(@$this->input->post('search')){
                $search = $this->input->post('search');
            }
            // echo $this->input->post('kecamatan');
            $post = $this->input->post();
            $this->load->model('DataModel');
            $kecamatan = $this->DataModel->getKecamatan();
            $kategori = $this->DataModel->getKategori();
            $data = $this->AdminModel->getAllKiriman($page, $search, 1);
            $jumDataAll = $this->AdminModel->getCountKiriman($search, 1);
            $jumlahDatainPage = $this->AdminModel->getJumlahInPage();
            $jumlahPage = ceil($jumDataAll/$jumlahDatainPage);

            // print_r($data);
		}else{
            $data = array();
            $jumlahPage = 1;
            $kategori = array();
        }
        
		$kirim = array(
            'jumlahAll' => $jumDataAll,
            'jumlahPage' => $jumlahPage,
			'data' => $data,
            'status' => $status,
            'kecamatan'=> $kecamatan,
            'kategori' => $kategori,
        );

        echo json_encode($kirim);
    }
    public function getKirimanPokir($page = 1){
        $jumDataAll = 0;
        // $status = $this->myconfig->check($this->input->post('session'), $this->level);
        // $session = $this->myconfig->getSession($this->input->post('session'), $this->level);
        // // $getToken = $this->AdminModel->getGrupToken($this->input->post('token'));
        // if(!@$session['status'] || !$session['status'] ){
        //     $status = false;
        // }
        $status = true;
		if($status){
            $search = '';
            if(@$this->input->post('search')){
                $search = $this->input->post('search');
            }
            // echo $this->input->post('kecamatan');
            $post = $this->input->post();
            $this->load->model('DataModel');
            $kecamatan = $this->DataModel->getKecamatan();
            $kategori = $this->DataModel->getKategori();
            $data = array();
            $dataSet = array();
            $kd_asal = array();
            $data = $this->AdminModel->getAllKirimanPokir($page, $search, 1);
            $jumDataAll = $this->AdminModel->getCountKirimanPokir($search, 1);
            $jumlahDatainPage = $this->AdminModel->getJumlahInPage();
            $jumlahPage = ceil($jumDataAll/$jumlahDatainPage);
            $dataSet = array();
            $no=0;
            foreach($data as $key){
                $dataSet[$no] = $key;
                $kd_asal = explode('-',$key['kd_asal']);
                if(count($kd_asal)==3){
                    $dataSet[$no]['kecamatan'] = $this->DataModel->findKec($kd_asal[0])[0]['Nm_Kec'];
                    $dataSet[$no]['kelurahan'] = $this->DataModel->findKel($kd_asal[1],$kd_asal[2])[0]['Nm_Kel'];
    
                }else{
                    $dataSet[$no]['kecamatan'] = null;
                    $dataSet[$no]['kelurahan'] = null;

                }
                
                $no++;

            }

            // print_r($data);
		}else{
            $dataSet = array();
            $jumlahPage = 1;
            $kategori = array();
            $kecamatan = array();
            $kategori = array();
            $kd_asal = array();
        }
        
		$kirim = array(
            'jumlahAll' => $jumDataAll,
            'jumlahPage' => $jumlahPage,
			'data' => $dataSet,
            'status' => $status,
            'kecamatan'=> $kecamatan,
            'kategori' => $kategori,
            'asal'=> $kd_asal,
        );

        echo json_encode($kirim);
    }
    
    public function update(){
        
        $status = true;
        // print_r($getToken);s
        $pesan = "Gagal Mengubah data";
        // print_r($this->input->post());
        if($status){
            $post = $this->input->post();

            $status = $this->AdminModel->updateApi($post);
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



