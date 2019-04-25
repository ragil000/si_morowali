<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ImportController extends CI_Controller {

	private $zona, $judul, $satuan,$kode;

	public function __construct()
    {
        parent::__construct();

        $this->load->model('ImportModel');
        $this->load->library('Fungsi');
        $this->judul = '';
		$this->load->library('AdminTemplate');
		$this->admintemplate->cekLevel('admin');
    }

    public function showExport($error = null){

    	$data['title'] = "Import | Admin Satuan Harga";
		$data['menu'] = "import";
		$data['menuLevel'] = 1;
		$name = 'ssh';
		if($name == 'ssh'){
			$data['menuLevel'] = 1;
		}else if($name == 'hspk'){
			$data['menuLevel'] = 2;
		}else if($name == 'asb'){
			$data['menuLevel'] = 3;
		}else{
			$data['menuLevel'] = 4;
		}
		
		$data['error'] = $error;

    	$dataTemplate['isi'] = $this->load->view('import-export/export', $data, true);
		$dataTemplate['myScript'] = $this->load->view('import-export/script.php', null, true);
		//$dataTemplate['navigator'] = $this->load->view('include/navigator', $data, true);

		$dataTemplate['head'] = $this->load->view('include/head.php', null, true);
		$dataTemplate['header'] = $this->load->view('include/header.php', null, true);
		$dataTemplate['sidebar'] = $this->load->view('include/sidebar.php', null, true);

		$dataTemplate['footer'] = $this->load->view('include/footer.php', null, true);
		$dataTemplate['script'] = $this->load->view('include/script.php', null, true);
		

		$this->admintemplate->templateAdmin($dataTemplate, false);
    }

    public function importData(){
    	//print_r($this->input->post());
    	//print_r($_FILES['ssh']['tmp_name']);
    	$ssh = $_FILES['ssh']['tmp_name'];
    	$hspk = $_FILES['hspk']['tmp_name'];
    	$asb = $_FILES['asb']['tmp_name'];
    	$num = 1;
    	$nameError = 'ErrorInputData.csv';
    	if($ssh){
    		if($this->input->post('hapusSsh') == 'hapus'){
    			//$this->db->query("DELETE FROM ref_ssh");
    		}
    		
    		$query = $this->db->query('SELECT * FROM ref_ssh');
			$dataAwal = $query->num_rows();

    		$error = $this->import('ssh', $ssh);
    		$this->outputCsv($nameError, $error, $num);

    		$query = $this->db->query('SELECT * FROM ref_ssh');
			$dataAkhir = $query->num_rows();
			
			echo "Data awal = ".$dataAwal." - "." Data Akhir =".$dataAkhir." ==>".($dataAkhir-$dataAwal);
			$num++;
    	}
    	if($hspk){
    		if($this->input->post('hapusHspk') == 'hapus'){
    			//$this->db->query("DELETE FROM ta_ssh_hspk");
				//$this->db->query("DELETE FROM ref_hspk");
    		}
    		
    		$error = $this->import('hspk', $hspk);
    		$this->outputCsv($nameError, $error, $num);
			$num++;
    	}
    	if($asb){
    		if($this->input->post('hapusAsb') == 'hapus'){
    			//$this->db->query("DELETE FROM Ta_Hspk_Asb");
				//$this->db->query("DELETE FROM ref_asb");
    		}
    		
    		$error = $this->import('asb', $asb);
    		$this->outputCsv($nameError, $error, $num);
			$num++;
    	}
    	//ob_flush();
    }

    public function export($name = 'ssh', $data = null){
    	
    	if($data == null){
    		if($name == 'ssh'){
	    		$usersData = $this->ImportModel->exportSsh();
	    	}else if($name == 'hspk'){
	    		$usersData = $this->ImportModel->exportHspk();
	    	}else{
	    		$usersData = $this->ImportModel->exportAsb();
	    	}
	    	$data =  $usersData;
    	}
    	
		//$usersData = $usersData;
    	$this->load->dbutil();
		$this->load->helper('file');
		$this->load->helper('download');
		
		$delimiter = ";";
		$nuline    = "\r\n";
		//print_r($data);
		force_download($name.'.csv', $this->dbutil->csv_from_result($data, $delimiter, $nuline));

    }

    public function import($name = 'ssh', $fileName){
    	ini_set('max_execution_time', 0); 
		ini_set('memory_limit','2048M');
    	$row = 1;
    	$berhasil = 1;
    	$error = array();

    	$sukses = false;
		if (($handle = fopen($fileName, "r")) !== FALSE) {

		    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		        $num = count($data);
		        //echo "<p> $num fields in line $row: <br /></p>\n";
		       
		        for ($c=0; $c < $num; $c++) {
		        	$result = false;
		        	if($row == 1){
		        		$menu = explode(";", $data[$c]);
		        		$menu = str_replace("\"","",$menu);
		        		array_push($error,$menu);
		        		//print_r($menu);
		        	}else{
		        		
		        		if($num == 1){
		        			$data[$c] = str_replace("\"","",$data[$c]);
		        			$data[$c] = str_replace(",","-",$data[$c]);


			        		
		        			$pisah = explode(";", $data[$c]);
			        		

			        		//$pisah = str_replace("\"","",$pisah);
		        			//print_r($pisah);
		        			//echo "<br>";
		        			if($name == 'ssh'){
		        				$result = $this->ImportModel->saveSsh2($pisah);
								
		        			}else if($name == 'hspk'){
		        				
			        			$hspk = explode(".", $pisah[0]);
			        			// echo "<pre>";
		        				// print_r($data[$c]);
		        				// echo "</pre>";
		        				$this->load->model('RefHspkModel');
		        				if(count($hspk) == 4 && $pisah[2] == ''){
				        			$this->judul = $pisah[1]; 
				        			$this->satuan = $pisah[3]; 
				        			$this->kode = $pisah[0]; 
				        			//	echo $this->judul;
				        		}else{
				        			$result = $this->ImportModel->saveHspk($pisah, $this->judul, $this->satuan, $this->kode);
				        		}
				        		//echo $this->kode."-".$pisah[0]." - ".$this->judul." - ".$this->satuan."<br>";
		        				
		        				
		      //   				$this->load->model('RefHspkModel');
		      //   				$kodeHspk = $pisah[0].'-'.$pisah[1].'-'.$pisah[2].'-'.$pisah[3];
		      //   				$kodeSsh  = $pisah[4].'-'.$pisah[5].'-'.$pisah[6].'-'.$pisah[7].'-'.$pisah[8].'-'.$pisah[9];
		      //   				$sshHspk = $this->RefHspkModel->loadSshHspk($kodeHspk, $kodeSsh);
		      //   				//print_r($sshHspk);
		      //   				if($sshHspk){
								// 	$dataKirim = array(
		      //   					'kodeHspk' => $pisah[0].'-'.$pisah[1].'-'.$pisah[2].'-'.$pisah[3],
		      //   					'uraianKegiatan' => $pisah[10], 
		      //   					'satuan' => $pisah[11],
		      //   					'kodeSsh' => $pisah[4].'-'.$pisah[5].'-'.$pisah[6].'-'.$pisah[7].'-'.$pisah[8].'-'.$pisah[9],
		      //   					'satuanSsh' => $sshHspk->Kd_Satuan,
		      //   					'koefisien' => $pisah[13],
		      //   					'kategori' => $pisah[12],
			     //    				);
			     //    				$data = $this->RefHspkModel->setData($dataKirim,2);
			     //    				if(count($data)>0){
			     //    					$result = true;
			     //    				}
								// }
		        			}else if($name == 'asb'){
		        				$this->load->model('RefAsbModel');

		        				$asb = explode(".", $pisah[0]);

		        				if(count($asb) == 5 && $pisah[2] == ''){
				        			$this->judul = $pisah[1]; 
				        			$this->satuan = $pisah[3]; 
				        			$this->kode = $pisah[0]; 
				        			//$result = true;
				        		}else{
				        			$result = $this->ImportModel->saveAsb($pisah, $this->judul, $this->satuan, $this->kode);
				        		}

		        // 				$this->load->model('RefAsbModel');
		        // 				$kodeAsb = $pisah[0].'-'.$pisah[1].'-'.$pisah[2].'-'.$pisah[3].'-'.$pisah[4];
		        // 				$kodeSsh = $pisah[5].'-'.$pisah[6].'-'.$pisah[7].'-'.$pisah[8].'-'.$pisah[9].'-'.$pisah[10];
		        // 				$kodeHspk = "";
		        // 				$kodeAsb2 = "";

		        // 				$asal = $pisah[13];
		        // 				if($asal == 1){
		        // 					$kodeSsh  = $pisah[5].'-'.$pisah[6].'-'.$pisah[7].'-'.$pisah[8].'-'.$pisah[9].'-'.$pisah[10];
		        // 					$getData = $this->RefAsbModel->loadSshHspk($kodeAsb, $kodeSsh, $asal);
		        // 				}else if($asal == 2){
		        // 					$kodeHspk  = $pisah[5].'-'.$pisah[6].'-'.$pisah[7].'-'.$pisah[8];
		        // 					$getData = $this->RefAsbModel->loadSshHspk($kodeAsb, $kodeHspk, $asal);
		        // 				}else if($asal == 3){
		        // 					$kodeAsb2  = $pisah[5].'-'.$pisah[6].'-'.$pisah[7].'-'.$pisah[8].'-'.$pisah[9];
		        // 					$getData = $this->RefAsbModel->loadSshHspk($kodeAsb, $kodeAsb2, $asal);

		        // 				}
		        // 				if($getData){
		        // 					//print_r($getData);
			       //  				$dataKirim = array(
			       //  					"asal" => $pisah[13],
										// "jenisPekerjaan" => $pisah[11],
										// "kodeAsb" => $kodeAsb,
										// "kodeAsb2" => $kodeAsb2,
										// "kodeHspk" => $kodeHspk,
										// "kodeSsh" => $kodeSsh,
										// "koefisien" => $pisah[15],
										// "pekerjaan" => $pisah[14],
										// "satuanAsb" => $pisah[12],
										// "satuanTambahan" => $getData->Kd_Satuan,
			       //  				);
			        				
			       //  				$data = $this->RefAsbModel->setData($dataKirim,2);
			       //  				//echo json_encode($data);
			       //  				if(count($data)>0){
			       //  					$result = true;
			       //  				}
		        // 				}
		        			}else{
		        				$result = false;
		        			}
		        			
		        			if(!$result){
		        				array_push($error,$pisah);
		        			}
			        		$berhasil++;
			        		
			        	}else{

			        		$result = false;
			        	}
			        	
		        	}
		        }
		        if($num!=1){
		        	array_push($error,$data);
		        }
		        $row++;
		    }


		    fclose($handle);
		}
		//echo "Jumlah data yg terbaca = ".$row;
		// echo "<pre>";
		// echo "Jumlah error : ".count($error);
		// print_r($error);
		// echo "</pre>";

  //       echo "<br><br>";
		
		//$this->showExport($error);
		//$this->exportManual($error, $menu);
		return $error;
    }

    public function outputCsv($fileName, $assocDataArray, $num = 1)
	{
		if($num == 1){
		    if(ob_get_length() > 0) {
			    ob_clean();
			}
		    header('Pragma: public');
		    header('Expires: 0');
		    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		    header('Cache-Control: private', false);
		    header('Content-Type: text/csv');
		    header('Content-Disposition: attachment;filename=' . $fileName);  
	    }  
	    if(isset($assocDataArray['0'])){
	        $fp = fopen('php://output', 'w');
	        //fputcsv($fp, $menu, ";", "\"");	
	        foreach($assocDataArray AS $values){
	            fputcsv($fp, $values, ";");
	        }
	        fputcsv($fp, array(), ";", "\"");
	        fputcsv($fp, array(), ";", "\"");
	        fclose($fp);
	    }
	    
	}
}