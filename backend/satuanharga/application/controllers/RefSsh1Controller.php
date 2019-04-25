<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RefSsh1Controller extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('RefSsh1Model');
    }
	
	public function index($page = 1,$dataId = null)
	{
		$this->load->library('AdminTemplate');
		$this->load->library('Fungsi');
		
		$search = '';
		if(@$_GET['search']){
			$search = $_GET['search'];
		}

		$data['title'] = "SSH 1 | Admin Satuan Harga";
		$data['menu'] = "ssh";
		$data['menuLevel'] = 1;
		$data['nomor'] = 1;
		$data['pesan'] = $this->setSsh($data['nomor']);
		if(@$this->session->flashdata('message')){
			$data['pesan'] = $this->session->flashdata('message');
		}

		if($dataId != null){
			$data['pesan'] = $this->deleteSsh($data['nomor'], $dataId);
			$this->session->set_flashdata('message', $data['pesan']);
			redirect(base_url('admin/ssh1/page-'.$page.'?search='.$search), 'refresh'); 
		}

		$data['page'] = $page;
		$data['jumlahSshInPage'] = $this->RefSsh1Model->getJumlahSshInPage();
		$data['jumlahSsh'] = $this->RefSsh1Model->getCountSsh($search);
		$data['search'] = $search;

		$data['ssh'] = $this->RefSsh1Model->getAllSsh($page, $search);
		//$data['idLast'] = $this->getLastId($data['nomor'], '-');

		$dataTemplate['isi'] = $this->load->view('ref-ssh1/table', $data, true);
		$dataTemplate['myScript'] = $this->load->view('ref-ssh1/script.php', null, true);

		$dataTemplate['head'] = $this->load->view('include/head.php', null, true);
		$dataTemplate['header'] = $this->load->view('include/header.php', null, true);
		$dataTemplate['sidebar'] = $this->load->view('include/sidebar.php', null, true);

		$dataTemplate['footer'] = $this->load->view('include/footer.php', null, true);
		$dataTemplate['script'] = $this->load->view('include/script.php', null, true);
		

		$this->admintemplate->templateAdmin($dataTemplate);

	}

	public function setSsh($nomor){

		$pesan = '';
		if($this->input->post()){
			$this->load->library('form_validation');
	        $this->form_validation->set_rules('kodeSsh', 'kodeSsh', 'required',
	                array('required' => '%s belum terisi.')
	        );

	        if ($this->form_validation->run() == FALSE)
	        {
	            echo validation_errors();
	        }
	        else
	        {

	            if($this->input->post("tombol") == "Buat SSH"){
	            	if($this->RefSsh1Model->createSsh($this->input->post(),$nomor)){
						$pesan = "Berhasil Membuat SSH";
					}
	            }else if($this->input->post("tombol") == "Edit SSH"){
	            	if($this->RefSsh1Model->updateSsh($this->input->post(), $nomor)){
						$pesan = "Berhasil Mengubah SSH";
					}
	            }
				
	        }
		}
		return $pesan;		
	}

	public function deleteSsh($nomor, $dataId){
		$pesan = '';
		if($this->RefSsh1Model->deleteSsh($nomor, $dataId)){
			$pesan = 'Berhasil Menghapus SSH';
		}
		return $pesan;
	}

	public function getLastId($nomor, $dataId){
		$data = $this->RefSsh1Model->getLast($nomor, $dataId);
		echo json_encode($data);
	}


	// public function getSSh($ssh, $dataId){
	// 	$data = $this->RefSsh1Model->getSsh($ssh, $dataId);

	// 	echo json_encode($data);
		
	// }

}
