<?php

class PraRkaModel extends CI_Model
{
    private $jumlah, $table;
    public function __construct()
    {
        parent::__construct();
        $this->jumlah = 20;
        $this->table = 'ref_rka_pra';
        $this->table_rkpd = 'ta_rkpd';
    }

    public function getCount($search = '', $post){

        $opd = $this->cekInput($post);
        $this->db->join($this->table_rkpd, ''.$this->table_rkpd.'.perumusan_program_id = '.$this->table.'.perumusan_program_id', 'left');
        $this->db->join('ref_rpjmd', 'ref_rpjmd.rpjmd_id = '.$this->table_rkpd.'.rpjmd_id', 'left');
        $this->db->where('ref_rpjmd.rpjmd_id', $post['rpjmd']);
        
        $this->db->join('ref_rek_1', 'ref_rek_1.Kd_Rek_1 = '.$this->table.'.Kd_Rek_1', 'left');
        $this->db->join('ref_rek_2', 'ref_rek_2.Kd_Rek_1 = '.$this->table.'.Kd_Rek_1 AND ref_rek_2.Kd_Rek_2 = '.$this->table.'.Kd_Rek_2', 'left');
        $this->db->join('ref_rek_3', 'ref_rek_3.Kd_Rek_1 = '.$this->table.'.Kd_Rek_1 AND ref_rek_3.Kd_Rek_2 = '.$this->table.'.Kd_Rek_2 AND ref_rek_3.Kd_Rek_3 = '.$this->table.'.Kd_Rek_3', 'left');
        $this->db->join('ref_rek_4', 'ref_rek_4.Kd_Rek_1 = '.$this->table.'.Kd_Rek_1 AND ref_rek_4.Kd_Rek_2 = '.$this->table.'.Kd_Rek_2 AND ref_rek_4.Kd_Rek_3 = '.$this->table.'.Kd_Rek_3 AND ref_rek_4.Kd_Rek_4 = '.$this->table.'.Kd_Rek_4', 'left');
        $this->db->join('ref_rek_5', 'ref_rek_5.Kd_Rek_1 = '.$this->table.'.Kd_Rek_1 AND ref_rek_5.Kd_Rek_2 = '.$this->table.'.Kd_Rek_2 AND ref_rek_5.Kd_Rek_3 = '.$this->table.'.Kd_Rek_3 AND ref_rek_5.Kd_Rek_4 = '.$this->table.'.Kd_Rek_4 AND ref_rek_5.Kd_Rek_5 = '.$this->table.'.Kd_Rek_5', 'left');

        if(@$opd[0]['Kd_Urusan']){
            $this->db->where(''.$this->table_rkpd.'.Kd_Urusan', $opd[0]['Kd_Urusan']);
            $this->db->where(''.$this->table_rkpd.'.Kd_Bidang', $opd[0]['Kd_Bidang']);
            $this->db->where(''.$this->table_rkpd.'.Kd_Unit', $opd[0]['Kd_Unit']);
            $this->db->where(''.$this->table_rkpd.'.Kd_Sub', $opd[0]['Kd_Sub']);
        }

        $this->db->where(''.$this->table.'.tahun', $post['tahun']);
        $this->db->where(''.$this->table_rkpd.'.perumusan_program_id', $post['perumusan_program_id']);
        $this->db->like('nama_belanja', $search);

        $this->db->order_by("".$this->table.".Kd_Rek_1", "asc");
        $this->db->order_by("".$this->table.".Kd_Rek_2", "asc");
        $this->db->order_by("".$this->table.".Kd_Rek_3", "asc");
        $this->db->order_by("".$this->table.".Kd_Rek_4", "asc");
        $this->db->order_by("".$this->table.".Kd_Rek_5", "asc");

        $query = $this->db->get($this->table);
        
        return $query->num_rows();
    }

    public function getJumlahInPage(){
        return $this->jumlah;
    }

    public function getAll($page = 1, $search = '', $post){
        $jumlah = $this->jumlah;
        $awal = ($page - 1)*$jumlah;

        
        $opd = $this->cekInput($post);
        $this->db->join($this->table_rkpd, ''.$this->table_rkpd.'.perumusan_program_id = '.$this->table.'.perumusan_program_id', 'left');
        $this->db->join('ref_rpjmd', 'ref_rpjmd.rpjmd_id = '.$this->table_rkpd.'.rpjmd_id', 'left');
        $this->db->where('ref_rpjmd.rpjmd_id', $post['rpjmd']);
        
        $this->db->join('ref_rek_1', 'ref_rek_1.Kd_Rek_1 = '.$this->table.'.Kd_Rek_1', 'left');
        $this->db->join('ref_rek_2', 'ref_rek_2.Kd_Rek_1 = '.$this->table.'.Kd_Rek_1 AND ref_rek_2.Kd_Rek_2 = '.$this->table.'.Kd_Rek_2', 'left');
        $this->db->join('ref_rek_3', 'ref_rek_3.Kd_Rek_1 = '.$this->table.'.Kd_Rek_1 AND ref_rek_3.Kd_Rek_2 = '.$this->table.'.Kd_Rek_2 AND ref_rek_3.Kd_Rek_3 = '.$this->table.'.Kd_Rek_3', 'left');
        $this->db->join('ref_rek_4', 'ref_rek_4.Kd_Rek_1 = '.$this->table.'.Kd_Rek_1 AND ref_rek_4.Kd_Rek_2 = '.$this->table.'.Kd_Rek_2 AND ref_rek_4.Kd_Rek_3 = '.$this->table.'.Kd_Rek_3 AND ref_rek_4.Kd_Rek_4 = '.$this->table.'.Kd_Rek_4', 'left');
        $this->db->join('ref_rek_5', 'ref_rek_5.Kd_Rek_1 = '.$this->table.'.Kd_Rek_1 AND ref_rek_5.Kd_Rek_2 = '.$this->table.'.Kd_Rek_2 AND ref_rek_5.Kd_Rek_3 = '.$this->table.'.Kd_Rek_3 AND ref_rek_5.Kd_Rek_4 = '.$this->table.'.Kd_Rek_4 AND ref_rek_5.Kd_Rek_5 = '.$this->table.'.Kd_Rek_5', 'left');

        if(@$opd[0]['Kd_Urusan']){
            $this->db->where(''.$this->table_rkpd.'.Kd_Urusan', $opd[0]['Kd_Urusan']);
            $this->db->where(''.$this->table_rkpd.'.Kd_Bidang', $opd[0]['Kd_Bidang']);
            $this->db->where(''.$this->table_rkpd.'.Kd_Unit', $opd[0]['Kd_Unit']);
            $this->db->where(''.$this->table_rkpd.'.Kd_Sub', $opd[0]['Kd_Sub']);
        }
        $this->db->where(''.$this->table.'.tahun', $post['tahun']);
        $this->db->where(''.$this->table_rkpd.'.perumusan_program_id', $post['perumusan_program_id']);
        $this->db->like('nama_belanja', $search);

        $this->db->order_by("".$this->table.".Kd_Rek_1", "asc");
        $this->db->order_by("".$this->table.".Kd_Rek_2", "asc");
        $this->db->order_by("".$this->table.".Kd_Rek_3", "asc");
        $this->db->order_by("".$this->table.".Kd_Rek_4", "asc");
        $this->db->order_by("".$this->table.".Kd_Rek_5", "asc");

        $query = $this->db->get($this->table)->result_array();
        return $query;
    }
    
    public function update($post){
        
        $post = $this->security->xss_clean($post);
        
        $result = false;
        $opd = $this->cekInput($post);
        // print_r($post);
        if(count($opd)> 0){
            $id = $post['belanja_id'];
            $tahun = $post['tahun'];
            $this->db->where('target'.$tahun.'_status !=', 3);
            $this->db->where('perumusan_program_id', $post['perumusan_program_id']);
            $cek = $this->db->get(''.$this->table_rkpd.'')->num_rows();
            
            if($cek > 0){
                $this->db->where('belanja_id', $id);
                $data = array();
                $data['Kd_Rek_4'] = $post['Kd_Rek_4'];
                $data['Kd_Rek_5'] = $post['Kd_Rek_5'];
                $data['nama_belanja'] = $post['nama_belanja'];
                $data['volume'] = $post['volume'];
                $data['satuan'] = $post['satuan'];
                $data['harga'] = $post['harga'];
                $data['status'] = $post['status'];
                $data['komentar'] = $post['komentar'];
                $result = $this->db->update($this->table, $data);
            }

        }
        
        return $result;
    }

    public function create($post)
    {
        $this->load->library('MyConfig');
        $post = $this->security->xss_clean($post);
        $date = time();

        $result = false;
        $opd = $this->cekInput($post);
        // print_r($post);
        if($opd > 0){

            $tahun = $post['tahun'];
            $this->db->where('target'.$tahun.'_status !=', 3);
            $this->db->where('perumusan_program_id', $post['perumusan_program_id']);
            $cek = $this->db->get(''.$this->table_rkpd.'')->num_rows();

            if($cek > 0){
                $this->db->where('belanja_id', $post['belanja_id']);
                $dataKirim = $this->db->get($this->table)->result_array();
                // print_r($dataKirim);
                if(count($dataKirim)>0){
                    
                    $result = $this->db->insert($this->table, array(
                        // 'strategi_kebijakan_id' => $post['strategi_kebijakan_id'], 
                        'Kd_Rek_1' => $dataKirim[0]['Kd_Rek_1'], 
                        'Kd_Rek_2' => $dataKirim[0]['Kd_Rek_2'], 
                        'Kd_Rek_3' => $dataKirim[0]['Kd_Rek_3'], 
                        'Kd_Rek_4' => $dataKirim[0]['Kd_Rek_4'], 
                        'Kd_Rek_5' => $dataKirim[0]['Kd_Rek_5'], 
                        'satuan' => 1, 
                        'perumusan_program_id' => $dataKirim[0]['perumusan_program_id'], 
                        'tahun' => $post['tahun'], 
                    ));
                }else{
                    $result = $this->db->insert($this->table, array(
                        // 'strategi_kebijakan_id' => $post['strategi_kebijakan_id'], 
                        'Kd_Rek_1' => 5, 
                        'Kd_Rek_2' => 2, 
                        'Kd_Rek_3' => 2, 
                        'Kd_Rek_4' => 1, 
                        'Kd_Rek_5' => 1, 
                        'satuan' => 1, 
                        'perumusan_program_id' => $post['perumusan_program_id'], 
                        'tahun' => $post['tahun'], 
                    ));
                }
            }
        }
        return $result;
    }

    public function delete($post){

        $opd = $this->cekInput($post);
        $result = false;
        // print_r($post);
        if(count($opd) > 0){

            $tahun = $post['tahun'];
            $this->db->where('target'.$tahun.'_status !=', 3);
            $this->db->where('perumusan_program_id', $post['perumusan_program_id']);
            $cek = $this->db->get(''.$this->table_rkpd.'')->num_rows();
            if($cek > 0){
                $this->db->where('perumusan_program_id', $post['perumusan_program_id']);
                $dataKirim = $this->db->get($this->table)->num_rows();
                // print_r($dataKirim);
                if($dataKirim > 1){
                    $id = $post['belanja_id'];
                    $this->db->where('belanja_id', $id);
                    $result = $this->db->delete($this->table);
                }
            }
        }
        return $result;
    }


    public function cekInput($post){

        if(@$post['jenis'] == 'perubahan'){
            $this->table = 'ref_rka_pra_perubahan';
            $this->table_rkpd = 'ta_rkpd_perubahan';
            // print_r($post);
        }

        $this->db->where('user_id', $post['user_id']);
        $query = $this->db->get('ref_opd_user');
        // return $query->result_array();
        if(count($query->result_array())>0){
            return $query->result_array();
        }else{
            return 1;
        }
    }

    public function setJumlahAll($post){
        // $jumlah 

        //SELECT SUM(harga*volume) FROM `ref_rka_pra` WHERE `tahun` = 1 AND `perumusan_program_id` = 23
        $this->db->select('SUM(harga*volume) as jumlah');
        $this->db->where('tahun', $post['tahun']);
        $this->db->where('perumusan_program_id', $post['perumusan_program_id']);
        $query = $this->db->get($this->table);

        $jumlah = $query->row()->jumlah;

        $this->db->where('perumusan_program_id', $post['perumusan_program_id']);
        $query = $this->db->update($this->table_rkpd);

    }

}