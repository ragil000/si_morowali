<?php

class RefHspk1Model extends CI_Model
{
    private $jumlah;
    public function __construct()
    {
        parent::__construct();
        $this->jumlah = 20;
    }

    public function getCountHspk($search = ''){  //for navigator
        $this->db->like('Nm_Hspk1', $search);
        $query = $this->db->get('ref_hspk1');
        return count($query->result_array());
    }

    public function getJumlahHspkInPage(){  //for navigator
        return $this->jumlah;
    }

    public function getAllHspk($page = 1, $search = ''){
        $jumlah = $this->jumlah;

        $awal = ($page - 1)*$jumlah;
        $sql=" SELECT * FROM ref_hspk1
               WHERE Nm_Hspk1 LIKE '%".$search."%'
               ORDER BY Kd_Hspk1 ASC
               LIMIT ".$awal.",".$jumlah." ";
        $query = $this->db->query($sql);
        return $query->result_array();
    }


    public function updateHspk($post){
        $data=$post['id_hspk'];
        $this->db->where('Kd_Hspk1', $data);
        $result = $this->db->update('ref_hspk1', array(
          'Kd_Hspk1' => $post['kode_hspk1'],
          'Nm_Hspk1' => $post['nm_hspk1'],
        ));
        return $result;
    }

    public function createHspk($post){
        $post = $this->security->xss_clean($post);
        $result = $this->db->insert('ref_hspk1', array(
              'Kd_Hspk1' => $post['kode_hspk1'],
              'Nm_Hspk1' => $post['nm_hspk1'],
          ));
        return $result;
    }

    public function deleteHspk($kodeHspk){
        $this->db->where('Kd_Hspk1', $kodeHspk);
        $result = $this->db->delete('ref_hspk1');
        return $result;
    }


    public function getHspk($id,$tableName){ //display table
         if($tableName=="ref_hspk1"){ //create->display last record + to text
             $sql = "SELECT * FROM ref_hspk1  ";
             $sql .= "ORDER BY Kd_Hspk1 DESC";
          }
         $query = $this->db->query($sql);
         return $query->result_array();
     }

}
