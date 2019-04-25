<?php

class RefHspk3Model extends CI_Model
{
    private $jumlah;
    public function __construct()
    {
        parent::__construct();
        $this->jumlah = 20;
    }

    public function getCountHspk($search = ''){  //for navigator
        $this->db->like('Nm_Hspk3', $search);
        $query = $this->db->get('ref_hspk3');
        return count($query->result_array());
    }

    public function getJumlahHspkInPage(){  //for navigator
        return $this->jumlah;
    }

    public function getAllHspk($page = 1, $search = ''){
        $jumlah = $this->jumlah;
        $awal = ($page - 1)*$jumlah;

        $sql=" SELECT * FROM ref_hspk3 a
               LEFT JOIN ref_hspk2 b
               ON concat(a.Kd_Hspk1,'.', a.Kd_Hspk2) = concat(b.Kd_Hspk1,'.', b.Kd_Hspk2)
               LEFT JOIN ref_hspk1 c ON a.Kd_Hspk1 = c.Kd_Hspk1
               WHERE Nm_Hspk3 LIKE '%".$search."%'
               ORDER BY a.Kd_Hspk1,a.Kd_Hspk2,a.Kd_Hspk3 ASC
               LIMIT ".$awal.",".$jumlah." ";
        $query = $this->db->query($sql);
        return $query->result_array();
    }


    public function updateHspk($post){
        $data=$post['id_hspk'];           //old key type hidden
        $id = explode(':', $data);
        for($i = count($id); $i>0; $i--){
            $this->db->where('Kd_Hspk'.$i, $id[($i-1)]);
        }
        $result = $this->db->update('ref_hspk3', array(
          'Kd_Hspk1' => $post['kode_hspk1'],
          'Kd_Hspk2' => $post['kode_hspk2'],
          'Kd_Hspk3' => $post['kode_hspk3'],
          'Nm_Hspk3' => $post['nm_hspk3'],
        ));
        return $result;
    }

    public function createHspk($post){
        $post = $this->security->xss_clean($post);
        $result = $this->db->insert('ref_hspk3', array(
              'Kd_Hspk1' => $post['kode_hspk1'],
              'Kd_Hspk2' => $post['kode_hspk2'],
              'Kd_Hspk3' => $post['kode_hspk3'],
              'Nm_Hspk3' => $post['nm_hspk3'],
          ));
        return $result;
    }

    public function deleteHspk($kodeHspk){
      $id = explode(':', $kodeHspk);
      for($i = count($id); $i>0; $i--){
          $this->db->where('Kd_Hspk'.$i, $id[($i-1)]);
      }
      $result = $this->db->delete('ref_hspk3');
      return $result;
    }

    public function getHspk($id,$tableName){ //display table
         if($tableName=="ref_hspk1"){ //create->display last record + to text
             $sql = "SELECT * FROM ref_hspk1  ";
         }
         if($tableName=="ref_hspk2"){  //create -> display table to combo
             $sql = "SELECT * FROM ref_hspk2 WHERE Kd_Hspk1='".$id."' ";
             $sql .= " ORDER BY Kd_Hspk2 ";
         }
         if($tableName=="ref_hspk3"){ //create->display last record + to text
            $kode=explode(':', $id);
            $sql = "SELECT * FROM ref_hspk3 WHERE Kd_Hspk1='".$kode[0]."' AND ";
            $sql .= "Kd_Hspk2 ='".$kode[1]."' ORDER BY Kd_Hspk3 DESC";
         }

         $query = $this->db->query($sql);
         return $query->result_array();
     }

}
