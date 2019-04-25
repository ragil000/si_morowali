<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RefSsh2Controller extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('refSsh/RefSsh2Model');
				$this->load->helper('url_helper');
    }

	public function index($page = 1,$dataId = null)
	{
		$this->load->library('AdminTemplate');
		$this->load->library('Fungsi');

		$search = '';
		if(@$_GET['search']){
			$search = $_GET['search'];
		}

		$data['title'] = "SSH 2 | Admin Satuan Harga";
		$data['menu'] = "ssh";
		$data['menuLevel'] = 2;
		$data['pesan'] = $this->setSsh();
		if(@$this->session->flashdata('message')){
			$data['pesan'] = $this->session->flashdata('message');
		}

		if($dataId != null){										//dr script.php
			$data['pesan'] = $this->deleteSsh($dataId);
			$this->session->set_flashdata('message', $data['pesan']);
			redirect(base_url('admin/ssh2/page-'.$page.'?search='.$search), 'refresh');
		}

		$data['page'] = $page;
		$data['tableName'] = 'ssh2';   //for page
		$data['jumlahRecInPage'] = $this->RefSsh2Model->getJumlahSshInPage();
		$data['jumlahRec'] = $this->RefSsh2Model->getCountSsh($search);
		$data['search'] = $search;

		$data['ssh'] = $this->RefSsh2Model->getAllSsh($page, $search);
		//$data['idLast'] = $this->getLastId($data['nomor'], '-');

		$dataTemplate['isi'] = $this->load->view('refSsh/ref-ssh2/table', $data, true);
		$dataTemplate['navigator'] = $this->load->view('include/navigator', $data, true);
		$dataTemplate['myScript'] = $this->load->view('refSsh/ref-ssh2/script.php', null, true);

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
          	if($this->RefSsh2Model->createSsh($this->input->post()))
							$pesan = "Berhasil Membuat SSH";
						else
							$pesan = "Gagal menyimpan data SSH";
          }else if($this->input->post("tombol") == "Edit SSH"){
		        if($this->RefSsh2Model->updateSsh($this->input->post()))
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
		if($this->RefSsh2Model->deleteSsh($dataId)){
			$pesan = 'Berhasil Menghapus SSH';
		}
		return $pesan;
	}

	public function getSsh($id,$tableName){   ///view detail
		$data = $this->RefSsh2Model->getSsh($id,$tableName);
		echo json_encode($data);
	}


}
