<?php

class VisiPenjelasanModel extends CI_Model
{
    private $jumlah, $table;
    public function __construct()
    {
        parent::__construct();
        $this->jumlah = 20;
        $this->table = 'ref_opd_visi_penjelasan';
        
    }

    public function getCount($search = '', $post){

        $opd = $this->cekInput($post);

        $this->db->join('ref_opd_visi', 'ref_opd_visi.opd_visi_id = ref_opd_visi_penjelasan.opd_visi_id', 'left');
        $this->db->where('ref_opd_visi.Kd_Urusan', $opd[0]['Kd_Urusan']);
        $this->db->where('ref_opd_visi.Kd_Bidang', $opd[0]['Kd_Bidang']);
        $this->db->where('ref_opd_visi.Kd_Unit', $opd[0]['Kd_Unit']);
        $this->db->where('ref_opd_visi.Kd_Sub', $opd[0]['Kd_Sub']);
        $this->db->like('opd_visi_penjelasan_nama', $search);
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
        $opd = $this->cekInput($post);
        $this->db->join('ref_opd_visi', 'ref_opd_visi.opd_visi_id = ref_opd_visi_penjelasan.opd_visi_id', 'left');
        $this->db->where('ref_opd_visi.Kd_Urusan', $opd[0]['Kd_Urusan']);
        $this->db->where('ref_opd_visi.Kd_Bidang', $opd[0]['Kd_Bidang']);
        $this->db->where('ref_opd_visi.Kd_Unit', $opd[0]['Kd_Unit']);
        $this->db->where('ref_opd_visi.Kd_Sub', $opd[0]['Kd_Sub']);
        $this->db->like('opd_visi_penjelasan_nama', $search);
        $query = $this->db->limit($jumlah,$awal)->get($this->table)->result_array();
        return $query;
    }
    

    public function update($post){
        
        $post = $this->security->xss_clean($post);
        
        $opd = $this->cekInput($post);
        if(count($opd) > 0){
            $id = $post['opd_visi_penjelasan_id'];
            $this->db->where('opd_visi_penjelasan_id', $id);
            $data = array(
                'opd_visi_penjelasan_nama' => $post['opd_visi_penjelasan_nama'], 
            );
            $result = $this->db->update($this->table, $data);
        }else{
            $result = false;
        }
        

        return $result;
    }

    public function create($post)
    {
        $result = false;
        $this->load->library('MyConfig');
        $post = $this->security->xss_clean($post);
        // $result = false;
        // print_r($post);
        $opd = $this->cekInput($post);
        if(count($opd) > 0){

            $this->db->where('Kd_Urusan', $opd[0]['Kd_Urusan']);
            $this->db->where('Kd_Bidang', $opd[0]['Kd_Bidang']);
            $this->db->where('Kd_Unit', $opd[0]['Kd_Unit']);
            $this->db->where('Kd_Sub', $opd[0]['Kd_Sub']);
            // $this->db->where('rpjmd_id', $post['rpjmd']);
            $dataTambahan = $this->db->get('ref_opd_visi')->row();
            // print_r($dataTambahan);
            $result = $this->db->insert($this->table, array(
                'opd_visi_id' => $dataTambahan->opd_visi_id,
            ));
        }
        
        return $result;
    }

    public function delete($post){

        $visi = $this->cekInput($post);
        if($visi > 0){
            $id = $post['opd_visi_penjelasan_id'];;
            $this->db->where('opd_visi_penjelasan_id', $id);
            $result = $this->db->delete($this->table);
        }else{
            $result = false;
        }
        // $result = false;
        return $result;
    }

    public function cekInput($post){

        $this->db->where('user_id', $post['user_id']);
        $query = $this->db->get('ref_opd_user');
        return $query->result_array();

    }

}