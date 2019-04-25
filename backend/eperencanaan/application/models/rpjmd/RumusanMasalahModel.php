<?php

class RumusanMasalahModel extends CI_Model
{
    private $jumlah, $table;
    public function __construct()
    {
        parent::__construct();
        $this->jumlah = 20;
        $this->table = 'ref_rumusan_masalah';
    }

    public function getCount($search = '', $post){

        $this->db->join('ref_sub_unit', 'ref_sub_unit.Kd_Urusan = '.$this->table.'.Kd_Urusan AND ref_sub_unit.Kd_Bidang = '.$this->table.'.Kd_Bidang AND ref_sub_unit.Kd_Sub = '.$this->table.'.Kd_Sub AND  ref_sub_unit.Kd_Unit = '.$this->table.'.Kd_Unit' , 'left');
        $this->db->join('ref_rpjmd', 'ref_rpjmd.rpjmd_id = ref_rumusan_masalah.rpjmd_id', 'left');
        $this->db->join('ref_rpjmd_user', 'ref_rpjmd_user.rpjmd_id = ref_rpjmd.rpjmd_id', 'left');
        $this->db->where('ref_rpjmd_user.user_id', $post['user_id']);
        $this->db->where('ref_rpjmd_user.rpjmd_id', $post['rpjmd']);
        $this->db->like('rumusan_masalah_nama', $search);
        $query = $this->db->get($this->table);
        // return count($query->result_array());

        return $query->num_rows();
    }

    public function getJumlahInPage(){
        return $this->jumlah;
    }

    public function getAll($page = 1, $search = '', $post){
        $jumlah = $this->jumlah;
        $awal = ($page - 1)*$jumlah;
        
        $this->db->join('ref_sub_unit', 'ref_sub_unit.Kd_Urusan = '.$this->table.'.Kd_Urusan AND ref_sub_unit.Kd_Bidang = '.$this->table.'.Kd_Bidang AND ref_sub_unit.Kd_Sub = '.$this->table.'.Kd_Sub AND  ref_sub_unit.Kd_Unit = '.$this->table.'.Kd_Unit' , 'left');
        $this->db->join('ref_rpjmd', 'ref_rpjmd.rpjmd_id = ref_rumusan_masalah.rpjmd_id', 'left');
        $this->db->join('ref_rpjmd_user', 'ref_rpjmd_user.rpjmd_id = ref_rpjmd.rpjmd_id', 'left');
        $this->db->where('ref_rpjmd_user.user_id', $post['user_id']);
        $this->db->where('ref_rpjmd_user.rpjmd_id', $post['rpjmd']);
        $this->db->like('rumusan_masalah_nama', $search);
        if(@$post['all']){
            
        }else{
            $this->db->limit($jumlah,$awal);
        }
        $query = $this->db->get($this->table)->result_array();
        return $query;
    }
    

    public function update($post){
        
        $post = $this->security->xss_clean($post);
        

        $data = $this->cekInput($post);
        // print_r($post);
        if($data > 0){
            $opd = explode('-',$post['opd']);
            $id = $post['rumusan_masalah_id'];
            $this->db->where('rumusan_masalah_id', $id);
            $data = array(
                'rpjmd_id' => $post['rpjmd'], 
                'rumusan_masalah_nama' => $post['rumusan_masalah_nama'], 
                'rumusan_masalah_akar' => $post['rumusan_masalah_akar'], 
                'rumusan_masalah_bukti' => $post['rumusan_masalah_bukti'], 
                'rumusan_masalah_asumsi' => $post['rumusan_masalah_asumsi'], 
                'rumusan_masalah_lokasi' => $post['rumusan_masalah_lokasi'], 
                'Kd_Urusan' => $opd[0], 
                'Kd_Bidang' => $opd[1], 
                'Kd_Unit' => $opd[2], 
                'Kd_Sub' => $opd[3], 
            );
            $result = $this->db->update($this->table, $data);
        }else{
            $result = false;
        }
        

        return $result;
    }

    public function create($post)
    {
        $this->load->library('MyConfig');
        $post = $this->security->xss_clean($post);
        $date = time();

        $opd = explode('-',$post['opd']);


        $data = $this->cekInput($post);
        // print_r($post);
        if($data > 0){
            $result = $this->db->insert($this->table, array(
                'rpjmd_id' => $post['rpjmd'], 
                'rumusan_masalah_nama' => $post['rumusan_masalah_nama'], 
                'rumusan_masalah_akar' => $post['rumusan_masalah_akar'], 
                'rumusan_masalah_bukti' => $post['rumusan_masalah_bukti'], 
                'rumusan_masalah_asumsi' => $post['rumusan_masalah_asumsi'], 
                'rumusan_masalah_lokasi' => $post['rumusan_masalah_lokasi'], 
                'Kd_Urusan' => $opd[0], 
                'Kd_Bidang' => $opd[1], 
                'Kd_Sub' => $opd[2], 
                'Kd_Unit' => $opd[3],  
            ));
        }else{
            $result = false;
        }
        
        return $result;
    }

    public function delete($post){

        $data = $this->cekInput($post);
        // print_r($post);
        if($data > 0){
            $id = $post['rumusan_masalah_id'];
            $this->db->where('rumusan_masalah_id', $id);
            $result = $this->db->delete($this->table);
        }else{
            $result = false;
        }
        

        return $result;
    }

    public function cekInput($post){

        $this->db->where('user_id', $post['user_id']);
        $this->db->where('rpjmd_id', $post['rpjmd']);
        $query = $this->db->get('ref_rpjmd_user');

        return $query->num_rows();
    }

}