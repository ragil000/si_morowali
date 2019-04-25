<?php

class TampilModel extends CI_Model
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
        $this->db->join('indikator', 'indikator.indikator_id = strategi.indikator_id', 'left');
        $this->db->join('sasaran', 'sasaran.sasaran_id = indikator.sasaran_id', 'left');
        $this->db->join('tujuan', 'tujuan.tujuan_id = sasaran.tujuan_id', 'left');
        $this->db->join('misi', 'misi.misi_id = tujuan.misi_id', 'left');
        $this->db->join('visi', 'visi.visi_id = misi.visi_id', 'left');
        $this->db->join('user_visi', 'user_visi.visi_id = visi.visi_id', 'left');
        $this->db->where('user_visi.user_id', $user_id);
        if(@$post['urusan'] != '' && @$post['bidang'] != ''){
            $this->db->where($this->table.'.urusan', $post['urusan']);
            $this->db->where($this->table.'.bidang', $post['bidang']);
        }
        $this->db->like('strategi_nama', $search);
        $query = $this->db->get($this->table);
        // return count($query->result_array());

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
        $this->db->join('indikator', 'indikator.indikator_id = strategi.indikator_id', 'left');
        $this->db->join('sasaran', 'sasaran.sasaran_id = indikator.sasaran_id', 'left');
        $this->db->join('tujuan', 'tujuan.tujuan_id = sasaran.tujuan_id', 'left');
        $this->db->join('misi', 'misi.misi_id = tujuan.misi_id', 'left');
        $this->db->join('visi', 'visi.visi_id = misi.visi_id', 'left');
        $this->db->join('user_visi', 'user_visi.visi_id = visi.visi_id', 'left');
        $this->db->where('user_visi.user_id', $user_id);
        if(@$post['urusan'] != '' && @$post['bidang'] != ''){
            $this->db->where($this->table.'.urusan', $post['urusan']);
            $this->db->where($this->table.'.bidang', $post['bidang']);
        }
        $this->db->like('strategi_nama', $search);
        $this->db->order_by("ref_urusan.Kd_Urusan asc");
        $query = $this->db->limit($jumlah,$awal)->get($this->table)->result_array();
        return $query;
    }

    
}