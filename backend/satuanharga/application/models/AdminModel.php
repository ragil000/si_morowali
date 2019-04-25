<?php

class AdminModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function cekLogin($post){
    	$this->db->where('username', $post['user']);
    	$user = $this->db->get('user')->row();
    	$hasil = false;
    	if (password_verify($post['pass'], $user->password_hash)) {
		    $hasil = true;
		    $newdata = array(
               'username'  => $user->username,
               'nama'  => $user->nama_lengkap,
               'id'     => $user->id,
               'level'     => $user->ssh_level,
               'logged_in' => TRUE
           	);

			   $this->session->set_userdata($newdata);
		  }

		  return $hasil;
    }

    public function cekStatusLogin(){
    	$cek = false;
    	if(@$this->session->userdata('id')){
    		if($this->session->userdata('logged_in')){
    			$cek = true;
    		}
    	}
    	return $cek;
	}
	
	public function cekUser($user){

		$cek = false;

        if($user == 'opd'){
            if($this->session->userdata('level') == 1 || $this->session->userdata('level') == 3){
                $cek = true;
            }
        }else if($user == 'aset'){
            if($this->session->userdata('level') == 1 || $this->session->userdata('level') == 2){
                $cek = true;
            }
        }else if($user == 'admin'){
            if($this->session->userdata('level') == 1){
                $cek = true;
            }
        }

        return $cek;
	}

    public function setSession(){

    }
}