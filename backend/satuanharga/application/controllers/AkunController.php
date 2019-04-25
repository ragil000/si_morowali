<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AkunController extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('AkunModel');
		$this->load->library('AdminTemplate');
		$this->admintemplate->cekLevel('admin');
    }
	
	public function index($page = 1,$dataId = null)
	{
		$this->load->library('Fungsi');
		
		//echo "<script>alert('".$_GET['search']."')</script>";
		$search = '';
		if(@$_GET['search']){
			$search = $_GET['search'];
		}

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

		$data['page'] = $page;
		$data['tableName'] = 'ssh';   //for page
		$data['jumlahRecInPage'] = $this->AkunModel->getJumlahInPage();
		$data['jumlahRec'] = $this->AkunModel->getCount($search);
		$data['search'] = $search;

		$data['ssh'] = $this->AkunModel->getAll($page, $search);

		$data['title'] = "SSH | Admin Satuan Harga";
		$data['menu'] = "akun";
		$data['menuLevel'] = 1;

		$dataTemplate['isi'] = $this->load->view('akun/table', $data, true);
		$dataTemplate['myScript'] = $this->load->view('akun/script.php', null, true);
		$dataTemplate['navigator'] = $this->load->view('include/navigator', $data, true);

		$dataTemplate['head'] = $this->load->view('include/head.php', null, true);
		$dataTemplate['header'] = $this->load->view('include/header.php', null, true);
		$dataTemplate['sidebar'] = $this->load->view('include/sidebar.php', null, true);

		$dataTemplate['footer'] = $this->load->view('include/footer.php', null, true);
		$dataTemplate['script'] = $this->load->view('include/script.php', null, true);
		

		$this->admintemplate->templateAdmin($dataTemplate);

	}

	public function setData(){

		$pesan = '';
		if($this->input->post("tombol")){
			$this->load->library('form_validation');
	        $this->form_validation->set_rules('username', 'username', 'required',
	                array('required' => 'You must provide a %s.')
	        );

	        if ($this->form_validation->run() == FALSE)
	        {
	            echo validation_errors();
	        }
	        else
	        {

	            if($this->input->post("tombol") == "Buat Akun"){
	            	if($this->AkunModel->create($this->input->post())){
						$pesan = "Berhasil Membuat Akun";
					}
	            }else if($this->input->post("tombol") == "Edit Akun"){
	            	if($this->AkunModel->update($this->input->post())){
						$pesan = "Berhasil Mengubah Akun";
					}
	            }
				
	        }
		}
		return $pesan;

        
		
	}

	public function loadData(){
		$data = $this->AkunModel->loadData($this->input->post());
		echo json_encode($data);
	}

	public function delete($dataId){
		$pesan = '';
		if($this->AkunModel->delete($dataId)){
			$pesan = 'Berhasil Menghapus Akun';
		}
		return $pesan;
	}

}
