<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataController extends CI_Controller {

	public function __construct()
    {
		parent::__construct();
		$this->load->library('MyConfig');
    }

    public function getVisi($api = true){
		$session = $this->myconfig->getSession($this->input->post('session'), 0 , true);
		if(@$session['status'] && $session['status']){
            $this->load->model('rpjmd/DataModel');
            $data = $this->DataModel->getVisi($session['id']);

		}else{
			$data = array();
        }
		$kirim = array(
			'data' => $data,
			'status' => $status
        );
        
        echo json_encode($kirim);
	}
	
	// public function getIndikator($api = true){
	// 	$status = false;
	// 	$session = $this->myconfig->getSession($this->input->post('session'), 0 , true);

	// 	if(@$session['status']){
	// 		$status = $session['status'];
	// 	}
		
	// 	if($status){
    //         $this->load->model('rpjmd/DataModel');
    //         $data = $this->DataModel->getIndikator($session['id']);

	// 	}else{
	// 		$data = array();
    //     }
	// 	$kirim = array(
	// 		'data' => $data,
	// 		'status' => $status
    //     );
        
    //     echo json_encode($kirim);
	// }
	
	public function getBidang(){
		$status = false;
		$session = $this->myconfig->getSession($this->input->post('session'), 0 , true);

		if(@$session['status']){
			$status = $session['status'];
		}
		
		if($status){
            $this->load->model('rpjmd/DataModel');
            $data = $this->DataModel->getBidang($this->input->post('urusan'));

		}else{
			$data = array();
        }
		$kirim = array(
			'data' => $data,
			'status' => $status
        );
        
        echo json_encode($kirim);
	}

	public function getProgram(){
		$status = false;
		$session = $this->myconfig->getSession($this->input->post('session'), 0 , true);

		if(@$session['status']){
			$status = $session['status'];
		}
		
		if($status){
            $this->load->model('rpjmd/DataModel');
            $data = $this->DataModel->getProgram($this->input->post('urusan'), $this->input->post('bidang'));

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
		$status = false;
		$session = $this->myconfig->getSession($this->input->post('session'), 0 , true);

		if(@$session['status']){
			$status = $session['status'];
		}
		
		if($status){
			$this->load->model('rpjmd/DataModel');
			// print_r($this->input->post());
            $data = $this->DataModel->getOpd($this->input->post('urusan'), $this->input->post('bidang'));

		}else{
			$data = array();
        }
		$kirim = array(
			'data' => $data,
			'status' => $status
        );
        
        echo json_encode($kirim);
	}

	public function getFungsi(){
		$status = false;
		$session = $this->myconfig->getSession($this->input->post('session'), 0 , true);

		if(@$session['status']){
			$status = $session['status'];
		}
		
		if($status){
			$this->load->model('rpjmd/DataModel');
            $data = $this->DataModel->getFungsi();

		}else{
			$data = array();
        }
		$kirim = array(
			'data' => $data,
			'status' => $status
        );
        
        echo json_encode($kirim);
	}

	public function getMisi(){
		$status = false;
		$session = $this->myconfig->getSession($this->input->post('session'), 0 , true);
		if(@$session['status']){
			$status = $session['status'];
		}
		
		if($status){
			$post = $this->input->post();
            $post['user_id'] = $session['id'];

            $this->load->model('rpjmd/DataModel');
            $data = $this->DataModel->getMisi($post);

		}else{
			$data = array();
        }
		$kirim = array(
			'data' => $data,
			'status' => $status
        );
        
        echo json_encode($kirim);
	}

	public function getTujuan(){
		$status = false;
		$session = $this->myconfig->getSession($this->input->post('session'), 0 , true);
		if(@$session['status']){
			$status = $session['status'];
		}
		
		if($status){
			$post = $this->input->post();
            $post['user_id'] = $session['id'];

            $this->load->model('rpjmd/DataModel');
            $data = $this->DataModel->getTujuan($post, true);

		}else{
			$data = array();
        }
		$kirim = array(
			'data' => $data,
			'status' => $status
        );
        
        echo json_encode($kirim);
	}

	public function getSasaran(){
		$status = false;
		$session = $this->myconfig->getSession($this->input->post('session'), 0 , true);
		if(@$session['status']){
			$status = $session['status'];
		}
		
		if($status){
			$post = $this->input->post();
            $post['user_id'] = $session['id'];

            $this->load->model('rpjmd/DataModel');
            $data = $this->DataModel->getSasaran($post, true);

		}else{
			$data = array();
        }
		$kirim = array(
			'data' => $data,
			'status' => $status
        );
        
        echo json_encode($kirim);
	}

	public function getIndikator(){
		$status = false;
		$session = $this->myconfig->getSession($this->input->post('session'), 0 , true);
		if(@$session['status']){
			$status = $session['status'];
		}
		
		if($status){
			$post = $this->input->post();
            $post['user_id'] = $session['id'];

            $this->load->model('rpjmd/DataModel');
            $data = $this->DataModel->getIndikator($post, true);

		}else{
			$data = array();
        }
		$kirim = array(
			'data' => $data,
			'status' => $status
        );
        
        echo json_encode($kirim);
	}

	public function getIsuStrategi(){
		$status = false;
		$session = $this->myconfig->getSession($this->input->post('session'), 0 , true);
		if(@$session['status']){
			$status = $session['status'];
		}
		
		if($status){
			$post = $this->input->post();
            $post['user_id'] = $session['id'];

            $this->load->model('rpjmd/DataModel');
            $data = $this->DataModel->getIsuStrategi($post, true);

		}else{
			$data = array();
        }
		$kirim = array(
			'data' => $data,
			'status' => $status
        );
        
        echo json_encode($kirim);
	}

	public function getTujuanSasaran(){
		$status = false;
		$session = $this->myconfig->getSession($this->input->post('session'), 0 , true);
		if(@$session['status']){
			$status = $session['status'];
		}
		
		if($status){
			$post = $this->input->post();
            $post['user_id'] = $session['id'];

            $this->load->model('rpjmd/DataModel');
            $data = $this->DataModel->getTujuanSasaran($post, true);

		}else{
			$data = array();
        }
		$kirim = array(
			'data' => $data,
			'status' => $status
        );
        
        echo json_encode($kirim);
	}

	public function getStrategiKebijakan(){
		$status = false;
		$session = $this->myconfig->getSession($this->input->post('session'), 0 , true);
		if(@$session['status']){
			$status = $session['status'];
		}
		$dataProgram = array();
		if($status){
			$post = $this->input->post();
            $post['user_id'] = $session['id'];

            $this->load->model('rpjmd/DataModel');
            $data = $this->DataModel->getStrategiKebijakan($post, true);
			if(@$data[0]){
				$dataProgram = $this->DataModel->getProgram($data[0]['Kd_Urusan'], $data[0]['Kd_Bidang']);
			}
		}else{
			$data = array();
        }
		$kirim = array(
			'data' => $data,
			'dataProgram' => $dataProgram,
			'status' => $status
        );
        
        echo json_encode($kirim);
	}

	public function getSatuan(){
		$status = false;
		$session = $this->myconfig->getSession($this->input->post('session'), 0 , true);
		if(@$session['status']){
			$status = $session['status'];
		}
		
		if($status){
			$post = $this->input->post();
            $post['user_id'] = $session['id'];

            $this->load->model('rpjmd/DataModel');
            $data = $this->DataModel->getSatuan();

		}else{
			$data = array();
        }
		$kirim = array(
			'data' => $data,
			'status' => $status
        );
        
        echo json_encode($kirim);
	}

	public function getRek5(){
		$status = false;
		$session = $this->myconfig->getSession($this->input->post('session'), 0 , true);
		if(@$session['status']){
			$status = $session['status'];
		}
		
		if($status){
			$post = $this->input->post();
            $post['user_id'] = $session['id'];
			
			$this->load->model('opd/DataModel');
			$rek1 = $post['Kd_Rek_1'];
			$rek2 = $post['Kd_Rek_2'];
			$rek3 = $post['Kd_Rek_3'];
			$rek4 = $post['Kd_Rek_4'];
			// print_r($post);
            $data = $this->DataModel->getRekening5($rek1, $rek2, $rek3, $rek4);

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