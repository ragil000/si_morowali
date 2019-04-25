<?php

class UrusanModel extends CI_Model
{
    private $jumlah, $table;
    public function __construct()
    {
        parent::__construct();
        $this->jumlah = 5;
        $this->table = 'ref_urusan';
    }

    public function getCount($search = ''){
        $this->db->like('Nm_Urusan', $search);
        $query = $this->db->get($this->table);
        // return count($query->result_array());

        
        return $query->num_rows();
    }

    public function getJumlahInPage(){
        return $this->jumlah;
    }

    public function getAll($page = 1, $search = ''){
        $jumlah = $this->jumlah;
        

        $awal = ($page - 1)*$jumlah;
        $this->db->like('Nm_Urusan', $search);
        $query = $this->db->limit($jumlah,$awal)->get($this->table)->result_array();
        return $query;
    }
    

    public function update($post){
        
        $post = $this->security->xss_clean($post);
        
        $cekData = $this->cekInput($post['user_id']);
        if($cekData > 0){
            $id = $post['id'];
            $this->db->where('Kd_Urusan', $id);
            $data = array(
                'Nm_Urusan' => $post['urusan'], 
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

        $cekData = $this->cekInput($post['user_id']);
        if($cekData > 0){
            $result = $this->db->insert($this->table, array(
                'Nm_Urusan' => $post['urusan'], 
            ));
        }else{
            $result = false;
        }
        
        return $result;
    }

    public function delete($post){

        

        $cekData = $this->cekInput($post['user_id']);
        if($cekData > 0){
            $id = $post['id'];
            $this->db->where('Kd_Urusan', $id);
            $result = $this->db->delete($this->table);
        }else{
            $result = false;
        }

        // $result = false;
        return $result;
    }

    public function cekInput($user_id){

        return 1;
    }

}