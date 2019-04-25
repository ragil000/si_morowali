<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller {

	private $zona;

	public function __construct()
    {
        parent::__construct();
    }

    public function index(){
    	$this->load->library('AdminTemplate');

    	$data['title'] = "SSH | Admin Satuan Harga";
		$data['menu'] = "home";
		$data['menuLevel'] = 1;

    	$dataTemplate['isi'] = $this->load->view('admin/awal', $data, true);
		$dataTemplate['myScript'] = $this->load->view('save/script.php', null, true);
		//$dataTemplate['navigator'] = $this->load->view('include/navigator', $data, true);

		$dataTemplate['head'] = $this->load->view('include/head.php', null, true);
		$dataTemplate['header'] = $this->load->view('include/header.php', null, true);
		$dataTemplate['sidebar'] = $this->load->view('include/sidebar.php', null, true);

		$dataTemplate['footer'] = $this->load->view('include/footer.php', null, true);
		$dataTemplate['script'] = $this->load->view('include/script.php', null, true);
		$this->admintemplate->templateAdmin($dataTemplate, false);
    }

    

    public function login(){
    	$this->load->model('AdminModel');
    	$hasil = $this->AdminModel->cekLogin($this->input->post());

    	if($hasil)
    		redirect(base_url('admin'));
    	else
    		redirect(base_url());
    }

    public function logout(){
    	$this->session->sess_destroy();

     	redirect(base_url(),'refresh');
    }


}