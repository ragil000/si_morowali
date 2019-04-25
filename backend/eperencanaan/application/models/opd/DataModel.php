<?php

class DataModel extends CI_Model
{
    private $jumlah;
    public function __construct()
    {
        parent::__construct();
        $this->jumlah = 20;
    }

    public function getMisi($post){

        $opd = $this->getKodeOpd($post['user_id']);

        $this->db->join('ref_opd_visi', 'ref_opd_visi.opd_visi_id = ref_opd_misi.opd_visi_id', 'left');
        $this->db->where('ref_opd_visi.Kd_Urusan', $opd[0]['Kd_Urusan']);
        $this->db->where('ref_opd_visi.Kd_Bidang', $opd[0]['Kd_Bidang']);
        $this->db->where('ref_opd_visi.Kd_Unit', $opd[0]['Kd_Unit']);
        $this->db->where('ref_opd_visi.Kd_Sub', $opd[0]['Kd_Sub']);
        $query = $this->db->get('ref_opd_misi');
        return $query->result_array();
    }

    public function getTujuan($post, $select = false){

        $opd = $this->getKodeOpd($post['user_id']);
        $this->db->join('ref_opd_misi', 'ref_opd_misi.opd_misi_id = ref_opd_tujuan.opd_misi_id', 'left');
        $this->db->join('ref_opd_visi', 'ref_opd_visi.opd_visi_id = ref_opd_misi.opd_visi_id', 'left');
        $this->db->where('ref_opd_visi.Kd_Urusan', $opd[0]['Kd_Urusan']);
        $this->db->where('ref_opd_visi.Kd_Bidang', $opd[0]['Kd_Bidang']);
        $this->db->where('ref_opd_visi.Kd_Unit', $opd[0]['Kd_Unit']);
        $this->db->where('ref_opd_visi.Kd_Sub', $opd[0]['Kd_Sub']);
        if($select){
            $this->db->where('ref_opd_tujuan.opd_misi_id', $post['id']);
        }
        $query = $this->db->get('ref_opd_tujuan');
        return $query->result_array();
    }

    public function getSasaran($post, $select = false){

        $opd = $this->getKodeOpd($post['user_id']);
        $this->db->join('ref_opd_tujuan', 'ref_opd_tujuan.opd_tujuan_id = ref_opd_sasaran.opd_tujuan_id', 'left');
        $this->db->join('ref_opd_misi', 'ref_opd_misi.opd_misi_id = ref_opd_tujuan.opd_misi_id', 'left');
        $this->db->join('ref_opd_visi', 'ref_opd_visi.opd_visi_id = ref_opd_misi.opd_visi_id', 'left');
        if(@$post['name'] == 'opd'){
            $this->db->where('ref_opd_visi.Kd_Urusan', $opd[0]['Kd_Urusan']);
            $this->db->where('ref_opd_visi.Kd_Bidang', $opd[0]['Kd_Bidang']);
            $this->db->where('ref_opd_visi.Kd_Unit', $opd[0]['Kd_Unit']);
            $this->db->where('ref_opd_visi.Kd_Sub', $opd[0]['Kd_Sub']);
        }
        
        if($select){
            $this->db->where('ref_opd_sasaran.opd_tujuan_id', $post['id']);
        }
        $query = $this->db->get('ref_opd_sasaran');
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

    public function getKegiatan($kd_urusan, $kd_bidang, $kd_program){
        // $query = $this->db->get('ref_kamus_program');
        $this->db->where('Kd_Urusan', $kd_urusan);
        $this->db->where('Kd_Bidang', $kd_bidang);
        $this->db->where('Kd_Prog', $kd_program);
        $query = $this->db->get('ref_kegiatan');
        return $query->result_array();
    }

    public function selectKegiatan($kd_urusan, $kd_bidang, $kd_program, $kd_kegiatan){
        // $query = $this->db->get('ref_kamus_program');
        $this->db->where('Kd_Urusan', $kd_urusan);
        $this->db->where('Kd_Bidang', $kd_bidang);
        $this->db->where('Kd_Prog', $kd_program);
        $this->db->where('Kd_Keg', $kd_kegiatan);
        $query = $this->db->get('ref_kegiatan');
        return $query->result_array();
    }

    public function selectProgram($id){
        $query = $this->db->get('ref_kamus_program');
        return $query->result_array();
    }

    public function selectRkpd($kd_urusan, $kd_bidang, $kd_program, $kd_kegiatan){
        $this->db->where('Kd_Urusan', $kd_urusan);
        $this->db->where('Kd_Bidang', $kd_bidang);
        $this->db->where('Kd_Prog', $kd_program);
        $this->db->where('Kd_Keg', $kd_kegiatan);
        $query = $this->db->get('ta_rkpd');
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

    public function getRekening4($rek1, $rek2, $rek3){
        $this->db->where('Kd_Rek_1', $rek1);
        $this->db->where('Kd_Rek_2', $rek2);
        $this->db->where('Kd_Rek_3', $rek3);
        $query = $this->db->get('ref_rek_4');
        return $query->result_array();
    }

    public function getRekening5($rek1, $rek2, $rek3, $rek4){
        $this->db->where('Kd_Rek_1', $rek1);
        $this->db->where('Kd_Rek_2', $rek2);
        $this->db->where('Kd_Rek_3', $rek3);
        $this->db->where('Kd_Rek_4', $rek4);
        $query = $this->db->get('ref_rek_5');
        return $query->result_array();
    }

    public function getKodeOpd($user_id){
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('ref_opd_user');
        return $query->result_array();
    }

    public function getDataOpd($user_id){
        $this->db->join('ref_urusan', 'ref_urusan.Kd_Urusan = ref_opd_user.Kd_Urusan', 'left');
        $this->db->join('ref_bidang', 'ref_bidang.Kd_Urusan = ref_opd_user.Kd_Urusan AND ref_bidang.Kd_Bidang = ref_opd_user.Kd_Bidang', 'left');
        $this->db->join('ref_unit', 'ref_unit.Kd_Urusan = ref_opd_user.Kd_Urusan AND ref_unit.Kd_Bidang = ref_opd_user.Kd_Bidang AND ref_unit.Kd_Unit = ref_opd_user.Kd_Unit', 'left');
        $this->db->join('ref_sub_unit', 'ref_sub_unit.Kd_Urusan = ref_opd_user.Kd_Urusan AND ref_sub_unit.Kd_Bidang = ref_opd_user.Kd_Bidang AND ref_sub_unit.Kd_Unit = ref_opd_user.Kd_Unit AND ref_sub_unit.Kd_Sub = ref_opd_user.Kd_Sub', 'left');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('ref_opd_user');
        return $query->result_array();
    }

    
}