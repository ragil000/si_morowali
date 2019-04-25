<?php

class StrategiKebijakanModel extends CI_Model
{
    private $jumlah, $table;
    public function __construct()
    {
        parent::__construct();
        $this->jumlah = 20;
        $this->table = 'ta_strategi_kebijakan';
    }

    public function getCount($search = '', $post){


        $this->db->join('ta_tujuan_sasaran', 'ta_tujuan_sasaran.tujuan_sasaran_id = ta_strategi_kebijakan.tujuan_sasaran_id', 'left');
        $this->db->join('ta_isu_strategi', 'ta_isu_strategi.isu_strategi_id = ta_tujuan_sasaran.isu_strategi_id', 'left');
        $this->db->join('ref_indikator', 'ref_indikator.indikator_id = ta_tujuan_sasaran.indikator_id', 'left');
        $this->db->join('ref_sasaran', 'ref_sasaran.sasaran_id = ref_indikator.sasaran_id', 'left');
        $this->db->join('ref_tujuan', 'ref_tujuan.tujuan_id = ref_sasaran.tujuan_id', 'left');
        $this->db->join('ref_misi', 'ref_misi.misi_id = ref_tujuan.misi_id AND ta_isu_strategi.misi_id = ref_misi.misi_id', 'left');
        $this->db->join('ref_rpjmd', 'ref_rpjmd.rpjmd_id = ref_misi.rpjmd_id', 'left');
        $this->db->join('ref_rpjmd_user', 'ref_rpjmd_user.rpjmd_id = ref_rpjmd.rpjmd_id', 'left');
        $this->db->join('ref_urusan', 'ref_urusan.Kd_Urusan = ta_isu_strategi.Kd_Urusan', 'left');
        $this->db->join('ref_bidang', 'ref_bidang.Kd_Urusan = ta_isu_strategi.Kd_Urusan AND ref_bidang.Kd_Bidang = ta_isu_strategi.Kd_Bidang', 'left');
        $this->db->where('ref_rpjmd_user.user_id', $post['user_id']);
        $this->db->where('ref_rpjmd_user.rpjmd_id', $post['rpjmd']);
        $this->db->like('strategi_pembangunan', $search);
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
        
        
        $this->db->join('ta_tujuan_sasaran', 'ta_tujuan_sasaran.tujuan_sasaran_id = ta_strategi_kebijakan.tujuan_sasaran_id', 'left');
        $this->db->join('ta_isu_strategi', 'ta_isu_strategi.isu_strategi_id = ta_tujuan_sasaran.isu_strategi_id', 'left');
        $this->db->join('ref_indikator', 'ref_indikator.indikator_id = ta_tujuan_sasaran.indikator_id', 'left');
        $this->db->join('ref_sasaran', 'ref_sasaran.sasaran_id = ref_indikator.sasaran_id', 'left');
        $this->db->join('ref_tujuan', 'ref_tujuan.tujuan_id = ref_sasaran.tujuan_id', 'left');
        $this->db->join('ref_misi', 'ref_misi.misi_id = ref_tujuan.misi_id AND ta_isu_strategi.misi_id = ref_misi.misi_id', 'left');
        $this->db->join('ref_rpjmd', 'ref_rpjmd.rpjmd_id = ref_misi.rpjmd_id', 'left');
        $this->db->join('ref_rpjmd_user', 'ref_rpjmd_user.rpjmd_id = ref_rpjmd.rpjmd_id', 'left');
        $this->db->join('ref_urusan', 'ref_urusan.Kd_Urusan = ta_isu_strategi.Kd_Urusan', 'left');
        $this->db->join('ref_bidang', 'ref_bidang.Kd_Urusan = ta_isu_strategi.Kd_Urusan AND ref_bidang.Kd_Bidang = ta_isu_strategi.Kd_Bidang', 'left');
        $this->db->where('ref_rpjmd_user.user_id', $post['user_id']);
        $this->db->where('ref_rpjmd_user.rpjmd_id', $post['rpjmd']);
        $this->db->like('strategi_pembangunan', $search);
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
            $id = $post['strategi_kebijakan_id'];
            $this->db->where('strategi_kebijakan_id', $id);
            $data = array(
                'tujuan_sasaran_id' => $post['tujuan_sasaran_id'], 
                'strategi_pembangunan' => $post['strategi_pembangunan'], 
                'arah_kebijakan' => $post['arah_kebijakan'], 
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


        $data = $this->cekInput($post);
        // print_r($post);
        if($data > 0){
            $result = $this->db->insert($this->table, array(
                'tujuan_sasaran_id' => $post['tujuan_sasaran_id'], 
                'strategi_pembangunan' => $post['strategi_pembangunan'], 
                'arah_kebijakan' => $post['arah_kebijakan'],  
            ));
            // if($result){
            //     $id_insert = $this->db->insert_id();
            //     $result = $this->db->insert('ta_perumusan_program', array(
            //         'strategi_kebijakan_id' => $id_insert,  
            //     ));
            // }
        }else{
            $result = false;
        }
        
        return $result;
    }

    public function delete($post){

        $data = $this->cekInput($post);
        // print_r($post);
        if($data > 0){
            $id = $post['strategi_kebijakan_id'];
            $this->db->where('strategi_kebijakan_id', $id);
            $result = $this->db->delete($this->table);

            // $this->db->where('strategi_kebijakan_id', $id);
            // $result = $this->db->delete('ta_perumusan_program');
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