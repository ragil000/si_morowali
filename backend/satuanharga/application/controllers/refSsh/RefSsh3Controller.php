<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RefSsh3Controller extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('refSsh/RefSsh3Model');
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

		$data['title'] = "SSH 3 | Admin Satuan Harga";
		$data['menu'] = "ssh";
		$data['menuLevel'] = 3;
		$data['pesan'] = $this->setSsh();
		if(@$this->session->flashdata('message')){
			$data['pesan'] = $this->session->flashdata('message');
		}

		if($dataId != null){	//to delete record from script.php / see route.php
			$data['pesan'] = $this->deleteSsh($dataId);
			$this->session->set_flashdata('message', $data['pesan']);
			redirect(base_url('admin/ssh3/page-'.$page.'?search='.$search), 'refresh');
		}

		$data['page'] = $page;
		$data['tableName'] = 'ssh3';   //for page
		$data['jumlahRecInPage'] = $this->RefSsh3Model->getJumlahSshInPage();
		$data['jumlahRec'] = $this->RefSsh3Model->getCountSsh($search);
		$data['search'] = $search;

		$data['ssh'] = $this->RefSsh3Model->getAllSsh($page, $search);
		//$data['idLast'] = $this->getLastId($data['nomor'], '-');

		$dataTemplate['isi'] = $this->load->view('refSsh/ref-ssh3/table', $data, true);
		$dataTemplate['navigator'] = $this->load->view('include/navigator', $data, true);
		$dataTemplate['myScript'] = $this->load->view('refSsh/ref-ssh3/script.php', null, true);

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
			$this->form_validation->set_rules('kode_ssh2', 'kode_ssh2', 'required',
         array('required' => '%s belum terisi.')
      );

      if ($this->form_validation->run() == FALSE)
      {
          echo validation_errors();
      }
      else
      {
				if($this->input->post("tombol") == "Buat SSH"){
					if($this->RefSsh3Model->createSsh($this->input->post()))
						$pesan = "Berhasil Membuat SSH";
					else
						$pesan = "Gagal menyimpan data SSH";
				}else if($this->input->post("tombol") == "Edit SSH"){
					if($this->RefSsh3Model->updateSsh($this->input->post()))
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
		if($this->RefSsh3Model->deleteSsh($dataId)){
			$pesan = 'Berhasil Menghapus SSH';
		}
		return $pesan;
	}

	public function getSsh($id,$tableName){
		$data = $this->RefSsh3Model->getSsh($id,$tableName);
		echo json_encode($data);
	}


}
