<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminTemplate {

	private  $CI;

    public function __construct()
    {
        $this->CI =& get_instance();

        $this->CI->load->model('AdminModel');

    }

    public function cekStatusLogin(){
    	
    	if(!$this->CI->AdminModel->cekStatusLogin()){
    		redirect(base_url('admin/logout'));
    	}
    }

    public function cekLevel($user){

        if(!$this->CI->AdminModel->cekUser($user)){
    		redirect(base_url('admin'));
    	}
        
    }

    public function templateAdmin($data, $all = true, $user = 'admin'){
    	$this->cekStatusLogin();
    	?>
<!DOCTYPE html>
<html>
<head>
	<?=$data['head']?>

</head>
<body>
	<?=$data['header']?>
	<?=$data['sidebar']?>


	<div class="main-container">
		<div class="my-2 mx-2">
			<?=$data['isi']?>
			<?php if($all) echo $data['navigator']; 
			?>
			<?=$data['footer']?>
		</div>
	</div>

	<?=$data['script']?>
	<?=$data['myScript']?>


</body>
</html>


    	<?php

	}

	public function templateAdminSave($data, $all = true, $user = 'admin'){
    	$this->cekStatusLogin();
    	?>
<!DOCTYPE html>
<html>
<head>
	<?=$data['head']?>

</head>
<body>


	<div class="">
		<div class="my-2 mx-2">
			<?=$data['isi']?>
		</div>
	</div>

	<?=$data['script']?>
	<?=$data['myScript']?>


</body>
</html>


    	<?php

    }
}
