<?php

class PegawaiModel extends CI_Model
{
    private $jumlah, $table;
    public function __construct()
    {
        parent::__construct();
        $this->jumlah = 20;
        $this->table = 'ref_opd_pegawai';
    }

    public function getCount($search = '', $post){
        $opd = $this->cekInput($post);
        $this->db->where('ref_opd_pegawai.Kd_Urusan', $opd[0]['Kd_Urusan']);
        $this->db->where('ref_opd_pegawai.Kd_Bidang', $opd[0]['Kd_Bidang']);
        $this->db->where('ref_opd_pegawai.Kd_Unit', $opd[0]['Kd_Unit']);
        $this->db->where('ref_opd_pegawai.Kd_Sub', $opd[0]['Kd_Sub']);
        // $this->db->join('ref_rpjmd', 'ref_rpjmd.rpjmd_id = ref_misi.rpjmd_id', 'left');
        // $this->db->join('ref_rpjmd_user', 'ref_rpjmd_user.rpjmd_id = ref_rpjmd.rpjmd_id', 'left');
        // $this->db->where('ref_rpjmd_user.user_id', $post['user_id']);
        // $this->db->where('ref_rpjmd_user.rpjmd_id', $post['rpjmd']);
        $this->db->like('opd_pegawai_nama', $search);
        $query = $this->db->get($this->table);
        // return count($query->result_array());

        
        return $query->num_rows();
    }

    public function getJumlahInPage(){
        return $this->jumlah;
    }

    public function getAll($page = 1, $search = '', $post){
        $jumlah = $this->jumlah;
        
        
        $awal = ($page - 1)*$jumlah;
        $opd = $this->cekInput($post);
        $this->db->where('ref_opd_pegawai.Kd_Urusan', $opd[0]['Kd_Urusan']);
        $this->db->where('ref_opd_pegawai.Kd_Bidang', $opd[0]['Kd_Bidang']);
        $this->db->where('ref_opd_pegawai.Kd_Unit', $opd[0]['Kd_Unit']);
        $this->db->where('ref_opd_pegawai.Kd_Sub', $opd[0]['Kd_Sub']);
        // $this->db->join('ref_rpjmd', 'ref_rpjmd.rpjmd_id = ref_misi.rpjmd_id', 'left');
        // $this->db->join('ref_rpjmd_user', 'ref_rpjmd_user.rpjmd_id = ref_rpjmd.rpjmd_id', 'left');
        // $this->db->where('ref_rpjmd_user.user_id', $post['user_id']);
        // $this->db->where('ref_rpjmd_user.rpjmd_id', $post['rpjmd']);
        $this->db->like('opd_pegawai_nama', $search);
        if(@$post['all']){
            
        }else{
            $this->db->limit($jumlah,$awal);
        }
        $query = $this->db->get($this->table)->result_array();
        return $query;
    }
    

    public function update($post){
        
        $post = $this->security->xss_clean($post);
        
        $opd = $this->cekInput($post);
        if(count($opd) > 0){
            $jk = '';
            if($post['opd_pegawai_jk'] == 1){
                $jk = "Laki - Laki";
            }else if($post['opd_pegawai_jk'] == 2){
                $jk = "Perempuan";
            }
            $id = $post['opd_pegawai_id'];
            $this->db->where('opd_pegawai_id', $id);
            $data = array(
                'opd_pegawai_nama' => $post['opd_pegawai_nama'], 
                'opd_pegawai_jk' => $jk, 
                'opd_pegawai_nip' => $post['opd_pegawai_nip'], 
                'opd_pegawai_golongan' => $post['opd_pegawai_golongan'], 
                'opd_pegawai_pangkat' => $post['opd_pegawai_pangkat'], 
                'opd_pegawai_jabatan' => $post['opd_pegawai_jabatan'], 
                'opd_pegawai_pendidikan' => $post['opd_pegawai_pendidikan'], 
            );
            $result = $this->db->update($this->table, $data);
        }else{
            $result = false;
        }
        

        return $result;
    }

    public function create($post)
    {
        $this->load->library('MyConfig');
        $post = $this->security->xss_clean($post);
        // $result = false;
        // print_r($post);
        $opd = $this->cekInput($post);
        if(count($opd) > 0){
            $result = $this->db->insert($this->table, array(
                'Kd_Urusan' => $opd[0]['Kd_Urusan'],
                'Kd_Bidang' => $opd[0]['Kd_Bidang'], 
                'Kd_Unit' => $opd[0]['Kd_Unit'],
                'Kd_Sub' => $opd[0]['Kd_Sub'],
            ));
        }else{
            $result = false;
        }
        
        return $result;
    }

    public function delete($post){

        $visi = $this->cekInput($post);
        if($visi > 0){
            $id = $post['opd_pegawai_id'];;
            $this->db->where('opd_pegawai_id', $id);
            $result = $this->db->delete($this->table);
        }else{
            $result = false;
        }
        // $result = false;
        return $result;
    }

    public function cekInput($post){

        $this->db->where('user_id', $post['user_id']);
        // $this->db->where('rpjmd_id', $post['rpjmd']);
        $query = $this->db->get('ref_opd_user');
        return $query->result_array();

    }

}