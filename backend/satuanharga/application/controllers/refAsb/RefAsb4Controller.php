<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RefAsb4Controller extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('refAsb/RefAsb4Model');
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

		$data['title'] = "ASB 4 | Admin Satuan Harga";
		$data['menu'] = "asb";
		$data['menuLevel'] = 4;
		$data['pesan'] = $this->setAsb();
		if(@$this->session->flashdata('message')){
			$data['pesan'] = $this->session->flashdata('message');
		}

		if($dataId != null){	//to delete record from script.php / see route.php
			$data['pesan'] = $this->deleteAsb($dataId);
			$this->session->set_flashdata('message', $data['pesan']);
			redirect(base_url('admin/asb4/page-'.$page.'?search='.$search), 'refresh');
		}

		$data['page'] = $page;
		$data['tableName'] = 'asb4';   //for page
		$data['jumlahRecInPage'] = $this->RefAsb4Model->getJumlahAsbInPage();
		$data['jumlahRec'] = $this->RefAsb4Model->getCountAsb($search);
		$data['search'] = $search;

		$data['asb'] = $this->RefAsb4Model->getAllAsb($page, $search);


		$dataTemplate['isi'] = $this->load->view('refAsb/ref-asb4/table', $data, true);
		$dataTemplate['navigator'] = $this->load->view('include/navigator', $data, true);
		$dataTemplate['myScript'] = $this->load->view('refAsb/ref-asb4/script.php', null, true);

		$dataTemplate['head'] = $this->load->view('include/head.php', null, true);
		$dataTemplate['header'] = $this->load->view('include/header.php', null, true);
		$dataTemplate['sidebar'] = $this->load->view('include/sidebar.php', null, true);

		$dataTemplate['footer'] = $this->load->view('include/footer.php', null, true);
		$dataTemplate['script'] = $this->load->view('include/script.php', null, true);

		$this->admintemplate->templateAdmin($dataTemplate);
	}

	public function setAsb(){
		$pesan = '';
		if($this->input->post()){
			$this->load->library('form_validation');
      $this->form_validation->set_rules('kode_asb1', 'kode_asb1', 'required',
         array('required' => '%s belum terisi.')
      );

      if ($this->form_validation->run() == FALSE)
      {
          echo validation_errors();
      }
      else
      {
				if($this->input->post("tombol") == "Buat ASB"){
					if($this->RefAsb4Model->createAsb($this->input->post()))
						$pesan = "Berhasil Membuat ASB";
					else
						$pesan = "Gagal menyimpan data ASB";
				}else if($this->input->post("tombol") == "Edit ASB"){
					if($this->RefAsb4Model->updateAsb($this->input->post()))
						$pesan = "Berhasil Mengubah ASB";
					else
						$pesan = "Gagal mengubah data ASB";
				}
      }
		}
		return $pesan;
	}

	public function deleteAsb($dataId){
		$pesan = '';
		if($this->RefAsb4Model->deleteAsb($dataId)){
			$pesan = 'Berhasil Menghapus ASB';
		}
		return $pesan;
	}

	public function getAsb($id,$tableName){
		$data = $this->RefAsb4Model->getAsb($id,$tableName);
		echo json_encode($data);
	}


}
