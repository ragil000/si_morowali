<?php

class RefAsbModel extends CI_Model
{
    private $jumlah;
    private $table;
    private $persenZona;
    public function __construct()
    {
        parent::__construct();
        $this->jumlah = 20;
        $this->table = 'ref_asb';
        $this->persenZona[1] = 0.03;
        $this->persenZona[2] = 0;
        $this->persenZona[3] = 0.06;
        $this->persenZona[4] = 0.10;
    }

    public function getHspk($ssh, $dataId){

        $id = explode('-', $dataId); 
        for($i = $ssh; $i>1; $i--){
            if($i <= 5)
                $this->db->where('Kd_Hspk'.($i-1), $id[($i-2)]);
        }
        
        if($ssh < 4){
            $query = $this->db->get('ref_hspk'.$ssh);
        }else{

            $query = $this->db->get('ref_hspk');
        }
        return $query->result_array();
    }

    public function getSsh($ssh, $dataId){

        $id = explode('-', $dataId); 
        for($i = $ssh; $i>1; $i--){
            if($i <= 7)
                $this->db->where('Kd_Ssh'.($i-1), $id[($i-2)]);
        }
        
        if($ssh < 6){
            $query = $this->db->get('ref_ssh'.$ssh);
        }else{
            $query = $this->db->get('ref_ssh');
        }
        
        return $query->result_array();
        
    }

    public function getAsb2($ssh, $dataId){

        $id = explode('-', $dataId); 
        for($i = $ssh; $i>1; $i--){
            if($i <= 6)
                $this->db->where('Kd_Asb'.($i-1), $id[($i-2)]);
        }
        
        if($ssh < 5){
            $query = $this->db->get('ref_asb'.$ssh);
        }else{
            $query = $this->db->get('ref_asb');
        }
        
        return $query->result_array();
        
    }

    public function getAsb($data, $dataId){

        $id = explode('-', $dataId); 
        for($i = $data; $i>1; $i--){
            $this->db->where('Kd_Asb'.($i-1), $id[($i-2)]);
        }
        
        if($data < 5){
            $query = $this->db->get($this->table.$data);
            return $query->result_array();
        }else if($data == 5){
            $this->db->order_by('Kd_Asb5', 'DESC'); 
            $query = $this->db->get($this->table);
        }else if($data ==6){
            $query = $this->db->get($this->table);
        }

        return $query->row();
        
    }

    public function tableAll($nameTable){

        $query = $this->db->get($nameTable);
        return $query->result_array();
    }

    public function getCount($search = ''){
        $this->db->like('Jenis_Pekerjaan', $search);
        $query = $this->db->get($this->table);
        return count($query->result_array());
    }

    public function getJumlahInPage(){
        return $this->jumlah;
    }

    public function getAll($page = 1, $search = '', $all = false){
        $jumlah = $this->jumlah;

        $awal = ($page - 1)*$jumlah;
        $this->db->like('Jenis_Pekerjaan', $search);
         $this->db->join('ref_standard_satuan', 'ref_standard_satuan.Kd_Satuan= '.$this->table.'.Kd_Satuan', 'left');
        
        if(!$all)
            $this->db->limit($jumlah,$awal);

        $query = $this->db->get($this->table);
        //$query = $this->db->get('ref_ssh');


        return $query->result_array();
    }

    public function getSatuan($id = 0){
        if($id != 0){
            $this->db->where('Kd_Satuan', $id);
        }
        $this->db->order_by('Uraian', 'ASC'); 
        $query = $this->db->get('ref_standard_satuan');
        return $query->result_array();
    }

    public function delete($kodeHspk, $kodeSsh = null, $zona = 1, $hapusAll = false){

        $idAsb = explode('-', $kodeHspk); 
        
        if($hapusAll){
            for($i = 6; $i>1; $i--){
                $this->db->where('Kd_Asb'.($i-1), $idAsb[($i-2)]);
            }

            $result = $this->db->delete('ref_asb');
            return $result;
        }

        


        for($i = 6; $i>1; $i--){
            $this->db->where('Kd_Asb'.($i-1), $idAsb[($i-2)]);
        }

        // $this->db->where('zona', $zona);

        if($kodeSsh != null){
            $idSsh = explode('-', $kodeSsh); 
            for($i = 7; $i>1; $i--){
                if($i - 1 <= 4)
                    $this->db->where('Kd_Hspk_Ssh'.($i-1), $idSsh[($i-2)]);
                else
                    $this->db->where('Kd_Ssh'.($i-1), $idSsh[($i-2)]);
            }
        }

        $result = $this->db->delete('Ta_Hspk_Asb');


        if($result){


            $this->setHspk($kodeHspk,null,null, $zona, true);


            for($i = 6; $i>1; $i--){
                $this->db->where('Kd_Asb'.($i-1), $idAsb[($i-2)]);
            }

            

            $sshHspk = $this->db->get('Ta_Hspk_Asb')->row();

            if(!$sshHspk){
                for($i = 6; $i>1; $i--){
                    $this->db->where('Kd_Asb'.($i-1), $idAsb[($i-2)]);
                }

                $result = $this->db->delete('ref_asb');
                return $result;
            }

            
        }
        return 0;
    }

    public function cekData($idCek, $idAsb, $zona, $koefisien = 0){


        //$post = $this->security->xss_clean($post);

        $idAsb1 = explode('-', $idAsb);
        $id1 = explode('-', $idCek);

        for($i = 6; $i>1; $i--){
            $this->db->where('Kd_Asb'.($i-1), $idAsb1[($i-2)]);
        }

        for($i = 7; $i>1; $i--){
            if($i-1 <=4)
                $this->db->where('Kd_Hspk_Ssh'.($i-1), $id1[($i-2)]);
            else
                $this->db->where('Kd_Ssh'.($i-1), $id1[($i-2)]);
        }

        if($koefisien != 0){
            $this->db->where('Koefisien', $koefisien);
        }

        // $this->db->where('zona', $zona);

        $query = $this->db->get('Ta_Hspk_Asb');
        
        //return $post;
        return $query->row();
    }

    public function cekAsb($idHspk){


        for($i = 6; $i>1; $i--){
            $this->db->where('Kd_Asb'.($i-1), $idHspk[($i-2)]);
        }

        $query = $this->db->get('ref_asb');
        
        return $query->row();
    }

    public function getHarga($idSsh, $asal =1){

        $id = explode('-', $idSsh);

        if($asal == 1){
            $kode = 'Kd_Ssh';
            $table = 'ref_ssh';
            $jum = 7;
        }else if($asal == 2){
            $kode = 'Kd_Hspk';
            $table = 'ref_hspk';
            $jum = 5;
        }else if($asal == 3){
            $kode = 'Kd_Asb';
            $table = 'ref_asb';
            $jum = 6;
        }

        if(count($id) != $jum -1){
            return array();
        }

        for($i = $jum; $i>1; $i--){
            $this->db->where($kode.($i-1), $id[($i-2)]);
        }
        $query = $this->db->get($table);
        
        return $query->row();
    }

    public function setHspk($kodeHspk, $uraianKegiatan = null, $satuan = null, $zona = 2, $load = false){
        $this->load->library('Fungsi');
        //$post = $this->security->xss_clean($post);

        $idHspk = explode('-', $kodeHspk);
        $hasilData = [];

        $this->db->select('*, ref_kategori_pekerjaan_asb.Uraian as pekerjaan');
        $this->db->from('Ta_Hspk_Asb');
        $this->db->join('ref_kategori_pekerjaan_asb', 'ref_kategori_pekerjaan_asb.Kd_Pekerjaan= Ta_Hspk_Asb.Kategori_Pekerjaan', 'left');
        $this->db->join('ref_standard_satuan', 'ref_standard_satuan.Kd_Satuan= Ta_Hspk_Asb.Kd_Satuan', 'a');
        
        for($i = 6; $i>1; $i--){
            $this->db->where('Kd_Asb'.($i-1), $idHspk[($i-2)]);
        }
        $this->db->order_by("Kategori_Pekerjaan", "asc");

        $query = $this->db->get();

        //$query = $this->db->get('Ta_Hspk_Asb');
        
        $totalHspk = 0;
        $totalHspk1 = 0;
        $totalHspk2 = 0;
        $totalHspk3 = 0;
        $totalHspk4 = 0;
        $hasilData = $query->result_array();
        
        //$this->db->reconnect();
        $coba = [];
        $no = 0;
        foreach ($hasilData as $keyHspk) {
            $totalHspk += $keyHspk['Harga_Satuan']*$keyHspk['Koefisien'];
            $totalHspk1 += $keyHspk['HargaZona1'];
            $totalHspk2 += $keyHspk['HargaZona2'];
            $totalHspk3 += $keyHspk['HargaZona3'];
            $totalHspk4 += $keyHspk['HargaZona4'];
            $coba[$no] = $keyHspk;
            if($load){
                if($keyHspk['Asal'] == 1){
                    for($i = 7; $i>1; $i--){
                        if($i-1 <= 4)
                            $this->db->where('Kd_Ssh'.($i-1), $keyHspk['Kd_Hspk_Ssh'.($i-1)]);
                        else
                            $this->db->where('Kd_Ssh'.($i-1), $keyHspk['Kd_Ssh'.($i-1)]);
                    }
                    $keyHspk = $this->db->get('ref_ssh')->row();
                    $coba[$no]['Nama_Barang'] = $keyHspk->Nama_Barang;
                    $coba[$no]['Jumlah_HargaZona1'] = $keyHspk->harga_zona1;
                    $coba[$no]['Jumlah_HargaZona2'] = $keyHspk->harga_zona2;
                    $coba[$no]['Jumlah_HargaZona3'] = $keyHspk->harga_zona3;
                    $coba[$no]['Jumlah_HargaZona4'] = $keyHspk->harga_zona4;

                   
                    
                }else if($keyHspk['Asal'] == 2){
                    for($i = 5; $i>1; $i--){
                        if($i-1 <= 4)
                            $this->db->where('Kd_Hspk'.($i-1), $keyHspk['Kd_Hspk_Ssh'.($i-1)]);
                        else
                            $this->db->where('Kd_Hspk'.($i-1), $keyHspk['Kd_Ssh'.($i-1)]);
                    }
                    $keyHspk = $this->db->get('ref_hspk')->row();
                    $coba[$no]['Nama_Barang'] = $keyHspk->Uraian_Kegiatan;
                    $coba[$no]['Jumlah_HargaZona1'] = $keyHspk->HargaZona1;
                    $coba[$no]['Jumlah_HargaZona2'] = $keyHspk->HargaZona2;
                    $coba[$no]['Jumlah_HargaZona3'] = $keyHspk->HargaZona3;
                    $coba[$no]['Jumlah_HargaZona4'] = $keyHspk->HargaZona4;
                }else if($keyHspk['Asal'] == 3){
                    for($i = 6; $i>1; $i--){
                        if($i-1 <= 4)
                            $this->db->where('Kd_Asb'.($i-1), $keyHspk['Kd_Hspk_Ssh'.($i-1)]);
                        else
                            $this->db->where('Kd_Asb'.($i-1), $keyHspk['Kd_Ssh'.($i-1)]);
                    }
                    $keyHspk = $this->db->get('ref_asb')->row();
                    $coba[$no]['Nama_Barang'] = $keyHspk->Jenis_Pekerjaan;
                    $coba[$no]['Jumlah_HargaZona1'] = $keyHspk->HargaZona1;
                    $coba[$no]['Jumlah_HargaZona2'] = $keyHspk->HargaZona2;
                    $coba[$no]['Jumlah_HargaZona3'] = $keyHspk->HargaZona3;
                    $coba[$no]['Jumlah_HargaZona4'] = $keyHspk->HargaZona4;
                }
            }
            


            $no++;
        }

        for($i = 6; $i>1; $i--){
            $this->db->where('Kd_Asb'.($i-1), $idHspk[($i-2)]);
        }

        if($uraianKegiatan && $satuan){
            $dataUpdate = array(
                'Jenis_Pekerjaan' => $uraianKegiatan,
                'Kd_Satuan' => $satuan,
                'HargaZona1' => $totalHspk1, 
                'HargaZona2' => $totalHspk2, 
                'HargaZona3' => $totalHspk3, 
                'HargaZona4' => $totalHspk4, 
                'Harga' => $totalHspk,
            );
        }else{
            $dataUpdate = array(
                'HargaZona1' => $totalHspk1, 
                'HargaZona2' => $totalHspk2, 
                'HargaZona3' => $totalHspk3, 
                'HargaZona4' => $totalHspk4, 
                'Harga' => $totalHspk,
            );
        }
        $this->db->update('ref_asb', $dataUpdate);
        
        return $coba;
        return $hasilData;
        
    }

    public function setData($post, $zona, $asal = 1){
        $this->load->library('Fungsi');
        //return $post;
        $post = $this->security->xss_clean($post);
        //return $post;
        $idAsb = explode('-', $post['kodeAsb']);
        
        $asal = $post['asal'];
        if($asal == 1){
            $data =  $this->getHarga($post['kodeSsh'], $asal);
            $harga_zona = 'harga_zona';
            $idCek = $post['kodeSsh'];
            $idSsh = explode('-', $post['kodeSsh']);
        }else if($asal == 2){
            $idHspk = explode('-', $post['kodeHspk']);
            $data =  $this->getHarga($post['kodeHspk'], $asal);
            $harga_zona = 'HargaZona';
            $idCek = $post['kodeHspk']."-0-0";
            
        }else if($asal == 3){
            $idAsb2 = explode('-', $post['kodeAsb2']);
            $data =  $this->getHarga($post['kodeAsb2'], $asal);
            $harga_zona = 'HargaZona';
            $idCek = $post['kodeAsb2']."-0";
        }

        if(count($data) == 0){
            return array();
        }

        $harga_zona1 = $harga_zona."1";
        $harga_zona2 = $harga_zona."2";
        $harga_zona3 = $harga_zona."3";
        $harga_zona4 = $harga_zona."4";

        $koefisien =floatval($post['koefisien']); ;

        $hargaSatuan = $data->$harga_zona2;
        $total = $koefisien*$hargaSatuan ;

        $hargaSatuan1 = $data->$harga_zona1;
        $hargaSatuan2 = $data->$harga_zona2;
        $hargaSatuan3 = $data->$harga_zona3;
        $hargaSatuan4 = $data->$harga_zona4;

        $total1 = $koefisien*$hargaSatuan1;
        $total2 = $koefisien*$hargaSatuan2;
        $total3 = $koefisien*$hargaSatuan3;
        $total4 = $koefisien*$hargaSatuan4;

        $status = true;
        if(!$this->cekAsb($idAsb)){
            $resultHspk = $this->db->insert('ref_asb', array(
                'Kd_Asb1' => $idAsb[0],
                'Kd_Asb2' => $idAsb[1],
                'Kd_Asb3' => $idAsb[2],
                'Kd_Asb4' => $idAsb[3], 
                'Kd_Asb5' => $idAsb[4],
                'Jenis_Pekerjaan' => $post['jenisPekerjaan'],
                'Kd_Satuan' => $post['satuanAsb'],
                'HargaZona1' => $total1, 
                'HargaZona2' => $total2, 
                'HargaZona3' => $total3, 
                'HargaZona4' => $total4, 
                'Harga' => $total,
            ));

            if($resultHspk)
                $status = false;

        }


        $inputId = explode('-', $idCek);
        
        if(!$this->cekData($idCek, $post['kodeAsb'], $zona, $post['koefisien'])){

            
            $data = array(
                'Kd_Asb1' => $idAsb[0],
                'Kd_Asb2' => $idAsb[1],
                'Kd_Asb3' => $idAsb[2],
                'Kd_Asb4' => $idAsb[3],
                'Kd_Asb5' => $idAsb[4],
                'Kd_Hspk_Ssh1' => $inputId[0],
                'Kd_Hspk_Ssh2' => $inputId[1],
                'Kd_Hspk_Ssh3' => $inputId[2],
                'Kd_Hspk_Ssh4' => $inputId[3],
                'Kd_Ssh5' => $inputId[4],
                'Kd_Ssh6' => $inputId[5],
                'Asal' => (int)$this->fungsi->convert_to_number($asal),
                'Kategori_Pekerjaan' => $post['pekerjaan'],
                'Kd_Satuan' => $post['satuanAsb'],  
                'Koefisien' => $koefisien, 
                'Harga_Satuan' => $hargaSatuan,
                'HargaZona1' => $total1, 
                'HargaZona2' => $total2, 
                'HargaZona3' => $total3, 
                'HargaZona4' => $total4, 
                //'zona' => $zona,
                'Jumlah_Harga' => $total,
            );

            $resultHspkSsh = $this->db->insert('Ta_Hspk_Asb', $data);
            //return $post;
        }else{

            for($i = 6; $i>1; $i--){
                $this->db->where('Kd_Asb'.($i-1), $idAsb[($i-2)]);
            }

            for($i = 7; $i>1; $i--){
                if($i-1 <= 4)
                    $this->db->where('Kd_Hspk_Ssh'.($i-1), $inputId[($i-2)]);
                else
                    $this->db->where('Kd_Ssh'.($i-1), $inputId[($i-2)]);
            }

            //$this->db->where('zona', $zona);

            $resultHspkSsh = $this->db->update('Ta_Hspk_Asb', array(
                'Kd_Satuan' => $post['satuanAsb'], 
                'Koefisien' => $koefisien, 
                'Harga_Satuan' => $hargaSatuan,
                'HargaZona1' => $total1, 
                'HargaZona2' => $total2, 
                'HargaZona3' => $total3, 
                'HargaZona4' => $total4, 
                'Jumlah_Harga' => $total,
            ));

            if($resultHspkSsh){
                //return 'berhasil Edit';
            }
        }
        $hasilData = [];

        $hasilData = $this->setHspk($post['kodeAsb'],$post['jenisPekerjaan'],$post['satuanAsb'], $zona, true);

        return $hasilData;
        

    }

    public function setDataAsb($post, $zona){
        //$this->load->library('Fungsi');
        $post = $this->security->xss_clean($post);
        $result = true;
        //$this->delete()
        if(@$post['kirim']){
            foreach ($post['kirim'] as $data) {
                $result = $this->delete($data['idAsb'], $data['id'], $zona, false);
                // if(!$result){
                //     break;
                // }
            }
        }
        

        return $result;
        //return $post['kirim'][0]['idHspk'];
    }

    // 1= 3, 3 = 6, 4 = 10

    public function loadDataAsb($post, $zona){
        $post = $this->security->xss_clean($post);


        $id = explode('-', $post['idAsb']); 
        $dataHspk = [];
        $dataSsh = [];
        

        $query = $this->db->query('SELECT * FROM ref_asb a5, ref_asb1 a1, ref_asb2 a2, ref_asb3 a3, ref_asb4 a4, ref_standard_satuan s 
                    where a5.Kd_Asb1 = a1.Kd_Asb1
                    and a5.Kd_Asb1 = a2.Kd_Asb1 and a5.Kd_Asb2 = a2.Kd_Asb2
                    and a5.Kd_Asb1 = a3.Kd_Asb1 and a5.Kd_Asb2 = a3.Kd_Asb2 and a5.Kd_Asb3 = a3.Kd_Asb3
                    and a5.Kd_Asb1 = a4.Kd_Asb1 and a5.Kd_Asb2 = a4.Kd_Asb2 and a5.Kd_Asb3 = a4.Kd_Asb3 and a5.Kd_Asb4 = a4.Kd_Asb4
                    and a5.Kd_Satuan = s.Kd_Satuan
                    and a5.Kd_Asb1 ='.$id[0].' and a5.Kd_Asb2 ='.$id[1].' and a5.Kd_Asb3 ='.$id[2].' and a5.Kd_Asb4 ='.$id[3].' and a5.Kd_Asb5 ='.$id[4]);

        $dataHspk = $query;


        // $this->db->select('*');
        // $this->db->from('ref_hspk');
        // for($i = 4; $i>1; $i--){
            
        //     $this->db->join('ref_hspk'.($i-1), 'ref_hspk'.($i-1).'.Kd_Hspk'.($i-1).' = ref_hspk.Kd_Hspk'.($i-1), 'left');
        $this->db->select('*, ref_kategori_pekerjaan_asb.Uraian as pekerjaan');
        $this->db->from('Ta_Hspk_Asb');
        $this->db->join('ref_kategori_pekerjaan_asb', 'ref_kategori_pekerjaan_asb.Kd_Pekerjaan= Ta_Hspk_Asb.Kategori_Pekerjaan', 'left');
        $this->db->join('ref_standard_satuan', 'ref_standard_satuan.Kd_Satuan= Ta_Hspk_Asb.Kd_Satuan', 'a');
        for($i = 6; $i>1; $i--){
            $this->db->where('Kd_Asb'.($i-1), $id[($i-2)]);
        }
        $this->db->order_by("Kategori_Pekerjaan", "asc");
        // $this->db->where('zona', $zona);


        
        $dataSsh = $this->db->get();

        $total[1] = 0;
        $total[2] = 0;
        $total[3] = 0;
        $total[4] = 0;
        $coba = [];
        $no= 0;
        foreach ($dataSsh->result_array() as $key) {
            $coba[$no] = $key; 
            $coba[$no]['Nama_Barang'] = '';
            $coba[$no]['HargaZona1'] = 0;
            $coba[$no]['HargaZona2'] = 0;
            $coba[$no]['HargaZona3'] = 0;
            $coba[$no]['HargaZona4'] = 0;
            if($key['Asal'] == 1){
                for($i = 7; $i>1; $i--){
                    if($i-1 <= 4){
                        $this->db->where('Kd_Ssh'.($i-1), $key['Kd_Hspk_Ssh'.($i-1)]);
                    }else{
                        $this->db->where('Kd_Ssh'.($i-1), $key['Kd_Ssh'.($i-1)]);
                    }
                }
                $cek = $this->db->get('ref_ssh')->row();
                if(count($cek) > 0){
                    $coba[$no]['Nama_Barang'] = $cek->Nama_Barang;
                    $coba[$no]['HargaZona1'] = $cek->harga_zona1;
                    $coba[$no]['HargaZona2'] = $cek->harga_zona2;
                    $coba[$no]['HargaZona3'] = $cek->harga_zona3;
                    $coba[$no]['HargaZona4'] = $cek->harga_zona4;
                    $coba[$no]['Jumlah_Harga1'] = $coba[$no]['HargaZona1']*$key['Koefisien'];
                    $coba[$no]['Jumlah_Harga2'] = $coba[$no]['HargaZona2']*$key['Koefisien'];
                    $coba[$no]['Jumlah_Harga3'] = $coba[$no]['HargaZona3']*$key['Koefisien'];
                    $coba[$no]['Jumlah_Harga4'] = $coba[$no]['HargaZona4']*$key['Koefisien'];
                    $total[1] += $coba[$no]['Jumlah_Harga1'];
                    $total[2] += $coba[$no]['Jumlah_Harga2'];
                    $total[3] += $coba[$no]['Jumlah_Harga3'];
                    $total[4] += $coba[$no]['Jumlah_Harga4'];
                }
                
            }else if($key['Asal'] == 2){
                for($i = 5; $i>1; $i--){
                    if($i-1 <= 4){
                        $this->db->where('Kd_Hspk'.($i-1), $key['Kd_Hspk_Ssh'.($i-1)]);
                    }else{
                        $this->db->where('Kd_Hspk'.($i-1), $key['Kd_Ssh'.($i-1)]);
                    }
                    
                }
                $cek = $this->db->get('ref_hspk')->row();
                if(count($cek) > 0){
                    $coba[$no]['Nama_Barang'] = $cek->Uraian_Kegiatan;
                    $coba[$no]['HargaZona1'] = floatval($cek->HargaZona1);
                    $coba[$no]['HargaZona2'] = floatval($cek->HargaZona2);
                    $coba[$no]['HargaZona3'] = floatval($cek->HargaZona3);
                    $coba[$no]['HargaZona4'] = floatval($cek->HargaZona4);

                    $coba[$no]['Jumlah_Harga1'] = $coba[$no]['HargaZona1']*$key['Koefisien'];
                    $coba[$no]['Jumlah_Harga2'] = $coba[$no]['HargaZona2']*$key['Koefisien'];
                    $coba[$no]['Jumlah_Harga3'] = $coba[$no]['HargaZona3']*$key['Koefisien'];
                    $coba[$no]['Jumlah_Harga4'] = $coba[$no]['HargaZona4']*$key['Koefisien'];
                    $total[1] += $coba[$no]['Jumlah_Harga1'];
                    $total[2] += $coba[$no]['Jumlah_Harga2'];
                    $total[3] += $coba[$no]['Jumlah_Harga3'];
                    $total[4] += $coba[$no]['Jumlah_Harga4'];
                }
                
            }else if($key['Asal'] == 3){
                for($i = 6; $i>1; $i--){
                    if($i-1 <= 4){
                        $this->db->where('Kd_Asb'.($i-1), $key['Kd_Hspk_Ssh'.($i-1)]);
                    }else{
                        $this->db->where('Kd_Asb'.($i-1), $key['Kd_Ssh'.($i-1)]);
                    }
                }
                $cek = $this->db->get('ref_asb')->row();
                if(count($cek) > 0){
                    $coba[$no]['Nama_Barang'] = $cek->Jenis_Pekerjaan;
                    $coba[$no]['HargaZona1'] = $cek->HargaZona1;
                    $coba[$no]['HargaZona2'] = $cek->HargaZona2;
                    $coba[$no]['HargaZona3'] = $cek->HargaZona3;
                    $coba[$no]['HargaZona4'] = $cek->HargaZona4;
                    $coba[$no]['Jumlah_Harga1'] = $coba[$no]['HargaZona1']*$key['Koefisien'];
                    $coba[$no]['Jumlah_Harga2'] = $coba[$no]['HargaZona2']*$key['Koefisien'];
                    $coba[$no]['Jumlah_Harga3'] = $coba[$no]['HargaZona3']*$key['Koefisien'];
                    $coba[$no]['Jumlah_Harga4'] = $coba[$no]['HargaZona4']*$key['Koefisien'];
                    $total[1] += $coba[$no]['Jumlah_Harga1'];
                    $total[2] += $coba[$no]['Jumlah_Harga2'];
                    $total[3] += $coba[$no]['Jumlah_Harga3'];
                    $total[4] += $coba[$no]['Jumlah_Harga4'];
                }
            }


            $no++;
        }

        // $total[1] = number_format($total[1],2,",",".");
        // $total[2] = number_format($total[2],2,",",".");
        // $total[3] = number_format($total[3],2,",",".");
        // $total[4] = number_format($total[4],2,",",".");
        
        //ubah jumlah harga
        for($i = 6; $i>1; $i--){
            $this->db->where('Kd_Asb'.($i-1), $id[($i-2)]);
        }

        $dataUpdate = array(
            'HargaZona1' => $total[1], 
            'HargaZona2' => $total[2], 
            'HargaZona3' => $total[3], 
            'HargaZona4' => $total[4], 
            'Harga' => $total[2],
        );
        $this->db->update('ref_asb', $dataUpdate);
        //. ubah jumlah harga

        
        //$this->setHspk($post['idAsb'],null,null, $zona);
        
        $data = array(
            'asb' => $dataHspk->row(),
            //'AsbHspk' => $dataSsh->result_array(),
            'AsbHspk' => $coba,
            'total' => [0,number_format($total[1],2,",","."),number_format($total[2],2,",","."),number_format($total[3],2,",","."),number_format($total[4],2,",",".")],
            'cona' => $dataUpdate,
        );
        

        return $data;
    }

    public function setIsiAsb(){
        $data = $this->db->get('Ta_Hspk_Asb');
        foreach ($data->result_array() as $key) {
            $dataUpdate = array(
                'HargaZona1' => $key['HargaZona1'], 
                'HargaZona2' => $key['HargaZona2'], 
                'HargaZona3' => $key['HargaZona3'], 
                'HargaZona4' => $key['HargaZona4'], 
                'Harga' => $key['HargaZona2'],
            );
            $this->db->update('ref_asb', $dataUpdate);
        }
    }

    public function deleteDataSsh($post, $zona){
        $idAsb = explode('-', $post['idAsb']); 
        $idSsh = explode('-', $post['idSsh']); 

        for($i = 6; $i>1; $i--){
            $this->db->where('Kd_Asb'.($i-1), $idAsb[($i-2)]);
        }
        for($i = 7; $i>1; $i--){
            if($i - 1 <= 4)
                $this->db->where('Kd_Hspk_Ssh'.($i-1), $idSsh[($i-2)]);
            else
                $this->db->where('Kd_Ssh'.($i-1), $idSsh[($i-2)]);
        }
        // $this->db->where('zona', $zona);
        
        $result = $this->db->delete('Ta_Hspk_Asb');

        //return $post;
        return $result;
    
    }

    public function loadSshHspk($hspk, $hspkSsh, $asal){
        $idHspk = explode('-', $hspk); 
        $idHspkSsh = explode('-', $hspkSsh); 

        if($asal == 1){
            $kode = "Kd_Ssh";
            $batas  = 7;
            $table = "ref_ssh";
        }else if($asal == 2){
            $kode = "Kd_Hspk";
            $batas  = 5;
            $table = "ref_hspk";
        }else if($asal == 3){
            $kode = "Kd_Asb";
            $batas  = 6;
            $table = "ref_asb";
        }

        for($i = $batas; $i>1; $i--){
            $this->db->where($kode.($i-1), $idHspkSsh[($i-2)]);
        }
        
        $result = $this->db->get($table);

        return $result->row();
    }



}