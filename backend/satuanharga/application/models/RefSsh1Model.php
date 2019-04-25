<?php

class RefSsh1Model extends CI_Model
{
    private $jumlah;
    public function __construct()
    {
        parent::__construct();
        $this->jumlah = 20;
    }

    public function getLast($nomor, $dataId){
        $id = explode('-', $dataId); 
        for($i = $nomor; $i>1; $i--){
            $this->db->where('Kd_Ssh'.($i), $id[($i-2)]);
        }
        $this->db->order_by('Kd_Ssh'.$nomor, 'DESC');
        $query = $this->db->get('ref_ssh'.$nomor);
        return $query->row();
    }

    // public function getSsh($ssh, $dataId){

    //     $id = explode('-', $dataId); 
    //     for($i = $ssh; $i>1; $i--){
    //         $this->db->where('Kd_Ssh'.($i-1), $id[($i-2)]);
    //     }
    //     if($ssh < 6){
    //         $query = $this->db->get('ref_ssh'.$ssh);
    //         return $query->result_array();
    //     }else if($ssh ==6){
    //         $this->db->order_by('Kd_Ssh6', 'DESC'); 
    //         $query = $this->db->get('ref_ssh');
    //     }else if($ssh ==7){
    //         $query = $this->db->get('ref_ssh');
    //     }
    //     return $query->row();
    // }

    public function getCountSsh($search = ''){
        $this->db->like('Nm_Ssh1', $search);
        $query = $this->db->get('ref_ssh1');
        return count($query->result_array());
    }

    public function getJumlahSshInPage(){
        return $this->jumlah;
    }

    public function getAllSsh($page = 1, $search = ''){
        $jumlah = $this->jumlah;

        $awal = ($page - 1)*$jumlah;
        $this->db->like('Nm_Ssh1', $search);
        $query = $this->db->limit($jumlah,$awal)->get('ref_ssh1');
        return $query->result_array();
    }


    public function updateSsh($post, $nomor){
        $this->load->library('Fungsi');
        $post = $this->security->xss_clean($post);
        // $satuan = $this->getSatuan($post['satuan']);
        $id = explode('-', $post['kodeSsh']); 
        for($i = $nomor+1; $i>1; $i--){
            $this->db->where('Kd_Ssh'.$nomor, $id[($i-2)]);
        }

        //$zona = $post['zona'];
        //$this->db->where('Kd_Ssh'.($i-1), $id[($i-2)]);

        $result = $this->db->update('ref_ssh'.$nomor, array(
            //'Kd_Ssh'.$nomor => $post['kodeSsh'],
            'Nm_Ssh'.$nomor => $post['uraianSsh'], 
        ));
        return $result;
    }

    public function createSsh($post, $nomor)
    {
        $this->load->library('Fungsi');
        $post = $this->security->xss_clean($post);

        $result = $this->db->insert('ref_ssh'.$nomor, array(
            'Kd_Ssh'.$nomor => $post['kodeSsh'],
            'Nm_Ssh'.$nomor => $post['uraianSsh'], 
        ));
        return $result;
    }

    public function deleteSsh($nomor, $kodeSsh){

        $id = explode('-', $kodeSsh); 
        for($i = $nomor+1; $i>1; $i--){
            $this->db->where('Kd_Ssh'.$nomor, $id[($i-2)]);
        }
        $result = $this->db->delete('ref_ssh'.$nomor);
        return $result;
    }


}