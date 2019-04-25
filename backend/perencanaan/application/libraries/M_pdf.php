<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class M_pdf {
    
    function M_pdf()
    {
        $CI = & get_instance();
        log_message('Debug', 'mPDF class is loaded.');
    }
 
    function load($params = NULL)
    {
        include_once APPPATH.'/third_party/mpdf/mpdf.php';
         
        if ($params === NULL)
        {
            $param = '"en-GB-x","A4","","",10,10,10,10,6,3';  
            return new mPDF($param);        		
        }else{
            return new mPDF('c', 'A4-L');
        }
         
        //return new mPDF($param);
        
    }

    
    
}