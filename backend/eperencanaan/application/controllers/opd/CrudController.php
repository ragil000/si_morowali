<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudController extends CI_Controller {

    private $level, $akun, $tahun;
	public function __construct()
    {
		parent::__construct();
        $this->load->library('MyConfig');
        $this->level = 1;
        $this->akun = 2;
        $this->tahun = date("Y");
		
    }

    public function getData($name, $page = 1, $save = ''){

        if($page <= 0) $page = 1;
        $jumDataAll = 0;
        $data = array();
        $kirim = array();
        $dataTambah = array();
        $jumlahDatainPage = 20;
        $jumlahPage = 1;
        $status = false;
        $linkSavePDF = '';
        $nameFile = '';

        $session = $this->myconfig->getSession($this->input->post('session'), $this->level,true,  $this->akun);
        if(@$session['status']){
            $status = $session['status'];
        }
        // // echo "sdf";
		if($status){
            $search = '';
            if(@$this->input->post('search')){
                $search = $this->input->post('search');
            }
            $this->load->model('opd/DataModel');
            $post = $this->input->post();
            $post['user_id'] = $session['id'];
            $post['tahun_asli'] = $this->tahun;
           

            if($save != ''){
                $post['all'] = true;
            }

            if($name == "opd_pegawai"){
                
                $this->load->model('opd/PegawaiModel');
                $data = $this->PegawaiModel->getAll($page, $search, $post);
            
                // $dataAll
                $jumDataAll = $this->PegawaiModel->getCount($search, $post);
                $jumlahDatainPage = $this->PegawaiModel->getJumlahInPage();
                $jumlahPage = ceil($jumDataAll/$jumlahDatainPage);

                $linkSavePDF = 'opd/pegawai';
                $nameFile = 'pegawai';
                
            }
            
            if($name == "opd_visi"){
                $this->load->model('opd/VisiModel');
                $data = $this->VisiModel->getAll($page, $search, $post);
            
                // $dataAll
                $jumDataAll = $this->VisiModel->getCount($search, $post);
                $jumlahDatainPage = $this->VisiModel->getJumlahInPage();
                $jumlahPage = ceil($jumDataAll/$jumlahDatainPage);

                $linkSavePDF = 'opd/visi';
                $nameFile = 'visi';
            }
            
            if($name == "opd_visi_penjelasan"){
                $this->load->model('opd/VisiPenjelasanModel');
                $data = $this->VisiPenjelasanModel->getAll($page, $search, $post);
            
                // $dataAll
                $jumDataAll = $this->VisiPenjelasanModel->getCount($search, $post);
                $jumlahDatainPage = $this->VisiPenjelasanModel->getJumlahInPage();
                $jumlahPage = ceil($jumDataAll/$jumlahDatainPage);

                $linkSavePDF = 'opd/visi-penjelasan';
                $nameFile = 'visi-penjelasan';
            }

            if($name == "opd_misi"){
                $this->load->model('opd/MisiModel');
                $data = $this->MisiModel->getAll($page, $search, $post);
            
                // $dataAll
                $jumDataAll = $this->MisiModel->getCount($search, $post);
                $jumlahDatainPage = $this->MisiModel->getJumlahInPage();
                $jumlahPage = ceil($jumDataAll/$jumlahDatainPage);

                $linkSavePDF = 'opd/misi';
                $nameFile = 'misi';
            }

            if($name == "opd_tujuan"){
                $this->load->model('opd/TujuanModel');
                $data = $this->TujuanModel->getAll($page, $search, $post);
            
                // $dataAll
                $jumDataAll = $this->TujuanModel->getCount($search, $post);
                $jumlahDatainPage = $this->TujuanModel->getJumlahInPage();
                $jumlahPage = ceil($jumDataAll/$jumlahDatainPage);
                
                
                $dataTambah = $this->DataModel->getMisi($post);

                $linkSavePDF = 'opd/tujuan';
                $nameFile = 'tujuan';
            }

            if($name == "opd_sasaran"){
                $this->load->model('opd/SasaranModel');
                $data = $this->SasaranModel->getAll($page, $search, $post);
            
                // $dataAll
                $jumDataAll = $this->SasaranModel->getCount($search, $post);
                $jumlahDatainPage = $this->SasaranModel->getJumlahInPage();
                $jumlahPage = ceil($jumDataAll/$jumlahDatainPage);
                
                $dataTambah = $this->DataModel->getTujuan($post);

                $linkSavePDF = 'opd/sasaran';
                $nameFile = 'sasaran';
            }

            if($name == "opd_indikator"){
                $this->load->model('opd/IndikatorModel');
                $data = $this->IndikatorModel->getAll($page, $search, $post);
            
                // $dataAll
                $jumDataAll = $this->IndikatorModel->getCount($search, $post);
                $jumlahDatainPage = $this->IndikatorModel->getJumlahInPage();
                $jumlahPage = ceil($jumDataAll/$jumlahDatainPage);
                
                $dataTambah = $this->DataModel->getSasaran($post);

                $linkSavePDF = 'opd/indikator';
                $nameFile = 'indikator';
            }

            if($name == "opd_pagu"){
                $this->load->model('bappeda/OpdPaguModel');
                $data = $this->OpdPaguModel->getAll($page, $search, $post);
                // // print_r($post);
                // // $dataAll
                $jumDataAll = $this->OpdPaguModel->getCount($search, $post);
                $jumlahDatainPage = $this->OpdPaguModel->getJumlahInPage();
                $jumlahPage = ceil($jumDataAll/$jumlahDatainPage);
                // getAllOpd
                $kirim['dataAllOpd'] = $this->DataModel->getAllOpd($post);
            }
            
            if($name == "opd_renstra_kab" || $name == "opd_renstra_opd"){
                $this->load->model('opd/RenstraKabModel');
                $data = $this->RenstraKabModel->getAll($page, $search, $post);
            
                // $dataAll
                // $jumDataAll = $this->RenstraKabModel->getCount($search, $post);
                // $jumlahDatainPage = $this->RenstraKabModel->getJumlahInPage();
                // $jumlahPage = ceil($jumDataAll/$jumlahDatainPage);
                
                if($name == "opd_renstra_opd"){
                    $post['name'] = 'opd';
                }
                $linkSavePDF = 'opd/renstra-opd';
                $nameFile = 'renstra-opd';

                $dataTambah = $this->DataModel->getSasaran($post);

                $data = $this->RenstraKabModel->getAll($page, $search, $post);

                $dataAll = array();
                $no = 0;
                $urusan = 0;
                $bidang = 0;
                $program = 0;
                foreach($data as $key){
                    
                    if($key['Kd_Prog'] != $program){
                        $program = $key['Kd_Prog'];
                        $dataAll[$no] = $key;
                        $dataAll[$no]['idAll'] = $no+1;
                        $dataAll[$no]['Kd_Keg'] = '';
                        $dataAll[$no]['Ket_Kegiatan'] = '';
                        $dataAll[$no]['nama_jenis'] = @$dataAll[$no]['Ket_Program'];
                        $no++;
                    }
                    $dataAll[$no] = $key;
                    $dataAll[$no]['idAll'] = $no+1;
                    $dataAll[$no]['nama_jenis'] = @$dataAll[$no]['Ket_Kegiatan'];
                    // $dataAll[$no] = $key;
                    // $dataAll[$no]['opd']
                    $dataAll[$no]['target1_satuan_nama'] = $this->DataModel->selectSatuan($key['target1_satuan'])[0]['Uraian'];
                    $dataAll[$no]['target2_satuan_nama'] = $this->DataModel->selectSatuan($key['target2_satuan'])[0]['Uraian'];
                    $dataAll[$no]['target3_satuan_nama'] = $this->DataModel->selectSatuan($key['target3_satuan'])[0]['Uraian'];
                    $dataAll[$no]['target4_satuan_nama'] = $this->DataModel->selectSatuan($key['target4_satuan'])[0]['Uraian'];
                    $dataAll[$no]['target5_satuan_nama'] = $this->DataModel->selectSatuan($key['target5_satuan'])[0]['Uraian'];

                    if(@$key['Kd_Sub'] && @$key['Kd_Unit']){
                        $nm  = $this->DataModel->selectOpd($key['Kd_Urusan'], $key['Kd_Bidang'], $key['Kd_Sub'], $key['Kd_Unit']);
                        
                        $dataAll[$no]['Nm_Sub_Unit'] = @$nm[0]['Nm_Sub_Unit'];
                        $nm  = $this->DataModel->selectKegiatan($key['Kd_Urusan'], $key['Kd_Bidang'], $key['Kd_Prog'], $key['Kd_Keg']);
                        
                        $dataAll[$no]['Ket_Kegiatan'] = @$nm[0]['Ket_Kegiatan'];
                    }
                    $no++;
                }
                
                // $dataAll
                $jumDataAll = $this->RenstraKabModel->getCount($search, $post);
                $jumlahDatainPage = $this->RenstraKabModel->getJumlahInPage();
                $jumlahPage = ceil($jumDataAll/$jumlahDatainPage);
                $dataTambah =array();
                $data = $dataAll;
            }

            

            if($name == "opd_rkpd_awal"){
                $this->load->model('opd/RkpdAwalModel');
                $data = $this->RkpdAwalModel->getAll($page, $search, $post);
                $dataAll = array();
                $no = 0;
                $urusan = 0;
                $bidang = 0;
                $program = 0;
                $tahun = $this->tahun;
                if(@$data[0]['rpjmd_tahun']){
                    $tahun = $tahun-$data[0]['rpjmd_tahun']+1;
                }else{
                    $tahun=0;
                }
                foreach($data as $key){
                    if($key['Kd_Urusan'] != $urusan){
                        $urusan = $key['Kd_Urusan'];
                        $dataAll[$no] = $key;
                        $dataAll[$no]['idAll'] = $no+1;
                        $dataAll[$no]['Kd_Bidang'] = 0;
                        $dataAll[$no]['Kd_Prog'] = 0;
                        $dataAll[$no]['Kd_Keg'] = 0;
                        $dataAll[$no]['nama_jenis'] = $dataAll[$no]['Nm_Urusan'];
                        $no++;
                    }
                    if($key['Kd_Bidang'] != $bidang){
                        $bidang = $key['Kd_Bidang'];
                        $dataAll[$no] = $key;
                        $dataAll[$no]['idAll'] = $no+1;
                        $dataAll[$no]['Kd_Prog'] = 0;
                        $dataAll[$no]['Kd_Keg'] = 0;
                        $dataAll[$no]['nama_jenis'] = $dataAll[$no]['Nm_Bidang'];
                        $no++;
                    }
                    if($key['Kd_Prog'] != $program){
                        $program = $key['Kd_Prog'];
                        $dataAll[$no] = $key;
                        $dataAll[$no]['idAll'] = $no+1;
                        $dataAll[$no]['Kd_Keg'] = 0;
                        $dataAll[$no]['nama_jenis'] = $dataAll[$no]['Ket_Program'];
                        $no++;
                    }
                    $dataAll[$no] = $key;
                    $dataAll[$no]['idAll'] = $no+1;
                    $dataAll[$no]['nama_jenis'] = $dataAll[$no]['Ket_Kegiatan'];
                    // $dataAll[$no]['opd']
                    $dataAll[$no]['target1_satuan_nama'] = $this->DataModel->selectSatuan($key['target1_satuan'])[0]['Uraian'];
                    $dataAll[$no]['target2_satuan_nama'] = $this->DataModel->selectSatuan($key['target2_satuan'])[0]['Uraian'];
                    $dataAll[$no]['target3_satuan_nama'] = $this->DataModel->selectSatuan($key['target3_satuan'])[0]['Uraian'];
                    $dataAll[$no]['target4_satuan_nama'] = $this->DataModel->selectSatuan($key['target4_satuan'])[0]['Uraian'];
                    $dataAll[$no]['target5_satuan_nama'] = $this->DataModel->selectSatuan($key['target5_satuan'])[0]['Uraian'];
                    $no++;
                }
                $jumDataAll = $this->RkpdAwalModel->getCount($search, $post);
                $jumlahDatainPage = $this->RkpdAwalModel->getJumlahInPage();
                $jumlahPage = ceil($jumDataAll/$jumlahDatainPage);
                $dataTambah =array('tahun' => $tahun);
                $data = $dataAll;
            }
            
            if($name == "opd_rkpd_verifikasi" || $name == "opd_renja_awal" || $name == "opd_rkpd_perubahan" || $name == "opd_renja_perubahan"){
                $this->load->model('opd/RkpdVerifikasiModel');
                if($name == "opd_renja_awal"){
                    $post['name'] = 'opd';
                }
                if($name == "opd_rkpd_perubahan" || $name == "opd_renja_perubahan"){
                    $post['jenis'] = 'rkpd_perubahan';
                }
                $linkSavePDF = 'opd/rkpd';
                $nameFile = 'RKPD';
                $data = $this->RkpdVerifikasiModel->getAll($page, $search, $post);
                $dataAll = array();
                $no = 0;
                $urusan = 0;
                $bidang = 0;
                $program = 0;
                $tahun = $this->tahun;
                
                if(@$data[0]['rpjmd_tahun']){
                    $tahun = $tahun-$data[0]['rpjmd_tahun']+1;
                }else{
                    $tahun=0;
                }
                foreach($data as $key){
                    if($key['Kd_Urusan'] != $urusan){
                        $urusan = $key['Kd_Urusan'];
                        $bidang = 0;
                        $program = 0;
                        $dataAll[$no] = $key;
                        $dataAll[$no]['idAll'] = $no+1;
                        $dataAll[$no]['Kd_Bidang'] = 0;
                        $dataAll[$no]['Kd_Prog'] = 0;
                        $dataAll[$no]['Kd_Keg'] = 0;
                        $dataAll[$no]['Nm_Bidang'] = '';
                        $dataAll[$no]['Ket_Program'] = '';
                        $dataAll[$no]['Ket_Kegiatan'] = '';
                        $dataAll[$no]['nama_jenis'] = @$dataAll[$no]['Nm_Urusan'];
                        $no++;
                    }
                    if($key['Kd_Bidang'] != $bidang){
                        $bidang = $key['Kd_Bidang'];
                        $program = 0;
                        $dataAll[$no] = $key;
                        $dataAll[$no]['idAll'] = $no+1;
                        $dataAll[$no]['Kd_Prog'] = 0;
                        $dataAll[$no]['Kd_Keg'] = 0;
                        $dataAll[$no]['Ket_Program'] = '';
                        $dataAll[$no]['Ket_Kegiatan'] = '';
                        $dataAll[$no]['nama_jenis'] = @$dataAll[$no]['Nm_Bidang'];
                        $no++;
                    }
                    if($key['Kd_Prog'] != $program){
                        $program = $key['Kd_Prog'];
                        $dataAll[$no] = $key;
                        $dataAll[$no]['idAll'] = $no+1;
                        $dataAll[$no]['Kd_Keg'] = 0;
                        $dataAll[$no]['Ket_Kegiatan'] = '';
                        $dataAll[$no]['nama_jenis'] = @$dataAll[$no]['Ket_Program'];
                        $no++;
                    }
                    $dataAll[$no] = $key;
                    $dataAll[$no]['idAll'] = $no+1;
                    $dataAll[$no]['nama_jenis'] = @$dataAll[$no]['Ket_Kegiatan'];
                    // $dataAll[$no]['opd']
                    $dataAll[$no]['target1_satuan_nama'] = @$this->DataModel->selectSatuan($key['target1_satuan'])[0]['Uraian'];
                    $dataAll[$no]['target2_satuan_nama'] = @$this->DataModel->selectSatuan($key['target2_satuan'])[0]['Uraian'];
                    $dataAll[$no]['target3_satuan_nama'] = @$this->DataModel->selectSatuan($key['target3_satuan'])[0]['Uraian'];
                    $dataAll[$no]['target4_satuan_nama'] = @$this->DataModel->selectSatuan($key['target4_satuan'])[0]['Uraian'];
                    $dataAll[$no]['target5_satuan_nama'] = @$this->DataModel->selectSatuan($key['target5_satuan'])[0]['Uraian'];
                    
                    if(@$key['Kd_Sub'] && @$key['Kd_Unit']){
                        $nm  = $this->DataModel->selectOpd($key['Kd_Urusan'], $key['Kd_Bidang'], $key['Kd_Sub'], $key['Kd_Unit']);
                        
                        $dataAll[$no]['Nm_Sub_Unit'] = @$nm[0]['Nm_Sub_Unit'];
                        // $nm  = $this->DataModel->selectKegiatan($key['Kd_Urusan'], $key['Kd_Bidang'], $key['Kd_Prog'], $key['Kd_Keg']);
                        
                        // $dataAll[$no]['Ket_Kegiatan'] = @$nm[0]['Ket_Kegiatan'];
                        
                    }
                    
                    $no++;
                }
                $jumDataAll = $this->RkpdVerifikasiModel->getCount($search, $post);
                $jumlahDatainPage = $this->RkpdVerifikasiModel->getJumlahInPage();
                $jumlahPage = ceil($jumDataAll/$jumlahDatainPage);
                $dataTambah =array('tahun' => $tahun);
                $data = $dataAll;
                $kirim['dataUrusan'] = $this->DataModel->getUrusan();
                $kirim['dataSatuan'] = $this->DataModel->getSatuan();
            }

            if($name == "opd_pra_rka" || $name == "opd_pra_rka_perubahan"){
                $this->load->model('opd/PraRkaModel');
                if($name == "opd_renja_awal"){
                    $post['name'] = 'opd';
                }
                if($name == "opd_pra_rka_perubahan"){
                    $post['jenis'] = 'perubahan';
                }
                // print_r($post);
                $linkSavePDF = 'opd/rka';
                $nameFile = 'Rka';
                
                $data = $this->PraRkaModel->getAll($page, $search, $post);
                $dataAll = array();
                $no = 0;
                $Kd_Rek_1 = 0;
                $Kd_Rek_2 = 0;
                $Kd_Rek_3 = 0;
                $Kd_Rek_4 = 0;
                $Kd_Rek_5 = 0;
                $tahun = $this->tahun;
                
                if(@$data[0]['rpjmd_tahun']){
                    $tahun = $tahun-$data[0]['rpjmd_tahun']+1;
                }else{
                    $tahun=0;
                }
                $totalIndex = 0;
                $total4Index = 0;
                $total5Index = 0;
                $kirim['dataTotal'] = 0;

                foreach($data as $key){
                    if($key['Kd_Rek_1'] != $Kd_Rek_1){
                        $Kd_Rek_1 = $key['Kd_Rek_1'];
                        $Kd_Rek_2 = 0;
                        $Kd_Rek_3 = 0;
                        $Kd_Rek_4 = 0;
                        $Kd_Rek_5 = 0;
                        $dataAll[$no] = $key;
                        $dataAll[$no]['idAll'] = $no+1;
                        $dataAll[$no]['Kd_Rek_2'] = '';
                        $dataAll[$no]['Kd_Rek_3'] = '';
                        $dataAll[$no]['Kd_Rek_4'] = '';
                        $dataAll[$no]['Kd_Rek_5'] = '';
                        $dataAll[$no]['nama_belanja'] = $key['Nm_Rek_1'];
                        $no++;
                    }
                    if($key['Kd_Rek_2'] != $Kd_Rek_2){
                        $Kd_Rek_2 = $key['Kd_Rek_2'];
                        $Kd_Rek_3 = 0;
                        $Kd_Rek_4 = 0;
                        $Kd_Rek_5 = 0;
                        $dataAll[$no] = $key;
                        $dataAll[$no]['idAll'] = $no+1;
                        $dataAll[$no]['Kd_Rek_3'] = '';
                        $dataAll[$no]['Kd_Rek_4'] = '';
                        $dataAll[$no]['Kd_Rek_5'] = '';
                        $dataAll[$no]['nama_belanja'] = $key['Nm_Rek_2'];
                        $no++;
                    }
                    if($key['Kd_Rek_3'] != $Kd_Rek_3){
                        $Kd_Rek_3 = $key['Kd_Rek_3'];
                        $Kd_Rek_4 = 0;
                        $Kd_Rek_5 = 0;
                        $dataAll[$no] = $key;
                        $dataAll[$no]['idAll'] = $no+1;
                        $totalIndex = $no;
                        $dataAll[$totalIndex]['total'] = 0;
                        $dataAll[$no]['Kd_Rek_4'] = '';
                        $dataAll[$no]['Kd_Rek_5'] = '';
                        $dataAll[$no]['nama_belanja'] = $key['Nm_Rek_3'];
                        $no++;
                    }
                    if($key['Kd_Rek_4'] != $Kd_Rek_4){
                        $Kd_Rek_4 = $key['Kd_Rek_4'];
                        $Kd_Rek_5 = 0;
                        $total4Index = $no;
                        $dataAll[$total4Index]['total'] = 0;
                        $dataAll[$no] = $key;
                        $dataAll[$no]['idAll'] = $no+1;
                        $dataAll[$no]['Kd_Rek_5'] = '';
                        $dataAll[$no]['nama_belanja'] = $key['Nm_Rek_4'];
                        $no++;
                    }
                    if($key['Kd_Rek_5'] != $Kd_Rek_5){
                        $Kd_Rek_5 = $key['Kd_Rek_5'];
                        $total5Index = $no;
                        $dataAll[$total5Index]['total'] = 0;
                        $dataAll[$no] = $key;
                        $dataAll[$no]['idAll'] = $no+1;
                        $dataAll[$no]['nama_belanja'] = $key['Nm_Rek_5'];
                        $no++;
                    }
                    $dataAll[$no] = $key;
                    $dataAll[$no]['idAll'] = $no+1;
                    $dataAll[$no]['Kd_Rek_1'] = '';
                    $dataAll[$no]['Kd_Rek_2'] = '';
                    $dataAll[$no]['Kd_Rek_3'] = '';
                    // $dataAll[$no]['Kd_Rek_4'] = '';
                    // $dataAll[$no]['Kd_Rek_5'] = '';
                    @$dataAll[$totalIndex]['total'] += $dataAll[$no]['harga']*$dataAll[$no]['volume'];
                    @$dataAll[$total4Index]['total'] += $dataAll[$no]['harga']*$dataAll[$no]['volume'];
                    @$dataAll[$total5Index]['total'] += $dataAll[$no]['harga']*$dataAll[$no]['volume'];
                    $dataAll[$no]['satuan_nama'] = @$this->DataModel->selectSatuan($key['satuan'])[0]['Uraian'];
                    
                    $no++;
                }
                $jumDataAll = $this->PraRkaModel->getCount($search, $post);
                $jumlahDatainPage = $this->PraRkaModel->getJumlahInPage();
                $jumlahPage = ceil($jumDataAll/$jumlahDatainPage);
                $dataTambah =array('tahun' => $tahun);
                $data = $dataAll;
                $kirim['dataUrusan'] = $this->DataModel->getUrusan();
                $kirim['dataRek4'] = $this->DataModel->getRekening4(5, 2, 2);
                $kirim['dataSatuan'] = $this->DataModel->getSatuan();
            }
            
            $dataOpd = @$this->DataModel->getDataOpd($post['user_id'])[0];
            $kirim['dataOpd'] = $dataOpd;
        }
        
        $kirim['jumlahAll'] = $jumDataAll;
        $kirim['jumlahPage'] = $jumlahPage;
        $kirim['data'] = $data;
        $kirim['dataTambah'] = $dataTambah;
        
        $kirim['status'] = $status;
        
        if($save == 'pdf'){
            $this->load->library('M_pdf');
            $this->m_pdf->getPdf($nameFile, $linkSavePDF, $kirim);
        }else if($save == 'excel'){
            $this->exportExcel($nameFile, $kirim['data']);
        }else{
            echo json_encode($kirim);
        }
    }
    
    public function create($name){
        $status = false;
        $session = $this->myconfig->getSession($this->input->post('session'), $this->level, $this->akun);
        if(@$session['status']){
            $status = $session['status'];
        }
        $pesan = "Gagal Memasukkan data";
        // print_r($this->input->post());
        if($status){
            $post = $this->input->post();
            $post['user_id'] = $session['id'];
            
            
            if($name == "opd_pegawai"){
                $this->load->model('opd/PegawaiModel');
                $status = $this->PegawaiModel->create($post);
            }

            if($name == "opd_visi"){
                $this->load->model('opd/VisiModel');
                $status = $this->VisiModel->create($post);
            }

            if($name == "opd_visi_penjelasan"){
                $this->load->model('opd/VisiPenjelasanModel');
                $status = $this->VisiPenjelasanModel->create($post);
            }
            

            if($name == "opd_misi"){
                $this->load->model('opd/MisiModel');
                $status = $this->MisiModel->create($post);
            }

            if($name == "opd_tujuan"){
                $this->load->model('opd/TujuanModel');
                $status = $this->TujuanModel->create($post);
            }

            if($name == "opd_sasaran"){
                $this->load->model('opd/SasaranModel');
                $status = $this->SasaranModel->create($post);
            }

            if($name == "opd_indikator"){
                $this->load->model('opd/IndikatorModel');
                $status = $this->IndikatorModel->create($post);
            }

            if($name == "opd_pagu"){
                $this->load->model('bappeda/OpdPaguModel');
                $status = $this->OpdPaguModel->create($post);
            }

            if($name == "opd_renstra_kab" || $name == "opd_renstra_opd"){
                if($name == "opd_renstra_opd"){
                    $post['name'] = 'opd';
                }
                $this->load->model('opd/RenstraKabModel');
                $status = $this->RenstraKabModel->create($post);
            }

            if($name == "opd_rkpd_verifikasi"){
                $this->load->model('opd/RkpdVerifikasiModel');
                $status = $this->RkpdVerifikasiModel->create($post);
            }
            
            if($name == "opd_pra_rka"){
                $this->load->model('opd/PraRkaModel');
                $status = $this->PraRkaModel->create($post);
            }
            
            if($status)
                $pesan = "Berhasil Memasukkan Data";
        }
        // print_r($post['foto']);
        $kirim = array(
            'pesan' => $pesan,
			'status' => $status
		);
		echo json_encode($kirim);

    }

    public function update($name){
        $status = false;
        $session = $this->myconfig->getSession($this->input->post('session'), $this->level, $this->akun);
        if(@$session['status']){
            $status = $session['status'];
        }
        // echo "sd";
        $pesan = "Gagal Mengubah data";
        // print_r($this->input->post());
        if($status){
            $post = $this->input->post();
            $post['user_id'] = $session['id'];
            // print_r($_FILES);
            if($name == "opd_pegawai"){
                $this->load->model('opd/PegawaiModel');
                $status = $this->PegawaiModel->update($post);
            }

            if($name == "opd_visi"){
                $this->load->model('opd/VisiModel');
                $status = $this->VisiModel->update($post);
            }

            if($name == "opd_visi_penjelasan"){
                $this->load->model('opd/VisiPenjelasanModel');
                $status = $this->VisiPenjelasanModel->update($post);
            }

            if($name == "opd_misi"){
                $this->load->model('opd/MisiModel');
                $status = $this->MisiModel->update($post);
            }

            if($name == "opd_tujuan"){
                $this->load->model('opd/TujuanModel');
                $status = $this->TujuanModel->update($post);
            }

            if($name == "opd_sasaran"){
                $this->load->model('opd/SasaranModel');
                $status = $this->SasaranModel->update($post);
            }

            if($name == "opd_indikator"){
                $this->load->model('opd/IndikatorModel');
                $status = $this->IndikatorModel->update($post);
            }

            if($name == "opd_pagu"){
                $this->load->model('bappeda/OpdPaguModel');
                $status = $this->OpdPaguModel->update($post);
            }

            if($name == "opd_renstra_kab" || $name == "opd_renstra_opd"){
                if($name == "opd_renstra_opd"){
                    $post['name'] = 'opd';
                }
                $this->load->model('opd/RenstraKabModel');
                $status = $this->RenstraKabModel->update($post);
            }

            if($name == "opd_rkpd_awal"){
                $this->load->model('opd/RkpdAwalModel');
                $status = $this->RkpdAwalModel->update($post);
            }

            if($name == "opd_rkpd_verifikasi"){
                $this->load->model('opd/RkpdVerifikasiModel');
                $status = $this->RkpdVerifikasiModel->update($post);
            }

            if($name == "opd_pra_rka"){
                $this->load->model('opd/PraRkaModel');
                $status = $this->PraRkaModel->update($post);
                $this->PraRkaModel->setJumlahAll($post);
            }
            
            if($status)
                $pesan = "Berhasil Mengubah Data";
        }

        $kirim = array(
            'pesan' => $pesan,
			'status' => $status
		);
		echo json_encode($kirim);

    }

    public function delete($name){
        $status = false;
        $session = $this->myconfig->getSession($this->input->post('session'), $this->level, $this->akun);
        if(@$session['status']){
            $status = $session['status'];
        }
        $pesan = "Gagal Menghapus data";
        // print_r($this->input->post());
        if($status){
            $post = $this->input->post();
            $post['user_id'] = $session['id'];

            if($name == "opd_pegawai"){
                $this->load->model('opd/PegawaiModel');
                $status = $this->PegawaiModel->delete($post);
            }

            if($name == "opd_visi_penjelasan"){
                $this->load->model('opd/VisiPenjelasanModel');
                $status = $this->VisiPenjelasanModel->delete($post);
            }

            if($name == "opd_misi"){
                $this->load->model('opd/MisiModel');
                $status = $this->MisiModel->delete($post);
            }
            if($name == "opd_tujuan"){
                $this->load->model('opd/TujuanModel');
                $status = $this->TujuanModel->delete($post);
            }

            if($name == "opd_sasaran"){
                $this->load->model('opd/SasaranModel');
                $status = $this->SasaranModel->delete($post);
            }

            if($name == "opd_indikator"){
                $this->load->model('opd/IndikatorModel');
                $status = $this->IndikatorModel->delete($post);
            }

            if($name == "opd_pagu"){
                $this->load->model('bappeda/OpdPaguModel');
                $status = $this->OpdPaguModel->delete($post);
            }

            if($name == "opd_renstra_kab" || $name == "opd_renstra_opd"){
                if($name == "opd_renstra_opd"){
                    $post['name'] = 'opd';
                }
                $this->load->model('opd/RenstraKabModel');
                $status = $this->RenstraKabModel->delete($post);
            }

            if($name == "opd_rkpd_verifikasi"){
                $this->load->model('opd/RkpdVerifikasiModel');
                $status = $this->RkpdVerifikasiModel->delete($post);
            }

            if($name == "opd_pra_rka"){
                
                $this->load->model('opd/PraRkaModel');
                $status = $this->PraRkaModel->delete($post);
            }
            
            if($status)
                $pesan = "Berhasil Menghapus Data";
        }

        $kirim = array(
            'pesan' => $pesan,
			'status' => $status
		);
		echo json_encode($kirim);

    }

    public function other($name){
        $status = false;
        $session = $this->myconfig->getSession($this->input->post('session'), $this->level, $this->akun);
        if(@$session['status']){
            $status = $session['status'];
        }
        $pesan = "Gagal Memproses data";
        if($status){
            $post = $this->input->post();
            $post['user_id'] = $session['id'];

            if($name == "opd_renja_awal"){
                $this->load->model('opd/RkpdVerifikasiModel');
                $status = $this->RkpdVerifikasiModel->kirim($post);
                if($status)
                    $pesan = "Berhasil Mengirim Data";
            }

            if($name == "opd_renja_perubahan"){
                $this->load->model('opd/RkpdVerifikasiModel');
                $status = $this->RkpdVerifikasiModel->kirim($post, 'ta_rkpd_perubahan');
                if($status)
                    $pesan = "Berhasil Mengirim Data";
            }
            
            if($name == "opd_pra_rka"){
                $this->load->model('opd/RkpdVerifikasiModel');
                $status = $this->RkpdVerifikasiModel->kirimFromBappeda($post);
                if($status)
                    $pesan = "Berhasil Mengirim Data";
            }

            if($name == "opd_pra_rka_perubahan"){
                $this->load->model('opd/RkpdVerifikasiModel');
                $status = $this->RkpdVerifikasiModel->kirimFromBappeda($post, 'ta_rkpd_perubahan');
                if($status)
                    $pesan = "Berhasil Mengirim Data";
            }
        }

        $kirim = array(
            'pesan' => $pesan,
			'status' => $status
		);
		echo json_encode($kirim);
    }

    function exportExcel($name='data', $data)
    {
        $this->load->library("excel");

        $fileName = $name."-".time();

        $object = new PHPExcel();

        $object->setActiveSheetIndex(0);

        if($name == 'visi'){
            $table_columns = array(
                "Nomor",
                "Visi", 
            );
    
            $column = 0;
    
            foreach($table_columns as $field)
            {
                $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
                $column++;
            }
    
            
            $excel_row = 2;
            $nomor = 1;
            foreach($data as $row)
            {
                $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $nomor);
                $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['opd_visi_nama']);
                $excel_row++;
                $nomor++;
            }
        }else if($name == 'visi-penjelasan'){
            $table_columns = array(
                "Nomor",
                "Visi Penjelasan", 
            );
    
            $column = 0;
    
            foreach($table_columns as $field)
            {
                $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
                $column++;
            }
    
            
            $excel_row = 2;
            $nomor = 1;
            foreach($data as $row)
            {
                $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $nomor);
                $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['opd_visi_penjelasan_nama']);
                $excel_row++;
                $nomor++;
            }
        }else if($name == 'misi'){
            $table_columns = array(
                "Nomor",
                "Visi",
                "Misi", 
            );
    
            $column = 0;
    
            foreach($table_columns as $field)
            {
                $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
                $column++;
            }
    
            
            $excel_row = 2;
            $nomor = 1;
            foreach($data as $row)
            {
                $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $nomor);
                $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['opd_visi_nama']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['opd_misi_nama']);
                $excel_row++;
                $nomor++;
            }
        }else if($name == 'tujuan'){
            $table_columns = array(
                "Nomor",
                "Misi",
                "Tujuan", 
            );
    
            $column = 0;
    
            foreach($table_columns as $field)
            {
                $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
                $column++;
            }
    
            
            $excel_row = 2;
            $nomor = 1;
            foreach($data as $row)
            {
                $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $nomor);
                $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['opd_misi_nama']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['opd_tujuan_nama']);
                $excel_row++;
                $nomor++;
            }
        }else if($name == 'sasaran'){
            $table_columns = array(
                "Nomor",
                "Tujuan",
                "Sasaran", 
            );
    
            $column = 0;
    
            foreach($table_columns as $field)
            {
                $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
                $column++;
            }
    
            
            $excel_row = 2;
            $nomor = 1;
            foreach($data as $row)
            {
                $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $nomor);
                $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['opd_tujuan_nama']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['opd_sasaran_nama']);
                $excel_row++;
                $nomor++;
            }
        }else if($name == 'indikator'){
            $table_columns = array(
                "Nomor",
                "Sasaran",
                "Indikator", 
            );
    
            $column = 0;
    
            foreach($table_columns as $field)
            {
                $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
                $column++;
            }
    
            
            $excel_row = 2;
            $nomor = 1;
            foreach($data as $row)
            {
                $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $nomor);
                $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['opd_sasaran_nama']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['opd_indikator_nama']);
                $excel_row++;
                $nomor++;
            }
        }else if($name == 'pegawai'){
            $table_columns = array(
                "Nomor",
                "Nama",
                "Jenis Kelamin",
                "NIP",
                "Golongan",
                "Pangkat",
                "Jabatan",
                "Pendidikan",
            );
    
            $column = 0;
    
            foreach($table_columns as $field)
            {
                $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
                $column++;
            }
    
            
            $excel_row = 2;
            $nomor = 1;
            foreach($data as $row)
            {
                $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $nomor);
                $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['opd_pegawai_nama']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['opd_pegawai_jk']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row['opd_pegawai_nip']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row['opd_pegawai_golongan']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row['opd_pegawai_pangkat']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row['opd_pegawai_jabatan']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row['opd_pegawai_pendidikan']);
                $excel_row++;
                $nomor++;
            }
        }else if($name == 'renstra-opd'){
            $this->load->library("excel");

            $fileName = $name."-".time();
    
            $object = new PHPExcel();
    
            $object->setActiveSheetIndex(0);
    
            $table_columns = array(
                array(
                    "Tujuan",
                    "Sasaran",
                    "Indikator",
                    "Kode",
                    "Program",
                    "Kegiatan",
                    "Indikator Kinerka (Outcome)",
                    "",
                    "Kondisi Kinerja pada Awal RPJMD (Tahun 0)",
                    "Capaian Kerja",
                    "",
                    "",
                    "",
                    "",
                    "",
                    "",
                    "",
                    "",
                    "",
                    "",
                    "",
                    "Lokasi",
                    "Penanggungjawab",
                ),
                array(
                    "",
                    "",
                    "",
                    "",
                    "",
                    "",
                    "Program",
                    "Kegiatan",
                    "",
                    "2019",
                    "",
                    "2020",
                    "",
                    "2021",
                    "",
                    "2022",
                    "",
                    "2023",
                    "",
                    "Kondisi Kinerja Akhir Periode",
                    "",
                    "",
                    "",
                ),
                array(
                    "",
                    "",
                    "",
                    "",
                    "",
                    "",
                    "",
                    "",
                    "",
                    "Target",
                    "Rp",
                    "Target",
                    "Rp",
                    "Target",
                    "Rp",
                    "Target",
                    "Rp",
                    "Target",
                    "Rp",
                    "Target",
                    "Rp",
                    "",
                    "",
                )
    
            );
    
            $column = 0;
            $row = 1;
            foreach($table_columns as $field)
            {
                $column = 0;
                foreach($field as $field2){
                    $object->getActiveSheet()->setCellValueByColumnAndRow($column, $row, $field2);
                    $column++;
                }
                $row++;            
            }
    
            $excel_row = $row;
            $nomor = 1;
            foreach($data as $row)
            {
                
                if($row['Kd_Keg'] == null || $row['Kd_Keg'] == ''){
                    
                    $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row['tujuan_nama']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['sasaran_nama']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['indikator_nama']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row['Kd_Urusan']." ".$row['Kd_Bidang']." ".$row['Kd_Prog']." ".$row['Kd_Keg']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row['Ket_Program']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row['Ket_Kegiatan']);

                }else{
                    $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row['tujuan_nama']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['sasaran_nama']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['indikator_nama']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row['Kd_Urusan']." ".$row['Kd_Bidang']." ".$row['Kd_Prog']." ".$row['Kd_Keg']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row['Ket_Program']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row['Ket_Kegiatan']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row['outcome']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row['outcome_kegiatan']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $row['kondisi_awal']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $row['target1_tahun']." ".$row['target1_satuan_nama']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $row['target1_harga']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $row['target2_tahun']." ".$row['target2_satuan_nama']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, $row['target2_harga']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, $row['target3_tahun']." ".$row['target3_satuan_nama']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(14, $excel_row, $row['target3_harga']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(15, $excel_row, $row['target4_tahun']." ".$row['target4_satuan_nama']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(16, $excel_row, $row['target4_harga']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(17, $excel_row, $row['target5_tahun']." ".$row['target5_satuan_nama']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(18, $excel_row, $row['target5_harga']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(19, $excel_row, $row['akhir_target']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(20, $excel_row, ($row['target1_harga']+$row['target2_harga']+$row['target3_harga']+$row['target4_harga']+$row['target5_harga']));
                    $object->getActiveSheet()->setCellValueByColumnAndRow(21, $excel_row, $row['lokasi']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(22, $excel_row, $row['Nm_Sub_Unit']);
                }
                $excel_row++;
            }
        }else if($name == 'RKPD'){
            $this->load->library("excel");

            $fileName = $name."-".time();
    
            $object = new PHPExcel();
    
            $object->setActiveSheetIndex(0);
    
            $table_columns = array(
                array(
                    "Kode",
                    "",
                    "",
                    "",
                    "Urusan / Bidang / Program / Kegiatan",
                    "",
                    "",
                    "",
                    "Indikator Kinerka (Outcome)",
                    "",
                    "Tahun",
                    "",
                    "",
                    "",
                    "",
                    "",
                    "Tahun",
                    "",
                    "",
                    "OPD",
                ),
                array(
                    "",
                    "",
                    "",
                    "",
                    "",
                    "",
                    "",
                    "",
                    "Program",
                    "Kegiatan",
                    "Lokasi",
                    "Target capaian kinerja",
                    "",
                    "Kebutuhan Dana/ pagu indikatif (Rp)",
                    "Sumber Dana",
                    "Catatan Penting",
                    "Target capaian kinerja",
                    "",
                    "Kebutuhan Dana/ pagu indikatif (Rp)",
                ),
                array(
                    "(1)",
                    "",
                    "",
                    "",
                    "(2)",
                    "",
                    "",
                    "",
                    "(3)",
                    "",
                    "(4)",
                    "(5)",
                    "",
                    "(6)",
                    "(7)",
                    "(8)",
                    "(9)",
                    "",
                    "(10)",
                    "(11)",
                )
    
            );
    
            $column = 0;
            $row = 1;
            foreach($table_columns as $field)
            {
                $column = 0;
                foreach($field as $field2){
                    $object->getActiveSheet()->setCellValueByColumnAndRow($column, $row, $field2);
                    $column++;
                }
                $row++;            
            }
    
            $excel_row = $row;
            $nomor = 1;
        // print_r($data);
            $tahun = 1+$this->tahun-@$data[0]['rpjmd_tahun'];
            foreach($data as $row)
            {
                if($row['Kd_Keg'] == null || $row['Kd_Keg'] == ''){
                    $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row['Kd_Urusan']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['Kd_Bidang']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['Kd_Prog']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row['Kd_Keg']." ".$row['Kd_Bidang']." ".$row['Kd_Prog']." ".$row['Kd_Keg']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row['Nm_Urusan']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row['Nm_Bidang']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row['Ket_Program']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row['Ket_Kegiatan']);
                }else{
                    $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row['Kd_Urusan']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['Kd_Bidang']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['Kd_Prog']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row['Kd_Keg']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row['Nm_Urusan']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row['Nm_Bidang']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row['Ket_Program']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row['Ket_Kegiatan']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $row['outcome']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $row['outcome_kegiatan']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $row['kondisi_awal']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $row['target'.$tahun.'_tahun']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, $row['target'.$tahun.'_satuan_nama']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, $row['target'.$tahun.'_harga']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(14, $excel_row, $row['target'.$tahun.'_sumber_dana']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(15, $excel_row, $row['target'.$tahun.'_catatan']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(16, $excel_row, $row['target'.($tahun+1).'_tahun']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(17, $excel_row, $row['target'.($tahun+1).'_satuan_nama']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(18, $excel_row, $row['target'.($tahun+1).'_harga']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(19, $excel_row, $row['Nm_Sub_Unit']);
                }
                $excel_row++;
            }
        }else if($name == 'Rka'){
            $this->load->library("excel");

            $fileName = $name."-".time();
    
            $object = new PHPExcel();
    
            $object->setActiveSheetIndex(0);
    
            $table_columns = array(
               
                array(
                    "RENCANA KERJA DAN ANGGARAN",
                    "",
                    "",
                    "PRA",
                ),
                array(
                    "SATUAN KERJA PERANGKAT DAERAH",
                    "",
                    "",
                    "RKA - OPD",
                ),
                array(
                    "KABUPATEN MOROWALI",
                    "",
                    "",
                    "2.2.1",
                )
    
            );
    
            $column = 0;
            $row = 1;
            foreach($table_columns as $field)
            {
                $column = 0;
                foreach($field as $field2){
                    $object->getActiveSheet()->setCellValueByColumnAndRow($column, $row, $field2);
                    $column++;
                }
                $row++;            
            }
    
            $excel_row = $row;
            $nomor = 1;
            $countRow = 0;
        // print_r($data);
            $tahun = 1+$this->tahun-@$data[0]['rpjmd_tahun'];
            foreach($data as $row)
            {
                if($countRow == 0){
                    $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, "Urusan Pemerintahan");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, ":");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['Nm_Sub_Unit']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row['Nm_Sub_Unit']);
                }else if($countRow == 1){
                    $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, "Organisasi");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, ":");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['Nm_Sub_Unit']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row['Nm_Sub_Unit']);
                }else if($countRow == 2){
                    $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, "Unit Organisasi");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, ":");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['Nm_Sub_Unit']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row['Nm_Sub_Unit']);
                }else if($countRow == 3){
                    $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, "Sub Unit Organisasi");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, ":");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['Nm_Sub_Unit']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row['Nm_Sub_Unit']);
                }else if($countRow == 4){
                    $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, "Program");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, ":");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['Nm_Sub_Unit']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row['Nm_Sub_Unit']);
                }else if($countRow == 5){
                    $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, "Kegiatan");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, ":");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['Nm_Sub_Unit']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row['Nm_Sub_Unit']);
                }else if($countRow == 6){
                    $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, "Lokasi Kegiatan");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, ":");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['Nm_Sub_Unit']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row['Nm_Sub_Unit']);
                }else if($countRow == 7){
                    $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, "Jumlah Tahun n - 1");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, ":");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['Nm_Sub_Unit']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row['Nm_Sub_Unit']);
                }else if($countRow == 8){
                    $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, "Jumlah Tahun n");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, ":");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['Nm_Sub_Unit']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row['Nm_Sub_Unit']);
                }else if($countRow == 9){
                    $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, "Jumlah Tahun n + 1");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, ":");
                    $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['Nm_Sub_Unit']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row['Nm_Sub_Unit']);
                }
                
                $countRow++;
                $excel_row++;
            }

            // echo "sasasa";
        }
        
        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$fileName.'.xls"');
        $object_writer->save('php://output');
    }

}