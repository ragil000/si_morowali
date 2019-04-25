<?php

class RenstraKabModel extends CI_Model
{
    private $jumlah, $table;
    public function __construct()
    {
        parent::__construct();
        $this->jumlah = 20;
        $this->table = 'ta_perumusan_program';
    }

    public function getCount($search = '', $post){

        $opd = $this->cekInput($post);
        $this->db->join('ta_strategi_kebijakan', 'ta_strategi_kebijakan.strategi_kebijakan_id = ta_perumusan_program.strategi_kebijakan_id', 'left');
        $this->db->join('ta_tujuan_sasaran', 'ta_tujuan_sasaran.tujuan_sasaran_id = ta_strategi_kebijakan.tujuan_sasaran_id', 'left');
        $this->db->join('ta_isu_strategi', 'ta_isu_strategi.isu_strategi_id = ta_tujuan_sasaran.isu_strategi_id', 'left');
        $this->db->join('ref_indikator', 'ref_indikator.indikator_id = ta_tujuan_sasaran.indikator_id', 'left');
        $this->db->join('ref_sasaran', 'ref_sasaran.sasaran_id = ref_indikator.sasaran_id', 'left');
        $this->db->join('ref_tujuan', 'ref_tujuan.tujuan_id = ref_sasaran.tujuan_id', 'left');
        $this->db->join('ref_misi', 'ref_misi.misi_id = ta_isu_strategi.misi_id AND ref_misi.misi_id = ref_tujuan.misi_id', 'left');
        $this->db->join('ref_rpjmd', 'ref_rpjmd.rpjmd_id = ref_misi.rpjmd_id', 'left');
        $this->db->join('ref_rpjmd_user', 'ref_rpjmd_user.rpjmd_id = ref_rpjmd.rpjmd_id', 'left');
        // $this->db->where('ref_rpjmd_user.user_id', $post['user_id']);
        if(@$post['name'] == 'opd'){
            
            $this->db->where('ta_isu_strategi.Kd_Urusan', $opd[0]['Kd_Urusan']);
            $this->db->where('ta_isu_strategi.Kd_Bidang', $opd[0]['Kd_Bidang']);
            $this->db->where('ta_perumusan_program.Kd_Unit', $opd[0]['Kd_Unit']);
            $this->db->where('ta_perumusan_program.Kd_Sub', $opd[0]['Kd_Sub']);
        }
        $this->db->where('ref_rpjmd_user.rpjmd_id', $post['rpjmd']);
        $this->db->like('outcome_kegiatan', $search);
        $query = $this->db->get($this->table);

        return $query->num_rows();
    }

    public function getJumlahInPage(){
        return $this->jumlah;
    }

    public function getAll($page = 1, $search = '', $post, $all = false){
        $jumlah = $this->jumlah;
        $awal = ($page - 1)*$jumlah;

        $opd = $this->cekInput($post);
        // $this->db->select('ta_isu_strategi.Kd_Urusan, ta_isu_strategi.Kd_Bidang, ta_perumusan_program.Kd_Unit, ta_perumusan_program.Kd_Sub');
        $this->db->join('ta_strategi_kebijakan', 'ta_strategi_kebijakan.strategi_kebijakan_id = ta_perumusan_program.strategi_kebijakan_id', 'left');
        $this->db->join('ta_tujuan_sasaran', 'ta_tujuan_sasaran.tujuan_sasaran_id = ta_strategi_kebijakan.tujuan_sasaran_id', 'left');
        $this->db->join('ta_isu_strategi', 'ta_isu_strategi.isu_strategi_id = ta_tujuan_sasaran.isu_strategi_id', 'left');
        $this->db->join('ref_indikator', 'ref_indikator.indikator_id = ta_tujuan_sasaran.indikator_id', 'left');
        $this->db->join('ref_sasaran', 'ref_sasaran.sasaran_id = ref_indikator.sasaran_id', 'left');
        $this->db->join('ref_tujuan', 'ref_tujuan.tujuan_id = ref_sasaran.tujuan_id', 'left');
        $this->db->join('ref_misi', 'ref_misi.misi_id = ta_isu_strategi.misi_id AND ref_misi.misi_id = ref_tujuan.misi_id', 'left');
        $this->db->join('ref_rpjmd', 'ref_rpjmd.rpjmd_id = ref_misi.rpjmd_id', 'left');
        $this->db->join('ref_rpjmd_user', 'ref_rpjmd_user.rpjmd_id = ref_rpjmd.rpjmd_id', 'left');

        $this->db->join('ref_program', 'ref_program.Kd_Prog = ta_perumusan_program.Kd_Prog AND ta_isu_strategi.Kd_Urusan = ref_program.Kd_Urusan AND ta_isu_strategi.Kd_Bidang = ref_program.Kd_Bidang', 'left');
        // $this->db->join('ref_kegiatan', 'ref_kegiatan.Kd_Keg = ta_perumusan_program.Kd_Keg AND ref_kegiatan.Kd_Prog = ta_perumusan_program.Kd_Prog  AND ta_isu_strategi.Kd_Urusan = ref_kegiatan.Kd_Urusan AND ta_isu_strategi.Kd_Bidang = ref_kegiatan.Kd_Bidang', 'left');

        
        if(@$post['name'] == 'opd'){
            
            $this->db->where('ta_isu_strategi.Kd_Urusan', $opd[0]['Kd_Urusan']);
            $this->db->where('ta_isu_strategi.Kd_Bidang', $opd[0]['Kd_Bidang']);
            $this->db->where('ta_perumusan_program.Kd_Unit', $opd[0]['Kd_Unit']);
            $this->db->where('ta_perumusan_program.Kd_Sub', $opd[0]['Kd_Sub']);
        }
        
        // $this->db->where('ref_rpjmd_user.user_id', $post['user_id']);
        $this->db->where('ref_rpjmd_user.rpjmd_id', $post['rpjmd']);
        $this->db->like('outcome_kegiatan', $search);
        if($all){
            $this->db->limit($jumlah,$awal);
        }
        
        $query =  $this->db->get($this->table)->result_array();
        return $query;
    }
    

    public function update($post){
        
        $post = $this->security->xss_clean($post);
        

        $data = $this->cekInput($post);
        // print_r($post);
        if(count($data)> 0){
            $id = $post['perumusan_program_id'];
            $this->db->where('perumusan_program_id', $id);
            $data = array(
                'Kd_Keg' => $post['Kd_Keg'], 
                'outcome_kegiatan' => $post['outcome_kegiatan'], 
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

        $result = false;
        $data = $this->cekInput($post);
        // print_r($post);
        if(count($data) > 0){
            
            $this->db->where('perumusan_program_id', $post['perumusan_program_id']);
            $dataKirim = $this->db->get($this->table)->result_array();
            if(count($dataKirim)>0){
                unset($dataKirim[0]['perumusan_program_id']);
                unset($dataKirim[0]['Kd_Keg']);
                unset($dataKirim[0]['outcome_kegiatan']);
                $result = $this->db->insert($this->table, $dataKirim[0]);
                // print_r($dataKirim[0]);
            }
            
            
        }else{
            $result = false;
        }
        
        return $result;
    }

    public function delete($post){

        $data = $this->cekInput($post);
        // print_r($post);
        $result = false;
        if(count($data) > 0){
            $this->db->where('perumusan_program_id', $post['perumusan_program_id']);
            $dataKirim = $this->db->get($this->table)->result_array();
            if(count($dataKirim)>0){
                $this->db->where('Kd_Prog', $dataKirim[0]['Kd_Prog']);
                $prog = $this->db->get($this->table)->num_rows();
                if($prog>1){
                    $id = $post['perumusan_program_id'];
                    $this->db->where('perumusan_program_id', $id);
                    $result = $this->db->delete($this->table);
                }
            }
        }
        return $result;
    }


    public function cekInput($post){
        // return 1;
        if(@$post['name'] == 'opd'){
            $this->db->where('user_id', $post['user_id']);
            $query = $this->db->get('ref_opd_user');
            return $query->result_array();
        }else{
            return 1;
        }
        

    }

}