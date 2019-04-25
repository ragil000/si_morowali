<?php

class RkpdVerifikasiModel extends CI_Model
{
    private $jumlah, $table;
    public function __construct()
    {
        parent::__construct();
        $this->jumlah = 20;
        $this->table = 'ta_rkpd';
    }

    public function getCount($search = '', $post){

        $opd = $this->cekInput($post);
        $this->db->join('ref_rpjmd', 'ref_rpjmd.rpjmd_id = '.$this->table.'.rpjmd_id', 'left');
        $this->db->where('ref_rpjmd.rpjmd_id', $post['rpjmd']);
        if(@$post['name'] == 'opd'){
            
            $this->db->where($this->table.'.Kd_Urusan', $opd[0]['Kd_Urusan']);
            $this->db->where($this->table.'.Kd_Bidang', $opd[0]['Kd_Bidang']);
            $this->db->where($this->table.'.Kd_Unit', $opd[0]['Kd_Unit']);
            $this->db->where($this->table.'.Kd_Sub', $opd[0]['Kd_Sub']);
            // $this->db->where('ta_rkpd.status <=', 1);
        }
        
        $this->db->like('outcome', $search);
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
        $this->db->join('ref_urusan', 'ref_urusan.Kd_Urusan = '.$this->table.'.Kd_Urusan', 'left');
        $this->db->join('ref_bidang', $this->table.'.Kd_Urusan = ref_bidang.Kd_Urusan AND '.$this->table.'.Kd_Bidang = ref_bidang.Kd_Bidang', 'left');
        $this->db->join('ref_program', 'ref_program.Kd_Prog = '.$this->table.'.Kd_Prog AND '.$this->table.'.Kd_Urusan = ref_program.Kd_Urusan AND '.$this->table.'.Kd_Bidang = ref_program.Kd_Bidang', 'left');
        $this->db->join('ref_kegiatan', 'ref_kegiatan.Kd_Keg = '.$this->table.'.Kd_Keg AND ref_kegiatan.Kd_Prog = '.$this->table.'.Kd_Prog  AND '.$this->table.'.Kd_Urusan = ref_kegiatan.Kd_Urusan AND '.$this->table.'.Kd_Bidang = ref_kegiatan.Kd_Bidang', 'left');
        
        $this->db->join('ref_rpjmd', 'ref_rpjmd.rpjmd_id = '.$this->table.'.rpjmd_id', 'left');

        // $this->db->join('ref_sub_unit', 'ref_sub_unit.Kd_Urusan = ta_rkpd.Kd_Urusan AND ref_sub_unit.Kd_Bidang = ta_rkpd.Kd_Bidang AND ref_sub_unit.Kd_Unit = ta_rkpd.Kd_Unit AND ref_sub_unit.Kd_Sub = ta_rkpd.Kd_Sub', 'left');

        if(@$post['name'] == 'opd'){
            $this->db->where(''.$this->table.'.Kd_Urusan', $opd[0]['Kd_Urusan']);
            $this->db->where(''.$this->table.'.Kd_Bidang', $opd[0]['Kd_Bidang']);
            $this->db->where(''.$this->table.'.Kd_Unit', $opd[0]['Kd_Unit']);
            $this->db->where(''.$this->table.'.Kd_Sub', $opd[0]['Kd_Sub']);
        }

        $this->db->where('ref_rpjmd.rpjmd_id', $post['rpjmd']);
        $this->db->like('outcome', $search);
        $query = $this->db->limit($jumlah,$awal)->get($this->table)->result_array();
        return $query;
    }
    
    public function update($post){
        
        $post = $this->security->xss_clean($post);
        
        $result = false;
        $data = $this->cekInput($post);
        if(count($data)> 0){
            $id = $post['perumusan_program_id'];
            $tahun = $post['tahun'];
            $this->db->where('target'.$tahun.'_status !=', 3);
            $this->db->where('perumusan_program_id', $id);
            $data = array();
            $data['Kd_Urusan'] = $post['Kd_Urusan'];
            $data['Kd_Bidang'] = $post['Kd_Bidang'];
            $data['Kd_Unit'] = $post['Kd_Unit'];
            $data['Kd_Sub'] = $post['Kd_Sub'];
            $data['Kd_Prog'] = $post['Kd_Prog'];
            $data['Kd_Keg'] = $post['Kd_Keg'];
            $data['outcome'] = $post['outcome'];
            $data['outcome_kegiatan'] = $post['outcome_kegiatan'];
            $data['target'.$tahun.'_lokasi'] = $post['target'.$tahun.'_lokasi'];
            $data['target'.$tahun.'_tahun'] = $post['target'.$tahun.'_tahun'];
            $data['target'.$tahun.'_satuan'] = $post['target'.$tahun.'_satuan'];
            $data['target'.$tahun.'_harga'] = $post['target'.$tahun.'_harga'];
            $data['target'.$tahun.'_sumber_dana'] = $post['target'.$tahun.'_sumber_dana'];
            $data['target'.$tahun.'_catatan'] = $post['target'.$tahun.'_catatan'];
            $result = $this->db->update($this->table, $data);
        }
        
        return $result;
    }

    public function create($post)
    {
        $this->load->library('MyConfig');
        $post = $this->security->xss_clean($post);
        $date = time();

        $result = false;
        $data = $this->cekInput($post);
        if($data > 0){

            $this->db->where('perumusan_program_id', $post['perumusan_program_id']);
            $dataKirim = $this->db->get($this->table)->result_array();
            if(count($dataKirim)>0){
                $tahun = $post['tahun'];
                $this->db->where('target'.$tahun.'_status !=', 3);
                $result = $this->db->insert($this->table, array(
                    'Kd_Urusan' => $dataKirim[0]['Kd_Urusan'], 
                    'Kd_Bidang' => $dataKirim[0]['Kd_Bidang'], 
                    'Kd_Prog' => $dataKirim[0]['Kd_Prog'], 
                    'Kd_Keg' => $dataKirim[0]['Kd_Keg'], 
                    'rpjmd_id' => $dataKirim[0]['rpjmd_id'],
                    'Kd_Sub' => $dataKirim[0]['Kd_Sub'], 
                    'Kd_Unit' => $dataKirim[0]['Kd_Unit'],
                ));
            }
            
            
        }
        
        return $result;
    }

    public function delete($post){

        $data = $this->cekInput($post);
        // print_r($post);
        if(count($data) > 0){
            
            $dataKirim = $this->db->get($this->table)->num_rows();
            // print_r($dataKirim);
            if($dataKirim > 1){
                $id = $post['perumusan_program_id'];
                $tahun = $post['tahun'];
                $this->db->where('target'.$tahun.'_status !=', 3);
                $this->db->where('perumusan_program_id', $id);
                $result = $this->db->delete($this->table);
            }
            

        }else{
            $result = false;
        }

        return $result;
    }


    public function cekInput($post){

        if(@$post['jenis'] == 'rkpd_perubahan'){
            $this->table = 'ta_rkpd_perubahan';
            // print_r($post);
        }

        if(@$post['name'] == 'opd'){
            $this->db->where('user_id', $post['user_id']);
            $query = $this->db->get('ref_opd_user');
            return $query->result_array();
        }else{
            return 1;
        }
    }

    public function kirim($post, $table = 'ta_rkpd'){
        $post = $this->security->xss_clean($post);
        $result = false;
        $post['name'] = 'opd';
        $opd = $this->cekInput($post);
        // print_r($post);
        if(count($opd)> 0){
            $this->db->where('Kd_Urusan', $opd[0]['Kd_Urusan']);
            $this->db->where('Kd_Bidang', $opd[0]['Kd_Bidang']);
            $this->db->where('Kd_Unit', $opd[0]['Kd_Unit']);
            $this->db->where('Kd_Sub', $opd[0]['Kd_Sub']);
            $data = array();
            $tahun = $post['tahun'];
            $data['target'.$tahun.'_status'] = 2;
            $result = $this->db->update($table, $data);
        }
        
        return $result;
    }

    public function kirimFromBappeda($post, $table = 'ta_rkpd'){
        $post = $this->security->xss_clean($post);
        $result = false;
        $post['name'] = 'opd';
        $opd = $this->cekInput($post);
        
        $data = array();
        $tahun = $post['tahun'];
        $data['target'.$tahun.'_status'] = $post['status'];
        $this->db->where('perumusan_program_id', $post['perumusan_program_id']);
        $result = $this->db->update($table, $data);

        if($post['status'] == 3 && $result && $table == 'ta_rkpd'){
            $this->db->where('perumusan_program_id', $post['perumusan_program_id']);
            $dataKirim = $this->db->get($this->table)->result_array();

            $this->db->where('perumusan_program_id', $post['perumusan_program_id']);
            $this->db->where('tahun', $post['tahun']);
            $dataKirimRka = $this->db->get('ref_rka_pra')->result_array();

            if(count($dataKirim)> 0){
                $this->db->where('perumusan_program_id', $post['perumusan_program_id']);
                $cek = $this->db->get('ta_rkpd_perubahan')->num_rows();

                $dataKirim[0]['target'.$tahun.'_status'] = 0;

                if($cek > 0){
                    unset($dataKirim[0]['perumusan_program_id']);
                    $result = $this->db->update('ta_rkpd_perubahan', $dataKirim[0]);
                }else{
                    $result = $this->db->insert('ta_rkpd_perubahan', $dataKirim[0]);
                }

                //delete all rka perubahan
                $this->db->where('perumusan_program_id', $post['perumusan_program_id']);
                $this->db->where('tahun', $post['tahun']);
                $result = $this->db->delete('ref_rka_pra_perubahan');

                // //insert all
                $result = $this->db->insert_batch('ref_rka_pra_perubahan', $dataKirimRka);

            }
        }
        // }

        return $result;
    }

    

}