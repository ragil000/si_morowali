<?php

class SaveModel extends CI_Model
{
    private $table;
    public function __construct()
    {
        parent::__construct();
        $this->table = 'ref_asb';
    }
    public function coba(){
        return 'aa';
    }

    public function getAsb($data, $dataId, $kode = 0){

        $id = explode('-', $dataId); 
        for($i = $data; $i>1; $i--){
            if($data <= 5)
                $this->db->where('Kd_Asb'.($i-1), $id[($i-2)]);
        }
        
        if($kode != 0){
            $this->db->limit(1);
            $this->db->where('Kd_Asb1', $kode);
        }

        if($data < 5){
            $query = $this->db->get($this->table.$data);
            return $query->result_array();
        }else if($data == 5){
            $this->db->join('ref_standard_satuan', 'ref_standard_satuan.Kd_Satuan= '.$this->table.'.Kd_Satuan', 'left');
            $query = $this->db->get($this->table);

            return $query->result_array();
        }else if($data ==6){
            $query = $this->db->get($this->table);
        }

        return $query->row();
        
    }

    public function getHspk($data, $dataId, $kode = 0){

        $id = explode('-', $dataId); 
        for($i = $data; $i>1; $i--){
            $this->db->where('Kd_Hspk'.($i-1), $id[($i-2)]);
        }

        if($kode != 0){
            //$this->db->limit(1);
            $this->db->where('Kd_Hspk1', $kode);
        }
        
        if($data < 4){
            $query = $this->db->get('ref_hspk'.$data);
            return $query->result_array();
        }else if($data == 4){
            $this->db->join('ref_standard_satuan', 'ref_standard_satuan.Kd_Satuan= ref_hspk.Kd_Satuan', 'left');
            $query = $this->db->get('ref_hspk');
            return $query->result_array();
        }else if($data ==5){
            $query = $this->db->get('ref_hspk');
        }

        return $query->row();
        
    }

    public function getSsh($ssh, $dataId, $kode = 0){

        $id = explode('-', $dataId); 
        for($i = $ssh; $i>1; $i--){
            $this->db->where('Kd_Ssh'.($i-1), $id[($i-2)]);
        }

        if($kode != 0){
            //$this->db->limit(1);
            $this->db->where('Kd_Ssh'.$ssh, $kode);
        }
        
        if($ssh < 6){
            $query = $this->db->get('ref_ssh'.$ssh);
            return $query->result_array();
        }else if($ssh ==6){
            $this->db->join('ref_standard_satuan', 'ref_standard_satuan.Kd_Satuan= ref_ssh.Kd_Satuan', 'left');
            $query = $this->db->get('ref_ssh');
            return $query->result_array();
        }else if($ssh ==7){
            $query = $this->db->get('ref_ssh');
        }

        return $query->row();
        
    }

    public function getAset($data, $dataId, $kode = 0){

        $id = explode('-', $dataId); 
        for($i = $data; $i>1; $i--){
            $this->db->where('Kd_Aset'.($i-1), $id[($i-2)]);
        }
        
        if($kode != 0){
            $this->db->where('Kd_Aset'.$data, $kode);
        }

        if($data <= 5){
            $query = $this->db->get('ref_rek_aset'.$data);
            return $query->result_array();
        }

        return 0;
        
    }



}