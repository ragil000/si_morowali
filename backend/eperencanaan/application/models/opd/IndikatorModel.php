<?php

class IndikatorModel extends CI_Model
{
    private $jumlah, $table;
    public function __construct()
    {
        parent::__construct();
        $this->jumlah = 20;
        $this->table = 'ref_opd_indikator';
        
    }

    public function getCount($search = '', $post){

        $opd = $this->cekInput($post);
        $this->db->join('ref_opd_sasaran', 'ref_opd_sasaran.opd_sasaran_id = ref_opd_indikator.opd_sasaran_id', 'left');
        $this->db->join('ref_opd_tujuan', 'ref_opd_tujuan.opd_tujuan_id = ref_opd_sasaran.opd_tujuan_id', 'left');
        $this->db->join('ref_opd_misi', 'ref_opd_misi.opd_misi_id = ref_opd_tujuan.opd_misi_id', 'left');
        $this->db->join('ref_opd_visi', 'ref_opd_visi.opd_visi_id = ref_opd_misi.opd_visi_id', 'left');
        $this->db->where('ref_opd_visi.Kd_Urusan', $opd[0]['Kd_Urusan']);
        $this->db->where('ref_opd_visi.Kd_Bidang', $opd[0]['Kd_Bidang']);
        $this->db->where('ref_opd_visi.Kd_Unit', $opd[0]['Kd_Unit']);
        $this->db->where('ref_opd_visi.Kd_Sub', $opd[0]['Kd_Sub']);
        $this->db->like('opd_indikator_nama', $search);
        $query = $this->db->get($this->table);

        return $query->num_rows();
    }

    public function getJumlahInPage(){
        return $this->jumlah;
    }

    public function getAll($page = 1, $search = '', $post){
        $jumlah = $this->jumlah;
        

        $awal = ($page - 1)*$jumlah;
        $opd = $this->cekInput($post);
        $this->db->join('ref_opd_sasaran', 'ref_opd_sasaran.opd_sasaran_id = ref_opd_indikator.opd_sasaran_id', 'left');
        $this->db->join('ref_opd_tujuan', 'ref_opd_tujuan.opd_tujuan_id = ref_opd_sasaran.opd_tujuan_id', 'left');
        $this->db->join('ref_opd_misi', 'ref_opd_misi.opd_misi_id = ref_opd_tujuan.opd_misi_id', 'left');
        $this->db->join('ref_opd_visi', 'ref_opd_visi.opd_visi_id = ref_opd_misi.opd_visi_id', 'left');
        $this->db->where('ref_opd_visi.Kd_Urusan', $opd[0]['Kd_Urusan']);
        $this->db->where('ref_opd_visi.Kd_Bidang', $opd[0]['Kd_Bidang']);
        $this->db->where('ref_opd_visi.Kd_Unit', $opd[0]['Kd_Unit']);
        $this->db->where('ref_opd_visi.Kd_Sub', $opd[0]['Kd_Sub']);
        $this->db->like('opd_indikator_nama', $search);
        $this->db->order_by($this->table.'.opd_indikator_id', 'ASC');
        $query = $this->db->limit($jumlah,$awal)->get($this->table)->result_array();
        return $query;
    }
    

    public function update($post){
        
        $post = $this->security->xss_clean($post);
        
        $opd = $this->cekInput($post);
        if(count($opd) > 0){
            $id = $post['opd_indikator_id'];
            $this->db->where('opd_indikator_id', $id);
            $data = array(
                'opd_sasaran_id' => $post['opd_sasaran_id'], 
                'opd_indikator_nama' => $post['opd_indikator_nama'], 
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
        // $result = false;
        // print_r($post);
        $opd = $this->cekInput($post);
        if(count($opd) > 0){

            $this->load->model('opd/DataModel');
            $dataTambahan = $this->DataModel->getSasaran($post);
            
            // print_r($dataTambahan);
            $result = $this->db->insert($this->table, array(
                'opd_sasaran_id' => $dataTambahan[0]['opd_sasaran_id'],
            ));
        }else{
            $result = false;
        }
        
        return $result;
    }

    public function delete($post){

        $visi = $this->cekInput($post);
        if($visi > 0){
            $id = $post['opd_indikator_id'];;
            $this->db->where('opd_indikator_id', $id);
            $result = $this->db->delete($this->table);
        }else{
            $result = false;
        }
        // $result = false;
        return $result;
    }

    public function cekInput($post){

        $this->db->where('user_id', $post['user_id']);
        // $this->db->where('rpjmd_id', $post['rpjmd']);
        $query = $this->db->get('ref_opd_user');
        return $query->result_array();

    }

}