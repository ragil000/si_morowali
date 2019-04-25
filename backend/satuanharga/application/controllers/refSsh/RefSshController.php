<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RefSshController extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('refSsh/RefSshModel');
		$this->load->helper('url_helper');
		$this->load->library('AdminTemplate');
		$this->admintemplate->cekLevel('aset');
    }

	public function index($page = 1,$dataId = null)
	{
		$this->load->library('Fungsi');

		$search = '';
		if(@$_GET['search']){
			$search = $_GET['search'];
		}

		$data['zona'] = 1;
		if(@$_GET['zona']){
			$data['zona'] = $_GET['zona'];
		}

		$data['title'] = "SSH | Admin Satuan Harga";
		$data['menu'] = "ssh";
		$data['menuLevel'] = 6;
		$data['pesan'] = $this->setSsh();
		if(@$this->session->flashdata('message')){
			$data['pesan'] = $this->session->flashdata('message');
		}

		if($dataId != null){	//to delete record from script.php / see route.php
			$data['pesan'] = $this->deleteSsh($dataId);
			$this->session->set_flashdata('message', $data['pesan']);
			redirect(base_url('admin/ssh/page-'.$page.'?search='.$search), 'refresh');
		}


		$data['page'] = $page;
		$data['tableName'] = 'ssh';   //for page
		$data['jumlahRecInPage'] = $this->RefSshModel->getJumlahSshInPage();
		$data['jumlahRec'] = $this->RefSshModel->getCountSsh($search);
		$data['search'] = $search;

		$data['ssh'] = $this->RefSshModel->getAllSsh($page, $search);

		$dataTemplate['isi'] = $this->load->view('refSsh/ref-ssh/table', $data, true);
		
		$dataTemplate['myScript'] = $this->load->view('refSsh/ref-ssh/script.php', null, true);
		$dataTemplate['navigator'] = $this->load->view('include/navigator', $data, true);

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
					if($this->RefSsh5Model->createSsh($this->input->post()))
						$pesan = "Berhasil Membuat SSH";
					else
						$pesan = "Gagal menyimpan data SSH";
				}else if($this->input->post("tombol") == "Edit SSH"){
					if($this->RefSsh5Model->updateSsh($this->input->post()))
						$pesan = "Berhasil Mengubah SSH";
					else
						$pesan = "Gagal mengubah data SSH";
				}

      }
		}
		return $pesan;
	}

	public function deleteSsh($dataId){
		$pesan = '';
		if($this->RefSsh5Model->deleteSsh($dataId)){
			$pesan = 'Berhasil Menghapus SSH';
		}
		return $pesan;
	}

	public function getSsh($id,$tableName){
		$data = $this->RefSshModel->getSsh($id,$tableName);
		echo json_encode($data);
	}

	public function getView($id,$tableName){
		$data = $this->RefSshModel->getView($id,$tableName);
		echo json_encode($data);
	}



}
