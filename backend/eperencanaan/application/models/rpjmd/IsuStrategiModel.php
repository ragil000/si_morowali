<?php

class IsuStrategiModel extends CI_Model
{
    private $jumlah, $table;
    public function __construct()
    {
        parent::__construct();
        $this->jumlah = 20;
        $this->table = 'ta_isu_strategi';
    }

    public function getCount($search = '', $post){


        $this->db->join('ref_misi', 'ref_misi.misi_id = ta_isu_strategi.misi_id', 'left');
        $this->db->join('ref_rpjmd', 'ref_rpjmd.rpjmd_id = ref_misi.rpjmd_id', 'left');
        $this->db->join('ref_rpjmd_user', 'ref_rpjmd_user.rpjmd_id = ref_rpjmd.rpjmd_id', 'left');
        $this->db->where('ref_rpjmd_user.user_id', $post['user_id']);
        $this->db->where('ref_rpjmd_user.rpjmd_id', $post['rpjmd']);
        $this->db->like('isu_strategi_urusan', $search);
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
        
        $this->db->join('ref_urusan', 'ref_urusan.Kd_Urusan = '.$this->table.'.Kd_Urusan', 'left');
        $this->db->join('ref_bidang', 'ref_bidang.Kd_Urusan = '.$this->table.'.Kd_Urusan AND ref_bidang.Kd_Bidang = '.$this->table.'.Kd_Bidang', 'left');
        $this->db->join('ref_misi', 'ref_misi.misi_id = ta_isu_strategi.misi_id', 'left');
        $this->db->join('ref_rpjmd', 'ref_rpjmd.rpjmd_id = ref_misi.rpjmd_id', 'left');
        $this->db->join('ref_rpjmd_user', 'ref_rpjmd_user.rpjmd_id = ref_rpjmd.rpjmd_id', 'left');
        $this->db->where('ref_rpjmd_user.user_id', $post['user_id']);
        $this->db->where('ref_rpjmd_user.rpjmd_id', $post['rpjmd']);
        $this->db->like('isu_strategi_urusan', $search);
        if(@$post['all']){
            
        }else{
            $this->db->limit($jumlah,$awal);
        }
        $query = $this->db->get($this->table)->result_array();
        return $query;
    }
    

    public function update($post){
        
        $post = $this->security->xss_clean($post);
        

        $data = $this->cekInput($post);
        // print_r($post);
        if($data > 0){
            $id = $post['isu_strategi_id'];
            $this->db->where('isu_strategi_id', $id);
            $data = array(
                'misi_id' => $post['misi_id'], 
                'isu_strategi_urusan' => $post['isu_strategi_urusan'], 
                'isu_strategi_rpjpd' => $post['isu_strategi_rpjpd'], 
                'isu_strategi_rtrw' => $post['isu_strategi_rtrw'], 
                'isu_strategi_rpjmn' => $post['isu_strategi_rpjmn'], 
                'isu_strategi_dinamika' => $post['isu_strategi_dinamika'], 
                'isu_strategi_rpjmd' => $post['isu_strategi_rpjmd'], 
                'Kd_Urusan' => $post['Kd_Urusan'], 
                'Kd_Bidang' => $post['Kd_Bidang'], 
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
        $date = time();


        $data = $this->cekInput($post);
        // print_r($post);
        if($data > 0){
            $result = $this->db->insert($this->table, array(
                'misi_id' => $post['misi_id'], 
                'isu_strategi_urusan' => $post['isu_strategi_urusan'], 
                'isu_strategi_rpjpd' => $post['isu_strategi_rpjpd'], 
                'isu_strategi_rtrw' => $post['isu_strategi_rtrw'], 
                'isu_strategi_rpjmn' => $post['isu_strategi_rpjmn'], 
                'isu_strategi_dinamika' => $post['isu_strategi_dinamika'], 
                'isu_strategi_rpjmd' => $post['isu_strategi_rpjmd'], 
                'Kd_Urusan' => $post['Kd_Urusan'], 
                'Kd_Bidang' => $post['Kd_Bidang'],  
            ));
            // if($result){
            //     $id_insert = $this->db->insert_id();
            //     $result = $this->db->insert('ta_tujuan_sasaran', array(
            //         'isu_strategi_id' => $id_insert,  
            //     ));
            // }
        }else{
            $result = false;
        }
        
        return $result;
    }

    public function delete($post){

        $data = $this->cekInput($post);
        // print_r($post);
        if($data > 0){
            $id = $post['isu_strategi_id'];
            $this->db->where('isu_strategi_id', $id);
            $result = $this->db->delete($this->table);

            $this->db->where('isu_strategi_id', $id);
            $result = $this->db->delete('ta_tujuan_sasaran');
        }else{
            $result = false;
        }

        return $result;
    }

    public function cekInput($post){

        $this->db->where('user_id', $post['user_id']);
        $this->db->where('rpjmd_id', $post['rpjmd']);
        $query = $this->db->get('ref_rpjmd_user');

        return $query->num_rows();
    }

}