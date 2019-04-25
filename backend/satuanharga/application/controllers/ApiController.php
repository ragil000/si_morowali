<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApiController extends CI_Controller {

	private $zona;

	public function __construct()
    {
        parent::__construct();
    }

    public function getAll(){

        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header('Access-Control-Allow-Origin: *');

        $jumDataAll = 0;
        $data = array();
        $kirim = array();
        $dataTambah = array();
        $jumlahDatainPage = 20;
        $jumlahPage = 1;
        $status = true;

        $search = '';
        if(@$this->input->post('search')){
            $search = $this->input->post('search');
        }
        $this->load->model('ApiModel');
        $post = $this->input->post();

        
        // $data = $this->ApiModel->getAllSsh($search);
        
        // $kirim['data'] = $data;
        $kirim['dataSsh'] = $this->ApiModel->getAllSsh($search);
        $kirim['dataHspk'] = $this->ApiModel->getAllHspk($search);
        $kirim['dataAsb'] = $this->ApiModel->getAllAsb($search);
        $kirim['dataTambah'] = $dataTambah;
        
        $kirim['status'] = $status;
        
        echo json_encode($kirim);
    }


}