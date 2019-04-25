<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudController extends CI_Controller {

    private $level, $akun;
	public function __construct()
    {
		parent::__construct();
        $this->load->library('MyConfig');
        $this->level = 1;
        $this->akun = 2;
		
    }

    public function getData($name, $page = 1){

        if($page <= 0) $page = 1;
        $jumDataAll = 0;
        $data = array();
        $kirim = array();
        $dataTambah = array();
        $jumlahDatainPage = 20;
        $jumlahPage = 1;
        $status = false;

        $session = $this->myconfig->getSession($this->input->post('session'), $this->level, true,  $this->akun);
        if(@$session['status']){
            $status = $session['status'];
        }
        
		if($status){
            $search = '';
            if(@$this->input->post('search')){
                $search = $this->input->post('search');
            }
            $this->load->model('opd/DataModel');
            $post = $this->input->post();
            $post['user_id'] = $session['id'];

            if($name == "admin_user"){
                $this->load->model('admin/UserModel');
                $data = $this->UserModel->getAll($page, $search, $post);
            
                $jumDataAll = $this->UserModel->getCount($search, $post);
                $jumlahDatainPage = $this->UserModel->getJumlahInPage();
                $jumlahPage = ceil($jumDataAll/$jumlahDatainPage);

                $kirim['dataAllOpd'] = $this->DataModel->getAllOpd($post);
            }
            
        }
        
        $kirim['jumlahAll'] = $jumDataAll;
        $kirim['jumlahPage'] = $jumlahPage;
        $kirim['data'] = $data;
        $kirim['dataTambah'] = $dataTambah;
        
        $kirim['status'] = $status;
        
        echo json_encode($kirim);
    }
    
    public function create($name){
        $status = false;
        $session = $this->myconfig->getSession($this->input->post('session'), $this->level, $this->akun);
        if(@$session['status']){
            $status = $session['status'];
        }
        $pesan = "Gagal Memasukkan data";
        // print_r($this->input->post());
        if($status){
            $post = $this->input->post();
            $post['user_id'] = $session['id'];
            
            
            if($name == "admin_user"){
                $this->load->model('admin/UserModel');
                $status = $this->UserModel->create($post);
            }

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

    public function update($name){
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
            if($name == "admin_user"){
                $this->load->model('admin/UserModel');
                $status = $this->UserModel->update($post);
            }
            
            if($status)
                $pesan = "Berhasil Mengubah Data";
        }

        $kirim = array(
            'pesan' => $pesan,
			'status' => $status
		);
		echo json_encode($kirim);

    }

    public function delete($name){
        $status = false;
        $session = $this->myconfig->getSession($this->input->post('session'), $this->level, $this->akun);
        if(@$session['status']){
            $status = $session['status'];
        }
        $pesan = "Gagal Menghapus data";
        // print_r($this->input->post());
        if($status){
            $post = $this->input->post();
            $post['user_id'] = $session['id'];

            if($name == "admin_user"){
                $this->load->model('admin/UserModel');
                $status = $this->UserModel->delete($post);
            }

            if($status)
                $pesan = "Berhasil Menghapus Data";
        }

        $kirim = array(
            'pesan' => $pesan,
			'status' => $status
		);
		echo json_encode($kirim);

    }

    public function other($name){
        $status = false;
        $session = $this->myconfig->getSession($this->input->post('session'), $this->level, $this->akun);
        if(@$session['status']){
            $status = $session['status'];
        }
        $pesan = "Gagal Memproses data";
        if($status){
            $post = $this->input->post();
            $post['user_id'] = $session['id'];

            if($name == "opd_renja_awal"){
                $this->load->model('opd/RkpdVerifikasiModel');
                $status = $this->RkpdVerifikasiModel->kirim($post);
                $pesan = "Berhasil Mengirim Data";
            }
        }

        $kirim = array(
            'pesan' => $pesan,
			'status' => $status
		);
		echo json_encode($kirim);
    }

}