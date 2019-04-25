<?php

class RefAsbPekerjaanModel extends CI_Model
{
    private $jumlah;
    public function __construct()
    {
        parent::__construct();
        $this->jumlah = 20;
    }

    public function getCountSsh($search = ''){  //for navigator
        $this->db->like('Uraian', $search);
        $query = $this->db->get('ref_kategori_pekerjaan_asb');
        return count($query->result_array());
    }

    public function getJumlahSshInPage(){  //for navigator
        return $this->jumlah;
    }

    public function getAllSsh($page = 1, $search = ''){
        $jumlah = $this->jumlah;

        $awal = ($page - 1)*$jumlah;
        $sql=" SELECT * FROM ref_kategori_pekerjaan_asb
               WHERE Uraian LIKE '%".$search."%'
               ORDER BY Kd_Pekerjaan ASC
               LIMIT ".$awal.",".$jumlah." ";
        $query = $this->db->query($sql);
        return $query->result_array();
    }


    public function updateSsh($post){
        $data=$post['id_ssh'];
        $this->db->where('Kd_Pekerjaan', $data);
        $result = $this->db->update('ref_kategori_pekerjaan_asb', array(
          'Kd_Pekerjaan' => $post['kode_ssh1'],
          'Uraian' => $post['nm_ssh1'],
        ));
        return $result;
    }

    public function createSsh($post){
        $post = $this->security->xss_clean($post);
        $result = $this->db->insert('ref_kategori_pekerjaan_asb', array(
              'Kd_Pekerjaan' => $post['kode_ssh1'],
              'Uraian' => $post['nm_ssh1'],
          ));
        return $result;
    }

    public function deleteSsh($kodeSsh){
        $this->db->where('Kd_Pekerjaan', $kodeSsh);
        $result = $this->db->delete('ref_kategori_pekerjaan_asb');
        return $result;
    }


    public function getSsh($id,$tableName){ //display table
         if($tableName=="ref_ssh2"){  //create -> display table to combo
            $sql = "SELECT * FROM ref_ssh2 WHERE Kd_Ssh1='".$id."'";
         }
         if($tableName=="ref_kategori_pekerjaan_asb"){//create->display last rec+1 to text
            $sql = "SELECT * FROM ref_kategori_pekerjaan_asb  ";
            $sql .= "ORDER BY Kd_Pekerjaan DESC";
         }
         $query = $this->db->query($sql);
         return $query->result_array();
     }

}
