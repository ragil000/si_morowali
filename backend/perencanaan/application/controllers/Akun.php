<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun extends CI_Controller {

    private $level;
	public function __construct()
    {
		parent::__construct();
        $this->load->library('MyConfig');
        $this->load->model('AkunModel');
        $this->level = 5;
		
    }

    public function getData($page = 1, $api = true){
        $jumDataAll = 0;
        $status = $this->myconfig->check($this->input->post('session'), $this->level);
        
		if($status){
            $search = '';
            if(@$this->input->post('search')){
                $search = $this->input->post('search');
            }
            $data = $this->AkunModel->getAll($page, $search);
            
            // $dataAll

           

            


            $jumDataAll = $this->AkunModel->getCount($search);
            $jumlahDatainPage = $this->AkunModel->getJumlahInPage();
            $jumlahPage = ceil($jumDataAll/$jumlahDatainPage);
		}else{
            $data = array();
            $jumlahPage = 1;
        }
        
		$kirim = array(
            'jumlahAll' => $jumDataAll,
            'jumlahPage' => $jumlahPage,
			'data' => $data,
			'status' => $status
        );
        if($api)
            echo json_encode($kirim);
        else
            return json_encode($kirim);
    }
    
    public function create(){
        $status = $this->myconfig->check($this->input->post('session'), $this->level);
        $pesan = "Gagal Memasukkan data";
        // print_r($this->input->post());
        if($status){
            $post = $this->input->post();
            
            $status = $this->AkunModel->create($post);
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

        $status= false;
        $status = $this->myconfig->check($this->input->post('session'), $this->level);
        $pesan = "Gagal Mengubah data";
        // print_r($this->input->post());
        if($status){
            $post = $this->input->post();
            // print_r($_FILES);
            $status = $this->AkunModel->update($post);
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
        $status = $this->myconfig->check($this->input->post('session'), $this->level);
        $pesan = "Gagal Menghapus data";
        // print_r($this->input->post());
        if($status){
            $status = $this->AkunModel->delete($this->input->post());
            if($status)
                $pesan = "Berhasil Menghapus Data";
        }

        $kirim = array(
            'pesan' => $pesan,
			'status' => $status
		);
		echo json_encode($kirim);

    }

    public function setPassword(){
        $status = true;
        $session = $this->myconfig->getSession($this->input->post('session'), 0 , true);
        $post = $this->input->post();
        if(@$session['id']){
            $status = true;
        }
        $user = $this->AkunModel->getPassword($session['id']);


        if (!password_verify($post['password'], $user->password_hash)){
            $status = false;
            $pesan = 'Password Salah';
        }

        if(!($post['passwordBaru'] == $post['passwordUlang'])){
            $status = false;
            $pesan = 'Ulangi Password yang sama';
        }

        if($status){
            // $this->load->model('DataModel');
            
            $post['id'] = $session['id'];
            $status = $this->AkunModel->setPassword($post);

            $pesan = 'Berhasil Mengganti Password';
		}
		$kirim = array(
			'pesan' => $pesan,
			'status' => $status
        );
        
        echo json_encode($kirim);
    }

}