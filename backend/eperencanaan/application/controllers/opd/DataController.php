<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataController extends CI_Controller {

	public function __construct()
    {
		parent::__construct();
		$this->load->library('MyConfig');
    }

   
	
	public function getKegiatan(){
		$status = false;
		$session = $this->myconfig->getSession($this->input->post('session'), 0 , true);
        // print_r($this->input->post());
        // echo "sdf";
		if(@$session['status']){
			$status = $session['status'];
		}
		
		if($status){
            // print_r($this->input->post());
            $this->load->model('opd/DataModel');
            $data = $this->DataModel->getKegiatan($this->input->post('urusan'), $this->input->post('bidang'), $this->input->post('program'));

		}else{
			$data = array();
        }
		$kirim = array(
			'data' => $data,
			'status' => $status
        );
        
        echo json_encode($kirim);
	}

	public function selectRkpd(){
		$status = false;
		$session = $this->myconfig->getSession($this->input->post('session'), 0 , true);
        // print_r($this->input->post());
        // echo "sdf";
		if(@$session['status']){
			$status = $session['status'];
		}
		
		if($status){
            $this->load->model('opd/DataModel');
            $data = $this->DataModel->selectRkpd($this->input->post('urusan'), $this->input->post('bidang'), $this->input->post('program'), $this->input->post('kegiatan'));

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