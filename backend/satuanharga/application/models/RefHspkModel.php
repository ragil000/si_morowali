<?php

class RefHspkModel extends CI_Model
{
    private $jumlah;
    private $table;
    private $persenZona;
    public function __construct()
    {
        parent::__construct();
        $this->jumlah = 20;
        $this->table = 'ref_hspk';
        $this->persenZona[1] = 0.03;
        $this->persenZona[2] = 0;
        $this->persenZona[3] = 0.06;
        $this->persenZona[4] = 0.10;
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

    public function get($data, $dataId){

        $id = explode('-', $dataId); 
        for($i = $data; $i>1; $i--){
            $this->db->where('Kd_Hspk'.($i-1), $id[($i-2)]);
        }
        
        if($data < 4){
            $query = $this->db->get($this->table.$data);
            return $query->result_array();
        }else if($data == 4){
            $this->db->order_by('Kd_Hspk4', 'DESC'); 
            $query = $this->db->get($this->table);
        }else if($data ==5){
            $query = $this->db->get($this->table);
        }

        return $query->row();
        
    }

    public function getCount($search = '', $all = false){
        $this->db->like('Uraian_Kegiatan', $search);
        $query = $this->db->get($this->table);
        return count($query->result_array());
    }

    public function getJumlahInPage(){
        return $this->jumlah;
    }

    public function getAll($page = 1, $search = '', $all = false){
        $jumlah = $this->jumlah;

        $awal = ($page - 1)*$jumlah;
        $this->db->like('Uraian_Kegiatan', $search);
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

    public function delete($kodeHspk, $kodeSsh = null, $zona = 1, $hapusAll = true){

        $idHspk = explode('-', $kodeHspk); 
        //$this->setAllHspk($idHspk, $zona, 0);
        for($i = 5; $i>1; $i--){
            $this->db->where('Kd_Hspk'.($i-1), $idHspk[($i-2)]);
        }

        // $this->db->where('zona', $zona);

        if($kodeSsh != null){
            $idSsh = explode('-', $kodeSsh); 
            for($i = 7; $i>1; $i--){
                $this->db->where('Kd_Ssh'.($i-1), $idSsh[($i-2)]);
            }
        }

        $result = $this->db->delete('ta_ssh_hspk');


        if($result){


            $this->setHspk($kodeHspk,null,null, $zona);


            for($i = 5; $i>1; $i--){
                $this->db->where('Kd_Hspk'.($i-1), $idHspk[($i-2)]);
            }

            $sshHspk = $this->db->get('ta_ssh_hspk')->row();

            if(!$sshHspk && $hapusAll){
                for($i = 5; $i>1; $i--){
                    $this->db->where('Kd_Hspk'.($i-1), $idHspk[($i-2)]);
                }

                $result = $this->db->delete('ref_hspk');

                for($i = 5; $i>1; $i--){
                    $this->db->where('Kd_Hspk_Ssh'.($i-1), $idHspk[($i-2)]);
                }

                $result = $this->db->delete('Ta_Hspk_Asb');

                return $result;
            }

            
        }
        return 0;
    }

    public function cekData($post, $zona){


        //$post = $this->security->xss_clean($post);

        $idHspk = explode('-', $post['kodeHspk']);
        $idSsh = explode('-', $post['kodeSsh']);

        for($i = 5; $i>1; $i--){
            $this->db->where('Kd_Hspk'.($i-1), $idHspk[($i-2)]);
        }

        for($i = 7; $i>1; $i--){
            $this->db->where('Kd_Ssh'.($i-1), $idSsh[($i-2)]);
        }

        // $this->db->where('zona', $zona);

        $query = $this->db->get('ta_ssh_hspk');
        
        //return $post;
        return $query->row();
    }

    public function cekHspk($idHspk){


        for($i = 5; $i>1; $i--){
            $this->db->where('Kd_Hspk'.($i-1), $idHspk[($i-2)]);
        }

        $query = $this->db->get('ref_hspk');
        
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

        for($i = $jum; $i>1; $i--){
            $this->db->where($kode.($i-1), $id[($i-2)]);
        }
        $query = $this->db->get($table);
        
        return $query->row();
    }

    public function getHargaSsh($idSsh){

        $id = explode('-', $idSsh);
        for($i = 7; $i>1; $i--){
            $this->db->where('Kd_Ssh'.($i-1), $id[($i-2)]);
        }

        $query = $this->db->get('ref_ssh');
        
        return $query->row();
    }

    public function setHspk($kodeHspk, $uraianKegiatan = null, $satuan = null, $zona){
        $this->load->library('Fungsi');
        //$post = $this->security->xss_clean($post);

        $idHspk = explode('-', $kodeHspk);
        $hasilData = [];
        $this->db->select('*');
        $this->db->from('ta_ssh_hspk');
        $this->db->join('ref_standard_satuan', 'ref_standard_satuan.Kd_Satuan= ta_ssh_hspk.Kd_Satuan', 'left');
        // $this->db->join('ref_ssh', '
        //         ref_ssh.Kd_Ssh1 = ta_ssh_hspk.Kd_Ssh1 
        //     and ref_ssh.Kd_Ssh2 = ta_ssh_hspk.Kd_Ssh2 
        //     and ref_ssh.Kd_Ssh3 = ta_ssh_hspk.Kd_Ssh3 
        //     and ref_ssh.Kd_Ssh4 = ta_ssh_hspk.Kd_Ssh4 
        //     and ref_ssh.Kd_Ssh5 = ta_ssh_hspk.Kd_Ssh5
        //     and ref_ssh.Kd_Ssh6 = ta_ssh_hspk.Kd_Ssh6', 'left');
        for($i = 5; $i>1; $i--){
            $this->db->where('Kd_Hspk'.($i-1), $idHspk[($i-2)]);
        }

        // $this->db->where('zona', $zona);
        
        $query = $this->db->get();
        
        //$query = $this->db->get('ta_ssh_hspk');
        
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
            $totalHspk += $keyHspk['Harga'];
            $totalHspk1 += $keyHspk['HargaZona1'];
            $totalHspk2 += $keyHspk['HargaZona2'];
            $totalHspk3 += $keyHspk['HargaZona3'];
            $totalHspk4 += $keyHspk['HargaZona4'];

            $coba[$no] = $keyHspk;

            if($keyHspk['asal'] == 1){
                for($i = 7; $i>1; $i--){
                    $this->db->where('Kd_Ssh'.($i-1), $keyHspk['Kd_Ssh'.($i-1)]);
                }
                $keyHspk = $this->db->get('ref_ssh')->row();
                $coba[$no]['Nama_Barang'] = $keyHspk->Nama_Barang;
                $coba[$no]['Jumlah_HargaZona1'] = $keyHspk->harga_zona1;
                $coba[$no]['Jumlah_HargaZona2'] = $keyHspk->harga_zona2;
                $coba[$no]['Jumlah_HargaZona3'] = $keyHspk->harga_zona3;
                $coba[$no]['Jumlah_HargaZona4'] = $keyHspk->harga_zona4;
                // $total[0] += $coba[$no]['Jumlah_HargaZona1']*$keyHspk['Koefisien'];
                // $total[1] += $coba[$no]['Jumlah_HargaZona2']*$keyHspk['Koefisien'];
                // $total[2] += $coba[$no]['Jumlah_HargaZona3']*$keyHspk['Koefisien'];
                // $total[3] += $coba[$no]['Jumlah_HargaZona4']*$keyHspk['Koefisien'];
            }else if($keyHspk['asal'] == 2){
                for($i = 5; $i>1; $i--){
                    $this->db->where('Kd_Hspk'.($i-1), $keyHspk['Kd_Ssh'.($i-1)]);
                }
                $keyHspk = $this->db->get('ref_hspk')->row();
                $coba[$no]['Nama_Barang'] = $keyHspk->Uraian_Kegiatan;
                $coba[$no]['Jumlah_HargaZona1'] = $keyHspk->HargaZona1;
                $coba[$no]['Jumlah_HargaZona2'] = $keyHspk->HargaZona2;
                $coba[$no]['Jumlah_HargaZona3'] = $keyHspk->HargaZona3;
                $coba[$no]['Jumlah_HargaZona4'] = $keyHspk->HargaZona4;
                // $total[0] += $coba[$no]['Jumlah_HargaZona1']*$keyHspk['Koefisien'];
                // $total[1] += $coba[$no]['Jumlah_HargaZona2']*$keyHspk['Koefisien'];
                // $total[2] += $coba[$no]['Jumlah_HargaZona3']*$keyHspk['Koefisien'];
                // $total[3] += $coba[$no]['Jumlah_HargaZona4']*$keyHspk['Koefisien'];
            }
            // $coba[$no]['Jumlah_HargaZona1'] = $keyHspk['HargaZona1'];
            // $coba[$no]['Jumlah_HargaZona2'] = $keyHspk['HargaZona2'];
            // $coba[$no]['Jumlah_HargaZona3'] = $keyHspk['HargaZona3'];
            // $coba[$no]['Jumlah_HargaZona4'] = $keyHspk['HargaZona4'];
            // $coba[$no]['Nama_Barang'] = $keyHspk['HargaZona4'];
            $no++;
        }

        for($i = 5; $i>1; $i--){
            $this->db->where('Kd_Hspk'.($i-1), $idHspk[($i-2)]);
        }

        if($uraianKegiatan && $satuan){
            $dataUpdate = array(
                'Uraian_Kegiatan' => $uraianKegiatan,
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
        $this->db->update('ref_hspk', $dataUpdate);

        //$this->setAllHspk($idHspk)
        
        //$this->setAllHspk($idHspk, $zona, $totalHspk);
        return $coba;
        //return $hasilData;
        
    }

    public function setData2($post, $zona = 1, $asal = 1){
        $this->load->library('Fungsi');
        $post = $this->security->xss_clean($post);
        if($asal == 2){
            $data =  $this->getHarga($post['kodeSsh'], $asal);
            $harga_zona = 'HargaZona';
        }else if($asal == 1){
            $data =  $this->getHargaSsh($post['kodeSsh']);
            $harga_zona = 'harga_zona';
        }

        $harga_zona1 = $harga_zona."1";
        $harga_zona2 = $harga_zona."2";
        $harga_zona3 = $harga_zona."3";
        $harga_zona4 = $harga_zona."4";
        
        $idHspk = explode('-', $post['kodeHspk']);
        $idSsh = explode('-', $post['kodeSsh']);

        $koefisien = $post['koefisien'];

        if(count($data) == 0){
            return array();
        }

        $hargaSatuan1 = $this->fungsi->convert_to_number($data->$harga_zona1);
        $hargaSatuan2 = $this->fungsi->convert_to_number($data->$harga_zona2);
        $hargaSatuan3 = $this->fungsi->convert_to_number($data->$harga_zona3);
        $hargaSatuan4 = $this->fungsi->convert_to_number($data->$harga_zona4);

        $total1 = $koefisien*$hargaSatuan1;
        $total2 = $koefisien*$hargaSatuan2;
        $total3 = $koefisien*$hargaSatuan3;
        $total4 = $koefisien*$hargaSatuan4;

        $status = true;
        if(!$this->cekHspk($idHspk)){
            $resultHspk = $this->db->insert('ref_hspk', array(
                'Kd_Hspk1' => $idHspk[0],
                'Kd_Hspk2' => $idHspk[1],
                'Kd_Hspk3' => $idHspk[2],
                'Kd_Hspk4' => $idHspk[3],
                'Uraian_Kegiatan' => $post['uraianKegiatan'],
                'Kd_Satuan' => $post['satuan'],
                'HargaZona1' => $total1, 
                'HargaZona2' => $total2, 
                'HargaZona3' => $total3, 
                'HargaZona4' => $total4, 
                'Harga' => $total2,
            ));

            if($resultHspk)
                $status = false;

        }

        
        
        if(!$this->cekData($post, $zona)){

            $resultHspkSsh = $this->db->insert('ta_ssh_hspk', array(
                'Kd_Hspk1' => $idHspk[0],
                'Kd_Hspk2' => $idHspk[1],
                'Kd_Hspk3' => $idHspk[2],
                'Kd_Hspk4' => $idHspk[3],
                'Kd_Ssh1' => $idSsh[0],
                'Kd_Ssh2' => $idSsh[1],
                'Kd_Ssh3' => $idSsh[2],
                'Kd_Ssh4' => $idSsh[3],
                'Kd_Ssh5' => $idSsh[4],
                'Kd_Ssh6' => $idSsh[5],
                'Kd_Satuan' => $post['satuanSsh'], 
                'Kategori' => $post['kategori'], 
                'Koefisien' => $koefisien, 
                'Harga_Satuan' => $hargaSatuan2, 
                'asal' => $asal,
                'HargaZona1' => $total1, 
                'HargaZona2' => $total2, 
                'HargaZona3' => $total3, 
                'HargaZona4' => $total4, 
                'Harga' => $total2,
            ));

            if($resultHspkSsh){
                //return 'berhasil input';
            }
        }else{
            for($i = 5; $i>1; $i--){
                $this->db->where('Kd_Hspk'.($i-1), $idHspk[($i-2)]);
            }

            for($i = 7; $i>1; $i--){
                $this->db->where('Kd_Ssh'.($i-1), $idSsh[($i-2)]);
            }

            // $this->db->where('zona', $zona);

            $resultHspkSsh = $this->db->update('ta_ssh_hspk', array(
                'Kd_Satuan' => $post['satuanSsh'], 
                'Kategori' => $post['kategori'], 
                'Koefisien' => $koefisien, 
                'Harga_Satuan' => $hargaSatuan2, 
                'HargaZona1' => $total1, 
                'HargaZona2' => $total2, 
                'HargaZona3' => $total3, 
                'HargaZona4' => $total4, 
                'Harga' => $total2,
            ));

            if($resultHspkSsh){
                //return 'berhasil Edit';
            }
        }
        $hasilData = [];

        $hasilData = $this->setHspk($post['kodeHspk'],$post['uraianKegiatan'],$post['satuan'], $zona);

        return $hasilData;
        

    }

    public function setData($post, $zona = 1, $asal = 1){
        $this->load->library('Fungsi');
        $post = $this->security->xss_clean($post);
        
        $data =  $this->getHargaSsh($post['kodeSsh']);
        $harga_zona = 'harga_zona'.$zona;
        $idHspk = explode('-', $post['kodeHspk']);
        $idSsh = explode('-', $post['kodeSsh']);

        $koefisien = $post['koefisien'];

        $hargaSatuan1 = $data->harga_zona1;
        $hargaSatuan2 = $data->harga_zona2;
        $hargaSatuan3 = $data->harga_zona3;
        $hargaSatuan4 = $data->harga_zona4;

        $total1 = $koefisien*$hargaSatuan1;
        $total2 = $koefisien*$hargaSatuan2;
        $total3 = $koefisien*$hargaSatuan3;
        $total4 = $koefisien*$hargaSatuan4;

        $status = true;
        if(!$this->cekHspk($idHspk)){
            $resultHspk = $this->db->insert('ref_hspk', array(
                'Kd_Hspk1' => $idHspk[0],
                'Kd_Hspk2' => $idHspk[1],
                'Kd_Hspk3' => $idHspk[2],
                'Kd_Hspk4' => $idHspk[3],
                'Uraian_Kegiatan' => $post['uraianKegiatan'],
                'Kd_Satuan' => $post['satuan'],
                'HargaZona1' => $total1, 
                'HargaZona2' => $total2, 
                'HargaZona3' => $total3, 
                'HargaZona4' => $total4, 
                'Harga' => $total2,
            ));

            if($resultHspk)
                $status = false;

        }

        
        
        if(!$this->cekData($post, $zona)){

            $resultHspkSsh = $this->db->insert('ta_ssh_hspk', array(
                'Kd_Hspk1' => $idHspk[0],
                'Kd_Hspk2' => $idHspk[1],
                'Kd_Hspk3' => $idHspk[2],
                'Kd_Hspk4' => $idHspk[3],
                'Kd_Ssh1' => $idSsh[0],
                'Kd_Ssh2' => $idSsh[1],
                'Kd_Ssh3' => $idSsh[2],
                'Kd_Ssh4' => $idSsh[3],
                'Kd_Ssh5' => $idSsh[4],
                'Kd_Ssh6' => $idSsh[5],
                'Kd_Satuan' => $post['satuanSsh'], 
                'Kategori' => $post['kategori'], 
                'Koefisien' => $koefisien, 
                'Harga_Satuan' => $hargaSatuan2, 
                'asal' => $asal,
                'HargaZona1' => $total1, 
                'HargaZona2' => $total2, 
                'HargaZona3' => $total3, 
                'HargaZona4' => $total4, 
                'Harga' => $total2,
            ));

            if($resultHspkSsh){
                //return 'berhasil input';
            }
        }else{
            for($i = 5; $i>1; $i--){
                $this->db->where('Kd_Hspk'.($i-1), $idHspk[($i-2)]);
            }

            for($i = 7; $i>1; $i--){
                $this->db->where('Kd_Ssh'.($i-1), $idSsh[($i-2)]);
            }

            // $this->db->where('zona', $zona);

            $resultHspkSsh = $this->db->update('ta_ssh_hspk', array(
                'Kd_Satuan' => $post['satuanSsh'], 
                'Kategori' => $post['kategori'], 
                'Koefisien' => $koefisien, 
                'Harga_Satuan' => $hargaSatuan2, 
                'HargaZona1' => $total1, 
                'HargaZona2' => $total2, 
                'HargaZona3' => $total3, 
                'HargaZona4' => $total4, 
                'Harga' => $total2,
            ));

            if($resultHspkSsh){
                //return 'berhasil Edit';
            }
        }
        $hasilData = [];

        $hasilData = $this->setHspk($post['kodeHspk'],$post['uraianKegiatan'],$post['satuan'], $zona);

        return $hasilData;
        

    }

    public function setDataHspk($post, $zona){
        //$this->load->library('Fungsi');
        $post = $this->security->xss_clean($post);
        $result = true;
        //$this->delete()
        if(@$post['kirim']){
            foreach ($post['kirim'] as $data) {
                $result = $this->delete($data['idHspk'], $data['idSsh'], $zona, false);
                // if(!$result){
                //     break;
                // }
            }
        }
        

        return $result;
        //return $post['kirim'][0]['idHspk'];
    }



    public function loadDataHspk($post, $zona){
        $post = $this->security->xss_clean($post);


        $id = explode('-', $post['idHspk']); 
        $dataHspk = [];
        $dataSsh = [];

        $query = $this->db->query('SELECT * FROM ref_hspk h4, ref_hspk1 h1, ref_hspk2 h2, ref_hspk3 h3 
                    where h4.Kd_Hspk1 = h1.Kd_Hspk1 
                    and h4.Kd_Hspk1 = h2.Kd_Hspk1 and h4.Kd_Hspk2 = h2.Kd_Hspk2 
                    and h4.Kd_Hspk1 = h3.Kd_Hspk1 and h4.Kd_Hspk2 = h3.Kd_Hspk2 and h4.Kd_Hspk3 = h3.Kd_Hspk3 
                    and h4.Kd_Hspk1 = h4.Kd_Hspk1 and h4.Kd_Hspk2 = h4.Kd_Hspk2 and h4.Kd_Hspk3 = h4.Kd_Hspk3 and h4.Kd_Hspk4 = h4.Kd_Hspk4
                    and h4.Kd_Hspk1 ='.$id[0].' and h4.Kd_Hspk2 ='.$id[1].' and h4.Kd_Hspk3 ='.$id[2].' and h4.Kd_Hspk4 ='.$id[3]);

        $dataHspk = $query;

        $this->db->select('*');
        $this->db->from('ta_ssh_hspk');
        $this->db->join('ref_standard_satuan', 'ref_standard_satuan.Kd_Satuan= ta_ssh_hspk.Kd_Satuan', 'left');
        // $this->db->join('ref_ssh', '
        //         ref_ssh.Kd_Ssh1 = ta_ssh_hspk.Kd_Ssh1 
        //     and ref_ssh.Kd_Ssh2 = ta_ssh_hspk.Kd_Ssh2 
        //     and ref_ssh.Kd_Ssh3 = ta_ssh_hspk.Kd_Ssh3 
        //     and ref_ssh.Kd_Ssh4 = ta_ssh_hspk.Kd_Ssh4 
        //     and ref_ssh.Kd_Ssh5 = ta_ssh_hspk.Kd_Ssh5
        //     and ref_ssh.Kd_Ssh6 = ta_ssh_hspk.Kd_Ssh6', 'left');
        // $this->db->join('ref_hspk', '
        //         ref_hspk.Kd_Hspk1 = ta_ssh_hspk.Kd_Ssh1 
        //     and ref_hspk.Kd_Hspk2 = ta_ssh_hspk.Kd_Ssh2 
        //     and ref_hspk.Kd_Hspk3 = ta_ssh_hspk.Kd_Ssh3 
        //     and ref_hspk.Kd_Hspk4 = ta_ssh_hspk.Kd_Ssh4', 'left');
        for($i = 5; $i>1; $i--){
            $this->db->where('Kd_Hspk'.($i-1), $id[($i-2)]);
        }
        //$this->db->where('asal', 2);
        // $this->db->where('zona', $zona);
        

        $dataSsh = $this->db->get();
        $total[0] = 0;
        $total[1] = 0;
        $total[2] = 0;
        $total[3] = 0;
        $coba = [];
        $no= 0;
        foreach ($dataSsh->result_array() as $key) {
            $coba[$no] = $key;
            //$coba[$no]['HargaZona12'] = $key['HargaZona2']; 
            if($key['asal'] == 1){
                for($i = 7; $i>1; $i--){
                    $this->db->where('Kd_Ssh'.($i-1), $key['Kd_Ssh'.($i-1)]);
                }
                $cek = $this->db->get('ref_ssh')->row();
                $coba[$no]['Nama_Barang'] = $cek->Nama_Barang;
                $coba[$no]['Jumlah_HargaZona1'] = $cek->harga_zona1;
                $coba[$no]['Jumlah_HargaZona2'] = $cek->harga_zona2;
                $coba[$no]['Jumlah_HargaZona3'] = $cek->harga_zona3;
                $coba[$no]['Jumlah_HargaZona4'] = $cek->harga_zona4;
                $total[0] += $coba[$no]['Jumlah_HargaZona1']*$key['Koefisien'];
                $total[1] += $coba[$no]['Jumlah_HargaZona2']*$key['Koefisien'];
                $total[2] += $coba[$no]['Jumlah_HargaZona3']*$key['Koefisien'];
                $total[3] += $coba[$no]['Jumlah_HargaZona4']*$key['Koefisien'];

               
                
            }else if($key['asal'] == 2){
                for($i = 5; $i>1; $i--){
                    $this->db->where('Kd_Hspk'.($i-1), $key['Kd_Ssh'.($i-1)]);
                }
                $cek = $this->db->get('ref_hspk')->row();
                $coba[$no]['Nama_Barang'] = $cek->Uraian_Kegiatan;
                $coba[$no]['Jumlah_HargaZona1'] = $cek->HargaZona1;
                $coba[$no]['Jumlah_HargaZona2'] = $cek->HargaZona2;
                $coba[$no]['Jumlah_HargaZona3'] = $cek->HargaZona3;
                $coba[$no]['Jumlah_HargaZona4'] = $cek->HargaZona4;
                $total[0] += $coba[$no]['Jumlah_HargaZona1']*$key['Koefisien'];
                $total[1] += $coba[$no]['Jumlah_HargaZona2']*$key['Koefisien'];
                $total[2] += $coba[$no]['Jumlah_HargaZona3']*$key['Koefisien'];
                $total[3] += $coba[$no]['Jumlah_HargaZona4']*$key['Koefisien'];


            }
            $no++;
        }

        
        

        //$dataSsh = $this->db->get('ta_ssh_hspk');
        
        $this->setHspk($post['idHspk'],null,null, $zona);

        for($i = 5; $i>1; $i--){
            $this->db->where('Kd_Hspk'.($i-1), $id[($i-2)]);
        }

        $kirim =array(
            'HargaZona1' => $total[0], 
            'HargaZona2' => $total[1], 
            'HargaZona3' => $total[2], 
            'HargaZona4' => $total[3], 
            'Harga' => $total[1],
        );
        $this->db->update('ref_hspk', $kirim );
        
        $data = array(
            'hspk' => $dataHspk->row(),
            //'hspkSsh' => $dataSsh->result_array(),
            'hspkSsh' => $coba,
            'total' => $total,
            'a'=> $kirim
        );

        return $data;
    }

    public function deleteDataSsh($post, $zona){
        $idHspk = explode('-', $post['idHspk']); 
        $idSsh = explode('-', $post['idSsh']); 

        for($i = 5; $i>1; $i--){
            $this->db->where('Kd_Hspk'.($i-1), $idHspk[($i-2)]);
        }
        for($i = 7; $i>1; $i--){
            $this->db->where('Kd_Ssh'.($i-1), $idSsh[($i-2)]);
        }
        // $this->db->where('zona', $zona);
        
        $result = $this->db->delete('ta_ssh_hspk');

        //return $post;
        return $result;
    
    }

    public function setAllHspk($idHspk, $zona, $harga){
       
        $this->load->model('RefAsbModel');

        for($i = 7; $i>1; $i--){
            if($i-1 < 5)
                $this->db->where('Kd_Hspk_Ssh'.($i-1), $idHspk[($i-2)]);
            else
                $this->db->where('Kd_Ssh'.($i-1), 0);
        }
        // $this->db->where('zona', $zona);
        $this->db->where('Asal', 2);

        $table = 'Ta_Hspk_Asb';

        $ta_hspk_asb = $this->db->get($table);

        $temp = '';
        $getId = '';
        $total = 0;
        $ke = 0;
        foreach ($ta_hspk_asb->result_array() as $sshHspk) {
            $ke++;
            for($i = 1; $i<=5; $i++){
                $name = 'Kd_Asb'.$i;
                $this->db->where($name, $sshHspk[$name]);
                $coba[($i-1)] = $sshHspk[$name];
            }
            $getId = $coba[0].'-'.$coba[1].'-'.$coba[2].'-'.$coba[3].'-'.$coba[4];
            for($i = 1; $i<=6; $i++){
                if($i < 5)
                    $name = 'Kd_Hspk_Ssh'.$i;
                else
                    $name = 'Kd_Ssh'.$i;
                $this->db->where($name, $sshHspk[$name]);
            }
            // $this->db->where('zona', $zona);
            $this->db->where('Asal', 2);

            $result = $this->db->update($table, array(
                'Harga_Satuan' => $harga, 
                'Jumlah_Harga' => $harga*$sshHspk['Koefisien'], 
                'HargaZona1' => ($harga+($harga*0.03))*$sshHspk['Koefisien'], 
                'HargaZona2' => ($harga+($harga*0))*$sshHspk['Koefisien'], 
                'HargaZona3' => ($harga+($harga*0.06))*$sshHspk['Koefisien'], 
                'HargaZona4' => ($harga+($harga*0.1))*$sshHspk['Koefisien'], 
            ));
            
            if($temp != $getId){
                if($temp != '' || $ke == count($ta_hspk_asb)){
                    
                    if($temp == ''){
                        $temp = $getId;
                    }
                    $this->RefAsbModel->setHspk($temp, null, null, $zona);
                }
                $temp = $getId;
                $total = $harga*$sshHspk['Koefisien'];
            }else{
                $total +=  $harga*$sshHspk['Koefisien'];

            }
            $getId = '';
            
            //return $result;
        }
    }

    public function loadSshHspk($hspk, $ssh){
        $idHspk = explode('-', $hspk); 
        $idSsh = explode('-', $ssh); 

        for($i = 7; $i>1; $i--){
            $this->db->where('Kd_Ssh'.($i-1), $idSsh[($i-2)]);
        }
        // $this->db->where('zona', $zona);
        
        $result = $this->db->get('ref_ssh');

        //return $post;
        return $result->row();
    }



}