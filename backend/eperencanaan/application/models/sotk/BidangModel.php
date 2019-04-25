<?php

class BidangModel extends CI_Model
{
    private $jumlah, $table;
    public function __construct()
    {
        parent::__construct();
        $this->jumlah = 20;
        $this->table = 'ref_bidang';
    }

    public function getCount($search = '', $user_id){

        $this->db->join('ref_urusan', 'ref_urusan.Kd_Urusan = '.$this->table.'.Kd_Urusan', 'left');
        $this->db->join('ref_fungsi', 'ref_fungsi.Kd_Fungsi = '.$this->table.'.Kd_Fungsi', 'left');
        $this->db->like('Nm_Bidang', $search);
        $query = $this->db->get($this->table);
        // return count($query->result_array());

        return $query->num_rows();
    }

    public function getJumlahInPage(){
        return $this->jumlah;
    }

    public function getAll($page = 1, $search = '', $user_id){
        $jumlah = $this->jumlah;
        $awal = ($page - 1)*$jumlah;
        
        $this->db->join('ref_urusan', 'ref_urusan.Kd_Urusan = '.$this->table.'.Kd_Urusan', 'left');
        $this->db->join('ref_fungsi', 'ref_fungsi.Kd_Fungsi = '.$this->table.'.Kd_Fungsi', 'left');
        $this->db->like('Nm_Bidang', $search);
        $query = $this->db->limit($jumlah,$awal)->get($this->table)->result_array();
        return $query;
    }
    

    public function update($post){
        
        $post = $this->security->xss_clean($post);
        

        $id = $post['id'];
        
        $this->db->where('Kd_Bidang', $id);
        $this->db->where('Kd_Urusan', $post['urusan']);
        $data = array(
            'Kd_Urusan' => $post['urusan'], 
            'Nm_Bidang' => $post['bidang'],
            'Kd_Fungsi' => $post['fungsi'],
        );
        $result = $this->db->update($this->table, $data);
       
        

        return $result;
    }

    public function create($post)
    {
        $this->load->library('MyConfig');
        $post = $this->security->xss_clean($post);
        $date = time();

        $result = $this->db->insert($this->table, array(
            'Kd_Urusan' => $post['urusan'], 
            'Nm_Bidang' => $post['bidang'],
            'Kd_Fungsi' => $post['fungsi'],
        ));
        
        return $result;
    }

    public function delete($post){

        $id = $post['id'];

        $this->db->where('Kd_Bidang', $id);
        $this->db->where('Kd_Urusan', $post['urusan']);
        $result = $this->db->delete($this->table);

        return $result;
    }

    public function cekInput($user_id, $id){

        $this->db->join('sasaran', 'sasaran.sasaran_id = indikator.sasaran_id', 'left');
        $this->db->join('tujuan', 'tujuan.tujuan_id = sasaran.tujuan_id', 'left');
        $this->db->join('misi', 'misi.misi_id = tujuan.misi_id', 'left');
        $this->db->join('visi', 'visi.visi_id = misi.visi_id', 'left');
        $this->db->join('user_visi', 'user_visi.visi_id = visi.visi_id', 'left');
        $this->db->where('user_visi.user_id', $user_id);
        $this->db->where('indikator.indikator_id', $id);
        $query = $this->db->get('indikator');

        return $query->num_rows();
    }

}