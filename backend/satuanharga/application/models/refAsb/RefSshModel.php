<?php

class RefSshModel extends CI_Model
{
    private $jumlah;
    public function __construct()
    {
        parent::__construct();
        $this->jumlah = 20;
    }

    public function getSsh($ssh, $dataId){

        $id = explode('-', $dataId);
        for($i = $ssh; $i>1; $i--){
            $this->db->where('Kd_Ssh'.($i-1), $id[($i-2)]);
        }

        if($ssh < 6){
            $query = $this->db->get('ref_ssh'.$ssh);
            return $query->result_array();
        }else if($ssh ==6){
            $this->db->order_by('Kd_Ssh6', 'DESC');
            $query = $this->db->get('ref_ssh');
        }else if($ssh ==7){
            $query = $this->db->get('ref_ssh');
        }

        return $query->row();
    }

    public function getCountSsh($search = ''){
        $this->db->like('Nama_Barang', $search);
        $query = $this->db->get('ref_ssh');
        return count($query->result_array());
    }

    public function getJumlahSshInPage(){
        return $this->jumlah;
    }

    public function getAllSsh($page = 1, $search = ''){
        $jumlah = $this->jumlah;

        $awal = ($page - 1)*$jumlah;
        $this->db->like('Nama_Barang', $search);
        $query = $this->db->limit($jumlah,$awal)->get('ref_ssh');
        //$query = $this->db->get('ref_ssh');
        return $query->result_array();
    }

    public function getSatuan($id = 0){
        if($id != 0){
            $this->db->where('Kd_Satuan', $id);
        }
        $this->db->order_by('Uraian', 'ASC');
        $query = $this->db->get('ref_standard_satuan');
        return $query->result_array();
    }

    public function updateSsh($post,$zona){
        $this->load->library('Fungsi');
        $post = $this->security->xss_clean($post);

        $satuan = $this->getSatuan($post['satuan']);

        $id = explode('-', $post['kodeSsh']);
        for($i = 7; $i>1; $i--){
            $this->db->where('Kd_Ssh'.($i-1), $id[($i-2)]);
        }

        //$zona = $post['zona'];

        $result = $this->db->update('ref_ssh', array(
            'Kd_Satuan' => $post['satuan'],
            // 'Harga_Satuan' => $this->fungsi->convert_to_number($post['hargaZona2']),
            'harga_zona'.$zona => $this->fungsi->convert_to_number($post['hargaZona'.$zona]),
            // 'harga_zona2' => $this->fungsi->convert_to_number($post['hargaZona2']),
            // 'harga_zona3' => $this->fungsi->convert_to_number($post['hargaZona3']),
            // 'harga_zona4' => $this->fungsi->convert_to_number($post['hargaZona4']),
            'Satuan' => $satuan[0]['Uraian'],
            'Nama_Barang' => $post['namaBarang'],
        ));
        return $result;
    }

    public function createSsh($post,$zona)
    {
        $this->load->library('Fungsi');
        $post = $this->security->xss_clean($post);

        $satuan = $this->getSatuan($post['satuan']);

        $id = explode('-', $post['kodeSsh']);
        //$zona = $post['zona'];

        $result = $this->db->insert('ref_ssh', array(
            'Kd_Ssh1' => $id[0],
            'Kd_Ssh2' => $id[1],
            'Kd_Ssh3' => $id[2],
            'Kd_Ssh4' => $id[3],
            'Kd_Ssh5' => $id[4],
            'Kd_Ssh6' => $id[5],
            'Kd_Satuan' => $post['satuan'],
            // 'Harga_Satuan' => $this->fungsi->convert_to_number($post['hargaZona2']),
            'harga_zona'.$zona => $this->fungsi->convert_to_number($post['hargaZona'.$zona]),
            // 'harga_zona2' => $this->fungsi->convert_to_number($post['hargaZona2']),
            // 'harga_zona3' => $this->fungsi->convert_to_number($post['hargaZona3']),
            // 'harga_zona4' => $this->fungsi->convert_to_number($post['hargaZona4']),
            'Satuan' => $satuan[0]['Uraian'],
            'Nama_Barang' => $post['namaBarang'],
        ));
        return $result;
    }

    public function deleteSsh($kodeSsh){

        $id = explode('-', $kodeSsh);
        for($i = 7; $i>1; $i--){
            $this->db->where('Kd_Ssh'.($i-1), $id[($i-2)]);
        }
        $result = $this->db->delete('ref_ssh');
        return $result;
    }

    public function loadDataHspk($post, $zona){
        $id = explode('-', $post['idSsh']);
        // $this->db->select('*');
        // $this->db->from('ref_ssh');
        // for($i = 6; $i>1; $i--){

        //     $this->db->join('ref_ssh'.($i-1), 'ref_ssh'.($i-1).'.Kd_Ssh'.($i-1).' = ref_ssh.Kd_Ssh'.($i-1), 'left');


        // }

        // $this->db->join('ref_standard_satuan', 'ref_standard_satuan.Kd_Satuan = ref_ssh.Kd_Satuan', 'left');

        // for($i = 7; $i>1; $i--){
        //     $this->db->where('Kd_Ssh'.($i-1), $id[($i-2)]);

        // }



        //  $dataHspk = $this->db->get();

        $query = $this->db->query('SELECT * FROM ref_ssh s6, ref_ssh1 s1, ref_ssh2 s2, ref_ssh3 s3, ref_ssh4 s4, ref_ssh5 s5
                    WHERE s6.Kd_Ssh1 = s1.Kd_Ssh1
                    AND s6.Kd_Ssh1 = s2.Kd_Ssh1 AND s6.Kd_Ssh2 = s2.Kd_Ssh2
                    AND s6.Kd_Ssh1 = s3.Kd_Ssh1 AND s6.Kd_Ssh2 = s3.Kd_Ssh2 AND s6.Kd_Ssh3 = s3.Kd_Ssh3
                    AND s6.Kd_Ssh1 = s4.Kd_Ssh1 AND s6.Kd_Ssh2 = s4.Kd_Ssh2 AND s6.Kd_Ssh3 = s4.Kd_Ssh3 AND s6.Kd_Ssh4 = s4.Kd_Ssh4
                    AND s6.Kd_Ssh1 = s5.Kd_Ssh1 AND s6.Kd_Ssh2 = s5.Kd_Ssh2 AND s6.Kd_Ssh3 = s5.Kd_Ssh3 AND s6.Kd_Ssh4 = s5.Kd_Ssh4 AND s6.Kd_Ssh5 = s5.Kd_Ssh5
                     AND s6.Kd_Ssh1 = '.$id[0].'
                     AND s6.Kd_Ssh2 = '.$id[1].'
                     AND s6.Kd_Ssh3 = '.$id[2].'
                     AND s6.Kd_Ssh4 = '.$id[3].'
                     AND s6.Kd_Ssh5 = '.$id[4].'
                     AND s6.Kd_Ssh6 = '.$id[5].'
                    ');

        $dataHspk = $query;

        //return $post;
       return $dataHspk->row();
    }

}
