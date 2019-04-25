<?php

class OpdPaguModel extends CI_Model
{
    private $jumlah, $table;
    public function __construct()
    {
        parent::__construct();
        $this->jumlah = 20;
        $this->table = 'ref_opd_pagu';
    }

    public function getCount($search = '', $post){
        // $opd = $this->cekInput($post);
        // $this->db->where('ref_opd_pagu.Kd_Urusan', $opd[0]['Kd_Urusan']);
        // $this->db->where('ref_opd_pagu.Kd_Bidang', $opd[0]['Kd_Bidang']);
        // $this->db->where('ref_opd_pagu.Kd_Unit', $opd[0]['Kd_Unit']);
        // $this->db->where('ref_opd_pagu.Kd_Sub', $opd[0]['Kd_Sub']);
        $this->db->join('ref_sub_unit', 'ref_sub_unit.Kd_Urusan = ref_opd_pagu.Kd_Urusan AND ref_sub_unit.Kd_Bidang = ref_opd_pagu.Kd_Bidang AND ref_sub_unit.Kd_Unit = ref_opd_pagu.Kd_Unit AND ref_sub_unit.Kd_Sub = ref_opd_pagu.Kd_Sub', 'left');
        // $this->db->join('ref_rpjmd_user', 'ref_rpjmd_user.rpjmd_id = ref_rpjmd.rpjmd_id', 'left');
        // $this->db->where('ref_rpjmd_user.user_id', $post['user_id']);
        // $this->db->where('ref_rpjmd_user.rpjmd_id', $post['rpjmd']);
        // $this->db->like('opd_pegawai_nama', $search);
        $this->db->where('ref_opd_pagu.rpjmd_id', $post['rpjmd']);
        $query = $this->db->get($this->table);

        
        return $query->num_rows();
    }

    public function getJumlahInPage(){
        return $this->jumlah;
    }

    public function getAll($page = 1, $search = '', $post){
        $jumlah = $this->jumlah;
        
        
        $awal = ($page - 1)*$jumlah;
        // $opd = $this->cekInput($post);
        // $this->db->where('ref_opd_pagu.Kd_Urusan', $opd[0]['Kd_Urusan']);
        // $this->db->where('ref_opd_pagu.Kd_Bidang', $opd[0]['Kd_Bidang']);
        // $this->db->where('ref_opd_pagu.Kd_Unit', $opd[0]['Kd_Unit']);
        // $this->db->where('ref_opd_pagu.Kd_Sub', $opd[0]['Kd_Sub']);
        // $this->db->join('ref_rpjmd', 'ref_rpjmd.rpjmd_id = ref_misi.rpjmd_id', 'left');
        // $this->db->join('ref_rpjmd_user', 'ref_rpjmd_user.rpjmd_id = ref_rpjmd.rpjmd_id', 'left');
        // $this->db->where('ref_rpjmd_user.user_id', $post['user_id']);
        $this->db->join('ref_sub_unit', 'ref_sub_unit.Kd_Urusan = ref_opd_pagu.Kd_Urusan AND ref_sub_unit.Kd_Bidang = ref_opd_pagu.Kd_Bidang AND ref_sub_unit.Kd_Unit = ref_opd_pagu.Kd_Unit AND ref_sub_unit.Kd_Sub = ref_opd_pagu.Kd_Sub', 'left');
        $this->db->where('ref_opd_pagu.rpjmd_id', $post['rpjmd']);
        // $this->db->like('opd_pegawai_nama', $search);
        $query = $this->db->limit($jumlah,$awal)->get($this->table)->result_array();
        return $query;
    }
    

    public function update($post){
        
        $post = $this->security->xss_clean($post);
        $result = false;
        $opd = $this->cekInput($post);
        if($opd > 0){
            // print_r($post);
            $id = $post['opd_pagu_id'];
            $this->db->where('opd_pagu_id', $id);
            $data = array(
                'Kd_Urusan' => $post['Kd_Urusan'], 
                'Kd_Bidang' => $post['Kd_Bidang'], 
                'Kd_Unit' => $post['Kd_Unit'], 
                'Kd_Sub' => $post['Kd_Sub'], 
                'tahun1_sebelum' => $post['tahun1_sebelum'], 
                'tahun1_sesudah' => $post['tahun1_sesudah'], 
                'tahun2_sebelum' => $post['tahun2_sebelum'], 
                'tahun2_sesudah' => $post['tahun2_sesudah'], 
                'tahun3_sebelum' => $post['tahun3_sebelum'], 
                'tahun3_sesudah' => $post['tahun3_sesudah'], 
                'tahun4_sebelum' => $post['tahun4_sebelum'], 
                'tahun4_sesudah' => $post['tahun4_sesudah'], 
                'tahun5_sebelum' => $post['tahun5_sebelum'], 
                'tahun5_sesudah' => $post['tahun5_sesudah'], 
            );
            $result = $this->db->update($this->table, $data);
        }
        

        return $result;
    }

    public function create($post)
    {
        $this->load->library('MyConfig');
        $post = $this->security->xss_clean($post);
        $result = false;
        
        $opd = $this->cekInput($post);
        if($opd > 0){
            // print_r($post);
            $result = $this->db->insert($this->table, array(
                'rpjmd_id' => $post['rpjmd'],
            ));
        }
        
        return $result;
    }

    public function delete($post){

        $visi = $this->cekInput($post);
        if($visi > 0){
            $id = $post['opd_pagu_id'];;
            $this->db->where('opd_pagu_id', $id);
            $result = $this->db->delete($this->table);
        }else{
            $result = false;
        }
        // $result = false;
        return $result;
    }

    public function cekInput($post){

        // $this->db->where('user_id', $post['user_id']);
        // $query = $this->db->get('ref_opd_user');
        // return $query->result_array();

        return 1;

    }

}