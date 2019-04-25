<?php

class RefSsh2Model extends CI_Model
{
    private $jumlah;
    public function __construct()
    {
        parent::__construct();
        $this->jumlah = 20;
    }

    public function getCountSsh($search = ''){
        $this->db->like('Nm_Ssh2', $search);
        $query = $this->db->get('ref_ssh2');
        return count($query->result_array());
    }

    public function getJumlahSshInPage(){
        return $this->jumlah;
    }

    public function getAllSsh($page = 1, $search = ''){
        $jumlah = $this->jumlah;

        $awal = ($page - 1)*$jumlah;
        $this->db->select('*');
        $this->db->from('ref_ssh2');
        $this->db->join('ref_ssh1', 'ref_ssh2.Kd_Ssh1 = ref_ssh1.Kd_Ssh1');
        $this->db->like('Nm_Ssh2', $search);
        $this->db->limit($jumlah,$awal);
        $query = $this->db->get();
        return $query->result_array();
    }


    public function updateSsh($post){
        $data=$post['id_ssh'];            //type hidden for key
        $id = explode(':', $data);
        for($i = count($id); $i>0; $i--){
            $this->db->where('Kd_Ssh'.$i, $id[($i-1)]);
        }
        $result = $this->db->update('ref_ssh2', array(
          'Kd_Ssh2' => $post['kode_ssh2'],
          'Kd_Ssh1' => $post['kode_ssh1'],
          'Nm_Ssh2' => $post['nm_ssh2'],
        ));
        return $result;
    }

    public function createSsh($post)
    {
        $post = $this->security->xss_clean($post);
        $result = $this->db->insert('ref_ssh2', array(
            'Kd_Ssh1' => $post['kode_ssh1'],
            'Kd_Ssh2' => $post['kode_ssh2'],
            'Nm_Ssh2' => $post['nm_ssh2'],
        ));
        return $result;
    }

    public function deleteSsh($kodeSsh){
        $id = explode('-', $kodeSsh);
        for($i = count($id); $i>0; $i--){
            $this->db->where('Kd_Ssh'.$i, $id[($i-1)]);
        }
        $result = $this->db->delete('ref_ssh2');
        return $result;
    }


    public function getSsh($id,$tableName){ //display table
         if($tableName=="ref_ssh3"){  //view -> display table 2 parameter
            $dataId = explode(':', $id);
            $sql = "SELECT * FROM ref_ssh3 WHERE Kd_Ssh1='".$dataId[0]."' AND ";
            $sql .= "Kd_Ssh2 ='".$dataId[1]."'";
         }
         if($tableName=="ref_ssh1"){  //create -> display table to combo
            $sql = "SELECT * FROM ref_ssh1";
         }
         if($tableName=="ref_ssh2"){  //create -> display last record + to next text
            $sql = "SELECT * FROM ref_ssh2 WHERE Kd_Ssh1='".$id."' ";
            $sql .= "ORDER BY Kd_Ssh2 DESC";
         }
         $query = $this->db->query($sql);
         return $query->result_array();
     }

}
