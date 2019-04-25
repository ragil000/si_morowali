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
        $this->db->where('ssh_level <>', 0);
        $query = $this->db->get('user');
        return count($query->result_array());
    }

    public function getJumlahInPage(){
        return $this->jumlah;
    }

    public function getAll($page = 1, $search = ''){
        $jumlah = $this->jumlah;

        $awal = ($page - 1)*$jumlah;
        $this->db->like('username', $search);
        $this->db->where('ssh_level <>', 0);
        $query = $this->db->limit($jumlah,$awal)->get('user');
        //$query = $this->db->get('ref_ssh');
        return $query->result_array();
    }

    public function getSatuan($id = 0){
        if($id != 0){
            $this->db->where('Kd_Satuan', $id);
        }
        $this->db->order_by('Uraian', 'ASC'); 
        $query = $this->db->get('ref_standard_satuan');
        return $query->result_array();
    }

    public function update($post){
        

        $this->load->library('Fungsi');
        $post = $this->security->xss_clean($post);

        $this->db->where('id', $post['id']);

        $result = $this->db->update('user', array(
            'username' => $post['username'], 
            'nama_lengkap' => $post['namaLengkap'], 
            'email' => $post['email'],
            'ssh_level' => $post['level'], 
            'password_hash' => password_hash($post['password'], PASSWORD_DEFAULT), 
        ));
        return $result;
    }

    public function create($post)
    {
        $this->load->library('Fungsi');
        $post = $this->security->xss_clean($post);

        $result = $this->db->insert('user', array(
            'username' => $post['username'], 
            'nama_lengkap' => $post['namaLengkap'], 
            'email' => $post['email'],
            'ssh_level' => $post['level'], 
            'password_hash' => password_hash($post['password'], PASSWORD_DEFAULT), 
        ));
        return $result;
    }

    public function delete($id){

        $this->db->where('id', $id);
        

        $result = $this->db->delete('user');
        
        return $result;
    }

    public function loadData($post){
        $id = $post['idKu'];

        $query = $this->db->query('SELECT * FROM user WHERE id = '.$id);

        $dataHspk = $query;

        //return $post;
       return $dataHspk->row();
    }

    public function ubahPassword($post){
        $post = $this->security->xss_clean($post);
        $passwordLama = $post['passwordLama'];
        $passwordBaru = $post['passwordBaru'];
        $ulangPassword = $post['ulangPassword'];


        $this->db->where('id', $this->session->userdata('id'));

        $akun = $this->db->get('user')->row();
        if (!password_verify($passwordLama, $akun->password_hash)){
            return false;
        }

        if($passwordBaru != $ulangPassword){
            return false;
        }

        $this->db->where('id', $this->session->userdata('id'));

        $result = $this->db->update('user', array(
            'password_hash' => password_hash($passwordBaru, PASSWORD_DEFAULT), 
        ));
        return $result;
    }

    public function setAllSsh($idSsh, $zona, $harga){
       
        $this->load->model('RefHspkModel');
        $this->load->model('RefAsbModel');
        

        for($i = 7; $i>1; $i--){
            $this->db->where('Kd_Ssh'.($i-1), $idSsh[($i-2)]);
        }
        // $this->db->where('zona', $zona);

        $ta_ssh_hspk = $this->db->get('ta_ssh_hspk')->result_array();
        $temp = '';
        $getId = '';
        $total = 0;
        $ke = 0;

        foreach ($ta_ssh_hspk as $sshHspk) {
            $ke++;
            for($i = 1; $i<=4; $i++){
                $name = 'Kd_Hspk'.$i;
                $this->db->where($name, $sshHspk[$name]);
                $coba[($i-1)] = $sshHspk[$name];
            }
            $getId = $coba[0].'-'.$coba[1].'-'.$coba[2].'-'.$coba[3];
            for($i = 1; $i<=6; $i++){
                $name = 'Kd_Ssh'.$i;
                $this->db->where($name, $sshHspk[$name]);
            }
            // $this->db->where('zona', $zona);

            $result = $this->db->update('ta_ssh_hspk', array(
                'Harga_Satuan' => $harga, 
                'Harga' => $harga*$sshHspk['Koefisien'], 
                'HargaZona1' => ($harga+($harga*0.03))*$sshHspk['Koefisien'], 
                'HargaZona2' => ($harga+($harga*0))*$sshHspk['Koefisien'], 
                'HargaZona3' => ($harga+($harga*0.06))*$sshHspk['Koefisien'], 
                'HargaZona4' => ($harga+($harga*0.10))*$sshHspk['Koefisien'], 
            ));
            
            if($temp != $getId){

                if($temp != '' || $ke == count($ta_ssh_hspk)){
                    
                    if($temp == ''){
                        $temp = $getId;
                    }
                    $this->RefHspkModel->setHspk($temp, null, null, $zona);
                    
                }
                $temp = $getId;
                $total = $harga*$sshHspk['Koefisien'];
            }else{
                $total +=  $harga*$sshHspk['Koefisien'];

            }
            $getId = '';
            
        }

        for($i = 7; $i>1; $i--){
            if($i-1 < 5)
                $this->db->where('Kd_Hspk_Ssh'.($i-1), $idSsh[($i-2)]);
            else
                $this->db->where('Kd_Ssh'.($i-1), $idSsh[($i-2)]);
        }
        // $this->db->where('zona', $zona);
        $this->db->where('Asal', 1);

        $table = 'Ta_Hspk_Asb';

        $ta_hspk_asb = $this->db->get($table)->result_array();


        $temp = '';
        $getId = '';
        $total = 0;
        $ke = 0;
        foreach ($ta_hspk_asb as $sshHspk) {
            $ke++;
            for($i = 1; $i<=5; $i++){
                $name = 'Kd_Asb'.$i;
                $this->db->where($name, $sshHspk[$name]);
                $coba[($i-1)] = $sshHspk[$name];
            }
            $getId = $coba[0].'-'.$coba[1].'-'.$coba[2].'-'.$coba[3].'-'.$coba[4];
            for($i = 1; $i<=6; $i++){
                if($i < 5)
                    $name = 'Kd_Hspk_Ssh'.$i;
                else
                    $name = 'Kd_Ssh'.$i;
                $this->db->where($name, $sshHspk[$name]);
            }
            // $this->db->where('zona', $zona);
            $this->db->where('Asal', 1);

            $result = $this->db->update($table, array(
                'Harga_Satuan' => $harga, 
                'Jumlah_Harga' => $harga*$sshHspk['Koefisien'], 
                'HargaZona1' => ($harga+($harga*0.03))*$sshHspk['Koefisien'], 
                'HargaZona2' => ($harga+($harga*0))*$sshHspk['Koefisien'], 
                'HargaZona3' => ($harga+($harga*0.06))*$sshHspk['Koefisien'], 
                'HargaZona4' => ($harga+($harga*0.1))*$sshHspk['Koefisien'], 
            ));
            if($temp != $getId){

                if($temp != '' || $ke == count($ta_hspk_asb)){
                    
                    if($temp == ''){
                        $temp = $getId;
                    }
                    $this->RefAsbModel->setHspk($temp, null, null, $zona);
                }
                $temp = $getId;
                $total = $harga*$sshHspk['Koefisien'];
            }else{
                $total +=  $harga*$sshHspk['Koefisien'];

            }
            $getId = '';
            
            
        }
        

    }



}