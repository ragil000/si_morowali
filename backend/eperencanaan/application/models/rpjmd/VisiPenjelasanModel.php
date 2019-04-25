<?php

class VisiPenjelasanModel extends CI_Model
{
    private $jumlah, $table;
    public function __construct()
    {
        parent::__construct();
        $this->jumlah = 20;
        $this->table = 'ref_visi_penjelasan';
    }

    public function getCount($search = '', $post){

        $this->db->join('ref_rpjmd', 'ref_rpjmd.rpjmd_id = ref_visi_penjelasan.rpjmd_id', 'left');
        $this->db->join('ref_rpjmd_user', 'ref_rpjmd_user.rpjmd_id = ref_rpjmd.rpjmd_id', 'left');
        $this->db->where('ref_rpjmd_user.user_id', $post['user_id']);
        $this->db->where('ref_rpjmd_user.rpjmd_id', $post['rpjmd']);
        $this->db->like('visi_penjelasan_nama', $search);
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

        $this->db->join('ref_rpjmd', 'ref_rpjmd.rpjmd_id = ref_visi_penjelasan.rpjmd_id', 'left');
        $this->db->join('ref_rpjmd_user', 'ref_rpjmd_user.rpjmd_id = ref_rpjmd.rpjmd_id', 'left');
        $this->db->where('ref_rpjmd_user.user_id', $post['user_id']);
        $this->db->where('ref_rpjmd_user.rpjmd_id', $post['rpjmd']);
        $this->db->like('visi_penjelasan_nama', $search);
        if(@$post['all']){
            
        }else{
            $this->db->limit($jumlah,$awal);
        }
        $query = $this->db->get($this->table)->result_array();
        return $query;
    }
    

    public function update($post){
        
        $post = $this->security->xss_clean($post);
        // $result = false;
        $id = $post['id'];
        // echo $id;
        $date = time();
        
        $cek = $this->cekInput($post);
        if($cek > 0){
            $this->db->where('visi_penjelasan_id', $id);
            $data = array(
                'visi_penjelasan_nama' => $post['visi_penjelasan_nama'], 
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
        
        $cek = $this->cekInput($post);
        if($cek > 0){
            // print_r($post); 
            $result = $this->db->insert($this->table, array(
                'rpjmd_id' => $post['rpjmd'], 
                'visi_penjelasan_nama' => $post['visi_penjelasan_nama'], 
            ));
        }else{
            $result = false;
        }
       
        

        return $result;
    }


    public function delete($post){

        $cek = $this->cekInput($post);
        if($cek > 0){
            $id = $post['id'];
            $this->db->where('visi_penjelasan_id', $id);
            $result = $this->db->delete($this->table);
        }else{
            $result = false;
        }
        
        return $result;
    }

    public function cekInput($post){
        // print_r($post);
        $this->db->where('user_id', $post['user_id']);
        $this->db->where('rpjmd_id', $post['rpjmd']);
        $query = $this->db->get('ref_rpjmd_user');
        return 1;
    }
    

}