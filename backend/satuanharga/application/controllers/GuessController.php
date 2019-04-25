<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GuessController extends CI_Controller {

	private $zona;

	public function __construct()
    {
        parent::__construct();
    }



    public function index(){

    	$data['title'] = "SSH | Admin Satuan Harga";
		$data['menu'] = "home";
		$data['menuLevel'] = 1;

    	$this->load->view('guess/login', $data);
    }

    public function checkNum($number) {
	  if($number>1) {
	    throw new Exception("Value must be 1 or below");
	  }
	  return true;
	}

    public function coba2(){
    	//trigger exception in a "try" block
    	error_reporting(0);
    	ini_set('display_errors', 0);
		try {
		  $this->checkNum(1);
		  //If the exception is thrown, this text will not be shown
		  echo 'If you see this, the number is 1 or below';
		}

		//catch exception
		catch(Exception $e) {
		  echo 'Message: ' .$e->getMessage();
		}
    }

    public function coba3(){
    	echo password_hash('qwe123', PASSWORD_DEFAULT);
    }

    public function coba(){
    	$this->load->model('RefHspkModel');
    	$row = 1;
    	$berhasil = 1;
    	$set = [];
		if (($handle = fopen(base_url()."public/file/ref_hspk.csv", "r")) !== FALSE) {

		    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		    	$data = str_replace("  "," ",$data);
		        $num = count($data);
		        echo "<p> $num fields in line $row: <br /></p>\n";
		        
		        for ($c=0; $c < $num; $c++) {
		        	
		        	$data[$c] = str_replace("\"","",$data[$c]);
		        	if($row == 1){
		        		$menu = explode(";", $data[$c]);
		        		//print_r($pisah);
		        	}else{
		        		if($num == 1){
			        		$pisah = explode(";", $data[$c]);
			        		for ($i=0; $i < count($menu); $i++) { 
			        			$set[$menu[$i]][$berhasil-1] = $pisah[$i];
			        		}
			        		
			        		$berhasil++;
			        	}
		        	}
		            echo $data[$c] . "<br />\n";
		        }
		        $row++;
		    }
		    fclose($handle);
		    for ($i=0; $i < count($set[$menu[1]]); $i++) { 
		    	echo ($i+1)."<br>";
		    	print_r($menu);
		    	echo "<br>";
		    	print_r($menu[1]);
		    	echo "<br>";
			    print_r($set[$menu[1]]);
			    echo "<br><br><br>";
		    }
		}
    }
}