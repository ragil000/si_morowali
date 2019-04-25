<?php

class RefAsb1Model extends CI_Model
{
    private $jumlah;
    public function __construct()
    {
        parent::__construct();
        $this->jumlah = 20;
    }

    public function getCountAsb($search = ''){  //for navigator
        $this->db->like('Nm_Asb1', $search);
        $query = $this->db->get('ref_asb1');
        return count($query->result_array());
    }

    public function getJumlahAsbInPage(){  //for navigator
        return $this->jumlah;
    }

    public function getAllAsb($page = 1, $search = ''){
        $jumlah = $this->jumlah;

        $awal = ($page - 1)*$jumlah;
        $sql=" SELECT * FROM ref_asb1
               WHERE Nm_Asb1 LIKE '%".$search."%'
               ORDER BY Kd_Asb1 ASC
               LIMIT ".$awal.",".$jumlah." ";
        $query = $this->db->query($sql);
        return $query->result_array();
    }


    public function updateAsb($post){
        $data=$post['id_asb'];
        $this->db->where('Kd_Asb1', $data);
        $result = $this->db->update('ref_asb1', array(
          'Kd_Asb1' => $post['kode_asb1'],
          'Nm_Asb1' => $post['nm_asb1'],
        ));
        return $result;
    }

    public function createAsb($post){
        $post = $this->security->xss_clean($post);
        $result = $this->db->insert('ref_asb1', array(
              'Kd_Asb1' => $post['kode_asb1'],
              'Nm_Asb1' => $post['nm_asb1'],
          ));
        return $result;
    }

    public function deleteAsb($kodeAsb){
        $this->db->where('Kd_Asb1', $kodeAsb);
        $result = $this->db->delete('ref_asb1');
        return $result;
    }

    public function getAsb($id,$tableName){ //display table
        if($tableName=="ref_asb1"){//create->display last rec+1 to text
           $sql = "SELECT * FROM ref_asb1  ";
           $sql .= "ORDER BY Kd_Asb1 DESC";
        }
        $query = $this->db->query($sql);
        return $query->result_array();
   }

}
