<?php

class ApiModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllSsh($search = ''){
        $this->db->like('Nama_Barang', $search);
        $query = $this->db->get('ref_ssh');
        return $query->result_array();
    }

    public function getAllHspk($search = ''){
        $this->db->like('Uraian_Kegiatan', $search);
        $query = $this->db->get('ref_hspk');
        return $query->result_array();
    }

    public function getAllAsb($search = ''){
        $this->db->like('Jenis_Pekerjaan', $search);
        $query = $this->db->get('ref_asb');
        return $query->result_array();
    }
}