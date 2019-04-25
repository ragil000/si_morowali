<?php

class UserModel extends CI_Model
{
    private $jumlah, $table;
    public function __construct()
    {
        parent::__construct();
        $this->jumlah = 20;
        $this->table = 'ref_users';
    }

    public function getCount($search = '', $post){
        $this->db->like('username', $search);
        $query = $this->db->get($this->table);

        
        return $query->num_rows();
    }

    public function getJumlahInPage(){
        return $this->jumlah;
    }

    public function getAll($page = 1, $search = '', $post){
        $jumlah = $this->jumlah;
        
        $awal = ($page - 1)*$jumlah;
        $this->db->like('username', $search);
        $this->db->limit($jumlah,$awal);
        $query = $this->db->get($this->table)->result_array();
        return $query;
    }
    

    public function update($post){
        
        $post = $this->security->xss_clean($post);
        $result = false;
        $cek = $this->cekInput($post);
        if(count($cek) > 0){
            // print_r($post);
            $data = array();
            $data['email'] = $post['email'];
            $data['username'] = $post['username'];
            $data['level_id'] = $post['level_id'];
            $data['akun_id'] = $post['akun_id'];
            $this->db->where('user_id', $post['user']);
            $dataUser = $this->db->get($this->table)->result_array();
            if($post['password'] != @$dataUser[0]['password']){
                $this->load->library('MyConfig');
                $data['password'] = $this->myconfig->password_hash($post['password']);
            }
            $this->db->where('user_id', $post['user']);
            $result = $this->db->update($this->table, $data);
        }

        return $result;
    }

    public function create($post)
    {
        $this->load->library('MyConfig');
        $post = $this->security->xss_clean($post);
        $result = false;
        // print_r($post);
        $opd = $this->cekInput($post);
        if(count($opd) > 0){
            $result = $this->db->insert($this->table, array(
                'level_id' => 1,
                'akun_id' => 2,
            ));
        }
        
        return $result;
    }

    public function delete($post){
        $result = false;
        $cek = $this->cekInput($post);
        if($cek > 0){
            $id = $post['user'];;
            $this->db->where('user_id', $id);
            $result = $this->db->delete($this->table);
        }
        return $result;
    }

    public function cekInput($post){

        // $this->db->where('user_id', $post['user_id']);
        // // $this->db->where('rpjmd_id', $post['rpjmd']);
        // $query = $this->db->get('ref_opd_user');
        // return $query->result_array();
        return 1;

    }

}