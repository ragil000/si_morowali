<?php

class KecamatanModel extends CI_Model
{
    private $jumlah;
    private $table;
    public function __construct()
    {
        parent::__construct();
        $this->jumlah = 20;
        $this->table = "ref_musrenbang_kecamatan";
    }

    public function getCount($search = '', $dataToken){
        // $this->db->where('user_id', $dataToken['user_id']);
        $this->db->where('grup_id', $dataToken['grup_id']);
        $this->db->like('nama', $search);
        $query = $this->db->get($this->table);
        return $query->num_rows();
    }

    public function getJumlahInPage(){
        return $this->jumlah;
    }

    public function getAll($page = 1, $search = '', $dataToken, $all = false){
        $jumlah = $this->jumlah;

        $awal = ($page - 1)*$jumlah;
        $this->db->select($this->table.'.*, ref_standard_satuan.Uraian as nama_satuan, ref_sub_unit.Nm_Sub_Unit,  ref_musrenbang_kategori.kategori ');
        // $this->db->where('user_id', $dataToken['user_id']);
        $this->db->where('grup_id', $dataToken['grup_id']);
        $this->db->join('ta_user_unit', '
            ta_user_unit.Kd_User = '.$this->table.'.opd_user_id
            ', 'left');
        $this->db->join('ref_sub_unit', '
            ref_sub_unit.Kd_Urusan = ta_user_unit.Kd_Urusan
            AND ref_sub_unit.Kd_Bidang = ta_user_unit.Kd_Bidang
            AND ref_sub_unit.Kd_Unit = ta_user_unit.Kd_Unit
            AND ref_sub_unit.Kd_Sub = ta_user_unit.Kd_Sub_Unit
            ', 'left');
        $this->db->like('nama', $search);
        if(!$all){
            $this->db->limit($jumlah,$awal);
        }
        $this->db->join('ref_standard_satuan', '
            ref_standard_satuan.Kd_Satuan = '.$this->table.'.satuan_id
            ', 'left');
        $this->db->join('ref_musrenbang_kategori', '
            ref_musrenbang_kategori.id = ref_musrenbang_kecamatan.kategori_id
                ', 'left');
        
        $query = $this->db->get($this->table);
        
        return $query->result_array();
    }

    public function getCountKiriman($search = '', $user_id){
        $this->db->like('user_kec', '"'.$user_id.'"');
        $query = $this->db->get('ref_grup_musrenbang');
        return $query->num_rows();
    }

    public function getAllKiriman($page = 1, $search = '', $user_id, $all = false){
        $jumlah = $this->jumlah;

        $awal = ($page - 1)*$jumlah;
        // $this->db->select($this->table.'.*, ref_standard_satuan.Uraian as nama_satuan, ref_sub_unit.Nm_Sub_Unit');
        $this->db->like('user_kec', '"'.$user_id.'"');
        $this->db->order_by("tgl", "desc");
        if(!$all){
            $this->db->limit($jumlah,$awal);
        }
        
        $query = $this->db->get('ref_grup_musrenbang');
        
        return $query->result_array();
    }

    public function update($post){
        
        $post = $this->security->xss_clean($post);
        
        $id = $post['id'];

        $this->db->where('id', $id);
        $this->db->where('user_id', $post['user_id']);
        $this->db->where('grup_id', $post['grup_id']);
        

        if($post['foto'] != ''){
            $data = array(
                'nama' => $post['nama'],
                'alasan' => $post['alasan'],
                'lokasi' => $post['lokasi'],
                'volume' => $post['volume'],
                'satuan_id' => $post['satuan'],
                'pagu' => $post['pagu'],
                'manfaat' => $post['manfaat'],
                'pengusul' => $post['pengusul'],
                'file' => $post['foto'],
                'kategori_id' => $post['kategori'],
            );
        }else{
            $data = array(
                'nama' => $post['nama'],
                'alasan' => $post['alasan'],
                'lokasi' => $post['lokasi'],
                'volume' => $post['volume'],
                'satuan_id' => $post['satuan'],
                'pagu' => $post['pagu'],
                'manfaat' => $post['manfaat'],
                'pengusul' => $post['pengusul'],
                'kategori_id' => $post['kategori'],
            );
        }

        $result = $this->db->update($this->table, $data);

        return $result;
    }

    public function create($post)
    {
        $post = $this->security->xss_clean($post);
        $date = date("Y-m-d H:i:s");

        $data = array(
            'user_id' => $post['user_id'],
            'grup_id' => $post['grup_id'], 
            'nama' => $post['nama'],
            'alasan' => $post['alasan'],
            'lokasi' => $post['lokasi'],
            'volume' => $post['volume'],
            'satuan_id' => $post['satuan'],
            'kategori_id' => $post['kategori'],
            'pagu' => $post['pagu'],
            'manfaat' => $post['manfaat'],
            'pengusul' => $post['pengusul'],
            'file' => $post['foto'],
            'asal' => 2,
            'tgl_input' => $date,
        );
      
       
        $result = $this->db->insert($this->table, $data);
        return $result;
    }

    public function delete($post, $grup = true){

        $this->db->where('user_id', $post['user_id']);
        if($grup){
            $this->db->where('grup_id', $post['grup_id']);
            $this->db->where('id', $post['id']);
        }else{
            $this->db->where('grup_id !=', $post['grup_id']);
        }
        
        $result = $this->db->delete($this->table);
        return $result;
    }

    

    public function createGrup($tgl, $user_id)
    {
        $arrUser = json_encode(array($user_id));
        $data = array(
            'tgl' => $tgl,
            'posisi' => 5,
            'user_kec' => $arrUser,
        );
       
        $result = $this->db->insert('ref_grup_musrenbang', $data);

        
            $this->db->where('id',$this->db->insert_id());
            $query = $this->db->get('ref_grup_musrenbang');
        

        return $query->row();
    }

    public function createGrubToken($user_id, $grup_id){
        $dataSession = array(
            'user_id' => $user_id,
            'grup_id' => $grup_id,
        );
        $stringSession = json_encode($dataSession);
        $encryption = $this->encryption->encrypt($stringSession);
        return $encryption;
    }

    public function getGrup($post, $user_id){
        $this->db->like('user_kec', '"'.$user_id.'"');
        $this->db->where('id', $post['id']);

        $grup = $this->db->get('ref_grup_musrenbang')->row();
        return $grup;
    }

    public function getGrupToken($token){
        // return array();
        $decrypt = $this->encryption->decrypt($token);
		return json_decode($decrypt, true);
    }

    public function getAsal($user_id){
        $this->db->where('Kd_User', $user_id);
        $this->db->join('ref_lingkungan', '
            ref_lingkungan.Kd_Lingkungan = ta_user_kelompok.Kd_Lingkungan
            and ref_lingkungan.Kd_Urut_Kel = ta_user_kelompok.Kd_Urut_Kel
            and ref_lingkungan.Kd_Kel = ta_user_kelompok.Kd_Kel
            and ref_lingkungan.Kd_Kec = ta_user_kelompok.Kd_Kec
            and ref_lingkungan.Kd_Kab = ta_user_kelompok.Kd_Kab
            and ref_lingkungan.Kd_Prov = ta_user_kelompok.Kd_Prov
            ', 'left');
        $this->db->join('ref_kelurahan', '
            ref_kelurahan.Kd_Urut = ta_user_kelompok.Kd_Urut_Kel
            and ref_kelurahan.Kd_Kel = ta_user_kelompok.Kd_Kel
            and ref_kelurahan.Kd_Kec = ta_user_kelompok.Kd_Kec
            and ref_kelurahan.Kd_Kab = ta_user_kelompok.Kd_Kab
            and ref_kelurahan.Kd_Prov = ta_user_kelompok.Kd_Prov
            ', 'left');
        $this->db->join('ref_kecamatan', '
            ref_kecamatan.Kd_Kec = ta_user_kelompok.Kd_Kec
            and ref_kecamatan.Kd_Kab = ta_user_kelompok.Kd_Kab
            and ref_kecamatan.Kd_Prov = ta_user_kelompok.Kd_Prov
            ', 'left');
        $this->db->join('ref_kabupaten', '
            ref_kabupaten.Kd_Kab = ta_user_kelompok.Kd_Kab
            and ref_kabupaten.Kd_Prov = ta_user_kelompok.Kd_Prov
            ', 'left');
        $data = $this->db->get('ta_user_kelompok');
        return $data->row();
    }

    public function uploadBerkas($post){
        $post = $this->security->xss_clean($post);
        
        // $result = $this->ubahGrupPosisi($post['grup_id'], 4);
        $result = true;
        if($result){
            $this->db->where('user_id', $post['user_id']);
            $this->db->where('grup_id', $post['grup_id']);
            
            $data = array(
                'berkas_ba' => $post['ba'],
                'berkas_usulan' => $post['usulan'],
                'posisi' => 2,
            );
    
            $result = $this->db->update($this->table, $data);
        }

        return $result;
    }

    public function ubahGrupPosisi($id, $posisi, $larang = array(), $user_kel = NULL, $user_kec = NULL){
        $jalan = true;
        $pesan = '';
        $this->db->where('id', $id);
        $grup = $this->db->get('ref_grup_musrenbang')->row();
        if(in_array($grup->posisi, $larang) || $grup->posisi < 5 || $grup->posisi > 9){
            if($grup->posisi == 5){
                $pesan = 'Anda harus Memilih Grup Usulan Terlebih dahulu';
            }else if($grup->posisi == 6){
                $pesan = 'Anda Sudah Melakukan download berkas';
            }else if($grup->posisi == 7){
                $pesan = 'Data Anda Belum Lengkap';
            }else if($grup->posisi == 8){
                $pesan = 'Anda harus Menginput terlebih dahulu';
            }else if($grup->posisi == 9){
                $pesan = 'Usulan Anda Telah Terkirim';
            }else if($grup->posisi < 5){
                $pesan = 'Usulan Telah Ditarik Kembali';
            }else{
                $pesan = 'Usulan ini telah diproses';
            }
            $jalan = false;
        }
        
        if($jalan){
            $this->db->where('id', $id);
            $data = array(
                'posisi' => $posisi,
            );
            if($user_kel != NULL){
                $data['user_kel'] = $user_kel;
            }
            if($user_kec != NULL){
                $data['user_kec'] = $user_kec;
            }
            $result = $this->db->update('ref_grup_musrenbang', $data);
        }

        $kirim = array(
            'pesan' => $pesan,
            'status' => $jalan
        );

        return $kirim;
        
    }

    public function kirimBerkas($post){
        
        $result = false;

        $status = true;
    

        // $this->db->where('user_id', $post['user_id']);
        $this->db->where('grup_id', $post['grup_id']);
        $datas = $this->db->get($this->table)->result_array();
        
        if(count($datas)==0){
            
            $status = false;
        }
        

        if($status){
            
            foreach($datas as $data){
                
                $kirim = array(
                    'user_id' => $data['user_id'],
                    'grup_id' => $data['grup_id'],
                    'nama' => $data['nama'],
                    'alasan' => $data['alasan'],
                    'lokasi' => $data['lokasi'],
                    'volume' => $data['volume'],
                    'satuan_id' => $data['satuan_id'],
                    'kategori_id' => $data['kategori_id'],
                    'pagu' => $data['pagu'],
                    'pengusul' => $data['pengusul'],
                    'manfaat' => $data['manfaat'],
                    'file' => $data['file'],
                    'berkas_ba' => $data['berkas_ba'],
                    'berkas_usulan' => $data['berkas_usulan'],
                    'tgl_input' => $data['tgl_input'],
                    'asal' => $data['asal'],
                    'skor_keterdesakan' => $data['skor_keterdesakan'],
                    'skor_pertumbuhan' => $data['skor_pertumbuhan'],
                    'skor_potensi' => $data['skor_potensi'],
                    'skor_kemiskinan' => $data['skor_kemiskinan'],
                    'skor_manfaat' => $data['skor_manfaat'],
                    'skor_partisipasi' => $data['skor_partisipasi'],
                    'skor_pelaksanaan' => $data['skor_pelaksanaan'],
                    'skor_dokumen' => $data['skor_dokumen'],
                    'skor_total' => $data['skor_total'],
                    'opd_user_id' => $data['opd_user_id'],
                );

                $result = $this->db->insert('ref_musrenbang_opd', $kirim);
            }

            // $user_kec = $this->cariUserKecamatan($data['user_id']);

            // $this->ubahGrupPosisi($post['grup_id'], 5,array(),  $data['user_id'], $user_kec);
            
            // $this->delete($post, false);
        }
        return $status;

    }

    public function cariUserKecamatan($user_kel){
        $this->db->where('Kd_User', $user_kel);
        $data = $this->db->get('ta_user_kelompok');
        $user = $data->row();

        $this->db->where('Kd_Prov', $user->Kd_Prov);
        $this->db->where('Kd_Kab', $user->Kd_Kab);
        $this->db->where('Kd_Kec', $user->Kd_Kec);
        $this->db->where('Kd_Kel', 0);
        $data = $this->db->get('ta_user_kelompok');

        $data = $data->result_array();

        $user_kec = array();
        if(count($data) == 1)
        {
            foreach($data as $dataUser){
                array_push($user_kec, $dataUser['Kd_User']);
            }
        }
        $kirim = json_encode($user_kec);

        return $kirim;
        

    }

    public function createSkor($post){
        $post = $this->security->xss_clean($post);
        
        $id = $post['id'];
        $skor = $this->hitungSkor($post);

        $this->db->where('id', $id);
        // $this->db->where('user_id', $post['user_id']);
        $this->db->where('grup_id', $post['grup_id']);
        
        

        $data = array(
            'skor_keterdesakan' => $post['skor_keterdesakan'],
            'skor_pertumbuhan' => $post['skor_pertumbuhan'],
            'skor_potensi' => $post['skor_potensi'],
            'skor_kemiskinan' => $post['skor_kemiskinan'],
            'skor_manfaat' => $post['skor_manfaat'],
            'skor_partisipasi' => $post['skor_partisipasi'],
            'skor_pelaksanaan' => $post['skor_pelaksanaan'],
            'skor_dokumen' => $post['skor_dokumen'],
            'skor_total' => $skor,
            'opd_user_id' => $post['opd'],
        );

        $result = $this->db->update($this->table, $data);

        return $result;
    }

    public function hitungSkor($post){
        $hasil = 0;
        $hasil += $this->getSkor($post['skor_keterdesakan']);
        $hasil += $this->getSkor($post['skor_pertumbuhan']);
        $hasil += $this->getSkor($post['skor_potensi']);
        $hasil += $this->getSkor($post['skor_kemiskinan']);
        $hasil += $this->getSkor($post['skor_manfaat']);
        $hasil += $this->getSkor($post['skor_partisipasi']);
        $hasil += $this->getSkor($post['skor_pelaksanaan']);
        $hasil += $this->getSkor($post['skor_dokumen']);

        return (float)$hasil;
    }

    public function getSkor($isi){
        $this->db->where('Kd_Bobot', $isi);
        $skor = $this->db->get('ref_kecamatan_kriteria_bobot')->row();
        return $skor->Skor;
    }

    

}