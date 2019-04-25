<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RefSshController extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->model('RefSshModel');
		$this->load->library('AdminTemplate');
		$this->admintemplate->cekLevel('aset');
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

		

		$data['pesan'] = $this->setSsh($data['zona']);
		if(@$this->session->flashdata('message')){
			$data['pesan'] = $this->session->flashdata('message');
		}

		if($dataId != null){
			$data['pesan'] = $this->deleteSsh($dataId);
			$this->session->set_flashdata('message', $data['pesan']);
			redirect(base_url('admin/ssh/page-'.$page.'?search='.$search.'&zona='.$data['zona']), 'refresh'); 
 	 		//redirect(base_url('admin/ssh'), 'refresh'); 
		}

		$data['page'] = $page;
		$data['tableName'] = 'ssh';   //for page
		$data['jumlahRecInPage'] = $this->RefSshModel->getJumlahSshInPage();
		$data['jumlahRec'] = $this->RefSshModel->getCountSsh($search);
		$data['search'] = $search;

		$data['ssh1']  = $this->RefSshModel->getSsh(1, '');
		$data['satuan'] = $this->RefSshModel->getSatuan();
		$data['ssh'] = $this->RefSshModel->getAllSsh($page, $search);

		$data['title'] = "SSH | Admin Satuan Harga";
		$data['menu'] = "ssh";
		$data['menuLevel'] = 6;

		$dataTemplate['isi'] = $this->load->view('ref-ssh/table', $data, true);
		$dataTemplate['myScript'] = $this->load->view('ref-ssh/script.php', null, true);
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

	public function setSsh($zona){

		$pesan = '';
		if($this->input->post()){
			$this->load->library('form_validation');

	        //$this->form_validation->set_rules('namaBarang', 'namaBarang', 'required');
	        $this->form_validation->set_rules('namaBarang', 'namaBarang', 'required',
	                array('required' => 'You must provide a %s.')
	        );
	        // $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
	        // $this->form_validation->set_rules('email', 'Email', 'required');

	        if ($this->form_validation->run() == FALSE)
	        {
	            //$this->load->view('welcome');
	            echo validation_errors();
	        }
	        else
	        {

	            if($this->input->post("tombol") == "Buat SSH"){
	            	if($this->RefSshModel->createSsh($this->input->post(),$zona)){
						$pesan = "Berhasil Membuat SSH";
					}
	            }else if($this->input->post("tombol") == "Edit SSH"){
	            	if($this->RefSshModel->updateSsh($this->input->post(),$zona)){
						$pesan = "Berhasil Mengubah SSH";
					}
	            }
				
	        }
		}
		return $pesan;

        
		
	}

	public function deleteSsh($dataId){
		$pesan = '';
		if($this->RefSshModel->deleteSsh($dataId)){
			$pesan = 'Berhasil Menghapus SSH';
		}
		return $pesan;
	}


	public function getSSh($ssh, $dataId){
		$data = $this->RefSshModel->getSsh($ssh, $dataId);

		echo json_encode($data);
		
	}

	public function loadDataHspk($zona){
		$data = $this->RefSshModel->loadDataHspk($this->input->post(),$zona);
		echo json_encode($data);
	}

	public function changeAllSsh(){
		ini_set('max_execution_time', 0); 
		ini_set('memory_limit','2048M');
		$this->load->library('Fungsi');
        $ssh = $this->db->get('ref_ssh')->result_array();
        echo "<pre>";
        foreach ($ssh as $key) {
        	print_r($key);
        	$id[0] = $key['Kd_Ssh1'];
        	$id[1] = $key['Kd_Ssh2'];
        	$id[2] = $key['Kd_Ssh3'];
        	$id[3] = $key['Kd_Ssh4'];
        	$id[4] = $key['Kd_Ssh5'];
        	$id[5] = $key['Kd_Ssh6'];

        	for($i = 7; $i>1; $i--){
            $this->db->where('Kd_Ssh'.($i-1), $id[($i-2)]);
	        }

	        //$zona = $post['zona'];
	        $harga = $this->fungsi->convert_to_number($key['Harga_Satuan']);

	        $result = $this->db->update('ref_ssh', array(
	            'Harga_Satuan' => $harga, 
	            'harga_zona1' => $harga+($harga*0.03), 
	            'harga_zona2' => $harga, 
	            'harga_zona3' => $harga+($harga*0.06), 
	            'harga_zona4' => $harga+($harga*0.1), 
	        ));
        	//print_r($id);
        	$this->RefSshModel->setAllSsh($id, 2, $harga);
        }
        echo "</pre>";
        //print_r($ssh);

        //$this->setAllSsh($id, $zona, $this->fungsi->convert_to_number($post['hargaZona'.$zona]));
    }
}
