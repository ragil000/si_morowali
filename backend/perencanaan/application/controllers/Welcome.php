<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
    {
		parent::__construct();
		$this->load->library('MyConfig');
		
	}
	
	public function index()
	{
		$data = array(
			'no' => 1,
			'data' => 'aku',

		);
		echo json_encode($data);
		header("location: client/musrenbang/");
		//$this->load->view('welcome_message');
	}


	public function upload(){
		$status = false;
		// print_r($_FILES['file']);
		print_r($_FILES);
		if($status){
			$data = array(
				'no' => 1,
				'data' => 'aku',
				'session' => 'aqua',
				'status' => true
			);
		}else{
			$data = array(
				'status' => false
			);
		}
		echo json_encode($data);

	}

	public function encryption(){
		$this->load->library('encryption');
		

		$tes = '12345';
		$dataSession = array(
			'id-manusia' => 1,
			'status-manusia' => true
		);
		$string = json_encode($dataSession);
		// echo $string;
		$encryption = $this->encryption->encrypt($string);
		echo $encryption;
		$decrypt = $this->encryption->decrypt($encryption);
		echo $decrypt;
		$arr = json_decode($decrypt, true);
		print_r($arr);
	}

	public function cekUser(){
		$this->myconfig->header(0);
		$status = false;
		if($this->input->post()){
			$status = $this->myconfig->check($this->input->post('session'));
		}
		if($status){
			$data = array(
				'no' => 1,
				'data' => 'aku',
				'status' => true
			);
		}else{
			$data = array(
				'status' => false
			);
		}
		echo json_encode($data);
	}

	public function getData(){
		$this->myconfig->header(0);
		$status = $this->myconfig->check($this->input->post('session'));
		if($status){
			$data[0]['id'] = 1;
			$data[0]['nama'] = "aka";
			$data[0]['nim'] = "E11E11";
			$data[0]['umur'] = 19;
			$data[1]['id'] = 2;
			$data[1]['nama'] = "ksa";
			$data[1]['nim'] = "A1C2";
			$data[1]['umur'] = 22;
		}else{
			$data = array();
		}
		$kirim = array(
			'data' => $data,
			'status' => $status
		);
		echo json_encode($kirim);
	}

	public function view($folder, $nama){
		$this->load->view($folder."/".$nama);
	}

	public function cobaKelurahan(){
		
		// $data = "c4d2cbf3c78ffcf838cc6190cc273a20324c108251f78c4e9a13eb308f05e8457a29fdca0c77fce6f896ea8ee8f29fa0c20276ff5a7fec4850e4d57189af0666WssqqLY5cavEytvHcIS4tYs8dbN61LEmU7fzCoQUpUEAtN8ArV463JIB17Tf+ox5G7YUMzuv7QQH7YKLNMBmZn/ytcTTIBOp1u+KQlVZ7Ws=";
		
		// $this->load->library('MyConfig');
		// $tes =  $this->myconfig->getSession($data);

		// print_r($tes);

		// $this->load->model('DataModel');
		// $data = $this->DataModel->getSkor();

		$this->load->model('KecamatanModel');
		print_r($_GET);
		$data = $this->KecamatanModel->hitungSkor($_GET);

		echo "<pre>";
		print_r($data);
		echo "</pre>";
	}


}
