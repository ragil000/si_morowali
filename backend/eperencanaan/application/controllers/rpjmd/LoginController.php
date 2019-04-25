<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {

	public function __construct()
    {
		parent::__construct();
		$this->load->library('MyConfig');
		
	}
	
	// public function cek(){
	// 	if (password_verify('qwe123', '$2y$10$0.pkd5BAP0Rfw0.YdW/Rz.kF41b3NGOw8MeMAYg9YvUVO2zvYW0Aq')) {
	// 		echo "true";
	// 	}
	// }

    public function login($setDomain){
		$this->myconfig->header($setDomain);
		$this->load->model('DataModel');
		$this->load->model('AkunModel');
		$this->load->library('encryption');
		
		$status = false;
		
        $username = $this->input->post('user');
		$pass = $this->input->post('pass');
		// echo "sdf";
		if($this->input->post()){
			// print_r($this->input->post());
			$this->db->where('username', $username);
			$user = $this->db->get('ref_users')->row();
			if($user){
				if (password_verify($pass, $user->password)) {
					// $this->AkunModel->userRiwayat($user->id);
                    // $userLevel = $this->DataModel->getLevel($user->id);
                    $userLevel = $user->level_id;
                    $userAkun = $user->akun_id;
					if($userLevel != 0)
						$status = true;
				}
			}
		}
		if($status){
			
			$dataSession = array(
                'id' => $user->user_id,
				'level' => $userLevel,
				'status' => true,
				'domain' => $setDomain,
			);
			$stringSession = json_encode($dataSession);
			$encryption = $this->encryption->encrypt($stringSession);
			$data = array(
				'session' => $encryption,
                'level' => md5('levelUser'.$userLevel),
                'akun' => md5('akunUser'.$userAkun),
				'status' => true
			);
		}else{
			$data = array(
				'pesan' => 'Gagal Melakukan Login',
				'status' => false
			);
		}
		echo json_encode($data);
    }

}