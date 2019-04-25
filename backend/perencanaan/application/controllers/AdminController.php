<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller {

    private $level;
	public function __construct()
    {
		parent::__construct();
		$this->load->library('MyConfig');
        $this->load->model('AdminModel');
        $this->level = 5;
    }

    public function getData($page = 1, $api = true){
        
        $jumDataAll = 0;
        $status = $this->myconfig->check($this->input->post('session'), $this->level);
        $getToken = $this->AdminModel->getGrupToken($this->input->post('token'));
        if(@$getToken['user_id']){
            $user_id = $getToken['user_id'];
            $grup_id = $getToken['grup_id'];
        }else{
            $status = false;
        }
		if($status){
            $search = '';
            if(@$this->input->post('search')){
                $search = $this->input->post('search');
            }
            $data = $this->AdminModel->getAll($page, $search, $getToken);
            $jumDataAll = $this->AdminModel->getCount($search, $getToken);
            $jumlahDatainPage = $this->AdminModel->getJumlahInPage();
            $jumlahPage = ceil($jumDataAll/$jumlahDatainPage);
		}else{
            $data = array();
            $jumlahPage = 1;
            $kecamatan = array();
        }
        
		$kirim = array(
            'jumlahAll' => $jumDataAll,
            'jumlahPage' => $jumlahPage,
			'data' => $data,
            'status' => $status,
        );
        if($api)
            echo json_encode($kirim);
        else
            return json_encode($kirim);
    }

    public function getKiriman($page = 1){

        $jumDataAll = 0;
        $status = $this->myconfig->check($this->input->post('session'), $this->level);
        $session = $this->myconfig->getSession($this->input->post('session'), $this->level);
        // $getToken = $this->AdminModel->getGrupToken($this->input->post('token'));
        if(!@$session['status'] || !$session['status'] ){
            $status = false;
        }
        // $status = false;
		if($status){
            $search = '';
            if(@$this->input->post('search')){
                $search = $this->input->post('search');
            }
            // echo $this->input->post('kecamatan');
            $post = $this->input->post();
            $this->load->model('DataModel');
            $kecamatan = $this->DataModel->getKecamatan();
            $kategori = $this->DataModel->getKategori();
            $data = $this->AdminModel->getAllKiriman($page, $search, $session['id']);
            $jumDataAll = $this->AdminModel->getCountKiriman($search, $session['id']);
            $jumlahDatainPage = $this->AdminModel->getJumlahInPage();
            $jumlahPage = ceil($jumDataAll/$jumlahDatainPage);

            // print_r($data);
		}else{
            $data = array();
            $jumlahPage = 1;
            $kategori = array();
        }
        
		$kirim = array(
            'jumlahAll' => $jumDataAll,
            'jumlahPage' => $jumlahPage,
			'data' => $data,
            'status' => $status,
            'kecamatan'=> $kecamatan,
            'kategori' => $kategori,
        );

        echo json_encode($kirim);
    }
    public function getKirimanPokir($page = 1){
        $jumDataAll = 0;
        $status = $this->myconfig->check($this->input->post('session'), $this->level);
        $session = $this->myconfig->getSession($this->input->post('session'), $this->level);
        // $getToken = $this->AdminModel->getGrupToken($this->input->post('token'));
        if(!@$session['status'] || !$session['status'] ){
            $status = false;
        }
        // $status = false;
		if($status){
            $search = '';
            if(@$this->input->post('search')){
                $search = $this->input->post('search');
            }
            // echo $this->input->post('kecamatan');
            $post = $this->input->post();
            $this->load->model('DataModel');
            $kecamatan = $this->DataModel->getKecamatan();
            $kategori = $this->DataModel->getKategori();
            $data = array();
            $dataSet = array();
            $kd_asal = array();
            $data = $this->AdminModel->getAllKirimanPokir($page, $search, $session['id']);
            $jumDataAll = $this->AdminModel->getCountKirimanPokir($search, $session['id']);
            $jumlahDatainPage = $this->AdminModel->getJumlahInPage();
            $jumlahPage = ceil($jumDataAll/$jumlahDatainPage);
            $dataSet = array();
            $no=0;
            foreach($data as $key){
                $dataSet[$no] = $key;
                $kd_asal = explode('-',$key['kd_asal']);
                if(count($kd_asal)==3){
                    $dataSet[$no]['kecamatan'] = $this->DataModel->findKec($kd_asal[0])[0]['Nm_Kec'];
                    $dataSet[$no]['kelurahan'] = $this->DataModel->findKel($kd_asal[1],$kd_asal[2])[0]['Nm_Kel'];
    
                }else{
                    $dataSet[$no]['kecamatan'] = null;
                    $dataSet[$no]['kelurahan'] = null;

                }
                
                $no++;

            }

            // print_r($data);
		}else{
            $dataSet = array();
            $jumlahPage = 1;
            $kategori = array();
            $kecamatan = array();
            $kategori = array();
            $kd_asal = array();
        }
        
		$kirim = array(
            'jumlahAll' => $jumDataAll,
            'jumlahPage' => $jumlahPage,
			'data' => $dataSet,
            'status' => $status,
            'kecamatan'=> $kecamatan,
            'kategori' => $kategori,
            'asal'=> $kd_asal,
        );

        echo json_encode($kirim);
    }
    
    public function create(){
        $status = $this->myconfig->check($this->input->post('session'), $this->level);
        $getToken = $this->AdminModel->getGrupToken($this->input->post('token'));
        if(@$getToken['user_id']){
            $user_id = $getToken['user_id'];
            $grup_id = $getToken['grup_id'];
        }else{
            $status = false;
        }
        $pesan = "Gagal Memasukkan data";
        // print_r($this->input->post());
        if($status){
            $post = $this->input->post();
            if(@$_FILES['file']){
                $post['foto'] = $this->myconfig->imageUpload("file", "foto_", "foto-pokir");
            }else{
                $post['foto'] = 'no-image.png';
            }
            

            $post['grup_id'] = $getToken['grup_id'];
            $post['user_id'] = $getToken['user_id'];
            $status = $this->AdminModel->create($post);
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

    public function update(){
        $status = $this->myconfig->check($this->input->post('session'), $this->level);
        $getToken = $this->AdminModel->getGrupToken($this->input->post('token'));
        if(!@$getToken['user_id']){
            $status = false;
        }
        // print_r($getToken);s
        $pesan = "Gagal Mengubah data";
        // print_r($this->input->post());
        if($status){
            $post = $this->input->post();
            // print_r($_FILES);
            if(@$_FILES['file']){
                $post['foto'] = $this->myconfig->imageUpload("file", "foto_", "foto-pokir");
            }else{
                $post['foto'] = '';
            }

            $post['grup_id'] = $getToken['grup_id'];
            $post['user_id'] = $getToken['user_id'];
            $status = $this->AdminModel->update($post);
            if($status)
                $pesan = "Berhasil Mengubah Data";
        }

        $kirim = array(
            'pesan' => $pesan,
			'status' => $status
		);
		echo json_encode($kirim);

    }

    public function delete(){
        $status = $this->myconfig->check($this->input->post('session'), $this->level);
        $getToken = $this->AdminModel->getGrupToken($this->input->post('token'));
        if(!@$getToken['user_id']){
            $status = false;
        }
        $pesan = "Gagal Menghapus data";
        // print_r($this->input->post());
        if($status){
            $post = $this->input->post();
            $post['grup_id'] = $getToken['grup_id'];
            $post['user_id'] = $getToken['user_id'];
            $status = $this->AdminModel->delete($post);
            if($status)
                $pesan = "Berhasil Menghapus Data";
        }

        $kirim = array(
            'pesan' => $pesan,
			'status' => $status
		);
		echo json_encode($kirim);

    }

    public function getGrup(){
        $session = $this->myconfig->getSession($this->input->post('session'), $this->level);
        $grup = $this->AdminModel->getGrup($this->input->post(), $session['id']);
        $token =  $this->AdminModel->createGrubToken($session['id'], @$grup->id);
        // $getToken = $this->KelurahanModel->getGrupToken($token);
        // print_r($getToken['user_id']);

        $kirim = array(
            'token' => $token,
            'status' => true
        );

        echo json_encode($kirim);
    }

    public function createGrup(){
        $session = $this->myconfig->getSession($this->input->post('session'), $this->level);
        $date = date("Y-m-d H:i:s");
        $grup = $this->AdminModel->createGrup($date, $session['id']);
        $token =  $this->AdminModel->createGrubToken($session['id'], $grup->id);
        // $getToken = $this->KelurahanModel->getGrupToken($token);
        // print_r($getToken['user_id']);

        $kirim = array(
            'token' => $token,
            'status' => true
        );

        echo json_encode($kirim);
    }

    public function uploadBerkas(){
        $status = $this->myconfig->check($this->input->post('session'), $this->level);
        $getToken = $this->AdminModel->getGrupToken($this->input->post('token'));
        if(@$getToken['user_id']){
            $user_id = $getToken['user_id'];
            $grup_id = $getToken['grup_id'];
        }else{
            $status = false;
        }
        $pesan = "Gagal Memasukkan data";
        // print_r($_FILES);
        if($status){
            $post = $this->input->post();
            
            // echo "ba =>".$post['ba'];

            if(@$_FILES['usulan']){
                $post['usulan'] = $this->myconfig->imageUpload("usulan", "usulan_", "usulan-pokir", true);
            }else{
                $post['usulan'] = 'no-image.png';
            }
            // echo "usulan =>".$post['usulan'];
            
            if($post['usulan'] == 'no-image.png' ){
                $status = false;
            }

            $post['grup_id'] = $getToken['grup_id'];
            $post['user_id'] = $getToken['user_id'];
            if($status)
                $status = $this->AdminModel->uploadBerkas($post);
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

    public function kirimBerkas(){
        // print_r($_POST);
        $status = $this->myconfig->check($this->input->post('session'), $this->level);
        
        $getToken = $this->AdminModel->getGrupToken($this->input->post('token'));
        if(@$getToken['user_id']){
            $user_id = $getToken['user_id'];
            $grup_id = $getToken['grup_id'];
        }else{
            $status = false;
        }
        
        $pesan = "Gagal Memasukkan data";
        // print_r($_FILES);
        if($status){
            $post = $this->input->post();
            
            $post['grup_id'] = $getToken['grup_id'];
            $post['user_id'] = $getToken['user_id'];

            $status = $this->AdminModel->kirimBerkas($post);
            // print_r($status);
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

    public function createSkor(){
        
        $status = $this->myconfig->check($this->input->post('session'), $this->level);
        $getToken = $this->AdminModel->getGrupToken($this->input->post('token'));
        if(!@$getToken['user_id']){
            $status = false;
        }
        
        $pesan = "Gagal Membuat Skor";
        if($status){
            $post = $this->input->post();
            
            $post['grup_id'] = $getToken['grup_id'];
            $post['user_id'] = $getToken['user_id'];
            // print_r($post);
            $status = $this->AdminModel->createSkor($post);
            if($status)
                $pesan = "Berhasil Membuat Skor";
        }

        $kirim = array(
            'pesan' => $pesan,
			'status' => $status
		);
		echo json_encode($kirim);
    }
    
    public function getPdf($name = 'asb')
  	{
        $status = $this->myconfig->getSession($this->input->post('session'), $this->level);
        if($status){
            $this->load->model('DataModel');
            ini_set('max_execution_time', 0); 
            ini_set('memory_limit','2048M');
            //load mPDF library
            $this->load->library('M_pdf');

            $data['orang'] = 50;
            if(@$this->input->post('orang')){
                $data['orang'] = $this->input->post('orang');
            }
            $paran = "miring";
            $jenis = $this->input->post('jenis');
            $data['kecamatan'] = 0;
            $data['kategori'] = 0;
            if(@$this->input->post('kecamatan')){
                
                $data['kecamatan'] = $this->input->post('kecamatan');
            }

            if(@$this->input->post('pokir')){
                $data['pokir'] = true;
            }

            if(@$this->input->post('kategori')){
                $data['kategori'] = $this->input->post('kategori');
            }
            //$getToken = $this->KecamatanModel->getGrupToken($this->input->post('token'));
            $data['data'] = $this->AdminModel->getAll(1, '', null, true);


            #load data
            // $getToken = $this->AdminModel->getGrupToken($this->input->post('token'));

            // $data['asal'] = $this->AdminModel->getAsal($getToken['user_id']);

            // if($jenis == "usulan"){
            //     $data['user'] = $this->AdminModel->getUser($getToken['user_id']);
            //     $data['data'] = $this->AdminModel->getAll(1, '', $getToken, true);
            //     $paran = "miring";
            // }else{
                
            
            //     // $data['token'] = $getToken;
            //     $paran = NULL;
            // }
            // $html = $data['kecamatan'];
            $html = $this->load->view('admin/usulan',$data, true); 
            if($data['pokir']){
                $data['data'] = $this->AdminModel->getAllKirimanPokir(1, '', null, true);
                $html = $this->load->view('admin/usulan',$data, true); 
            }
            
            $pdfFilePath =$name."-".time()."-download.pdf";
         
            $pdf = $this->m_pdf->load($paran);
    
    
            $pdf->mirrorMargins = 1; 
    
            $pdf->defaultheaderfontsize = 10; /* in pts */
            $pdf->defaultheaderfontstyle = B; /* blank, B, I, or BI */

            $pdf->defaultfooterfontsize = 9; 
            $pdf->defaultfooterfontstyle = I; 

            $pdf->SetHeader('Dicetak dari: e-Musrenbang Kab. Morowali pada '.date("d").'-'.date("m").'-'.date("Y"));
            $pdf->SetFooter('Halaman {PAGENO}'); /* defines footer for Odd and Even Pages - placed at Outer margin */
            
            $pdf->AddPage('', // L - landscape, P - portrait 
                '', '', '', '',
                10, // margin_left
                10, // margin right
               20, // margin top
               20, // margin bottom
                0, // margin header
                0
            );
    
            $pdf->WriteHTML($html,2);
    
            $pdf->Output($pdfFilePath, "D");
        }else{
            echo "Download Gagal";
        }
  		
     
      
  	}
}



