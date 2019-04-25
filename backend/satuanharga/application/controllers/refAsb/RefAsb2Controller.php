<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RefAsb2Controller extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('refAsb/RefAsb2Model');
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

		$data['title'] = "ASB 2 | Admin Satuan Harga";
		$data['menu'] = "asb";
		$data['menuLevel'] = 2;
		$data['pesan'] = $this->setAsb();
		if(@$this->session->flashdata('message')){
			$data['pesan'] = $this->session->flashdata('message');
		}

		if($dataId != null){										//dr script.php
			$data['pesan'] = $this->deleteAsb($dataId);
			$this->session->set_flashdata('message', $data['pesan']);
			redirect(base_url('admin/asb2/page-'.$page.'?search='.$search), 'refresh');
		}

		$data['page'] = $page;
		$data['tableName'] = 'asb2';   //for page
		$data['jumlahRecInPage'] = $this->RefAsb2Model->getJumlahAsbInPage();
		$data['jumlahRec'] = $this->RefAsb2Model->getCountAsb($search);
		$data['search'] = $search;

		$data['asb'] = $this->RefAsb2Model->getAllAsb($page, $search);
		//$data['idLast'] = $this->getLastId($data['nomor'], '-');

		$dataTemplate['isi'] = $this->load->view('refAsb/ref-asb2/table', $data, true);
		$dataTemplate['navigator'] = $this->load->view('include/navigator', $data, true);
		$dataTemplate['myScript'] = $this->load->view('refAsb/ref-asb2/script.php', null, true);

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
          	if($this->RefAsb2Model->createAsb($this->input->post()))
							$pesan = "Berhasil Membuat ASB";
						else
							$pesan = "Gagal menyimpan data ASB";
          }else if($this->input->post("tombol") == "Edit ASB"){
		        if($this->RefAsb2Model->updateAsb($this->input->post()))
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
		if($this->RefAsb2Model->deleteAsb($dataId)){
			$pesan = 'Berhasil Menghapus ASB';
		}
		return $pesan;
	}

	public function getAsb($id,$tableName){   ///view detail
		$data = $this->RefAsb2Model->getAsb($id,$tableName);
		echo json_encode($data);
	}


}
