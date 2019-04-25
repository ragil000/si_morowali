<?php

class RefSsh4Model extends CI_Model
{
    private $jumlah;
    public function __construct()
    {
        parent::__construct();
        $this->jumlah = 25;
    }

    public function getCountSsh($search = ''){  //for navigator
        $this->db->like('Nm_Ssh4', $search);
        $query = $this->db->get('ref_ssh4');
        return count($query->result_array());
    }

    public function getJumlahSshInPage(){  //for navigator
        return $this->jumlah;
    }

    public function getAllSsh($page = 1, $search = ''){
        $jumlah = $this->jumlah;

        $awal = ($page - 1)*$jumlah;
        $sql= " SELECT *
                FROM ref_ssh4 a
                LEFT JOIN ref_ssh3 b
                  ON concat(a.Kd_Ssh1,'.', a.Kd_Ssh2,'.',a.Kd_Ssh3) = concat(b.Kd_Ssh1,'.', b.Kd_Ssh2,'.',b.Kd_Ssh3)
                LEFT JOIN ref_ssh2 c
                  ON concat(a.Kd_Ssh1,'.', a.Kd_Ssh2) = concat(c.Kd_Ssh1,'.', c.Kd_Ssh2)
                LEFT JOIN ref_ssh1 d
                  ON a.Kd_Ssh1 = d.Kd_Ssh1
               WHERE Nm_Ssh4 LIKE '%".$search."%'
               ORDER BY a.Kd_Ssh1 ASC
               LIMIT ".$awal.",".$jumlah." ";
        $query = $this->db->query($sql);
        return $query->result_array();
    }


    public function updateSsh($post){
        $data=$post['id_ssh'];            //type hidden for key
        $id = explode(':', $data);
        for($i = count($id); $i>0; $i--){
            $this->db->where('Kd_Ssh'.$i, $id[($i-1)]);
        }
        $result = $this->db->update('ref_ssh4', array(
          'Kd_Ssh1' => $post['kode_ssh1'],
          'Kd_Ssh2' => $post['kode_ssh2'],
          'Kd_Ssh3' => $post['kode_ssh3'],
          'Kd_Ssh4' => $post['kode_ssh4'],
          'Nm_Ssh4' => $post['nm_ssh4'],
        ));
        return $result;
    }

    public function createSsh($post)
    {
        $post = $this->security->xss_clean($post);
        $result = $this->db->insert('ref_ssh4', array(
            'Kd_Ssh1' => $post['kode_ssh1'],
            'Kd_Ssh2' => $post['kode_ssh2'],
            'Kd_Ssh3' => $post['kode_ssh3'],
            'Kd_Ssh4' => $post['kode_ssh4'],
            'Nm_Ssh4' => $post['nm_ssh4'],
        ));
        return $result;
    }

    public function deleteSsh($kodeSsh){
        $id = explode(':', $kodeSsh);
        for($i = count($id); $i>0; $i--){
            $this->db->where('Kd_Ssh'.$i, $id[($i-1)]);
        }
        $result = $this->db->delete('ref_ssh4');
        return $result;
    }


    public function getSsh($id,$tableName){ //display table
         if($tableName=="ref_ssh5"){  //view -> display table
           $kode=explode('.', $id);
           $sql = "SELECT * FROM ref_ssh5 WHERE Kd_Ssh1='".$kode[0]."' AND ";
           $sql .= " Kd_Ssh2 ='".$kode[1]."' AND Kd_Ssh3='".$kode[2]."' AND ";
           $sql .= " Kd_Ssh4 ='".$kode[3]."'";
         }
         if($tableName=="ref_ssh1"){  //create -> display table to combo
            $sql = "SELECT * FROM ref_ssh1";
         }
         if($tableName=="ref_ssh2"){  //create -> display table to combo
            $sql = "SELECT * FROM ref_ssh2 WHERE Kd_Ssh1='".$id."'";
         }
         if($tableName=="ref_ssh3"){  //create -> display table to combo
            $kode=explode(':', $id);
            $sql = "SELECT * FROM ref_ssh3 WHERE Kd_Ssh1='".$kode[0]."' AND ";
            $sql .= " Kd_Ssh2 ='".$kode[1]."'";
         }
         if($tableName=="ref_ssh4"){  //create -> display last record + 1 to next text
            $kode=explode(':', $id);
            $sql = "SELECT * FROM ref_ssh4 WHERE Kd_Ssh1='".$kode[0]."' AND ";
            $sql .= "Kd_Ssh2 ='".$kode[1]."' AND Kd_Ssh3 ='".$kode[2]."' ";
            $sql .= "ORDER BY Kd_Ssh4 DESC";
         }
         $query = $this->db->query($sql);
         return $query->result_array();
     }

}
