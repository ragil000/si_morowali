<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RefHspkController extends CI_Controller {

	private $zona;

	public function __construct()
    {
        parent::__construct();
		$this->load->model('RefHspkModel');
		$this->load->library('AdminTemplate');
		$this->admintemplate->cekLevel('opd');
    }
	
	public function index($page = 1,$dataId = null)
	{
		
		$this->load->library('Fungsi');

		
		//echo "<script>alert('".$_GET['search']."')</script>";
		$search = '';
		if(@$_GET['search']){
			$search = $_GET['search'];
		}

		$data['zona'] = 1;
		if(@$_GET['zona']){
			$data['zona'] = $_GET['zona'];
		}

		
		$data['pesan'] = '';
		//$data['pesan'] = $this->setHspk($data['zona']);
		if(@$this->session->flashdata('message')){
			$data['pesan'] = $this->session->flashdata('message');
		}

		if($dataId != null){
			$data['pesan'] = $this->delete($dataId);
			$this->session->set_flashdata('message', $data['pesan']);
 	 		redirect(base_url('admin/hspk/page-'.$page.'?search='.$search.'&zona='.$data['zona']), 'refresh'); 
		}

		$data['page'] = $page;
		$data['tableName'] = 'hspk';
		$data['jumlahRecInPage'] = $this->RefHspkModel->getJumlahInPage();
		$data['jumlahRec'] = $this->RefHspkModel->getCount($search);
		$data['search'] = $search;

		$data['ssh1']  = $this->RefHspkModel->get(1, '');
		$data['satuan'] = $this->RefHspkModel->getSatuan();
		
		$data['ssh'] = $this->RefHspkModel->getAll($page, $search);

		$data['title'] = "HSPK | Admin Satuan Harga";
		$data['menu'] = "hspk";
		$data['menuLevel'] = 4;

		$dataTemplate['isi'] = $this->load->view('ref-hspk/table', $data, true);
		$dataTemplate['myScript'] = $this->load->view('ref-hspk/script.php', null, true);
		$dataTemplate['navigator'] = $this->load->view('include/navigator', $data, true);

		$dataTemplate['head'] = $this->load->view('include/head.php', null, true);
		$dataTemplate['header'] = $this->load->view('include/header.php', null, true);
		$dataTemplate['sidebar'] = $this->load->view('include/sidebar.php', null, true);

		$dataTemplate['footer'] = $this->load->view('include/footer.php', null, true);
		$dataTemplate['script'] = $this->load->view('include/script.php', null, true);
		

		$this->admintemplate->templateAdmin($dataTemplate);
		//$this->admintemplate->templateAdmin2($dataTemplate);

		//$this->load->view('ref-ssh/table2', $data);

	}



	public function delete($dataId){
		$pesan = '';
		if($this->RefHspkModel->delete($dataId)){
			$pesan = 'Berhasil Menghapus HSPK';
		}
		return $pesan;
	}


	public function get($ssh, $dataId){
		$data = $this->RefHspkModel->get($ssh, $dataId);

		echo json_encode($data);
		
	}

	public function getSSh($ssh, $dataId){
		$data = $this->RefHspkModel->getSsh($ssh, $dataId);

		echo json_encode($data);
	}

	public function setData($zona){
		$data = $this->RefHspkModel->setData($this->input->post(),$zona);
		
		echo json_encode($data);
	}

	public function setDataHspk($zona){
		$data = $this->RefHspkModel->setDataHspk($this->input->post(),$zona);
		//print_r($this->input->post());
		echo json_encode($data);
	}

	public function loadDataHspk($zona){
		$data = $this->RefHspkModel->loadDataHspk($this->input->post(),$zona);
		echo json_encode($data);
	}

	public function deleteDataSsh($zona){
		$data = $this->RefHspkModel->deleteDataSsh($this->input->post(),$zona);
		echo json_encode($data);
	}

	public function save($page = 1,$dataId = null)
	{
		
		$this->load->library('Fungsi');

		
		//echo "<script>alert('".$_GET['search']."')</script>";
		$search = '';
		if(@$_GET['search']){
			$search = $_GET['search'];
		}

		$data['zona'] = 1;
		if(@$_GET['zona']){
			$data['zona'] = $_GET['zona'];
		}

		
		$data['pesan'] = '';
		//$data['pesan'] = $this->setHspk($data['zona']);
		if(@$this->session->flashdata('message')){
			$data['pesan'] = $this->session->flashdata('message');
		}

		if($dataId != null){
			$data['pesan'] = $this->delete($dataId);
			$this->session->set_flashdata('message', $data['pesan']);
 	 		redirect(base_url('admin/hspk/page-'.$page.'?search='.$search.'&zona='.$data['zona']), 'refresh'); 
		}

		$data['page'] = $page;
		$data['tableName'] = 'hspk';
		$data['jumlahRecInPage'] = $this->RefHspkModel->getJumlahInPage();
		$data['jumlahRec'] = $this->RefHspkModel->getCount($search, true);
		$data['search'] = $search;

		$data['ssh1']  = $this->RefHspkModel->get(1, '');
		$data['satuan'] = $this->RefHspkModel->getSatuan();
		
		$data['ssh'] = $this->RefHspkModel->getAll($page, $search, true);

		$data['title'] = "HSPK | Admin Satuan Harga";
		$data['menu'] = "hspk";
		$data['menuLevel'] = 4;

		$dataTemplate['isi'] = $this->load->view('save/hspk/table', $data, true);
		$dataTemplate['myScript'] = $this->load->view('save/hspk/script.php', null, true);
		$dataTemplate['navigator'] = $this->load->view('include/navigator', $data, true);

		$dataTemplate['head'] = $this->load->view('include/head.php', null, true);
		$dataTemplate['header'] = $this->load->view('include/header.php', null, true);
		$dataTemplate['sidebar'] = $this->load->view('include/sidebar.php', null, true);

		$dataTemplate['footer'] = $this->load->view('include/footer.php', null, true);
		$dataTemplate['script'] = $this->load->view('include/script.php', null, true);
		

		$this->admintemplate->templateAdminSave($dataTemplate);
		//$this->admintemplate->templateAdmin2($dataTemplate);

		//$this->load->view('ref-ssh/table2', $data);

	}
}
