<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PokirController extends CI_Controller {

    private $level;
	public function __construct()
    {
		parent::__construct();
		$this->load->library('MyConfig');
        $this->load->model('PokirModel');
        $this->level = 3;
    }

    public function getData($page = 1, $api = true){
        
        $jumDataAll = 0;
        $status = $this->myconfig->check($this->input->post('session'), $this->level);
        $getToken = $this->PokirModel->getGrupToken($this->input->post('token'));
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
            $this->load->model('DataModel');
            $kategori = $this->DataModel->getKategori();
            $data = $this->PokirModel->getAll($page, $search, $getToken);
            $jumDataAll = $this->PokirModel->getCount($search, $getToken);
            $jumlahDatainPage = $this->PokirModel->getJumlahInPage();
            $jumlahPage = ceil($jumDataAll/$jumlahDatainPage);
		}else{
            $kategori = array();
            $data = array();
            $jumlahPage = 1;
        }
        
		$kirim = array(
            'jumlahAll' => $jumDataAll,
            'jumlahPage' => $jumlahPage,
			'data' => $data,
            'status' => $status,
            'kategori' => $kategori,
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
        // $getToken = $this->PokirModel->getGrupToken($this->input->post('token'));
        if(!@$session['status'] || !$session['status'] ){
            $status = false;
        }
        // $status = false;
		if($status){
            $search = '';
            if(@$this->input->post('search')){
                $search = $this->input->post('search');
            }
            $data = $this->PokirModel->getAllKiriman($page, $search, $session['id']);
            $jumDataAll = $this->PokirModel->getCountKiriman($search, $session['id']);
            $jumlahDatainPage = $this->PokirModel->getJumlahInPage();
            $jumlahPage = ceil($jumDataAll/$jumlahDatainPage);
		}else{
            $data = array();
            $jumlahPage = 1;
        }
        
		$kirim = array(
            'jumlahAll' => $jumDataAll,
            'jumlahPage' => $jumlahPage,
			'data' => $data,
			'status' => $status
        );

        echo json_encode($kirim);
    }
    
    public function create(){
        $status = $this->myconfig->check($this->input->post('session'), $this->level);
        $getToken = $this->PokirModel->getGrupToken($this->input->post('token'));
        if(@$getToken['user_id']){
            $user_id = $getToken['user_id'];
            $grup_id = $getToken['grup_id'];
        }else{
            $status = false;
        }
        $pesan = "Gagal Memasukkan data";
        $statusGrup = $this->PokirModel->ubahGrupPosisi($getToken['grup_id'], 7, array(9));
        if(!$statusGrup['status']){
            $pesan = $statusGrup['pesan'];
            $status = $statusGrup['status'];
        }
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
            $status = $this->PokirModel->create($post);
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
        $getToken = $this->PokirModel->getGrupToken($this->input->post('token'));
        if(!@$getToken['user_id']){
            $status = false;
        }
        // print_r($getToken);s
        $pesan = "Gagal Mengubah data";
        $statusGrup = $this->PokirModel->ubahGrupPosisi($getToken['grup_id'], 7, array(9));
        if(!$statusGrup['status']){
            $pesan = $statusGrup['pesan'];
            $status = $statusGrup['status'];
        }
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
            $status = $this->PokirModel->update($post);
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
        $getToken = $this->PokirModel->getGrupToken($this->input->post('token'));
        if(!@$getToken['user_id']){
            $status = false;
        }
        $pesan = "Gagal Menghapus data";
        $statusGrup = $this->PokirModel->ubahGrupPosisi($getToken['grup_id'], 7, array(9));
        if(!$statusGrup['status']){
            $pesan = $statusGrup['pesan'];
            $status = $statusGrup['status'];
        }
        // print_r($this->input->post());
        if($status){
            $post = $this->input->post();
            $post['grup_id'] = $getToken['grup_id'];
            $post['user_id'] = $getToken['user_id'];
            $status = $this->PokirModel->delete($post);
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
        $grup = $this->PokirModel->getGrup($this->input->post(), $session['id']);
        $token =  $this->PokirModel->createGrubToken($session['id'], $grup->id);
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
        $grup = $this->PokirModel->createGrup($date, $session['id']);
        $token =  $this->PokirModel->createGrubToken($session['id'], $grup->id);
        // $getToken = $this->KelurahanModel->getGrupToken($token);
        // print_r($getToken['user_id']);
        // $statusGrup = $this->PokirModel->ubahGrupPosisi($getToken['grup_id'], 3, array(4,5));
        // if(!$statusGrup['status']){
        //     $pesan = $statusGrup['pesan'];
        //     $status = $statusGrup['status'];
        // }

        $kirim = array(
            'token' => $token,
            'status' => true
        );

        echo json_encode($kirim);
    }

    public function uploadBerkas(){
        $pesan = "Gagal Memasukkan data";
        $status = $this->myconfig->check($this->input->post('session'), $this->level);
        $getToken = $this->PokirModel->getGrupToken($this->input->post('token'));
        if(@$getToken['user_id']){
            $user_id = $getToken['user_id'];
            $grup_id = $getToken['grup_id'];
        }else{
            $status = false;
        }

        $statusGrup = $this->PokirModel->ubahGrupPosisi($getToken['grup_id'], 8, array(5,6,9));
        if(!$statusGrup['status']){
            $pesan = $statusGrup['pesan'];
            $status = $statusGrup['status'];
        }

        
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
                $status = $this->PokirModel->uploadBerkas($post);
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
        $pesan = "Gagal Mengirim Data";
        $status = $this->myconfig->check($this->input->post('session'), $this->level);
        
        $getToken = $this->PokirModel->getGrupToken($this->input->post('token'));
        if(@$getToken['user_id']){
            $user_id = $getToken['user_id'];
            $grup_id = $getToken['grup_id'];
        }else{
            $status = false;
        }
        
        
        
        if($status){
            $post = $this->input->post();
            
            $post['grup_id'] = $getToken['grup_id'];
            $post['user_id'] = $getToken['user_id'];

            $statusGrup = $this->PokirModel->ubahGrupPosisi($getToken['grup_id'], 9, array(5,6,7,9));
            if(!$statusGrup['status']){
                $pesan = $statusGrup['pesan'];
                $status = $statusGrup['status'];
            }

            if($status)
                $status = $this->PokirModel->kirimBerkas($post);
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
        $getToken = $this->PokirModel->getGrupToken($this->input->post('token'));
        if(!@$getToken['user_id']){
            $status = false;
        }
        
        $pesan = "Gagal Membuat OPD";
        if($status){
            $post = $this->input->post();
            
            $post['grup_id'] = $getToken['grup_id'];
            $post['user_id'] = $getToken['user_id'];
            // print_r($post);
            $status = $this->PokirModel->createSkor($post);
            if($status)
                $pesan = "Berhasil Membuat OPD";
        }

        $kirim = array(
            'pesan' => $pesan,
			'status' => $status
		);
		echo json_encode($kirim);
    }
    
    public function getPdf($name = 'asb')
  	{
        $status = $this->myconfig->check($this->input->post('session'), $this->level);
        if($status){
            ini_set('max_execution_time', 0); 
            ini_set('memory_limit','2048M');
            //load mPDF library
            $this->load->library('M_pdf');

            $data['orang'] = 50;
            if(@$this->input->post('orang')){
                $data['orang'] = $this->input->post('orang');
            }

            $jenis = $this->input->post('jenis');

            #load data
            $getToken = $this->PokirModel->getGrupToken($this->input->post('token'));

            $data['asal'] = $this->PokirModel->getAsal($getToken['user_id']);

            if($jenis == "usulan"){
                $data['user'] = $this->PokirModel->getUser($getToken['user_id']);
                $data['data'] = $this->PokirModel->getAll(1, '', $getToken, true);
                $paran = "miring";
            }else{
                $statusGrup = $this->PokirModel->ubahGrupPosisi($getToken['grup_id'], 6, array(9));
                if(!$statusGrup['status']){
                    $pesan = $statusGrup['pesan'];
                    $status = $statusGrup['status'];
                }
            
                // $data['token'] = $getToken;
                $paran = NULL;
            }

            $html = $this->load->view('pokir/'.$jenis,$data, true); 
            // $this->load->view('kelurahan/'.$jenis,$data); 
           

            $pdfFilePath =$name."-".time()."-download.pdf";
         
            
            //actually, you can pass mPDF parameter on this load() function
            $pdf = $this->m_pdf->load($paran);
    
    
            $pdf->mirrorMargins = 1; // Use different Odd/Even headers and footers and mirror margins
    
            $pdf->defaultheaderfontsize = 10; /* in pts */
            $pdf->defaultheaderfontstyle = B; /* blank, B, I, or BI */
        //    $pdf->defaultheaderline = 1;  /* 1 to include line below header/above footer */

            $pdf->defaultfooterfontsize = 9; /* in pts */
            $pdf->defaultfooterfontstyle = I; /* blank, B, I, or BI */
            //$pdf->defaultfooterline = 1;  /* 1 to include line below header/above footer */

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
    
            //generate the PDF!
            $pdf->WriteHTML($html,2);
    
            //offer it to user via browser download! (The PDF won't be saved on your server HDD)
            $pdf->Output($pdfFilePath, "D");
        }else{
            echo "Download Gagal";
        }
  		
     
      
  	}
}



