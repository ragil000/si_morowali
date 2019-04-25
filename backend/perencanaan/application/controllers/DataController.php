<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataController extends CI_Controller {

	public function __construct()
    {
		parent::__construct();
		$this->load->library('MyConfig');
    }

    public function getSatuan($api = true){
		$status = $this->myconfig->check($this->input->post('session'), 0 , true);
		if($status){
            $this->load->model('DataModel');
            $data = $this->DataModel->getSatuan();

		}else{
			$data = array();
        }
		$kirim = array(
			'data' => $data,
			'status' => $status
        );
        if($api)
            echo json_encode($kirim);
        else
            return json_encode($kirim);
    }

    public function getSkor(){
        $status = $this->myconfig->check($this->input->post('session'), 0 , true);
		if($status){
            $this->load->model('DataModel');
            $data = $this->DataModel->getSkor();

		}else{
			$data = array();
        }
		$kirim = array(
			'data' => $data,
			'status' => $status
        );
        
        echo json_encode($kirim);
    }

    public function getOpd(){
        $status = $this->myconfig->check($this->input->post('session'), 0 , true);
		if($status){
            $this->load->model('DataModel');
            $data = $this->DataModel->getOpd();

		}else{
			$data = array();
        }
		$kirim = array(
			'data' => $data,
			'status' => $status
        );
        
        echo json_encode($kirim);
    }

    public function getKecamatan(){
        $status = $this->myconfig->check($this->input->post('session'), 0 , true);
        if($status){
            $this->load->model('DataModel');
            $data = $this->DataModel->getKecamatan();
		}else{
			$data = array();
        }
		$kirim = array(
			'data' => $data,
			'status' => $status
        );
        
        echo json_encode($kirim);
    }

    public function getKelurahan(){
        $status = $this->myconfig->check($this->input->post('session'), 0 , true);
        if($status){
            $this->load->model('DataModel');
            $data = $this->DataModel->getKelurahan($this->input->post());
		}else{
			$data = array();
        }
		$kirim = array(
			'data' => $data,
			'status' => $status
        );
        
        echo json_encode($kirim);
    }

    public function getDapil(){
        $status = $this->myconfig->check($this->input->post('session'), 0 , true);
        if($status){
            $this->load->model('DataModel');
            $data = $this->DataModel->getDapil();
		}else{
			$data = array();
        }
		$kirim = array(
			'data' => $data,
			'status' => $status
        );
        
        echo json_encode($kirim);
    }

    
    
}