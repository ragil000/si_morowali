<?php

class RefAsb4Model extends CI_Model
{
    private $jumlah;
    public function __construct()
    {
        parent::__construct();
        $this->jumlah = 20;
    }

    public function getCountAsb($search = ''){  //for navigator
        $this->db->like('Nm_Asb4', $search);
        $query = $this->db->get('ref_asb4');
        return count($query->result_array());
    }

    public function getJumlahAsbInPage(){  //for navigator
        return $this->jumlah;
    }

    public function getAllAsb($page = 1, $search = ''){
        $jumlah = $this->jumlah;

        $awal = ($page - 1)*$jumlah;
        $sql= " SELECT *
                FROM ref_asb4 a
                LEFT JOIN ref_asb3 b
                  ON concat(a.Kd_Asb1,'.', a.Kd_Asb2,'.',a.Kd_Asb3) = concat(b.Kd_Asb1,'.', b.Kd_Asb2,'.',b.Kd_Asb3)
                LEFT JOIN ref_asb2 c
                  ON concat(a.Kd_Asb1,'.', a.Kd_Asb2) = concat(c.Kd_Asb1,'.', c.Kd_Asb2)
                LEFT JOIN ref_asb1 d
                  ON a.Kd_Asb1 = d.Kd_Asb1
               WHERE Nm_Asb4 LIKE '%".$search."%'
               ORDER BY a.Kd_Asb1,a.Kd_Asb2,a.Kd_Asb3,a.Kd_Asb4 ASC
               LIMIT ".$awal.",".$jumlah." ";
        $query = $this->db->query($sql);
        return $query->result_array();
    }


    public function updateAsb($post){
        $data=$post['id_asb'];            //type hidden for key
        $id = explode(':', $data);
        for($i = count($id); $i>0; $i--){
            $this->db->where('Kd_Asb'.$i, $id[($i-1)]);
        }
        $result = $this->db->update('ref_asb4', array(
          'Kd_Asb1' => $post['kode_asb1'],
          'Kd_Asb2' => $post['kode_asb2'],
          'Kd_Asb3' => $post['kode_asb3'],
          'Kd_Asb4' => $post['kode_asb4'],
          'Nm_Asb4' => $post['nm_asb4'],
        ));
        return $result;
    }

    public function createAsb($post)
    {
        $post = $this->security->xss_clean($post);
        $result = $this->db->insert('ref_asb4', array(
            'Kd_Asb1' => $post['kode_asb1'],
            'Kd_Asb2' => $post['kode_asb2'],
            'Kd_Asb3' => $post['kode_asb3'],
            'Kd_Asb4' => $post['kode_asb4'],
            'Nm_Asb4' => $post['nm_asb4'],
        ));
        return $result;
    }

    public function deleteAsb($kodeAsb){
        $id = explode(':', $kodeAsb);
        for($i = count($id); $i>0; $i--){
            $this->db->where('Kd_Asb'.$i, $id[($i-1)]);
        }
        $result = $this->db->delete('ref_asb4');
        return $result;
    }


    public function getAsb($id,$tableName){ //display table
         if($tableName=="ref_asb1"){  //create -> display table to combo
            $sql = "SELECT * FROM ref_asb1";
         }
         if($tableName=="ref_asb2"){  //create -> display table to combo
            $sql = "SELECT * FROM ref_asb2 WHERE Kd_Asb1='".$id."'";
         }
         if($tableName=="ref_asb3"){  //create -> display table to combo
            $kode=explode(':', $id);
            $sql = "SELECT * FROM ref_asb3 WHERE Kd_Asb1='".$kode[0]."' AND ";
            $sql .= " Kd_Asb2 ='".$kode[1]."'";
         }
         if($tableName=="ref_asb4"){  //create -> display last record + 1 to next text
            $kode=explode(':', $id);
            $sql = "SELECT * FROM ref_asb4 WHERE Kd_Asb1='".$kode[0]."' AND ";
            $sql .= "Kd_Asb2 ='".$kode[1]."' AND Kd_Asb3 ='".$kode[2]."' ";
            $sql .= "ORDER BY Kd_Asb4 DESC";
         }
         $query = $this->db->query($sql);
         return $query->result_array();
     }

}
