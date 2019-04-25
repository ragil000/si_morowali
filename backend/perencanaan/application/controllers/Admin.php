<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
    {
		parent::__construct();
		$this->load->library('MyConfig');
		
    }

    public function cekUser($setDomain){
        
        // $this->myconfig->header($setDomain);
        
		$status = false;
		if($this->input->post()){
			$status = $this->myconfig->check($this->input->post('session'), 0, true);
		}
		if($status){
			$data = array(
				'pesan' => '',
				'status' => true
			);
		}else{
			$data = array(
                'pesan' => '',
				'status' => false
			);
		}
		echo json_encode($data);
    }

}