<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RefAsbPekerjaanController extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('RefAsbPekerjaanModel');
		$this->load->helper('url_helper');
		
		$this->load->library('AdminTemplate');
		$this->admintemplate->cekLevel('opd');
    }

	public function index($page = 1,$dataId = null)
	{
		$this->load->library('Fungsi');

		$search = '';
		if(@$_GET['search']){
			$search = $_GET['search'];
		}

		$data['title'] = "ASB Pekerjaan | Admin Satuan Harga";
		$data['menu'] = "asb";
		$data['menuLevel'] = 6;
		$data['pesan'] = $this->setSsh();
		if(@$this->session->flashdata('message')){
			$data['pesan'] = $this->session->flashdata('message');
		}

		if($dataId != null){	//to delete record from script.php / see route.php
			$data['pesan'] = $this->deleteSsh($dataId);
			$this->session->set_flashdata('message', $data['pesan']);
			redirect(base_url('admin/asb-pekerjaan/page-'.$page.'?search='.$search), 'refresh');
		}

		$data['page'] = $page;
		$data['tableName'] = 'asb-pekerjaan';   //for page
		$data['jumlahRecInPage'] = $this->RefAsbPekerjaanModel->getJumlahSshInPage();
		$data['jumlahRec'] = $this->RefAsbPekerjaanModel->getCountSsh($search);
		$data['search'] = $search;

		$data['ssh'] = $this->RefAsbPekerjaanModel->getAllSsh($page, $search);

		$dataTemplate['isi'] = $this->load->view('ref-asb-pekerjaan/table', $data, true);
		$dataTemplate['navigator'] = $this->load->view('include/navigator', $data, true);
		$dataTemplate['myScript'] = $this->load->view('ref-asb-pekerjaan/script.php', null, true);

		$dataTemplate['head'] = $this->load->view('include/head.php', null, true);
		$dataTemplate['header'] = $this->load->view('include/header.php', null, true);
		$dataTemplate['sidebar'] = $this->load->view('include/sidebar.php', null, true);

		$dataTemplate['footer'] = $this->load->view('include/footer.php', null, true);
		$dataTemplate['script'] = $this->load->view('include/script.php', null, true);

		$this->admintemplate->templateAdmin($dataTemplate);

	}

	public function setSsh(){
		$pesan = '';
		if($this->input->post()){
			$this->load->library('form_validation');
      $this->form_validation->set_rules('kode_ssh1', 'kode_ssh1', 'required',
         array('required' => '%s belum terisi.')
      );
      if ($this->form_validation->run() == FALSE)
      {
          echo validation_errors();
      }
      else
      {
          if($this->input->post("tombol") == "Buat SSH"){
          	if($this->RefAsbPekerjaanModel->createSsh($this->input->post()))
							$pesan = "Berhasil Membuat ASB Pekerjaan";
						else
							$pesan = "Gagal menyimpan data ASB Pekerjaan";
						// print_r($this->input->post());
						// die();
          }else if($this->input->post("tombol") == "Edit SSH"){
		        if($this->RefAsbPekerjaanModel->updateSsh($this->input->post()))
							$pesan = "Berhasil Mengubah ASB Pekerjaan";
						else
							$pesan = "Gagal mengubah data ASB Pekerjaan";
          }

      }
		}
		return $pesan;
	}

	public function deleteSsh($dataId){
		$pesan = '';
		if($this->RefAsbPekerjaanModel->deleteSsh($dataId)){
			$pesan = 'Berhasil Menghapus SSH';
		}
		return $pesan;
	}

	public function getSsh($id,$tableName){
		$data = $this->RefAsbPekerjaanModel->getSsh($id,$tableName);
		echo json_encode($data);
	}


}
