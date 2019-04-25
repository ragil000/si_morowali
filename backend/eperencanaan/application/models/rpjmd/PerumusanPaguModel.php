<?php

class PerumusanPaguModel extends CI_Model
{
    private $jumlah, $table;
    public function __construct()
    {
        parent::__construct();
        $this->jumlah = 20;
        $this->table = 'ta_perumusan_program';
    }

    public function getCount($search = '', $post){

        
        $this->db->join('ta_strategi_kebijakan', 'ta_strategi_kebijakan.strategi_kebijakan_id = ta_perumusan_program.strategi_kebijakan_id', 'left');
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
        $this->db->like('outcome', $search);
        $query = $this->db->get($this->table);

        return $query->num_rows();
    }

    public function getJumlahInPage(){
        return $this->jumlah;
    }

    public function getAll($page = 1, $search = '', $post){
        $jumlah = $this->jumlah;
        $awal = ($page - 1)*$jumlah;

        // $this->db->join('ref_kamus_program', 'ref_kamus_program.Kd_Program = ta_perumusan_program.Kd_Program', 'left');
        $this->db->join('ta_strategi_kebijakan', 'ta_strategi_kebijakan.strategi_kebijakan_id = ta_perumusan_program.strategi_kebijakan_id', 'left');
        $this->db->join('ta_tujuan_sasaran', 'ta_tujuan_sasaran.tujuan_sasaran_id = ta_strategi_kebijakan.tujuan_sasaran_id', 'left');
        $this->db->join('ta_isu_strategi', 'ta_isu_strategi.isu_strategi_id = ta_tujuan_sasaran.isu_strategi_id', 'left');
        // $this->db->join('ref_sub_unit', 'ref_sub_unit.Kd_Urusan = ta_isu_strategi.Kd_Urusan AND ref_sub_unit.Kd_Bidang = ta_isu_strategi.Kd_Bidang AND ref_sub_unit.Kd_Sub = ta_perumusan_program.Kd_Sub AND ref_sub_unit.Kd_Unit = ta_perumusan_program.Kd_Unit', 'left');
        $this->db->join('ref_indikator', 'ref_indikator.indikator_id = ta_tujuan_sasaran.indikator_id', 'left');
        $this->db->join('ref_sasaran', 'ref_sasaran.sasaran_id = ref_indikator.sasaran_id', 'left');
        $this->db->join('ref_tujuan', 'ref_tujuan.tujuan_id = ref_sasaran.tujuan_id', 'left');
        $this->db->join('ref_misi', 'ref_misi.misi_id = ta_isu_strategi.misi_id AND ref_misi.misi_id = ref_tujuan.misi_id', 'left');
        $this->db->join('ref_rpjmd', 'ref_rpjmd.rpjmd_id = ref_misi.rpjmd_id', 'left');
        $this->db->join('ref_rpjmd_user', 'ref_rpjmd_user.rpjmd_id = ref_rpjmd.rpjmd_id', 'left');

        $this->db->join('ref_program', 'ref_program.Kd_Prog = ta_perumusan_program.Kd_Prog AND ta_isu_strategi.Kd_Urusan = ref_program.Kd_Urusan AND ta_isu_strategi.Kd_Bidang = ref_program.Kd_Bidang', 'left');

        $this->db->where('ref_rpjmd_user.user_id', $post['user_id']);
        $this->db->where('ref_rpjmd_user.rpjmd_id', $post['rpjmd']);
        $this->db->like('outcome', $search);
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
            $opd = explode('-', $post['opd']);
            $id = $post['perumusan_program_id'];
            $this->db->where('perumusan_program_id', $id);
            $data = array(
                'target1_harga' => $post['target1_harga'], 
                'target1_lokasi' => $post['target1_lokasi'], 
                'target2_harga' => $post['target2_harga'], 
                'target2_lokasi' => $post['target2_lokasi'], 
                'target3_harga' => $post['target3_harga'], 
                'target3_lokasi' => $post['target3_lokasi'], 
                'target4_harga' => $post['target4_harga'], 
                'target4_lokasi' => $post['target4_lokasi'], 
                'target5_harga' => $post['target5_harga'], 
                'target5_lokasi' => $post['target5_lokasi'], 
                'akhir_target' => $post['akhir_target'], 
                'Kd_Sub' => $opd[2], 
                'Kd_Unit' => $opd[3], 
            );
            $result = $this->db->update($this->table, $data);
        }else{
            $result = false;
        }
        
        return $result;
    }

    public function create($post)
    {
        // $this->load->library('MyConfig');
        // $post = $this->security->xss_clean($post);
        // $date = time();


        // $data = $this->cekInput($post);
        // // print_r($post);
        // if($data > 0){
        //     $result = $this->db->insert($this->table, array(
        //         'strategi_kebijakan_id' => $post['strategi_kebijakan_id'], 
        //         'Kd_Prog' => $post['Kd_Program'], 
        //         'outcome' => $post['outcome'], 
        //         'kondisi_awal' => $post['kondisi_awal'], 
        //         'kondisi_akhir' => $post['kondisi_akhir'], 
        //         'lokasi' => $post['lokasi'], 
        //     ));
            
        // }else{
        //     $result = false;
        // }
        
        // return $result;
    }

    public function delete($post){

        $data = $this->cekInput($post);
        // print_r($post);
        if($data > 0){
            $id = $post['perumusan_program_id'];
            $this->db->where('perumusan_program_id', $id);
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