<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SaveController extends CI_Controller {

	private $zona;

	public function __construct()
    {
        parent::__construct();
        $this->load->model('SaveModel');
		$this->load->library('Fungsi');
		
		$this->load->library('AdminTemplate');
		$this->admintemplate->cekLevel('admin');
    }

    public function index($name = 'ssh'){

    	$data['title'] = "SSH | Admin Satuan Harga";
		$data['menu'] = "laporan";
		if($name == 'ssh'){
			$data['menuLevel'] = 1;
		}else if($name == 'hspk'){
			$data['menuLevel'] = 2;
		}else if($name == 'asb'){
			$data['menuLevel'] = 3;
		}else{
			$data['menuLevel'] = 4;
		}

    	$dataTemplate['isi'] = $this->load->view('save/laporan', $data, true);
		$dataTemplate['myScript'] = $this->load->view('save/script.php', null, true);
		//$dataTemplate['navigator'] = $this->load->view('include/navigator', $data, true);

		$dataTemplate['head'] = $this->load->view('include/head.php', null, true);
		$dataTemplate['header'] = $this->load->view('include/header.php', null, true);
		$dataTemplate['sidebar'] = $this->load->view('include/sidebar.php', null, true);

		$dataTemplate['footer'] = $this->load->view('include/footer.php', null, true);
		$dataTemplate['script'] = $this->load->view('include/script.php', null, true);
		

		$this->admintemplate->templateAdmin($dataTemplate, false);
    }

    public function show($name = 'asb',$kode = 0, $kode2 = 0){

    	$data['kode'] = $kode;
    	$data['kode2'] = $kode2;
    	$this->load->view('save/'.$name, $data);
    }

    #save to pdf
  	public function save($name = 'asb',$kode = 0, $kode2 = 0)
  	{
  		ini_set('max_execution_time', 0); 
		ini_set('memory_limit','2048M');
	    //load mPDF library
	    $this->load->library('M_pdf');
	    $namaTambahan = '';
	    if(@$this->input->get('kode1')){
	    	$kode = $this->input->get('kode1');
	    	$namaTambahan =$namaTambahan.$kode."-";
	    }
	    if(@$this->input->get('kode2')){
	    	$kode2 = $this->input->get('kode2');
	    	$namaTambahan =$kode2."-";
	    	//$kode2 = explode('-', $this->input->get('kode2'))[1]; 
	    }



	    #load data
	    $data['kode'] = $kode;
	    $data['kode2'] = $kode2;
	 
	    //load the pdf_output.php by passing our data and get all data in $html varriable.
	    $html = $this->load->view('save/'.$name,$data, true); 
	   
	    //this the the PDF filename that user will get to download
	    $pdfFilePath =$name."-".$namaTambahan."-".time()."-download.pdf";
	 
	    
	    //actually, you can pass mPDF parameter on this load() function
	    $pdf = $this->m_pdf->load();


		$pdf->mirrorMargins = 1; // Use different Odd/Even headers and footers and mirror margins

	   	$pdf->defaultheaderfontsize = 10; /* in pts */
	   	$pdf->defaultheaderfontstyle = B; /* blank, B, I, or BI */
	   	//$pdf->defaultheaderline = 1;  /* 1 to include line below header/above footer */

	   	$pdf->defaultfooterfontsize = 9; /* in pts */
	   	$pdf->defaultfooterfontstyle = I; /* blank, B, I, or BI */
	   	//$pdf->defaultfooterline = 1;  /* 1 to include line below header/above footer */

	   	$pdf->SetHeader('Dicetak dari: Sistem Standar Satuan Harga Kota Morowali pada 05-12-2018');
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
     
      
  	}

  	

}