<?php

class RefHspkModel extends CI_Model
{
    private $jumlah;
    private $table;
    public function __construct()
    {
        parent::__construct();
        $this->jumlah = 20;
        $this->table = 'ref_hspk';
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

    public function getCount($search = ''){
        $this->db->like('Uraian_Kegiatan', $search);
        $query = $this->db->get($this->table);
        return count($query->result_array());
    }

    public function getJumlahInPage(){
        return $this->jumlah;
    }

    public function getAll($page = 1, $search = ''){
        $jumlah = $this->jumlah;

        $awal = ($page - 1)*$jumlah;
        $this->db->like('Uraian_Kegiatan', $search);
        $query = $this->db->limit($jumlah,$awal)->get($this->table);
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

    // public function update($post,$zona){
    //     $this->load->library('Fungsi');
    //     $post = $this->security->xss_clean($post);

    //     $satuan = $this->getSatuan($post['satuan']);

    //     $id = explode('-', $post['kodeSsh']); 
    //     for($i = 7; $i>1; $i--){
    //         $this->db->where('Kd_Hspk'.($i-1), $id[($i-2)]);
    //     }

    //     //$zona = $post['zona'];

    //     $result = $this->db->update($this->table, array(
    //         'Kd_Satuan' => $post['satuan'], 
    //         // 'Harga_Satuan' => $this->fungsi->convert_to_number($post['hargaZona2']),
    //         'harga_zona'.$zona => $this->fungsi->convert_to_number($post['hargaZona'.$zona]),
    //         // 'harga_zona2' => $this->fungsi->convert_to_number($post['hargaZona2']),
    //         // 'harga_zona3' => $this->fungsi->convert_to_number($post['hargaZona3']),
    //         // 'harga_zona4' => $this->fungsi->convert_to_number($post['hargaZona4']), 
    //         'Satuan' => $satuan[0]['Uraian'],
    //         'Nama_Barang' => $post['namaBarang'], 
    //     ));
    //     return $result;
    // }

    // public function create($post,$zona)
    // {
    //     $this->load->library('Fungsi');
    //     $post = $this->security->xss_clean($post);

    //     $satuan = $this->getSatuan($post['satuan']);

    //     $id = explode('-', $post['kodeSsh']); 
    //     //$zona = $post['zona'];

    //     $result = $this->db->insert($this->table, array(
    //         'Kd_Ssh1' => $id[0],
    //         'Kd_Ssh2' => $id[1],
    //         'Kd_Ssh3' => $id[2],
    //         'Kd_Ssh4' => $id[3],
    //         'Kd_Ssh5' => $id[4],
    //         'Kd_Ssh6' => $id[5],
    //         'Kd_Satuan' => $post['satuan'], 
    //         // 'Harga_Satuan' => $this->fungsi->convert_to_number($post['hargaZona2']), 
    //         'harga_zona'.$zona => $this->fungsi->convert_to_number($post['hargaZona'.$zona]), 
    //         // 'harga_zona2' => $this->fungsi->convert_to_number($post['hargaZona2']), 
    //         // 'harga_zona3' => $this->fungsi->convert_to_number($post['hargaZona3']), 
    //         // 'harga_zona4' => $this->fungsi->convert_to_number($post['hargaZona4']), 
    //         'Satuan' => $satuan[0]['Uraian'],
    //         'Nama_Barang' => $post['namaBarang'], 
    //     ));
    //     return $result;
    // }

    public function delete($kodeHspk, $kodeSsh = null, $zona = 1){

        

        $idHspk = explode('-', $kodeHspk); 
        for($i = 5; $i>1; $i--){
            $this->db->where('Kd_Hspk'.($i-1), $idHspk[($i-2)]);
        }

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

            if(!$sshHspk){
                for($i = 5; $i>1; $i--){
                    $this->db->where('Kd_Hspk'.($i-1), $idHspk[($i-2)]);
                }

                $result = $this->db->delete('ref_hspk');
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

        $this->db->where('zona', $zona);

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
        for($i = 5; $i>1; $i--){
            $this->db->where('Kd_Hspk'.($i-1), $idHspk[($i-2)]);
        }

        $this->db->where('zona', $zona);
        
        $query = $this->db->get('ta_ssh_hspk');
        
        $totalHspk = 0;
        $hasilData = $query->result_array();
        

        foreach ($hasilData as $keyHspk) {
            $totalHspk += $keyHspk['Harga'];
        }
        
        for($i = 5; $i>1; $i--){
            $this->db->where('Kd_Hspk'.($i-1), $idHspk[($i-2)]);
        }
        $resultHspk = $this->db->update('ref_hspk', array(
            'HargaZona'.$zona => $totalHspk, 
            //'Harga' => $totalHspk,
        ));

        // for($i = 5; $i>1; $i--){
        //     $this->db->where('Kd_Hspk'.($i-1), $idHspk[($i-2)]);
        // }

        // if($uraianKegiatan&& $satuan){
        //     $resultHspk = $this->db->update('ref_hspk', array(
        //         'Uraian_Kegiatan' => $uraianKegiatan,
        //         'Kd_Satuan' => $satuan,
        //         'HargaZona'.$zona => $totalHspk, 
        //         //'Harga' => $totalHspk,
        //     ));
        // }else{
        //     $resultHspk = $this->db->update('ref_hspk', array(
        //         'HargaZona'.$zona => $totalHspk, 
        //         //'Harga' => $totalHspk,
        //     ));
        // }
        
        

        return $hasilData;
        
    }

    public function setData($post, $zona){
        $this->load->library('Fungsi');
        $post = $this->security->xss_clean($post);
        
        $data =  $this->getHargaSsh($post['kodeSsh']);
        $harga_zona = 'harga_zona'.$zona;
        $idHspk = explode('-', $post['kodeHspk']);
        $idSsh = explode('-', $post['kodeSsh']);

        $koefisien = $this->fungsi->convert_to_number($post['koefisien']);
        $hargaSatuan = $this->fungsi->convert_to_number($data->$harga_zona);
        $total = $koefisien*$hargaSatuan ;

        $status = true;
        if(!$this->cekHspk($idHspk)){
            $resultHspk = $this->db->insert('ref_hspk', array(
                'Kd_Hspk1' => $idHspk[0],
                'Kd_Hspk2' => $idHspk[1],
                'Kd_Hspk3' => $idHspk[2],
                'Kd_Hspk4' => $idHspk[3],
                'Uraian_Kegiatan' => $post['uraianKegiatan'],
                'Kd_Satuan' => $post['satuan'],
                'HargaZona'.$zona => $total, 
                //'Harga' => $total,
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
                'Harga_Satuan' => $hargaSatuan, 
                'zona' => $zona,
                'Harga' => $total,
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

            $this->db->where('zona', $zona);

            $resultHspkSsh = $this->db->update('ta_ssh_hspk', array(
                'Kd_Satuan' => $post['satuanSsh'], 
                'Kategori' => $post['kategori'], 
                'Koefisien' => $koefisien, 
                'Harga_Satuan' => $hargaSatuan, 
                'Harga' => $total,
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
                $result = $this->delete($data['idHspk'], $data['idSsh'], $zona);
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
        // $this->db->select('*');
        // $this->db->from('ref_hspk');
        // for($i = 4; $i>1; $i--){
            
        //     $this->db->join('ref_hspk'.($i-1), 'ref_hspk'.($i-1).'.Kd_Hspk'.($i-1).' = ref_hspk.Kd_Hspk'.($i-1), 'left');
            
            
        // }

        // $this->db->join('ref_standard_satuan', 'ref_standard_satuan.Kd_Satuan = ref_hspk.Kd_Satuan', 'left');

        // for($i = 5; $i>1; $i--){
        //     $this->db->where('ref_hspk.Kd_Hspk'.($i-1), $id[($i-2)]);
            
        // }


        
        // $dataHspk = $this->db->get();

        // $query = $this->db->query('SELECT * FROM ref_ssh s6, ref_ssh1 s1, ref_ssh2 s2, ref_ssh3 s3, ref_ssh4 s4, ref_ssh5 s5 
        //             WHERE s6.Kd_Ssh1 = s1.Kd_Ssh1
        //             AND s6.Kd_Ssh1 = s2.Kd_Ssh1 AND s6.Kd_Ssh2 = s2.Kd_Ssh2
        //             AND s6.Kd_Ssh1 = s3.Kd_Ssh1 AND s6.Kd_Ssh2 = s3.Kd_Ssh2 AND s6.Kd_Ssh3 = s3.Kd_Ssh3
        //             AND s6.Kd_Ssh1 = s4.Kd_Ssh1 AND s6.Kd_Ssh2 = s4.Kd_Ssh2 AND s6.Kd_Ssh3 = s4.Kd_Ssh3 AND s6.Kd_Ssh4 = s4.Kd_Ssh4
        //             AND s6.Kd_Ssh1 = s5.Kd_Ssh1 AND s6.Kd_Ssh2 = s5.Kd_Ssh2 AND s6.Kd_Ssh3 = s5.Kd_Ssh3 AND s6.Kd_Ssh4 = s5.Kd_Ssh4 AND s6.Kd_Ssh5 = s5.Kd_Ssh5
        //              AND s6.Kd_Ssh1 = '.$id[0].' 
        //              AND s6.Kd_Ssh2 = '.$id[1].' 
        //              AND s6.Kd_Ssh3 = '.$id[2].'
        //              AND s6.Kd_Ssh4 = '.$id[3].'
        //              AND s6.Kd_Ssh5 = '.$id[4].'
        //              AND s6.Kd_Ssh6 = '.$id[5].'
        //             ');

        // $dataHspk = $query;

        $query = $this->db->query('SELECT * FROM ref_hspk h4, ref_hspk1 h1, ref_hspk2 h2, ref_hspk3 h3 
                    where h4.Kd_Hspk1 = h1.Kd_Hspk1 
                    and h4.Kd_Hspk1 = h2.Kd_Hspk1 and h4.Kd_Hspk2 = h2.Kd_Hspk2 
                    and h4.Kd_Hspk1 = h3.Kd_Hspk1 and h4.Kd_Hspk2 = h3.Kd_Hspk2 and h4.Kd_Hspk3 = h3.Kd_Hspk3 
                    and h4.Kd_Hspk1 = h4.Kd_Hspk1 and h4.Kd_Hspk2 = h4.Kd_Hspk2 and h4.Kd_Hspk3 = h4.Kd_Hspk3 and h4.Kd_Hspk4 = h4.Kd_Hspk4
                    and h4.Kd_Hspk1 ='.$id[0].' and h4.Kd_Hspk2 ='.$id[1].' and h4.Kd_Hspk3 ='.$id[2].' and h4.Kd_Hspk4 ='.$id[3]);

        $dataHspk = $query;


        for($i = 5; $i>1; $i--){
            $this->db->where('Kd_Hspk'.($i-1), $id[($i-2)]);
        }
        $this->db->where('zona', $zona);
        
        $dataSsh = $this->db->get('ta_ssh_hspk');
        
        $this->setHspk($post['idHspk'],null,null, $zona);
        
        $data = array(
            'hspk' => $dataHspk->row(),
            'hspkSsh' => $dataSsh->result_array(),
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
        $this->db->where('zona', $zona);
        
        $result = $this->db->delete('ta_ssh_hspk');

        //return $post;
        return $result;
    
    }



}