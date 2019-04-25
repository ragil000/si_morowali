<?php

class TujuanSasaranModel extends CI_Model
{
    private $jumlah, $table;
    public function __construct()
    {
        parent::__construct();
        $this->jumlah = 20;
        $this->table = 'ta_tujuan_sasaran';
    }

    public function getCount($search = '', $post){

        $this->db->join('ref_indikator', 'ref_indikator.indikator_id = ta_tujuan_sasaran.indikator_id', 'left');
        $this->db->join('ref_sasaran', 'ref_sasaran.sasaran_id = ref_indikator.sasaran_id', 'left');
        $this->db->join('ref_tujuan', 'ref_tujuan.tujuan_id = ref_sasaran.tujuan_id', 'left');
        $this->db->join('ta_isu_strategi', 'ta_isu_strategi.isu_strategi_id = ta_tujuan_sasaran.isu_strategi_id', 'left');
        $this->db->join('ref_misi', 'ref_misi.misi_id = ta_isu_strategi.misi_id AND ref_tujuan.misi_id = ref_misi.misi_id', 'left');
        $this->db->join('ref_rpjmd', 'ref_rpjmd.rpjmd_id = ref_misi.rpjmd_id', 'left');
        $this->db->join('ref_rpjmd_user', 'ref_rpjmd_user.rpjmd_id = ref_rpjmd.rpjmd_id', 'left');
        $this->db->where('ref_rpjmd_user.user_id', $post['user_id']);
        $this->db->where('ref_rpjmd_user.rpjmd_id', $post['rpjmd']);
        $this->db->like('tujuan_sasaran_kondisi_awal', $search);

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

        
        // $this->db->join('ref_standard_satuan', 'ref_standard_satuan.Kd_Satuan = ta_tujuan_sasaran.Kd_Satuan', 'left');
        $this->db->join('ref_indikator', 'ref_indikator.indikator_id = ta_tujuan_sasaran.indikator_id', 'left');
        $this->db->join('ref_sasaran', 'ref_sasaran.sasaran_id = ref_indikator.sasaran_id', 'left');
        $this->db->join('ref_tujuan', 'ref_tujuan.tujuan_id = ref_sasaran.tujuan_id', 'left');
        $this->db->join('ta_isu_strategi', 'ta_isu_strategi.isu_strategi_id = ta_tujuan_sasaran.isu_strategi_id', 'left');
        $this->db->join('ref_misi', 'ref_misi.misi_id = ta_isu_strategi.misi_id AND ref_tujuan.misi_id = ref_misi.misi_id', 'left');
        $this->db->join('ref_rpjmd', 'ref_rpjmd.rpjmd_id = ref_misi.rpjmd_id', 'left');
        $this->db->join('ref_rpjmd_user', 'ref_rpjmd_user.rpjmd_id = ref_rpjmd.rpjmd_id', 'left');
        $this->db->where('ref_rpjmd_user.user_id', $post['user_id']);
        $this->db->where('ref_rpjmd_user.rpjmd_id', $post['rpjmd']);
        $this->db->like('tujuan_sasaran_kondisi_awal', $search);

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
            
            $id = $post['tujuan_sasaran_id'];
            $this->db->where('tujuan_sasaran_id', $id);
            $data = array(
                'isu_strategi_id' => $post['isu_strategi_id'], 
                'indikator_id' => $post['indikator_id'], 
                'tujuan_sasaran_kondisi_awal' => $post['tujuan_sasaran_kondisi_awal'], 
                'target1_tahun' => $post['target1_tahun'], 
                'target1_satuan' => $post['target1_satuan'], 
                'target2_tahun' => $post['target2_tahun'], 
                'target2_satuan' => $post['target2_satuan'], 
                'target3_tahun' => $post['target3_tahun'], 
                'target3_satuan' => $post['target3_satuan'], 
                'target4_tahun' => $post['target4_tahun'], 
                'target4_satuan' => $post['target4_satuan'], 
                'target5_tahun' => $post['target5_tahun'], 
                'target5_satuan' => $post['target5_satuan'],
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
                'isu_strategi_id' => $post['isu_strategi_id'], 
                'indikator_id' => $post['indikator_id'], 
                'tujuan_sasaran_kondisi_awal' => $post['tujuan_sasaran_kondisi_awal'], 
                'target1_tahun' => $post['target1_tahun'], 
                'target1_satuan' => $post['target1_satuan'], 
                'target2_tahun' => $post['target2_tahun'], 
                'target2_satuan' => $post['target2_satuan'], 
                'target3_tahun' => $post['target3_tahun'], 
                'target3_satuan' => $post['target3_satuan'], 
                'target4_tahun' => $post['target4_tahun'], 
                'target4_satuan' => $post['target4_satuan'], 
                'target5_tahun' => $post['target5_tahun'], 
                'target5_satuan' => $post['target5_satuan'], 
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
            $id = $post['tujuan_sasaran_id'];
            $this->db->where('tujuan_sasaran_id', $id);
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