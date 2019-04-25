<?php

class AdminModel extends CI_Model
{
    private $jumlah;
    private $table;

    private $kec;

    public function __construct()
    {
        parent::__construct();
        $this->jumlah = 20;
        $this->table = "ref_musrenbang_opd";
        $this->kec = 1;
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
        $this->db->select('*, ref_musrenbang_opd.id as idAll, ref_standard_satuan.Uraian as nama_satuan, ref_sub_unit.Nm_Sub_Unit, ref_musrenbang_kategori.kategori');
        // $this->db->where('user_id', $dataToken['user_id']);
        
        if(@$this->input->post('pokir')){
            $this->db->where('asal', 3);
        }else{
            $this->db->where('asal !=', 3);
        }
        if(@$dataToken)
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
        $this->db->join('ta_user_kelompok', '
            ref_musrenbang_opd.user_id = ta_user_kelompok.Kd_User
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
        $this->db->join('ref_musrenbang_kategori', '
            ref_musrenbang_kategori.id = ref_musrenbang_opd.kategori_id
                ', 'left');
        if(@$this->input->post('kecamatan')){
            $this->db->where('ta_user_kelompok.Kd_Kec', $this->input->post('kecamatan'));
           
        }
        if(@$this->input->post('kategori')){
            $this->db->where('kategori_id', $this->input->post('kategori'));
            
        }
        // $this->db->where('kategori_id', 1);
        $this->db->like('nama', $search);
        if(!$all){
            $this->db->limit($jumlah,$awal);
        }
        $this->db->join('ref_standard_satuan', '
            ref_standard_satuan.Kd_Satuan = '.$this->table.'.satuan_id
            ', 'left');
        
        $query = $this->db->get($this->table);
        
        return $query->result_array();
    }

    public function getCountKiriman($search = '', $user_id, $kd_kec = null, $pokir = false){
        
        if(@$this->input->post('pokir')){
            $this->db->where('asal', 3);
        }else{
            $this->db->where('asal !=', 3);
        }
        
        $this->db->join('ta_user_kelompok', '
            ref_musrenbang_opd.user_id = ta_user_kelompok.Kd_User
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
        if(@$this->input->post('kecamatan')){
            $this->db->where('ref_kecamatan.Kd_Kec', $this->input->post('kecamatan'));
            
        }
        // print_r($post);
        // $this->db->group_by("grup_id", "desc");
        $this->db->join('ref_grup_musrenbang', '
            ref_musrenbang_opd.grup_id = ref_grup_musrenbang.id
            ');
        
        $query = $this->db->get('ref_musrenbang_opd');
        return $query->num_rows();
    }

    public function getAllKiriman($page = 1, $search = '', $user_id, $all = false){
        $jumlah = $this->jumlah;

        $awal = ($page - 1)*$jumlah;
        
        $this->db->select('*, ref_musrenbang_opd.id as idAll, ref_musrenbang_opd.nama as nama_usulan, ref_musrenbang_opd.id as idAll');
        $this->db->where('asal !=', 3);
        $this->db->join('ta_user_unit', '
            ta_user_unit.Kd_User = '.$this->table.'.opd_user_id
            ', 'left');
        $this->db->join('ref_sub_unit', '
            ref_sub_unit.Kd_Urusan = ta_user_unit.Kd_Urusan
            AND ref_sub_unit.Kd_Bidang = ta_user_unit.Kd_Bidang
            AND ref_sub_unit.Kd_Unit = ta_user_unit.Kd_Unit
            AND ref_sub_unit.Kd_Sub = ta_user_unit.Kd_Sub_Unit
            ', 'left');
        $this->db->join('ta_user_kelompok', '
            ref_musrenbang_opd.user_id = ta_user_kelompok.Kd_User
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
            // ref_sub_unit
        if(@$this->input->post('kecamatan')){
            $this->db->where('ref_kecamatan.Kd_Kec', $this->input->post('kecamatan')); 
            // print_r($post);
        }
        if(@$this->input->post('kategori')){
            $this->db->where('kategori_id', $this->input->post('kategori'));
            
        }
        // print_r($post['kecamatan']);
        // $this->db->group_by("grup_id", "desc");
        $this->db->join('ref_musrenbang_kategori', '
            ref_musrenbang_kategori.id = ref_musrenbang_opd.kategori_id
                ', 'left');
        $this->db->join('ref_standard_satuan', '
            ref_standard_satuan.Kd_Satuan = ref_musrenbang_opd.satuan_id
            ', 'left');
        $this->db->join('ref_grup_musrenbang', '
            ref_musrenbang_opd.grup_id = ref_grup_musrenbang.id
            ');
        if(!$all){
            $this->db->limit($jumlah,$awal);
        }
        
        $query = $this->db->get('ref_musrenbang_opd');
        
        return $query->result_array();
    }

    public function getCountKirimanPokir($search = '', $user_id, $kd_kec = null, $pokir = false){
        
        // $this->db->select('ref_musrenbang_opd.*, ref_standard_satuan.*');
        $this->db->where('asal', 3);
        if(@$this->input->post('kecamatan')){
            $this->db->like('kd_asal', $this->input->post('kecamatan').'-', 'after');
            
        }
        
        // print_r($post);
        // $this->db->group_by("grup_id", "desc");
        $this->db->join('ref_grup_musrenbang', '
            ref_musrenbang_opd.grup_id = ref_grup_musrenbang.id
            ');
        
        $query = $this->db->get('ref_musrenbang_opd');
        return $query->num_rows();
    }

    public function getAllKirimanPokir($page = 1, $search = '', $user_id, $all = false){
        $jumlah = $this->jumlah;

        $awal = ($page - 1)*$jumlah;
        
        $this->db->select(' ref_musrenbang_opd.*, ref_musrenbang_opd.id as idAll, ref_standard_satuan.*, ref_sub_unit.*, ref_musrenbang_kategori.kategori, ref_dewan.*');
        $this->db->where('asal', 3);
        if(@$this->input->post('kategori')){
            $this->db->where('kategori_id', $this->input->post('kategori'));
            
        }
       
        // echo "kategori = ".$this->input->post('kategori');
    if(@$this->input->post('kecamatan')){
        // $this->db->where('ref_kecamatan.Kd_Kec', $this->input->post('kecamatan')); 
        $this->db->like('kd_asal', $this->input->post('kecamatan').'-', 'after');
        // print_r($post);
    }
        $this->db->join('ta_user_unit', '
            ta_user_unit.Kd_User = ref_musrenbang_opd.opd_user_id
            ', 'left');
            $this->db->join('ref_sub_unit', '
            ref_sub_unit.Kd_Urusan = ta_user_unit.Kd_Urusan
            AND ref_sub_unit.Kd_Bidang = ta_user_unit.Kd_Bidang
            AND ref_sub_unit.Kd_Unit = ta_user_unit.Kd_Unit
            AND ref_sub_unit.Kd_Sub = ta_user_unit.Kd_Sub_Unit
            ', 'left');
            $this->db->join('ta_user_dapil', '
            ta_user_dapil.Kd_User = ref_musrenbang_opd.user_id
            ', 'left');
            $this->db->join('ref_dewan', '
            ref_dewan.Kd_Dewan = ta_user_dapil.Kd_Dewan
            ', 'left');
        
        
        // print_r($post['kecamatan']);
        // $this->db->group_by("grup_id", "desc");
        $this->db->join('ref_musrenbang_kategori', '
            ref_musrenbang_kategori.id = ref_musrenbang_opd.kategori_id
                ', 'left');
        $this->db->join('ref_standard_satuan', '
            ref_standard_satuan.Kd_Satuan = ref_musrenbang_opd.satuan_id
            ', 'left');
        $this->db->join('ref_grup_musrenbang', '
            ref_musrenbang_opd.grup_id = ref_grup_musrenbang.id
            ');
            // $this->db->join('ref_musrenbang_kategori', '
            // ref_musrenbang_kategori.id = ref_musrenbang_opd.kategori_id
            //     ', 'left');

        if(!$all){
            $this->db->limit($jumlah,$awal);
        }
        
        $query = $this->db->get('ref_musrenbang_opd');
        
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
                'lokasi' => $post['lokasi'],
                'volume' => $post['volume'],
                'satuan_id' => $post['satuan'],
                'pagu' => $post['pagu'],
                'manfaat' => $post['manfaat'],
                'pengusul' => $post['pengusul'],
                'file' => $post['foto'],
                'kd_asal' => $post['kecamatan'].'-'.$post['kelurahan'],
            );
        }else{
            $data = array(
                'nama' => $post['nama'],
                'lokasi' => $post['lokasi'],
                'volume' => $post['volume'],
                'satuan_id' => $post['satuan'],
                'pagu' => $post['pagu'],
                'manfaat' => $post['manfaat'],
                'pengusul' => $post['pengusul'],
                'kd_asal' => $post['kecamatan'].'-'.$post['kelurahan'],
            );
        }

        $result = $this->db->update($this->table, $data);

        return $result;
    }

    public function updateApi($post){
        
        $post = $this->security->xss_clean($post);
        
        $id = $post['id'];

        $this->db->where('id', $id);

        $data = array(
            'terima' => $post['terima'],
            'Kd_Prog' => $post['Kd_Prog'],
            'Kd_Keg' => $post['Kd_Keg'],
        );

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
            'lokasi' => $post['lokasi'],
            'volume' => $post['volume'],
            'satuan_id' => $post['satuan'],
            'pagu' => $post['pagu'],
            'manfaat' => $post['manfaat'],
            'pengusul' => $post['pengusul'],
            'file' => $post['foto'],
            'asal' => 3,
            'tgl_input' => $date,
            'kd_asal' => $post['kecamatan'].'-'.$post['kelurahan'],
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

    public function getGrup($post, $user_id){
        // $this->db->like('user_pokir', '"'.$user_id.'"');
        $this->db->where('id', $post['id']);
        // print_r($post);
        $grup = $this->db->get('ref_grup_musrenbang')->row();
        return $grup;
    }

    public function createGrup($tgl, $user_id)
    {
        $arrUser = json_encode(array($user_id));
        $data = array(
            'tgl' => $tgl,
            'posisi' => 3,
            'user_pokir' => $arrUser,
        );
    //    print_r($arrUser);
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

    public function getGrupToken($token){
        // return array();
        $decrypt = $this->encryption->decrypt($token);
		return json_decode($decrypt, true);
    }

    public function getAsal($user_id){
        $this->db->where('Kd_User', $user_id);
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
        
        $result = $this->ubahGrupPosisi($post['grup_id'], 4);

        if($result){
            $this->db->where('user_id', $post['user_id']);
            $this->db->where('grup_id', $post['grup_id']);
            
            $data = array(
                'berkas_usulan' => $post['usulan'],
                'posisi' => 2,
            );
    
            $result = $this->db->update($this->table, $data);
        }

        return $result;
    }

    public function ubahGrupPosisi($id, $posisi, $user_pokir = NULL, $paksa = false){
        $jalan = true;
        if(!$paksa){
            $this->db->where('id', $id);
            $grup = $this->db->get('ref_grup_musrenbang')->row();
            if($grup->posisi - 1 == $posisi){
                $jalan = false;
            }
        }
        if($jalan){
            $this->db->where('id', $id);
            $data = array(
                'posisi' => $posisi,
            );
            // if($user_kel != NULL){
            //     $data['user_kel'] = $user_kel;
            // }
            // if($user_kec != NULL){
            //     $data['user_kec'] = $user_kec;
            // }
            $result = $this->db->update('ref_grup_musrenbang', $data);
        }

        return $jalan;
        
    }

    public function kirimBerkas($post){
        
        $result = false;

        $status = true;
        

        $this->db->where('id', $post['grup_id']);
        $dataGrup = $this->db->get('ref_grup_musrenbang')->row();

        if($dataGrup->posisi != 4){
            $status = false;
            // print_r($post);
        }

        // $this->db->where('user_id', $post['user_id']);
        $this->db->where('grup_id', $post['grup_id']);
        $datas = $this->db->get($this->table)->result_array();
        
        if(count($datas)==0){
            // print_r($dataGrup);
            $status = false;
        }
        

        if($status){
            
            foreach($datas as $data){
                
                $kirim = array(
                    'user_id' => $data['user_id'],
                    'grup_id' => $data['grup_id'],
                    'nama' => $data['nama'],
                    'lokasi' => $data['lokasi'],
                    'volume' => $data['volume'],
                    'satuan_id' => $data['satuan_id'],
                    'pagu' => $data['pagu'],
                    'pengusul' => $data['pengusul'],
                    'manfaat' => $data['manfaat'],
                    'file' => $data['file'],
                    'berkas_ba' => $data['berkas_ba'],
                    'berkas_usulan' => $data['berkas_usulan'],
                    'tgl_input' => $data['tgl_input'],
                    'asal' => $data['asal'],
                    'kd_asal' => $data['kd_asal'],
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

            $this->ubahGrupPosisi($post['grup_id'], 5);
            
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

    public function getUser($user_id){
        $this->db->where('Kd_User', $user_id);
        $query = $this->db->get('ta_user_dapil');
        $set = $query->result_array();

        $this->db->where('Kd_Dapil', $set[0]['Kd_Dapil']);
        $query = $this->db->get('ref_dapil');
        $user['dapil'] = $query->row();

        $this->db->where('Kd_Dapil', $set[0]['Kd_Dapil']);
        $this->db->where('Kd_Dewan', $set[0]['Kd_Dewan']);
        $query = $this->db->get('ref_dewan');
        $user['dewan'] = $query->row();
        

        return $user;

    }

    public function createSkor($post){
        $post = $this->security->xss_clean($post);
        
        $id = $post['id'];
        // $skor = $this->hitungSkor($post);

        $this->db->where('id', $id);
        // $this->db->where('user_id', $post['user_id']);
        $this->db->where('grup_id', $post['grup_id']);
        
        $data = array(
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