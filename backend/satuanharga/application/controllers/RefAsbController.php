<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RefAsbController extends CI_Controller {

	private $zona;

	public function __construct()
    {
        parent::__construct();
        $this->load->model('RefAsbModel');
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
 	 		redirect(base_url('admin/asb/page-'.$page.'?search='.$search.'&zona='.$data['zona']), 'refresh'); 
		}


		$data['page'] = $page;
		$data['tableName'] = 'asb';
		$data['jumlahRecInPage'] = $this->RefAsbModel->getJumlahInPage();
		$data['jumlahRec'] = $this->RefAsbModel->getCount($search);
		$data['search'] = $search;

		$data['ssh1']  = $this->RefAsbModel->getAsb(1, '');
		$data['satuan'] = $this->RefAsbModel->getSatuan();
		$data['ssh'] = $this->RefAsbModel->getAll($page, $search);

		$data['pekerjaan']  = $this->RefAsbModel->tableAll('ref_kategori_pekerjaan_asb');

		$data['title'] = "ASB | Admin Satuan Harga";
		$data['menu'] = "asb";
		$data['menuLevel'] = 5;

		$dataTemplate['isi'] = $this->load->view('ref-asb/table', $data, true);
		$dataTemplate['myScript'] = $this->load->view('ref-asb/script.php', null, true);
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
		if($this->RefAsbModel->delete($dataId, null, null, true)){
			$pesan = 'Berhasil Menghapus HSPK';
		}
		return $pesan;
	}


	public function getAsb($asb, $dataId){
		$data = $this->RefAsbModel->getAsb($asb, $dataId);

		echo json_encode($data);
		
	}

	public function getAsb2($asb, $dataId){
		$data = $this->RefAsbModel->getAsb2($asb, $dataId);

		echo json_encode($data);
		
	}
	
	public function getHspk($ssh, $dataId){
		$data = $this->RefAsbModel->getHspk($ssh, $dataId);

		echo json_encode($data);
		
	}

	public function getSSh($ssh, $dataId){
		$data = $this->RefAsbModel->getSsh($ssh, $dataId);

		echo json_encode($data);
		
	}

	public function setData($zona){
		$data = $this->RefAsbModel->setData($this->input->post(),$zona);

		echo json_encode($data);
	}

	public function setDataAsb($zona){
		$data = $this->RefAsbModel->setDataAsb($this->input->post(),$zona);
		//print_r($this->input->post());
		echo json_encode($data);
	}

	public function loadDataAsb($zona){
		$data = $this->RefAsbModel->loadDataAsb($this->input->post(),$zona);
		echo json_encode($data);
	}

	public function deleteDataSsh($zona){
		
		$data = $this->RefAsbModel->deleteDataSsh($this->input->post(),$zona);
		echo json_encode($data);
	}

	public function setIsiAsb(){
		ini_set('max_execution_time', 0); 
		ini_set('memory_limit','2048M');
        $data = $this->db->get('Ta_Hspk_Asb');
        foreach ($data->result_array() as $key) {
            // $dataUpdate = array(
            //     'HargaZona1' => $key['HargaZona1'], 
            //     'HargaZona2' => $key['HargaZona2'], 
            //     'HargaZona3' => $key['HargaZona3'], 
            //     'HargaZona4' => $key['HargaZona4'], 
            //     'Harga' => $key['HargaZona2'],
            // );
            // $this->db->update('ref_asb', $dataUpdate);
             $this->db->group_by('Kd_Asb1 AND Kd_Asb2 AND Kd_Asb3 AND Kd_Asb4 AND Kd_Asb5');
            $idAsb = $key['Kd_Asb1']."-".$key['Kd_Asb2']."-".$key['Kd_Asb3']."-".$key['Kd_Asb4']."-".$key['Kd_Asb5'];
            $this->RefAsbModel->setHspk($idAsb,null,null, 2);
            $edit = false;
          //   if($key['Asal'] == 3){
          //   	$id[0] = $key['Kd_Hspk_Ssh1'];
	        	// $id[1] = $key['Kd_Hspk_Ssh2'];
	        	// $id[2] = $key['Kd_Hspk_Ssh3'];
	        	// $id[3] = $key['Kd_Hspk_Ssh4'];
	        	// $id[4] = $key['Kd_Ssh5'];

	        	// for($i = 6; $i>1; $i--){
	         //    	$this->db->where('Kd_Asb'.($i-1), $id[($i-2)]);
		        // }
		        // $data2 = $this->db->get('ref_asb')->row();
		        // if(count($data2) > 0){
		        // 	for($i = 6; $i>1; $i--){
		        // 		if(($i-1) <=4)
		        //     		$this->db->where('Kd_Hspk_Ssh'.($i-1), $id[($i-2)]);
		        //     	else
		        //     		$this->db->where('Kd_Ssh'.($i-1), $id[($i-2)]);
			       //  }
		        // 	$dataUpdate = array(
		        //         'HargaZona1' => $data2->HargaZona1*$key['Koefisien'], 
		        //         'HargaZona2' => $data2->HargaZona2*$key['Koefisien'], 
		        //         'HargaZona3' => $data2->HargaZona3*$key['Koefisien'], 
		        //         'HargaZona4' => $data2->HargaZona4*$key['Koefisien'], 
		        //         'Jumlah_Harga' => $data2->HargaZona2*$key['Koefisien'], 
		        //         'Harga_Satuan' => $data2->HargaZona2,
		        //     );
		        //    $edit = $this->db->update('Ta_Hspk_Asb', $dataUpdate);
		            
		        // }
          //   }else if($key['Asal'] == 2){
          //   	$id[0] = $key['Kd_Hspk_Ssh1'];
	        	// $id[1] = $key['Kd_Hspk_Ssh2'];
	        	// $id[2] = $key['Kd_Hspk_Ssh3'];
	        	// $id[3] = $key['Kd_Hspk_Ssh4'];

	        	// for($i = 5; $i>1; $i--){
	         //    	$this->db->where('Kd_Hspk'.($i-1), $id[($i-2)]);
		        // }
		        // $data2 = $this->db->get('ref_hspk')->row();
		        // if(count($data2) > 0){
		        // 	for($i = 5; $i>1; $i--){
		        // 		if(($i-1) <=4)
		        //     		$this->db->where('Kd_Hspk_Ssh'.($i-1), $id[($i-2)]);
		        //     	else
		        //     		$this->db->where('Kd_Ssh'.($i-1), $id[($i-2)]);
			       //  }
		        // 	$dataUpdate = array(
		        //         'HargaZona1' => $data2->HargaZona1*$key['Koefisien'], 
		        //         'HargaZona2' => $data2->HargaZona2*$key['Koefisien'], 
		        //         'HargaZona3' => $data2->HargaZona3*$key['Koefisien'], 
		        //         'HargaZona4' => $data2->HargaZona4*$key['Koefisien'], 
		        //         'Jumlah_Harga' => $data2->HargaZona2*$key['Koefisien'], 
		        //         'Harga_Satuan' => $data2->HargaZona2,
		        //     );
		        //     $edit = $this->db->update('Ta_Hspk_Asb', $dataUpdate);
		            
		        // }
          //   }else if($key['Asal'] == 1){
          //   	$id[0] = $key['Kd_Hspk_Ssh1'];
	        	// $id[1] = $key['Kd_Hspk_Ssh2'];
	        	// $id[2] = $key['Kd_Hspk_Ssh3'];
	        	// $id[3] = $key['Kd_Hspk_Ssh4'];
	        	// $id[4] = $key['Kd_Ssh5'];
	        	// $id[5] = $key['Kd_Ssh6'];

	        	// for($i = 7; $i>1; $i--){
	         //    	$this->db->where('Kd_Ssh'.($i-1), $id[($i-2)]);
		        // }
		        // $data2 = $this->db->get('ref_ssh')->row();
		        // if(count($data2) > 0){
		        // 	for($i = 7; $i>1; $i--){
		        // 		if(($i-1) <=4)
		        //     		$this->db->where('Kd_Hspk_Ssh'.($i-1), $id[($i-2)]);
		        //     	else
		        //     		$this->db->where('Kd_Ssh'.($i-1), $id[($i-2)]);
			       //  }
		        // 	$dataUpdate = array(
		        //         'HargaZona1' => $data2->harga_zona1*$key['Koefisien'], 
		        //         'HargaZona2' => $data2->harga_zona2*$key['Koefisien'], 
		        //         'HargaZona3' => $data2->harga_zona3*$key['Koefisien'], 
		        //         'HargaZona4' => $data2->harga_zona4*$key['Koefisien'], 
		        //         'Jumlah_Harga' => $data2->harga_zona2*$key['Koefisien'], 
		        //         'Harga_Satuan' => $data2->harga_zona2,
		        //     );
		        //     $edit = $this->db->update('Ta_Hspk_Asb', $dataUpdate);
		            
		        // }
		        
		        
          //   }
          //   if($edit){
		        // 	echo "<pre>";
			       //  print_r($dataUpdate);
			       //  echo "</pre>";
		        // }
        }
        
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
 	 		redirect(base_url('admin/asb/page-'.$page.'?search='.$search.'&zona='.$data['zona']), 'refresh'); 
		}


		$data['page'] = $page;
		$data['tableName'] = 'asb';
		$data['jumlahRecInPage'] = $this->RefAsbModel->getJumlahInPage();
		$data['jumlahRec'] = $this->RefAsbModel->getCount($search);
		$data['search'] = $search;

		$data['ssh1']  = $this->RefAsbModel->getAsb(1, '');
		$data['satuan'] = $this->RefAsbModel->getSatuan();
		$data['ssh'] = $this->RefAsbModel->getAll($page, $search, true);

		$data['pekerjaan']  = $this->RefAsbModel->tableAll('ref_kategori_pekerjaan_asb');

		$data['title'] = "ASB | Admin Satuan Harga";
		$data['menu'] = "asb";
		$data['menuLevel'] = 5;

		$dataTemplate['isi'] = $this->load->view('save/asb/table', $data, true);
		$dataTemplate['myScript'] = $this->load->view('save/asb/script.php', null, true);
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
