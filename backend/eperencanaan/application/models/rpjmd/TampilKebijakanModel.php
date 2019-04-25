<?php

class TampilKebijakanModel extends CI_Model
{
    private $jumlah, $table;
    public function __construct()
    {
        parent::__construct();
        $this->jumlah = 20;
        $this->table = 'strategi';
    }

    public function getCount($search = '', $user_id, $post){

        
        $this->db->join('ref_sub_unit', 'ref_sub_unit.Kd_Bidang = '.$this->table.'.bidang AND ref_sub_unit.Kd_Urusan = '.$this->table.'.urusan AND ref_sub_unit.Kd_Unit = '.$this->table.'.unit AND ref_sub_unit.Kd_Sub = '.$this->table.'.sub', 'left');
        $this->db->join('ref_bidang', 'ref_bidang.Kd_Bidang = '.$this->table.'.bidang AND ref_bidang.Kd_Urusan = '.$this->table.'.urusan ', 'left');
        $this->db->join('ref_urusan', 'ref_urusan.Kd_Urusan = '.$this->table.'.urusan', 'left');
        $this->db->join('ref_kamus_program', 'ref_kamus_program.Kd_Program = '.$this->table.'.program', 'left');
        $query = $this->db->get($this->table);
        return $query->num_rows();
    }

    public function getJumlahInPage(){
        return $this->jumlah;
    }

    public function getAll($page = 1, $search = '', $user_id, $post){
        $jumlah = $this->jumlah;
        $awal = ($page - 1)*$jumlah;
        

        $this->db->join('ref_sub_unit', 'ref_sub_unit.Kd_Bidang = '.$this->table.'.bidang AND ref_sub_unit.Kd_Urusan = '.$this->table.'.urusan AND ref_sub_unit.Kd_Unit = '.$this->table.'.unit AND ref_sub_unit.Kd_Sub = '.$this->table.'.sub', 'left');
        $this->db->join('ref_bidang', 'ref_bidang.Kd_Bidang = '.$this->table.'.bidang AND ref_bidang.Kd_Urusan = '.$this->table.'.urusan ', 'left');
        $this->db->join('ref_urusan', 'ref_urusan.Kd_Urusan = '.$this->table.'.urusan', 'left');
        $this->db->join('ref_kamus_program', 'ref_kamus_program.Kd_Program = '.$this->table.'.program', 'left');

        $this->db->order_by("ref_urusan.Kd_Urusan asc");
        $this->db->order_by("ref_bidang.Kd_Bidang asc");
        $query = $this->db->get($this->table)->result_array();
        return $query;
    }

    public function update($post){
        
        $post = $this->security->xss_clean($post);
        
        $id = $post['id'];
        $this->db->where('strategi_id', $id);
        $data = array(
            'tahun1' => $post['tahun1'], 
            'tahun2' => $post['tahun2'], 
            'tahun3' => $post['tahun3'], 
            'tahun4' => $post['tahun4'], 
            'tahun5' => $post['tahun5'], 
        );
        $result = $this->db->update($this->table, $data);
        
        return $result;
    }

    
}