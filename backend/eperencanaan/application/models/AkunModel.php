<?php

class AkunModel extends CI_Model
{
    private $jumlah;
    public function __construct()
    {
        parent::__construct();
        $this->jumlah = 20;
    }

    public function getCount($search = ''){
        $this->db->like('username', $search);
        $query = $this->db->get('user');
        // return count($query->result_array());

        
        return $query->num_rows();
    }

    public function getJumlahInPage(){
        return $this->jumlah;
    }

    public function olahUser($data){
        $this->load->model('DataModel');
        $namaLevel = array("","Kelurahan", "Kecamatan", "Pokir", "OPD", "Admin", "Super Admin");
        $no = 0;
        foreach($data as $key){
            $dataAll[$no] = $key;
            if($this->DataModel->getLevel($key['id']) != 0 && $this->DataModel->getLevel($key['id']) != 4)
                $dataAll[$no]['level'] = $namaLevel[$this->DataModel->getLevel($key['id'])];

            $no++;
        }
        return $dataAll;
    }

    public function getAll($page = 1, $search = ''){
        $jumlah = $this->jumlah;
        

        $awal = ($page - 1)*$jumlah;
        $this->db->like('username', $search);
        $query = $this->db->limit($jumlah,$awal)->get('user')->result_array();

        
        $dataAll = $this->olahUser($query);

        return $dataAll;
    }
    

    public function update($post){
        
        $post = $this->security->xss_clean($post);
        
        $id = $post['id'];
        $date = time();
        $this->db->where('id', $id);

        $data = array(
            'username' => $post['username'], 
            'no_hp_ktp' => $post['email'],
            'password_hash' => $this->myconfig->password_hash($post['password']),
            'level_musrenbang' => (string)$post['level'],
            'updated_at' => $date,
        );

        $result = $this->db->update('user', $data);

        $user_id = $id;

        if($post['level'] == 1){
            $kd_kel = explode("-",$post['kelurahan']);
            $this->db->where('Kd_User', $user_id);
            $data = array(
                'Kd_Kec' => $post['kecamatan'],
                'Kd_Kel' => $kd_kel[0],
                'Kd_Urut_Kel' => $kd_kel[1],
                // 'level_id' => $post['level'],
            );
            $result = $this->db->insert('ta_user_kelompok', $data);
        }else if($post['level'] == 2){
            $this->db->where('Kd_User', $user_id);
            $data = array(
                'Kd_Kec' => $post['kecamatan'],
            );
            $result = $this->db->insert('ta_user_kelompok', $data);
        }else if($post['level'] == 3){
            $this->db->where('Kd_Dapil', $post['dapil']);
            $this->db->order_by("Kd_Dewan", "desc");
            $dewan = $this->db->get("ref_dewan")->row();

            $data = array(
                'Tahun' => date('Y'),
                'Kd_Dapil' => $post['dapil'],
                'Kd_Dewan' => $dewan->Kd_Dewan+1,
                'Nm_Dewan' => $post['dewan'],
            );
            $result = $this->db->insert('ref_dewan', $data);

            $data = array(
                'Kd_User' => $user_id, 
                'Tahun' => date('Y'),
                'Kd_Dapil' => $post['dapil'],
                'Kd_Dewan' => $dewan->Kd_Dewan+1,
            );
            $result = $this->db->insert('ta_user_dapil', $data);
        }else if($post['level'] == 5){
            $this->db->where('id', $user_id);
            $data = array(
                'level_musrenbang' => '5',
                'updated_at' => $date,
            );
            $result = $this->db->update('user', $data);
        }else{
            $this->db->where('id', $user_id);
            $data = array(
                'level_musrenbang' => '0',
                'updated_at' => $date,
            );
            $result = $this->db->update('user', $data);
        }

        return $result;
    }

    public function create($post)
    {
        $this->load->library('MyConfig');
        $post = $this->security->xss_clean($post);
        $date = time();
        $result = $this->db->insert('user', array(
            'username' => $post['username'], 
            'no_hp_ktp' => $post['email'],
            'password_hash' => $this->myconfig->password_hash($post['password']),
            'level_musrenbang' => (string)$post['level'],
            'created_at' => $date,
            'updated_at' => $date,
            // 'level_musrenbang' => 5,
            // 'level_id' => $post['level'],
        ));

        $user_id = $this->db->insert_id();

        if($post['level'] == 1){

            $kd_kel = explode("-",$post['kelurahan']);

            $data = array(
                'Kd_User' => $user_id, 
                'Kd_Prov' => 72,
                'Kd_Kab' => 6,
                'Kd_Kec' => $post['kecamatan'],
                'Kd_Kel' => $kd_kel[0],
                'Kd_Urut_Kel' => $kd_kel[1],
                // 'level_id' => $post['level'],
            );
            $result = $this->db->insert('ta_user_kelompok', $data);
        }else if($post['level'] == 2){
            $data = array(
                'Kd_User' => $user_id, 
                'Kd_Prov' => 72,
                'Kd_Kab' => 6,
                'Kd_Kec' => $post['kecamatan'],
            );
            $result = $this->db->insert('ta_user_kelompok', $data);
        }else if($post['level'] == 3){
            $this->db->where('Kd_Dapil', $post['dapil']);
            $this->db->order_by("Kd_Dewan", "desc");
            $dewan = $this->db->get("ref_dewan")->row();

            $data = array(
                'Tahun' => date('Y'),
                'Kd_Dapil' => $post['dapil'],
                'Kd_Dewan' => $dewan->Kd_Dewan+1,
                'Nm_Dewan' => $post['dewan'],
            );
            $result = $this->db->insert('ref_dewan', $data);

            $data = array(
                'Kd_User' => $user_id, 
                'Tahun' => date('Y'),
                'Kd_Dapil' => $post['dapil'],
                'Kd_Dewan' => $dewan->Kd_Dewan+1,
            );
            $result = $this->db->insert('ta_user_dapil', $data);
        }else if($post['level'] == 5){
            $this->db->where('id', $user_id);
            $data = array(
                'level_musrenbang' => '5',
                'updated_at' => $date,
            );
            $result = $this->db->update('user', $data);
        }else{
            $this->db->where('id', $user_id);
            $data = array(
                'level_musrenbang' => '0',
                'updated_at' => $date,
            );
            $result = $this->db->update('user', $data);
        }

        

        return $result;
    }

    public function delete($post){

        $id = $post['id'];
        $this->db->where('id', $id);
        $result = $this->db->delete('user');
        return $result;
    }

    public function userRiwayat($user_id){
        // $post = $this->security->xss_clean($post);
        $date = date("Y-m-d H:i:s");

        $result = $this->db->insert('user_riwayat', array(
            'user_id' => $user_id, 
            'tgl_masuk' => $date,
        ));
    }

    public function setPassword($post){

        $date = time();
        $this->db->where('id', $post['id']);
        $data = array(
            'password_hash' => $this->myconfig->password_hash($post['passwordBaru']),
            'updated_at' => $date,
        );

        $result = $this->db->update('user', $data);

        return $result;
    }

    public function getPassword($id){
        $this->db->where('id', $id);
        return $this->db->get('user')->row();
    }
    

}