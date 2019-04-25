<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MyConfig {

    private static $CI;
    private $max_width = '2000';
    private $max_height = '2000';

    public function __construct()
    {
        self::$CI = & get_instance();
        self::$CI->load->library('image_lib');
    }

	public function header($angka)
    {
        $domain = array(
            "",
            "*",
            "http://192.168.***.***:3000",
        );
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        if($angka != 0)
            header('Access-Control-Allow-Origin: '.$domain[$angka]);
    }


    public function check($session, $level, $cekStatus = false,  $akun = 2){
		$status = false;
		$codeSession = $session;
		$codeSession = str_replace('"', '', $codeSession);
        $decrypt = self::$CI->encryption->decrypt($codeSession);
        $arrSession = json_decode($decrypt, true);
        
        if($cekStatus){
            if($arrSession['status']){
                $this->header($arrSession['domain']);
                $status = true;
            }
        }else{
            if($arrSession['status'] && $arrSession['level'] == $level && $arrSession['akun'] == $akun ){
                $this->header($arrSession['domain']);
                $status = true;
            }
        }

        if(!$status){
            $this->header($arrSession['domain']);
            header("HTTP/1.1 403 Access Forbidden");
            die();
        }
		
		return $status;
    }

    public function getSession($session, $level = 1, $cekStatus = false, $akun = 2){
        $status = false;
		$codeSession = str_replace('"', '', $session);
        $decrypt = self::$CI->encryption->decrypt($codeSession);
        $arrSession = json_decode($decrypt, true);
        if($cekStatus){
            if($arrSession['status']){
                $this->header($arrSession['domain']);
                $status = true;
            }
        }else{
            if($arrSession['status'] && $arrSession['level'] == $level && $arrSession['akun'] == $akun){
                $this->header($arrSession['domain']);
                $status = true;
            }
        }
		

        if(!$status){
            $this->header($arrSession['domain']);
            header("HTTP/1.1 403 Access Forbidden");
            die();
        }
        
		return $arrSession;
    }
    
    public function password_hash($password){
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function imageUpload($var= 'gambar', $namaGambar = 'gambar_', $folder = 'galeri', $pdf = false)
    {
        $name = "no-image.png";
        
            if ($_FILES[$var]["name"])
            {

                $data = array();
                if(!$pdf){
                    $name = $namaGambar.time().'.gif';
                }else{
                    $name = $namaGambar.time().'.pdf';
                }

                $security = 0444;

                $path = './attachments';
                if (!is_dir($path))
                    mkdir($path, $security);
 
                $pathMain = './attachments/'.$folder;
                if (!is_dir($pathMain))
                    mkdir($pathMain, $security);
 
                $pathThumb = './attachments/'.$folder.'/100X100';
                if (!is_dir($pathThumb))
                    mkdir($pathThumb, $security);
 
                $path2Thumb = './attachments/'.$folder.'/200X200';
                if (!is_dir($path2Thumb))
                    mkdir($path2Thumb, $security);
 
                $path3Thumb = './attachments/'.$folder.'/300X300';
                if (!is_dir($path3Thumb))
                    mkdir($path3Thumb, $security);
                
                $result = $this->do_upload($var, $pathMain, $name, $pdf);
                if (!$result['status'])
                {
                    $data['error_msg'] ="Can not upload Image for " . $result['error'] . " ";
                    // echo "<script>alert('Gambar telalu Besar. Ukuran Maximal $this->max_width X $this->max_height (2 MB)');</script>";
                    $name = "no-image.png";
                }
                else
                {
                    if(!$pdf){
                        if(!$this->resize_image($pathMain . '/' . $result['upload_data']['file_name'], $pathThumb . '/'.$name,'100','100'))
                        {
                        //    echo "<script>alert('Gagal Upload gambar ukuran 100X100');</script>";
                            $name = "no-image.png";
                        }
                            
                        if(!$this->resize_image($pathMain . '/' . $result['upload_data']['file_name'], $path2Thumb . '/'.$name,'200','200'))
                        {
                        // echo "<script>alert('Gagal Upload gambar ukuran 100X100');</script>";
                        $name = "no-image.png";
                        }
                        if(!$this->resize_image($pathMain . '/' . $result['upload_data']['file_name'], $path3Thumb . '/'.$name,'300','300'))
                        {
                            // echo "<script>alert('Gagal Upload gambar ukuran 100X100');</script>";
                            $name = "no-image.png";
                        }
                    }
                    
 
                }
            }
        
        return $name;
    }

    function do_upload($htmlFieldName, $path, $name, $pdf)
    {
        $config['file_name'] = $name;
        $config['upload_path'] = $path;
        if(!$pdf){
            $config['allowed_types'] = 'gif|jpg|png';
        }else{
            $config['allowed_types'] = 'pdf';
        }
        
        $config['max_size'] = '2048';
        $config['max_width'] = $this->max_width;
        $config['max_height'] = $this->max_height;
        self::$CI->load->library('upload', $config);
        self::$CI->upload->initialize($config);
        unset($config);
        if (!self::$CI->upload->do_upload($htmlFieldName))
        {
            return array('error' => self::$CI->upload->display_errors(), 'status' => 0);
        } else
        {
            return array('status' => 1, 'upload_data' => self::$CI->upload->data());
        }
    }

    function resize_image($sourcePath, $desPath, $width = '500', $height = '500')
    {
        self::$CI->image_lib->clear();
        $config['image_library'] = 'gd2';
        $config['source_image'] = $sourcePath;
        $config['new_image'] = $desPath;
        $config['quality'] = '100%';
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = true;
        $config['thumb_marker'] = '';
        $config['width'] = $width;
        $config['height'] = $height;
        self::$CI->image_lib->initialize($config);
 
        if (self::$CI->image_lib->resize())
            return true;
        return false;
    }

}