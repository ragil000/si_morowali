<?php

class StrategiModel extends CI_Model
{
    private $jumlah, $table;
    public function __construct()
    {
        parent::__construct();
        $this->jumlah = 20;
        $this->table = 'strategi';
    }

    public function getCount($search = '', $user_id){

        $this->db->join('ref_kamus_program', 'ref_kamus_program.Kd_Program = '.$this->table.'.program', 'left');
        $this->db->join('ref_sub_unit', 'ref_sub_unit.Kd_Bidang = '.$this->table.'.bidang AND ref_sub_unit.Kd_Urusan = '.$this->table.'.urusan AND ref_sub_unit.Kd_Unit = '.$this->table.'.unit AND ref_sub_unit.Kd_Sub = '.$this->table.'.sub', 'left');
        $this->db->join('ref_bidang', 'ref_bidang.Kd_Bidang = '.$this->table.'.bidang AND ref_bidang.Kd_Urusan = '.$this->table.'.urusan ', 'left');
        $this->db->join('ref_urusan', 'ref_urusan.Kd_Urusan = '.$this->table.'.urusan', 'left');
        $this->db->join('indikator', 'indikator.indikator_id = strategi.indikator_id', 'left');
        $this->db->join('sasaran', 'sasaran.sasaran_id = indikator.sasaran_id', 'left');
        $this->db->join('tujuan', 'tujuan.tujuan_id = sasaran.tujuan_id', 'left');
        $this->db->join('misi', 'misi.misi_id = tujuan.misi_id', 'left');
        $this->db->join('visi', 'visi.visi_id = misi.visi_id', 'left');
        $this->db->join('user_visi', 'user_visi.visi_id = visi.visi_id', 'left');
        $this->db->where('user_visi.user_id', $user_id);
        $this->db->like('strategi_nama', $search);
        $this->db->order_by("ref_urusan.Kd_Urusan asc");

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
        
        $this->db->join('ref_kamus_program', 'ref_kamus_program.Kd_Program = '.$this->table.'.program', 'left');
        $this->db->join('ref_sub_unit', 'ref_sub_unit.Kd_Bidang = '.$this->table.'.bidang AND ref_sub_unit.Kd_Urusan = '.$this->table.'.urusan AND ref_sub_unit.Kd_Unit = '.$this->table.'.unit AND ref_sub_unit.Kd_Sub = '.$this->table.'.sub', 'left');
        $this->db->join('ref_bidang', 'ref_bidang.Kd_Bidang = '.$this->table.'.bidang AND ref_bidang.Kd_Urusan = '.$this->table.'.urusan ', 'left');
        $this->db->join('ref_urusan', 'ref_urusan.Kd_Urusan = '.$this->table.'.urusan', 'left');
        $this->db->join('indikator', 'indikator.indikator_id = strategi.indikator_id', 'left');
        $this->db->join('sasaran', 'sasaran.sasaran_id = indikator.sasaran_id', 'left');
        $this->db->join('tujuan', 'tujuan.tujuan_id = sasaran.tujuan_id', 'left');
        $this->db->join('misi', 'misi.misi_id = tujuan.misi_id', 'left');
        $this->db->join('visi', 'visi.visi_id = misi.visi_id', 'left');
        $this->db->join('user_visi', 'user_visi.visi_id = visi.visi_id', 'left');
        $this->db->where('user_visi.user_id', $user_id);
        $this->db->like('strategi_nama', $search);
        $this->db->order_by("ref_urusan.Kd_Urusan asc");
        // $this->db->order_by("ref_bidang.Kd_Bidang asc");
        $query = $this->db->limit($jumlah,$awal)->get($this->table)->result_array();
        return $query;
    }
    

    public function update($post){
        
        $post = $this->security->xss_clean($post);
        
        $opd_id = explode('-', $post['opd']);

        $data = $this->cekInput($post['user_id'], $post['indikator']);
        // print_r($post);
        if($data > 0){
            $id = $post['id'];
            $this->db->where('strategi_id', $id);
            $data = array(
                'urusan' => $post['urusan'], 
                'bidang' => $post['bidang'],
                'unit' => $opd_id[0],
                'sub' => $opd_id[1], 
                'strategi_nama' => $post['strategi'], 
                'kebijakan_nama' => $post['kebijakan'], 
                'indikator_id' => $post['indikator'], 
                'program' => $post['program'], 
                'outcome_nama' => $post['outcome'], 
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
        $opd_id = explode('-', $post['opd']);

        $data = $this->cekInput($post['user_id'], $post['indikator']);
        // print_r($post);
        if($data > 0){
            $result = $this->db->insert($this->table, array(
                'urusan' => $post['urusan'], 
                'bidang' => $post['bidang'], 
                'unit' => $opd_id[0],
                'sub' => $opd_id[1], 
                'strategi_nama' => $post['strategi'], 
                'kebijakan_nama' => $post['kebijakan'], 
                'indikator_id' => $post['indikator'], 
                'program' => $post['program'], 
                'outcome_nama' => $post['outcome'], 
            ));
        }else{
            $result = false;
        }
        
        return $result;
    }

    public function delete($post){

        $id = $post['id'];

        $this->db->join('indikator', 'indikator.indikator_id = strategi.indikator_id', 'left');
        $this->db->join('sasaran', 'sasaran.sasaran_id = indikator.sasaran_id', 'left');
        $this->db->join('tujuan', 'tujuan.tujuan_id = sasaran.tujuan_id', 'left');
        $this->db->join('misi', 'misi.misi_id = tujuan.misi_id', 'left');
        $this->db->join('visi', 'visi.visi_id = misi.visi_id', 'left');
        $this->db->join('user_visi', 'user_visi.visi_id = visi.visi_id && user_visi.user_id = '.$post['user_id'], 'left');
        $this->db->where('strategi_id', $id);
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