<?php

class RefSshModel extends CI_Model
{
    private $jumlah;
    public function __construct()
    {
        parent::__construct();
        $this->jumlah = 20;
    }

    public function getSsh($ssh, $dataId){

        $id = explode('-', $dataId); 
        for($i = $ssh; $i>1; $i--){
            $this->db->where('Kd_Ssh'.($i-1), $id[($i-2)]);
        }
        
        if($ssh < 6){
            $query = $this->db->get('ref_ssh'.$ssh);
            return $query->result_array();
        }else if($ssh ==6){
            $this->db->order_by('Kd_Ssh6', 'DESC'); 
            $query = $this->db->get('ref_ssh');
        }else if($ssh ==7){
            $query = $this->db->get('ref_ssh');
        }

        return $query->row();
        
    }

    public function getCountSsh($search = ''){
        $this->db->like('Nama_Barang', $search);
        $query = $this->db->get('ref_ssh');
        return count($query->result_array());
    }

    public function getJumlahSshInPage(){
        return $this->jumlah;
    }

    public function getAllSsh($page = 1, $search = ''){
        $jumlah = $this->jumlah;

        $awal = ($page - 1)*$jumlah;
        $this->db->like('Nama_Barang', $search);
        $this->db->join('ref_standard_satuan', 'ref_standard_satuan.Kd_Satuan= ref_ssh.Kd_Satuan', 'left');
        $query = $this->db->limit($jumlah,$awal)->get('ref_ssh');
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

    public function updateSsh($post,$zona){
        $this->load->library('Fungsi');
        $post = $this->security->xss_clean($post);

        $satuan = $this->getSatuan($post['satuan']);

        $id = explode('-', $post['kodeSsh']); 
        for($i = 7; $i>1; $i--){
            $this->db->where('Kd_Ssh'.($i-1), $id[($i-2)]);
        }

        //$zona = $post['zona'];
        $harga = $this->fungsi->convert_to_number($post['hargaZona'.$zona]);

        $result = $this->db->update('ref_ssh', array(
            'Kd_Satuan' => $post['satuan'], 
            'Harga_Satuan' => $harga, 
            'harga_zona1' => $harga+($harga*0.03), 
            'harga_zona2' => $harga, 
            'harga_zona3' => $harga+($harga*0.06), 
            'harga_zona4' => $harga+($harga*0.1), 
            'Satuan' => $satuan[0]['Uraian'],
            'Nama_Barang' => $post['namaBarang'], 
        ));

        if($result){
            $this->setAllSsh($id, $zona, $this->fungsi->convert_to_number($post['hargaZona'.$zona]));
        }

        return $result;
    }

    public function createSsh($post,$zona)
    {
        $this->load->library('Fungsi');
        $post = $this->security->xss_clean($post);

        $satuan = $this->getSatuan($post['satuan']);

        $id = explode('-', $post['kodeSsh']); 
        //$zona = $post['zona'];
        $harga=$this->fungsi->convert_to_number($post['hargaZona'.$zona]);
        $result = $this->db->insert('ref_ssh', array(
            'Kd_Ssh1' => $id[0],
            'Kd_Ssh2' => $id[1],
            'Kd_Ssh3' => $id[2],
            'Kd_Ssh4' => $id[3],
            'Kd_Ssh5' => $id[4],
            'Kd_Ssh6' => $id[5],
            'Kd_Satuan' => $post['satuan'], 
            
            'Harga_Satuan' => $harga, 
            'harga_zona1' => $harga+($harga*0.03), 
            'harga_zona2' => $harga, 
            'harga_zona3' => $harga+($harga*0.06), 
            'harga_zona4' => $harga+($harga*0.1), 

            
            'Satuan' => $satuan[0]['Uraian'],
            'Nama_Barang' => $post['namaBarang'], 
        ));
        return $result;
    }

    public function deleteSsh($kodeSsh){


        $id = explode('-', $kodeSsh); 
        $this->setAllSsh($id, 2, 0);
        for($i = 7; $i>1; $i--){
            $this->db->where('Kd_Ssh'.($i-1), $id[($i-2)]);
        }

        $result = $this->db->delete('ref_ssh');
        
        return $result;
    }

    public function loadDataHspk($post, $zona){
        $id = explode('-', $post['idSsh']); 

        $query = $this->db->query('SELECT * FROM ref_ssh s6, ref_ssh1 s1, ref_ssh2 s2, ref_ssh3 s3, ref_ssh4 s4, ref_ssh5 s5 
                    WHERE s6.Kd_Ssh1 = s1.Kd_Ssh1
                    AND s6.Kd_Ssh1 = s2.Kd_Ssh1 AND s6.Kd_Ssh2 = s2.Kd_Ssh2
                    AND s6.Kd_Ssh1 = s3.Kd_Ssh1 AND s6.Kd_Ssh2 = s3.Kd_Ssh2 AND s6.Kd_Ssh3 = s3.Kd_Ssh3
                    AND s6.Kd_Ssh1 = s4.Kd_Ssh1 AND s6.Kd_Ssh2 = s4.Kd_Ssh2 AND s6.Kd_Ssh3 = s4.Kd_Ssh3 AND s6.Kd_Ssh4 = s4.Kd_Ssh4
                    AND s6.Kd_Ssh1 = s5.Kd_Ssh1 AND s6.Kd_Ssh2 = s5.Kd_Ssh2 AND s6.Kd_Ssh3 = s5.Kd_Ssh3 AND s6.Kd_Ssh4 = s5.Kd_Ssh4 AND s6.Kd_Ssh5 = s5.Kd_Ssh5
                     AND s6.Kd_Ssh1 = '.$id[0].' 
                     AND s6.Kd_Ssh2 = '.$id[1].' 
                     AND s6.Kd_Ssh3 = '.$id[2].'
                     AND s6.Kd_Ssh4 = '.$id[3].'
                     AND s6.Kd_Ssh5 = '.$id[4].'
                     AND s6.Kd_Ssh6 = '.$id[5].'
                    ');

        $dataHspk = $query;

        //return $post;
       return $dataHspk->row();
    }

    public function setAllSsh($idSsh, $zona, $harga){
       
        $this->load->model('RefHspkModel');
        $this->load->model('RefAsbModel');
        

        for($i = 7; $i>1; $i--){
            $this->db->where('Kd_Ssh'.($i-1), $idSsh[($i-2)]);
        }
        // $this->db->where('zona', $zona);

        $ta_ssh_hspk = $this->db->get('ta_ssh_hspk')->result_array();
        $temp = '';
        $getId = '';
        $total = 0;
        $ke = 0;

        foreach ($ta_ssh_hspk as $sshHspk) {
            $ke++;
            for($i = 1; $i<=4; $i++){
                $name = 'Kd_Hspk'.$i;
                $this->db->where($name, $sshHspk[$name]);
                $coba[($i-1)] = $sshHspk[$name];
            }
            $getId = $coba[0].'-'.$coba[1].'-'.$coba[2].'-'.$coba[3];
            for($i = 1; $i<=6; $i++){
                $name = 'Kd_Ssh'.$i;
                $this->db->where($name, $sshHspk[$name]);
            }
            // $this->db->where('zona', $zona);

            $result = $this->db->update('ta_ssh_hspk', array(
                'Harga_Satuan' => $harga, 
                'Harga' => $harga*$sshHspk['Koefisien'], 
                'HargaZona1' => ($harga+($harga*0.03))*$sshHspk['Koefisien'], 
                'HargaZona2' => ($harga+($harga*0))*$sshHspk['Koefisien'], 
                'HargaZona3' => ($harga+($harga*0.06))*$sshHspk['Koefisien'], 
                'HargaZona4' => ($harga+($harga*0.10))*$sshHspk['Koefisien'], 
            ));
            
            if($temp != $getId){

                if($temp != '' || $ke == count($ta_ssh_hspk)){
                    
                    if($temp == ''){
                        $temp = $getId;
                    }
                    $this->RefHspkModel->setHspk($temp, null, null, $zona);
                    
                }
                $temp = $getId;
                $total = $harga*$sshHspk['Koefisien'];
            }else{
                $total +=  $harga*$sshHspk['Koefisien'];

            }
            $getId = '';
            
        }

        for($i = 7; $i>1; $i--){
            if($i-1 < 5)
                $this->db->where('Kd_Hspk_Ssh'.($i-1), $idSsh[($i-2)]);
            else
                $this->db->where('Kd_Ssh'.($i-1), $idSsh[($i-2)]);
        }
        // $this->db->where('zona', $zona);
        $this->db->where('Asal', 1);

        $table = 'Ta_Hspk_Asb';

        $ta_hspk_asb = $this->db->get($table)->result_array();


        $temp = '';
        $getId = '';
        $total = 0;
        $ke = 0;
        foreach ($ta_hspk_asb as $sshHspk) {
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
            $this->db->where('Asal', 1);

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
            
            
        }
        

    }



}