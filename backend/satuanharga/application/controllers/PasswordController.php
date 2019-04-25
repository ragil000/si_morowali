<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PasswordController extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('AkunModel');
    }

    public function index($page = 1,$dataId = null){
        $this->load->library('AdminTemplate');
		$this->load->library('Fungsi');
		

		$data['pesan'] = $this->setData();
		if(@$this->session->flashdata('message')){
			$data['pesan'] = $this->session->flashdata('message');
		}

		if($dataId != null){
			$data['pesan'] = $this->delete($dataId);
			$this->session->set_flashdata('message', $data['pesan']);
			redirect(base_url('admin/akun/page-'.$page.'?search='.$search), 'refresh'); 
 	 		//redirect(base_url('admin/ssh'), 'refresh'); 
		}



		$data['title'] = "Password | Admin Satuan Harga";
		$data['menu'] = "password";
		$data['menuLevel'] = 1;

		$dataTemplate['isi'] = $this->load->view('password/form', $data, true);
		$dataTemplate['myScript'] = $this->load->view('password/script.php', null, true);

		$dataTemplate['head'] = $this->load->view('include/head.php', null, true);
		$dataTemplate['header'] = $this->load->view('include/header.php', null, true);
		$dataTemplate['sidebar'] = $this->load->view('include/sidebar.php', null, true);

		$dataTemplate['footer'] = $this->load->view('include/footer.php', null, true);
        $dataTemplate['script'] = $this->load->view('include/script.php', null, true);
        $this->admintemplate->templateAdmin($dataTemplate, false);
    }
    public function setData(){

		$pesan = '';
		if($this->input->post("tombol")){
			$this->load->library('form_validation');
	        $this->form_validation->set_rules('passwordLama', 'passwordLama', 'required',
	                array('required' => 'You must provide a %s.')
	        );

	        if ($this->form_validation->run() == FALSE)
	        {
	            echo validation_errors();
	        }
	        else
	        {

	            if($this->input->post("tombol") == "Ganti Password"){
	            	if($this->AkunModel->ubahPassword($this->input->post())){
						$pesan = "Berhasil Mengganti Password";
					}else{
                        $pesan = "Gagal Mengganti Password";
                    }
	            }
				
	        }
		}
		return $pesan;

        
		
	}
}