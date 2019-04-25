<?php

class RefAsb2Model extends CI_Model
{
    private $jumlah;
    public function __construct()
    {
        parent::__construct();
        $this->jumlah = 20;
    }

    public function getCountAsb($search = ''){
        $this->db->like('Nm_Asb2', $search);
        $query = $this->db->get('ref_asb2');
        return count($query->result_array());
    }

    public function getJumlahAsbInPage(){
        return $this->jumlah;
    }

    public function getAllAsb($page = 1, $search = ''){
        $jumlah = $this->jumlah;

        $awal = ($page - 1)*$jumlah;
        $this->db->select('*');
        $this->db->from('ref_asb2');
        $this->db->join('ref_asb1', 'ref_asb2.Kd_Asb1 = ref_asb1.Kd_Asb1');
        $this->db->like('Nm_Asb2', $search);
        $this->db->limit($jumlah,$awal);
        $query = $this->db->get();
        return $query->result_array();
    }


    public function updateAsb($post){
        $data=$post['id_asb'];            //type hidden for key
        $id = explode(':', $data);
        for($i = count($id); $i>0; $i--){
            $this->db->where('Kd_Asb'.$i, $id[($i-1)]);
        }
        $result = $this->db->update('ref_asb2', array(
          'Kd_Asb2' => $post['kode_asb2'],
          'Kd_Asb1' => $post['kode_asb1'],
          'Nm_Asb2' => $post['nm_asb2'],
        ));
        return $result;
    }

    public function createAsb($post)
    {
        $post = $this->security->xss_clean($post);
        $result = $this->db->insert('ref_asb2', array(
            'Kd_Asb1' => $post['kode_asb1'],
            'Kd_Asb2' => $post['kode_asb2'],
            'Nm_Asb2' => $post['nm_asb2'],
        ));
        return $result;
    }

    public function deleteAsb($kodeAsb){
        $id = explode(':', $kodeAsb);
        for($i = count($id); $i>0; $i--){
            $this->db->where('Kd_Asb'.$i, $id[($i-1)]);
        }
        $result = $this->db->delete('ref_asb2');
        return $result;
    }


    public function getAsb($id,$tableName){ //display table
         if($tableName=="ref_asb1"){  //create -> display table to combo
            $sql = "SELECT * FROM ref_asb1";
         }
         if($tableName=="ref_asb2"){  //create -> display last record + to next text
            $sql = "SELECT * FROM ref_asb2 WHERE Kd_Asb1='".$id."' ";
            $sql .= "ORDER BY Kd_Asb2 DESC";
         }
         $query = $this->db->query($sql);
         return $query->result_array();
     }

}
