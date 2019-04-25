<?php

class RefHspk2Model extends CI_Model
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

        $this->db->select('*');
        $this->db->from('ref_hspk2');
        $this->db->join('ref_hspk1', 'ref_hspk2.Kd_Hspk1 = ref_hspk1.Kd_Hspk1');
        $this->db->like('Nm_Hspk2', $search);
        $this->db->limit($jumlah,$awal);
        $query = $this->db->get();
        return $query->result_array();
    }


    public function updateHspk($post){
        $data=$post['id_hspk'];
        $id = explode(':', $data);
        for($i = count($id); $i>0; $i--){
            $this->db->where('Kd_Hspk'.$i, $id[($i-1)]);
        }
        $this->db->where('Kd_Hspk1', $data);
        $result = $this->db->update('ref_hspk2', array(
          'Kd_Hspk1' => $post['kode_hspk1'],
          'Kd_Hspk2' => $post['kode_hspk2'],
          'Nm_Hspk2' => $post['nm_hspk2'],
        ));
        return $result;
    }

    public function createHspk($post){
        $post = $this->security->xss_clean($post);
        $result = $this->db->insert('ref_hspk2', array(
              'Kd_Hspk1' => $post['kode_hspk1'],
              'Kd_Hspk2' => $post['kode_hspk2'],
              'Nm_Hspk2' => $post['nm_hspk2'],
          ));
        return $result;
    }

    public function deleteHspk($kodeHspk){
      $id = explode(':', $kodeHspk);
      for($i = count($id); $i>0; $i--){
          $this->db->where('Kd_Hspk'.$i, $id[($i-1)]);
      }
      $result = $this->db->delete('ref_hspk2');
      return $result;
    }


    public function getHspk($id,$tableName){ //display table
         if($tableName=="ref_hspk1"){ //create->display last record + to text
             $sql = "SELECT * FROM ref_hspk1  ";
         }
         if($tableName=="ref_hspk2"){ //create->display last record + to text
            $sql = "SELECT * FROM ref_hspk2  WHERE Kd_Hspk1='".$id."' ";
            $sql .= "ORDER BY Kd_Hspk2 DESC";
         }

         $query = $this->db->query($sql);
         return $query->result_array();
     }

}
