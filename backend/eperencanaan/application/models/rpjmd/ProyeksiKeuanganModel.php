<?php

class ProyeksiKeuanganModel extends CI_Model
{
    private $jumlah, $table;
    public function __construct()
    {
        parent::__construct();
        $this->jumlah = 20;
        $this->table = 'ta_proyeksi_keuangan';
    }

    public function getCount($search = '', $post){

        $this->db->join('ref_rek_4', 'ref_rek_4.Kd_Rek_1 = ta_proyeksi_keuangan.Kd_Rek_1 AND ref_rek_4.Kd_Rek_2 = ta_proyeksi_keuangan.Kd_Rek_2 AND ref_rek_4.Kd_Rek_3 = ta_proyeksi_keuangan.Kd_Rek_3 AND ref_rek_4.Kd_Rek_4 = ta_proyeksi_keuangan.Kd_Rek_4 ', 'left');
        $this->db->join('ref_rpjmd', 'ref_rpjmd.rpjmd_id = ta_proyeksi_keuangan.rpjmd_id', 'left');
        $this->db->join('ref_rpjmd_user', 'ref_rpjmd_user.rpjmd_id = ref_rpjmd.rpjmd_id', 'left');
        $this->db->where('ref_rpjmd_user.user_id', $post['user_id']);
        $this->db->where('ref_rpjmd_user.rpjmd_id', $post['rpjmd']);
        // $this->db->like('data_tahun_dasar', $search);
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
        
        $this->db->join('ref_rek_4', 'ref_rek_4.Kd_Rek_1 = ta_proyeksi_keuangan.Kd_Rek_1 AND ref_rek_4.Kd_Rek_2 = ta_proyeksi_keuangan.Kd_Rek_2 AND ref_rek_4.Kd_Rek_3 = ta_proyeksi_keuangan.Kd_Rek_3 AND ref_rek_4.Kd_Rek_4 = ta_proyeksi_keuangan.Kd_Rek_4 ', 'left');
        $this->db->join('ref_rpjmd', 'ref_rpjmd.rpjmd_id = ta_proyeksi_keuangan.rpjmd_id', 'left');
        $this->db->join('ref_rpjmd_user', 'ref_rpjmd_user.rpjmd_id = ref_rpjmd.rpjmd_id', 'left');
        $this->db->where('ref_rpjmd_user.user_id', $post['user_id']);
        $this->db->where('ref_rpjmd_user.rpjmd_id', $post['rpjmd']);

        $this->db->order_by("ref_rek_4.Kd_Rek_1", "asc");
        $this->db->order_by("ref_rek_4.Kd_Rek_2", "asc");
        $this->db->order_by("ref_rek_4.Kd_Rek_3", "asc");
        $this->db->order_by("ref_rek_4.Kd_Rek_4", "asc");

        // $this->db->like('data_tahun_dasar', $search);
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
            $rek = explode('-', $post['rekening']);
            $id = $post['proyeksi_keuangan_id'];
            $this->db->where('proyeksi_keuangan_id', $id);
            $data = array(
                'Kd_Rek_1' => $rek[0], 
                'Kd_Rek_2' => $rek[1], 
                'Kd_Rek_3' => $rek[2], 
                'Kd_Rek_4' => $rek[3], 
                'tahun1' => $post['tahun1'], 
                'tahun2' => $post['tahun2'], 
                'tahun3' => $post['tahun3'], 
                'tahun4' => $post['tahun4'], 
                'tahun5' => $post['tahun5'], 
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
            $rek = explode('-', $post['rekening']);
            $result = $this->db->insert($this->table, array(
                'rpjmd_id' => $post['rpjmd'], 
                'Kd_Rek_1' => $rek[0], 
                'Kd_Rek_2' => $rek[1], 
                'Kd_Rek_3' => $rek[2], 
                'Kd_Rek_4' => $rek[3],  
                'tahun1' => $post['tahun1'], 
                'tahun2' => $post['tahun2'], 
                'tahun3' => $post['tahun3'], 
                'tahun4' => $post['tahun4'], 
                'tahun5' => $post['tahun5'], 
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
            $id = $post['proyeksi_keuangan_id'];
            $this->db->where('proyeksi_keuangan_id', $id);
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