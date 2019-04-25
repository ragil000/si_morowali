<?php

class DataModel extends CI_Model
{
    private $jumlah;
    public function __construct()
    {
        parent::__construct();
        $this->jumlah = 20;
    }

    public function getSatuan(){
        $query = $this->db->get('ref_standard_satuan');
        return $query->result_array();
    }

    public function getSkor(){
        $pembobotan = $this->db->get('ref_kecamatan_kriteria_pembobotan')->result_array();

        $no = 0;
        foreach($pembobotan as $bobot){

            $dataBobot[$no] = $bobot;
            
            $this->db->where('Kd_Kriteria', $bobot['Kd_Kriteria']);
            $dataBobot[$no]['isi'] = $this->db->get('ref_kecamatan_kriteria_bobot')->result_array();
            $no++;
        }
        return $dataBobot;
    }

    public function getOpd(){
        $kodeOpd = $this->db->get('ta_user_unit')->result_array();

        $no = 0;
        foreach($kodeOpd as $opd){

            $dataOpd[$no] = $opd;
            $this->db->where('Kd_Urusan', $opd['Kd_Urusan']);
            $this->db->where('Kd_Bidang', $opd['Kd_Bidang']);
            $this->db->where('Kd_Unit', $opd['Kd_Unit']);
            $this->db->where('Kd_Sub', $opd['Kd_Sub_Unit']);
            $dataOpd[$no]['isi'] = $this->db->get('ref_sub_unit')->result_array();
            $no++;
        }
        return $dataOpd;
    }
    

    public function getKecamatan(){
        $this->db->where('Kd_Prov', 72);
        $this->db->where('Kd_Kab', 6);
        return $this->db->get('ref_kecamatan')->result_array();
    }

    public function getKelurahan($post){
        $this->db->where('Kd_Prov', 72);
        $this->db->where('Kd_Kab', 6);
        $this->db->where('Kd_Kec', $post['kecamatan']);
        return $this->db->get('ref_kelurahan')->result_array();
    }

    public function getDapil(){
        return $this->db->get('ref_dapil')->result_array();
    }

    public function getLevel($user_id){
        $level = 0;

        $this->db->where('id', $user_id);
        $this->db->where('level_musrenbang', '5');
        $query = $this->db->get('user');
        $user = $query->result_array();

        if(count($user)>0){
            $level = 5; // admin
        }

        $this->db->where('Kd_User', $user_id);
        $query = $this->db->get('ta_user_kelompok');
        $user = $query->result_array();
        if(count($user) > 0){
            if($user[0]['Kd_Lingkungan'] == 0)
            if($user[0]['Kd_Kel'] == 0){
                $level = 2;//kelurahan
            }else{
                $level = 1;//kecamatan
            }
        }else{
            $this->db->where('Kd_User', $user_id);
            $query = $this->db->get('ta_user_unit');
            $user = $query->result_array();
            if(count($user) > 0){
                $level = 4;//opd
            }else{
                $this->db->where('Kd_User', $user_id);
                $query = $this->db->get('ta_user_dapil');
                $user = $query->result_array();
                if(count($user) > 0){
                    $level = 3;//pokir
                }
            }
        }
        
        return $level;
    }

    public function getKategori(){
        return $this->db->get('ref_musrenbang_kategori')->result_array();
    }

    public function findKec($Kd_Kec){
        $this->db->where('Kd_Prov', 72);
        $this->db->where('Kd_Kab', 6);
        $this->db->where('Kd_Kec', $Kd_Kec);
        return $this->db->get('ref_kecamatan')->result_array();
    }

    public function findKel($Kd_Kel, $Kd_Urut){
        $this->db->where('Kd_Prov', 72);
        $this->db->where('Kd_Kab', 6);
        $this->db->where('Kd_Kel', $Kd_Kel);
        $this->db->where('Kd_Urut', $Kd_Urut);
        return $this->db->get('ref_kelurahan')->result_array();
    }

    public function getDataAll($post){
        $this->db->where('user_id', $post['user_id']);
        $this->db->where('grup_id', $post['grup_id']);
        $datas = $this->db->get($post['table'])->result_array();

        return $datas;
    }

    public function import($kirim){
        $result = $this->db->insert('ref_musrenbang_opd', $kirim);
        return $result;
    }

    
}