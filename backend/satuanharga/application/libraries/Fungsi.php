<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fungsi {

	private static $CI;

    public function __construct()
    {
        self::$CI = & get_instance();
    }

	public function convert_to_rupiah($angka)
    {
        return "Rp ".strrev(implode('.',str_split(strrev(strval($angka)),3)));
    }
    
    public function convert_to_number($rupiah)
    {
        return preg_replace("/[^0-9]/", "",$rupiah);
        //return intval(preg_replace(/[^0-9]/, '', $rupiah));
    }

}