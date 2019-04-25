<?php

class DataModel extends CI_Model
{
    private $jumlah;
    public function __construct()
    {
        parent::__construct();
        $this->jumlah = 20;
    }

    public function getVisi($user_id){

        $this->db->join('user_visi', 'user_visi.visi_id = visi.visi_id', 'left');
        $this->db->where('user_visi.user_id', $user_id);
        $query = $this->db->get('visi');
        return $query->result_array();
    }

    public function getMisi($post){

        $this->db->join('ref_rpjmd', 'ref_rpjmd.rpjmd_id = ref_misi.rpjmd_id', 'left');
        $this->db->join('ref_rpjmd_user', 'ref_rpjmd_user.rpjmd_id = ref_rpjmd.rpjmd_id', 'left');
        $this->db->where('ref_rpjmd_user.user_id', $post['user_id']);
        $this->db->where('ref_rpjmd_user.rpjmd_id', $post['rpjmd']);
        $query = $this->db->get('ref_misi');
        return $query->result_array();
    }

    public function getTujuan($post, $select = false){

        $this->db->join('ref_misi', 'ref_misi.misi_id = ref_tujuan.misi_id', 'left');
        $this->db->join('ref_rpjmd', 'ref_rpjmd.rpjmd_id = ref_misi.rpjmd_id', 'left');
        $this->db->join('ref_rpjmd_user', 'ref_rpjmd_user.rpjmd_id = ref_rpjmd.rpjmd_id', 'left');
        $this->db->where('ref_rpjmd_user.user_id', $post['user_id']);
        $this->db->where('ref_rpjmd_user.rpjmd_id', $post['rpjmd']);
        if($select){
            $this->db->where('ref_tujuan.misi_id', $post['id']);
        }
        $query = $this->db->get('ref_tujuan');
        return $query->result_array();
    }

    public function getSasaran($post, $select = false){

        $this->db->join('ref_tujuan', 'ref_tujuan.tujuan_id = ref_sasaran.tujuan_id', 'left');
        $this->db->join('ref_misi', 'ref_misi.misi_id = ref_tujuan.misi_id', 'left');
        $this->db->join('ref_rpjmd', 'ref_rpjmd.rpjmd_id = ref_misi.rpjmd_id', 'left');
        $this->db->join('ref_rpjmd_user', 'ref_rpjmd_user.rpjmd_id = ref_rpjmd.rpjmd_id', 'left');
        $this->db->where('ref_rpjmd_user.user_id', $post['user_id']);
        $this->db->where('ref_rpjmd_user.rpjmd_id', $post['rpjmd']);
        if($select){
            $this->db->where('ref_sasaran.tujuan_id', $post['id']);
        }
        $query = $this->db->get('ref_sasaran');
        return $query->result_array();
    }

    public function getIndikator($post, $select = false){

        $this->db->join('ref_sasaran', 'ref_sasaran.sasaran_id = ref_indikator.sasaran_id', 'left');
        $this->db->join('ref_tujuan', 'ref_tujuan.tujuan_id = ref_sasaran.tujuan_id', 'left');
        $this->db->join('ref_misi', 'ref_misi.misi_id = ref_tujuan.misi_id', 'left');
        $this->db->join('ref_rpjmd', 'ref_rpjmd.rpjmd_id = ref_misi.rpjmd_id', 'left');
        $this->db->join('ref_rpjmd_user', 'ref_rpjmd_user.rpjmd_id = ref_rpjmd.rpjmd_id', 'left');
        $this->db->where('ref_rpjmd_user.user_id', $post['user_id']);
        $this->db->where('ref_rpjmd_user.rpjmd_id', $post['rpjmd']);
        if($select){
            $this->db->where('ref_indikator.sasaran_id', $post['id']);
        }
        $query = $this->db->get('ref_indikator');
        return $query->result_array();
    }

    public function getIsuStrategi($post, $select = false){

        // $this->db->join('ref_indikator', 'ref_indikator.indikator_id = ta_isu_strategi.indikator_id', 'left');
        // $this->db->join('ref_sasaran', 'ref_sasaran.sasaran_id = ref_indikator.sasaran_id', 'left');
        // $this->db->join('ref_tujuan', 'ref_tujuan.tujuan_id = ref_sasaran.tujuan_id', 'left');
        $this->db->join('ref_misi', 'ref_misi.misi_id = ta_isu_strategi.misi_id', 'left');
        $this->db->join('ref_rpjmd', 'ref_rpjmd.rpjmd_id = ref_misi.rpjmd_id', 'left');
        $this->db->join('ref_rpjmd_user', 'ref_rpjmd_user.rpjmd_id = ref_rpjmd.rpjmd_id', 'left');
        $this->db->where('ref_rpjmd_user.user_id', $post['user_id']);
        $this->db->where('ref_rpjmd_user.rpjmd_id', $post['rpjmd']);
        if($select){
            $this->db->where('ta_isu_strategi.misi_id', $post['id']);
        }
        $query = $this->db->get('ta_isu_strategi');
        return $query->result_array();
    }

    public function getTujuanSasaran($post, $select = false){

        $this->db->join('ta_isu_strategi', 'ta_isu_strategi.isu_strategi_id = ta_tujuan_sasaran.isu_strategi_id', 'left');
        $this->db->join('ref_indikator', 'ref_indikator.indikator_id = ta_tujuan_sasaran.indikator_id', 'left');
        $this->db->join('ref_sasaran', 'ref_sasaran.sasaran_id = ref_indikator.sasaran_id', 'left');
        $this->db->join('ref_tujuan', 'ref_tujuan.tujuan_id = ref_sasaran.tujuan_id', 'left');
        $this->db->join('ref_misi', 'ref_misi.misi_id = ta_isu_strategi.misi_id AND ref_misi.misi_id = ref_tujuan.misi_id', 'left');
        $this->db->join('ref_rpjmd', 'ref_rpjmd.rpjmd_id = ref_misi.rpjmd_id', 'left');
        $this->db->join('ref_rpjmd_user', 'ref_rpjmd_user.rpjmd_id = ref_rpjmd.rpjmd_id', 'left');
        $this->db->where('ref_rpjmd_user.user_id', $post['user_id']);
        $this->db->where('ref_rpjmd_user.rpjmd_id', $post['rpjmd']);

        

        if($select){
            $this->db->where('ta_tujuan_sasaran.indikator_id', $post['id']);
        }
        $query = $this->db->get('ta_tujuan_sasaran');
        return $query->result_array();
    }

    public function getStrategiKebijakan($post, $select = false){

        $this->db->join('ta_tujuan_sasaran', 'ta_tujuan_sasaran.tujuan_sasaran_id = ta_strategi_kebijakan.tujuan_sasaran_id', 'left');
        $this->db->join('ta_isu_strategi', 'ta_isu_strategi.isu_strategi_id = ta_tujuan_sasaran.isu_strategi_id', 'left');
        $this->db->join('ref_indikator', 'ref_indikator.indikator_id = ta_tujuan_sasaran.indikator_id', 'left');
        $this->db->join('ref_sasaran', 'ref_sasaran.sasaran_id = ref_indikator.sasaran_id', 'left');
        $this->db->join('ref_tujuan', 'ref_tujuan.tujuan_id = ref_sasaran.tujuan_id', 'left');
        $this->db->join('ref_misi', 'ref_misi.misi_id = ta_isu_strategi.misi_id AND ref_misi.misi_id = ref_tujuan.misi_id', 'left');
        $this->db->join('ref_rpjmd', 'ref_rpjmd.rpjmd_id = ref_misi.rpjmd_id', 'left');
        $this->db->join('ref_rpjmd_user', 'ref_rpjmd_user.rpjmd_id = ref_rpjmd.rpjmd_id', 'left');
        $this->db->where('ref_rpjmd_user.user_id', $post['user_id']);
        $this->db->where('ref_rpjmd_user.rpjmd_id', $post['rpjmd']);

        if($select){
            $this->db->where('ta_strategi_kebijakan.tujuan_sasaran_id', $post['id']);
        }
        $query = $this->db->get('ta_strategi_kebijakan');
        return $query->result_array();
    }

    public function getUrusan(){
        $query = $this->db->get('ref_urusan');
        return $query->result_array();
    }

    public function getBidang($kd_urusan){
        $this->db->where('Kd_Urusan', $kd_urusan);
        $query = $this->db->get('ref_bidang');
        return $query->result_array();
    }

    public function getFungsi(){
        $query = $this->db->get('ref_fungsi');
        return $query->result_array();
    }

    
    public function getAllOpd(){
        $query = $this->db->get('ref_sub_unit');
        return $query->result_array();
    }

    public function getOpd($kd_urusan, $kd_bidang){
        $this->db->where('Kd_Urusan', $kd_urusan);
        $this->db->where('Kd_Bidang', $kd_bidang);
        $query = $this->db->get('ref_sub_unit');
        return $query->result_array();
    }

    public function selectOpd($kd_urusan, $kd_bidang, $kd_sub, $kd_unit){
        $this->db->where('Kd_Urusan', $kd_urusan);
        $this->db->where('Kd_Bidang', $kd_bidang);
        $query = $this->db->get('ref_sub_unit');
        return $query->result_array();
    }

    public function getProgramAll(){
        // $query = $this->db->get('ref_kamus_program');
        
        $query = $this->db->get('ref_program');
        return $query->result_array();
    }

    public function getProgram($kd_urusan, $kd_bidang){
        // $query = $this->db->get('ref_kamus_program');
        $this->db->where('Kd_Urusan', $kd_urusan);
        $this->db->where('Kd_Bidang', $kd_bidang);
        $query = $this->db->get('ref_program');
        return $query->result_array();
    }

    public function selectProgram($id){
        // $this->db->where('Kd_Program', $id);
        // $query = $this->db->get('ref_kamus_program');

        
        $query = $this->db->get('ref_kamus_program');
        return $query->result_array();
    }

    public function getSatuan(){
        $query = $this->db->get('ref_standard_satuan');
        return $query->result_array();
    }

    public function selectSatuan($id){
        $this->db->where('Kd_Satuan', $id);
        $query = $this->db->get('ref_standard_satuan');
        return $query->result_array();
    }

    public function getRekening($rek1){
        $this->db->where('Kd_Rek_1', $rek1);
        $query = $this->db->get('ref_rek_4');
        return $query->result_array();
    }

    

}