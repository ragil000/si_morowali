<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RefHspk3Controller extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('refHspk/RefHspk3Model');
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

		$data['title'] = "HSPK 3 | Admin Satuan Harga";
		$data['menu'] = "hspk";
		$data['menuLevel'] = 3;
		$data['pesan'] = $this->setHspk();
		if(@$this->session->flashdata('message')){
			$data['pesan'] = $this->session->flashdata('message');
		}

		if($dataId != null){	//to delete record from script.php / see route.php
			$data['pesan'] = $this->deleteHspk($dataId);
			$this->session->set_flashdata('message', $data['pesan']);
			redirect(base_url('admin/hspk3/page-'.$page.'?search='.$search), 'refresh');
		}

		$data['page'] = $page;
		$data['tableName'] = 'hspk3';   //for page
		$data['jumlahRecInPage'] = $this->RefHspk3Model->getJumlahHspkInPage();
		$data['jumlahRec'] = $this->RefHspk3Model->getCountHspk($search);
		$data['search'] = $search;

		$data['hspk'] = $this->RefHspk3Model->getAllHspk($page, $search);

		$dataTemplate['isi'] = $this->load->view('refHspk/ref-hspk3/table', $data, true);
		$dataTemplate['navigator'] = $this->load->view('include/navigator', $data, true);
		$dataTemplate['myScript'] = $this->load->view('refHspk/ref-hspk3/script.php', null, true);

		$dataTemplate['head'] = $this->load->view('include/head.php', null, true);
		$dataTemplate['header'] = $this->load->view('include/header.php', null, true);
		$dataTemplate['sidebar'] = $this->load->view('include/sidebar.php', null, true);

		$dataTemplate['footer'] = $this->load->view('include/footer.php', null, true);
		$dataTemplate['script'] = $this->load->view('include/script.php', null, true);

		$this->admintemplate->templateAdmin($dataTemplate);

	}

	public function setHspk(){
		$pesan = '';
		if($this->input->post()){
			$this->load->library('form_validation');
      $this->form_validation->set_rules('kode_hspk1', 'kode_hspk1', 'required',
         array('required' => '%s belum terisi.')
      );
      if ($this->form_validation->run() == FALSE)
      {
          echo validation_errors();
      }
      else
      {
          if($this->input->post("tombol") == "Buat HSPK"){
          	if($this->RefHspk3Model->createHspk($this->input->post()))
							$pesan = "Berhasil Membuat HSPK";
						else
							$pesan = "Gagal menyimpan data HSPK";
          }else if($this->input->post("tombol") == "Edit HSPK"){
		        if($this->RefHspk3Model->updateHspk($this->input->post()))
							$pesan = "Berhasil Mengubah HSPK";
						else
							$pesan = "Gagal mengubah data HSPK";
          }
      }
		}
		return $pesan;
	}

	public function deleteHspk($dataId){
		$pesan = '';
		if($this->RefHspk3Model->deleteHspk($dataId)){
			$pesan = 'Berhasil Menghapus HSPK';
		}
		return $pesan;
	}

	public function getHspk($id,$tableName){
		$data = $this->RefHspk3Model->getHspk($id,$tableName);
		echo json_encode($data);
	}


}
