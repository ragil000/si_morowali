<?php

class ImportModel extends CI_Model
{
	private $tableChange;
    public function __construct()
    {
        parent::__construct();
        $this->tableChange = 'Ta_Hspk_Asb';
    }

    public function exportHspk(){
    	$response = array();
 
	    // Select record
	    $this->db->select('ref_hspk.Kd_Hspk1, ref_hspk.Kd_Hspk2, ref_hspk.Kd_Hspk3, ref_hspk.Kd_Hspk4,
	    			Kd_Ssh1, Kd_Ssh2, Kd_Ssh3, Kd_Ssh4, Kd_Ssh5, Kd_Ssh6, Uraian_Kegiatan, ref_hspk.Kd_Satuan, Kategori, Koefisien, Harga_Satuan, ta_ssh_hspk.Harga');

	    $this->db->from('ref_hspk, ta_ssh_hspk');

	    $this->db->where('ta_ssh_hspk.Kd_Hspk1 = ref_hspk.Kd_Hspk1
	    	and ta_ssh_hspk.Kd_Hspk2 = ref_hspk.Kd_Hspk2
	    	and ta_ssh_hspk.Kd_Hspk3 = ref_hspk.Kd_Hspk3
	    	and ta_ssh_hspk.Kd_Hspk4 = ref_hspk.Kd_Hspk4');

	    $data = $this->db->get();

	    return $data;
    }

    public function exportSsh(){
 
	    // Select record
	    $this->db->select('Kd_Ssh1, Kd_Ssh2, Kd_Ssh3, Kd_Ssh4, Kd_Ssh5, Kd_Ssh6, Nama_Barang, Spesifikasi, Kd_Satuan, Satuan, Harga_Satuan');

	    $this->db->from('ref_ssh');

	    $data = $this->db->get();
	 
	    return $data;
    }

    public function exportAsb(){
    	$response = array();
 
	    // Select record
	    $this->db->select('ref_asb.Kd_Asb1, ref_asb.Kd_Asb2, ref_asb.Kd_Asb3, ref_asb.Kd_Asb4, ref_asb.Kd_Asb5,
	    			Kd_Hspk_Ssh1, Kd_Hspk_Ssh2, Kd_Hspk_Ssh3, Kd_Hspk_Ssh4, Kd_Ssh5, Kd_Ssh6, Jenis_Pekerjaan,  ref_asb.Kd_Satuan, Asal, Kategori_Pekerjaan, Koefisien, Harga_Satuan, ref_asb.Harga 
	    	');

	    $this->db->from('ref_asb, '.$this->tableChange);

	    $this->db->where($this->tableChange.'.Kd_Asb1 = ref_asb.Kd_Asb1
	    	and '.$this->tableChange.'.Kd_Asb2 = ref_asb.Kd_Asb2
	    	and '.$this->tableChange.'.Kd_Asb3 = ref_asb.Kd_Asb3
	    	and '.$this->tableChange.'.Kd_Asb4 = ref_asb.Kd_Asb4
	    	and '.$this->tableChange.'.Kd_Asb5 = ref_asb.Kd_Asb5');
	    $data = $this->db->get();

	    return $data;
    }

    public function saveSsh2($data){
        $result = false;
        $jalan = true;

        $data = str_replace("\"","",$data);
        $kode = explode(".", $data[0]);
        $deleteRow = 5;
        //print_r($kode);
        if(count($kode) == 2){
            $simpan = array(
                'Kd_Ssh1' => (int)$kode[0],
                'Kd_Ssh2' => (int)$kode[1],
                'Nm_Ssh2' => (string)$data[6-$deleteRow], 
            );

            $result2 = $this->db->insert('ref_ssh2', $simpan);
        }
        if(count($kode) == 3){
            $simpan = array(
                'Kd_Ssh1' => (int)$kode[0],
                'Kd_Ssh2' => (int)$kode[1],
                'Kd_Ssh3' => (int)$kode[2],
                'Nm_Ssh3' => (string)$data[6-$deleteRow], 
            );

            $result2 = $this->db->insert('ref_ssh3', $simpan);
        }
        if(count($kode) == 4){
            $simpan = array(
                'Kd_Ssh1' => (int)$kode[0],
                'Kd_Ssh2' => (int)$kode[1],
                'Kd_Ssh3' => (int)$kode[2],
                'Kd_Ssh4' => (int)$kode[3],
                'Nm_Ssh4' => (string)$data[6-$deleteRow], 
            );

            $result2 = $this->db->insert('ref_ssh4', $simpan);
        }

        if(count($kode) == 5){
            $simpan = array(
                'Kd_Ssh1' => (int)$kode[0],
                'Kd_Ssh2' => (int)$kode[1],
                'Kd_Ssh3' => (int)$kode[2],
                'Kd_Ssh4' => (int)$kode[3],
                'Kd_Ssh5' => (int)$kode[4],
                'Nm_Ssh5' => (string)$data[6-$deleteRow], 
            );

            $result2 = $this->db->insert('ref_ssh5', $simpan);
        }

        if(count($kode) != 6){
            
            return $result;
        }
        // print_r($data);
        // print_r($kode);
        // return $result;
        

        if(@$data[10-$deleteRow]){
            $harga=$this->fungsi->convert_to_number($data[10-$deleteRow]);
        }else{
            $harga = 0;
        }

        for($i = 0; $i < 5; $i++){
            $this->db->where('Kd_Ssh'.($i+1), (int)$kode[$i]);
        }
        
        $this->db->order_by('Kd_Ssh6', 'DESC'); 
        $query = $this->db->get('ref_ssh');
        $getLast = $query->row();

        if($getLast){
            $lastId = $getLast->Kd_Ssh6+1;
        }else{
            //echo "baru";
            $lastId = 1;
        }
        $ada = false;
        // if($this->cekSsh($data) > 0){
        //     $ada = true;
        // }

        if($ada){
            try {
                for($i = 0; $i < 5; $i++){
                    $this->db->where('Kd_Ssh'.($i+1), (int)$data[$i]);
                }
                $update = array(
                    'Kd_Satuan' => (int)$data[8], 
                    'Spesifikasi' => (string)$data[7],
                    'Harga_Satuan' => $harga, 
                    'harga_zona1' => $harga+($harga*0.03), 
                    'harga_zona2' => $harga, 
                    'harga_zona3' => $harga+($harga*0.06), 
                    'harga_zona4' => $harga+($harga*0.1), 
                    'Satuan' => (string)$data[9],
                    'Nama_Barang' => (string)$data[6], 
                );

                $result = $this->db->update('ref_ssh', $update);
                
                throw new RuntimeException();
            } catch (Exception $e) {
                
            }
        }else{
            try {
                if(!@$data[8-$deleteRow]){
                    return $result;
                }
                if(!is_numeric($data[8-$deleteRow])){
                    return $result;
                }
                $simpan = array(
                    'Kd_Ssh1' => (int)$kode[0],
                    'Kd_Ssh2' => (int)$kode[1],
                    'Kd_Ssh3' => (int)$kode[2],
                    'Kd_Ssh4' => (int)$kode[3],
                    'Kd_Ssh5' => (int)$kode[4],
                    'Kd_Ssh6' => (int)$kode[5],
                    'Kd_Satuan' => (int)$data[8-$deleteRow], 
                    'Spesifikasi' => (string)$data[7-$deleteRow],
                    'Harga_Satuan' => $harga, 
                    'harga_zona1' => $harga+($harga*0.03), 
                    'harga_zona2' => $harga, 
                    'harga_zona3' => $harga+($harga*0.06), 
                    'harga_zona4' => $harga+($harga*0.1), 
                    'Satuan' => (string)$data[9-$deleteRow],
                    'Nama_Barang' => (string)$data[6-$deleteRow], 
                );

                $result = $this->db->insert('ref_ssh', $simpan);
                // echo "<br>";
                // print_r($data);
                // if(!$result){
                //     echo "Gagal";
                // }
                throw new RuntimeException();
            } catch (Exception $e) {
                
            }
        }

        
        
        //echo $lastId;
        
        
        return $result;
    }

    public function saveSsh($data){
    	$result = false;
    	$data = str_replace("\"","",$data);

    	if(@$data[10]){
    		$harga=$this->fungsi->convert_to_number($data[10]);
    	}else{
    		$harga = 0;
    	}

    	for($i = 0; $i < 5; $i++){
            $this->db->where('Kd_Ssh'.($i+1), (int)$data[$i]);
        }
    	
        $this->db->order_by('Kd_Ssh6', 'DESC'); 
        $query = $this->db->get('ref_ssh');
		$getLast = $query->row();

		if($getLast){
			$lastId = $getLast->Kd_Ssh6+1;
		}else{
			//echo "baru";
			$lastId = 1;
		}
        $ada = false;
        // if($this->cekSsh($data) > 0){
        //     $ada = true;
        // }

        if($ada){
            try {
                for($i = 0; $i < 5; $i++){
                    $this->db->where('Kd_Ssh'.($i+1), (int)$data[$i]);
                }
                $update = array(
                    'Kd_Satuan' => (int)$data[8], 
                    'Spesifikasi' => (string)$data[7],
                    'Harga_Satuan' => $harga, 
                    'harga_zona1' => $harga+($harga*0.03), 
                    'harga_zona2' => $harga, 
                    'harga_zona3' => $harga+($harga*0.06), 
                    'harga_zona4' => $harga+($harga*0.1), 
                    'Satuan' => (string)$data[9],
                    'Nama_Barang' => (string)$data[6], 
                );

                $result = $this->db->update('ref_ssh', $update);
                
                throw new RuntimeException();
            } catch (Exception $e) {
                
            }
        }else{
            try {
                $simpan = array(
                    'Kd_Ssh1' => (int)$data[0],
                    'Kd_Ssh2' => (int)$data[1],
                    'Kd_Ssh3' => (int)$data[2],
                    'Kd_Ssh4' => (int)$data[3],
                    'Kd_Ssh5' => (int)$data[4],
                    'Kd_Ssh6' => (int)$data[5],
                    'Kd_Satuan' => (int)$data[8], 
                    'Spesifikasi' => (string)$data[7],
                    'Harga_Satuan' => $harga, 
                    'harga_zona1' => $harga+($harga*0.03), 
                    'harga_zona2' => $harga, 
                    'harga_zona3' => $harga+($harga*0.06), 
                    'harga_zona4' => $harga+($harga*0.1), 
                    'Satuan' => (string)$data[9],
                    'Nama_Barang' => (string)$data[6], 
                );

                $result = $this->db->insert('ref_ssh', $simpan);
                // echo "<br>";
                // print_r($data);
                // if(!$result){
                //     echo "Gagal";
                // }
                throw new RuntimeException();
            } catch (Exception $e) {
                
            }
        }

        
		
		//echo $lastId;
        
    	
        return $result;
    }

    public function cekSsh($data){
        for($i = 0; $i < 5; $i++){
            $this->db->where('Kd_Ssh'.($i+1), (int)$data[$i]);
        }

        return $this->db->get('ref_ssh')->num_rows();
    }

    public function deleteAllSsh(){
    	//DELETE FROM employees;
    	$this->db->query("DELETE FROM ref_ssh");
    }

    public function saveHspk($data, $judul = '', $satuan = 1, $kode){

        $result = false;
        

        $data = str_replace("\"","",$data);
        $hspk = explode(".", $kode);
        $ssh = explode(".", $data[0]);
        //print_r($hspk);

        if(count($hspk) == 4 && (count($ssh) == 6 || count($ssh) == 4)){
            //echo $kode." - ".$judul." - ".$satuan."<br>";
            //print_r($data);
            $asal = 1;
            if(count($ssh) == 4){
                $ssh[4] = 0;
                $ssh[5] = 0;
                $sshHspk= true;
                $isiSatuan = 1;
                $asal = 2;
            }else if(count($ssh) == 6){
                $kodeHspk = $hspk[0].'-'.$hspk[1].'-'.$hspk[2].'-'.$hspk[3];
                $kodeSsh  = $ssh[0].'-'.$ssh[1].'-'.$ssh[2].'-'.$ssh[3].'-'.$ssh[4].'-'.$ssh[5];
                $sshHspk = $this->RefHspkModel->loadSshHspk($kodeHspk, $kodeSsh);

                // if(count($sshHspk) == 0){
                //     return $result;
                // }
                
                $isiSatuan = $sshHspk->Kd_Satuan;
                //return $result;
               
            }else{
                return $result;
            }
            

            if($sshHspk){
                // echo "<pre>";
                // print_r($data);
                // echo "</pre>";
                // return true;
                $dataKirim = array(
                    'kodeHspk' => $hspk[0].'-'.$hspk[1].'-'.$hspk[2].'-'.$hspk[3],
                    'uraianKegiatan' => $judul, 
                    'satuan' => $satuan,
                    'kodeSsh' => $ssh[0].'-'.$ssh[1].'-'.$ssh[2].'-'.$ssh[3].'-'.$ssh[4].'-'.$ssh[5],
                    'satuanSsh' => $isiSatuan,
                    'koefisien' => floatval($data[2]),
                    'kategori' => $data[4],
                );
                $data2 = $this->RefHspkModel->setData2($dataKirim,2, $asal);
                if(count($data2)>0){
                    $result = true;
                }
            }
        }

        
        return $result;
    }

    public function saveAsb($data, $judul = '', $satuan = 1, $kode){
        $this->load->model('RefAsbModel');
        $result = false;
        $asb = explode(".", $kode);
        $sshHspk = explode(".", $data[0]);
        //print_r($sshHspk);

        if(count($sshHspk) == 2){
            $simpan = array(
                'Kd_Asb1' => (int)$sshHspk[0],
                'Kd_Asb2' => (int)$sshHspk[1],
                'Nm_Asb2' => (string)$data[1], 
            );

            $result = $this->db->insert('ref_asb2', $simpan);
        }

        if(count($sshHspk) == 3){
            $simpan = array(
                'Kd_Asb1' => (int)$sshHspk[0],
                'Kd_Asb2' => (int)$sshHspk[1],
                'Kd_Asb3' => (int)$sshHspk[2],
                'Nm_Asb3' => (string)$data[1], 
            );

            $result = $this->db->insert('ref_asb3', $simpan);
        }

        if(count($sshHspk) == 4){
            $simpan = array(
                'Kd_Asb1' => (int)$sshHspk[0],
                'Kd_Asb2' => (int)$sshHspk[1],
                'Kd_Asb3' => (int)$sshHspk[2],
                'Kd_Asb4' => (int)$sshHspk[3],
                'Nm_Asb4' => (string)$data[1], 
            );

            $result = $this->db->insert('ref_asb4', $simpan);
        }

        if(count($asb) != 5 ){

            return $result;
        }
// print_r($sshHspk);
        $kodeAsb = $asb[0].'-'.$asb[1].'-'.$asb[2].'-'.$asb[3].'-'.$asb[4];
        $kodeSsh = '';
        $kodeHspk = '';
        $kodeAsbTambahan = '';
        $asal = 0;
        $satuanTambahan = 1;
        if($sshHspk[0] < 24){
            $asal = 1;

            if(count($sshHspk) != 6){
                return $result;
            }
            //print_r($data);
            $kodeSsh  = $sshHspk[0].'-'.$sshHspk[1].'-'.$sshHspk[2].'-'.$sshHspk[3].'-'.$sshHspk[4].'-'.$sshHspk[5];

            for($i = 7; $i>1; $i--){
                $this->db->where('Kd_Ssh'.($i-1), $sshHspk[($i-2)]);
            }
            $dataSsh = $this->db->get('ref_ssh')->row();

            if(count($dataSsh) == 0){
                return $result;
            }
            $satuanTambahan = $dataSsh->Kd_Satuan;
            //$sshHspk2 = $this->RefHspkModel->loadSshHspk($kodeHspk, $kodeSsh);
        }else if($sshHspk[0] == 24){
            if(count($sshHspk) != 4){
                return $result;
            }
            $kodeHspk = $sshHspk[0].'-'.$sshHspk[1].'-'.$sshHspk[2].'-'.$sshHspk[3];
            $asal = 2;
            for($i = 5 ; $i>1;$i--){
                $this->db->where('Kd_Hspk'.($i-1), $sshHspk[($i-2)]);
            }
            $dataSsh = $this->db->get('ref_hspk')->row();

            if(count($dataSsh) == 0){
                return $result;
            }
            $satuanTambahan = $dataSsh->Kd_Satuan;
            // if(count($sshHspk) == 5){
            //     echo "Hspk<pre>";
            //     print_r($sshHspk);
            //     echo "</pre>";
            // }
        }else if($sshHspk[0] > 24){
            $asal = 3;
            if(count($sshHspk) != 5){
                return $result;
            }

            $kodeAsbTambahan = $sshHspk[0].'-'.$sshHspk[1].'-'.$sshHspk[2].'-'.$sshHspk[3].'-'.$sshHspk[4];
            
            for($i = 6; $i>1;$i--){
                $this->db->where('Kd_Asb'.($i-1), $sshHspk[($i-2)]);
            }
            $dataSsh = $this->db->get('ref_asb')->row();

            if(count($dataSsh) == 0){
                return $result;
            }
            $satuanTambahan = $dataSsh->Kd_Satuan;
            // if(count($sshHspk) == 5){
            //     echo "Asb<pre>";
            //     print_r($sshHspk);
            //     echo "</pre>";
            // }
        }else{
            return $result;
        }


        $dataKirim = array(
            'asal' => $asal,
            'jenisPekerjaan'=> $judul,
            'kodeAsb' => $kodeAsb,
            'kodeAsb2' => $kodeAsbTambahan,
            'kodeHspk' => $kodeHspk,
            'kodeSsh' => $kodeSsh,
            'koefisien'=> floatval($data[2]),
            'pekerjaan'=> $data[4],
            'satuanAsb'=> $satuan,
            'satuanTambahan'=> $satuanTambahan
        );

        $data2 = $this->RefAsbModel->setData($dataKirim,2, $asal);
        if(count($data2)>0){
            $result = true;
            // echo "botul<pre>";
            // print_r($dataKirim);
            // echo "</pre>";
        }
        

        // $data = str_replace("\"","",$data);
        // $asb = explode(".", $kode);
        // $ssh = explode(".", $data[0]);
        // //print_r($hspk);

        // if(count($asb) == 5 && (count($ssh) == 6 || count($ssh) == 5 || count($ssh) == 4)){
        //     //echo $kode." - ".$judul." - ".$satuan."<br>";
        //     //print_r($data);
        //     $asal = 1;
        //     if(count($ssh) == 5){

        //         $ssh[4] = 0;
        //         $ssh[5] = 0;
        //         $sshHspk= true;
        //         $isiSatuan = 1;
        //         $asal = 2;

        //     }else if(count($ssh) == 6){

        //         $kodeHspk = $asb[0].'-'.$asb[1].'-'.$asb[2].'-'.$asb[3].'-'.$asb[4];
        //         $kodeSsh  = $ssh[0].'-'.$ssh[1].'-'.$ssh[2].'-'.$ssh[3].'-'.$ssh[4].'-'.$ssh[5];
        //         $sshHspk = $this->RefHspkModel->loadSshHspk($kodeHspk, $kodeSsh);

        //         // if(count($sshHspk) == 0){
        //         //     return $result;
        //         // }
                
        //         $isiSatuan = $sshHspk->Kd_Satuan;
        //         //return $result;
               
        //     }else{
        //         return $result;
        //     }
            

        //     if($sshHspk){
        //         // echo "<pre>";
        //         // print_r($data);
        //         // echo "</pre>";
        //         // return true;
        //         $dataKirim = array(
        //             'kodeHspk' => $asb[0].'-'.$asb[1].'-'.$asb[2].'-'.$asb[3].'-'.$asb[4],
        //             'uraianKegiatan' => $judul, 
        //             'satuan' => $satuan,
        //             'kodeSsh' => $ssh[0].'-'.$ssh[1].'-'.$ssh[2].'-'.$ssh[3].'-'.$ssh[4].'-'.$ssh[5],
        //             'satuanSsh' => $isiSatuan,
        //             'koefisien' => floatval($data[2]),
        //             'kategori' => $data[4],
        //         );
        //         $data2 = $this->RefHspkModel->setData2($dataKirim,2, $asal);
        //         if(count($data2)>0){
        //             $result = true;
        //         }
        //     }
        // }

        
        return $result;
    }
}