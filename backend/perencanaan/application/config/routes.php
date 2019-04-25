<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['login/(:num)'] = "Login/login/$1";

$route['admin/ceklogin/(:num)'] = "Admin/cekUser/$1";

//ambil data tambahan
$route['getData/satuan'] = "DataController/getSatuan";
$route['getData/skor'] = "DataController/getSkor";
$route['getData/opd'] = "DataController/getOpd";
$route['getData/kecamatan'] = "DataController/getKecamatan";
$route['getData/kelurahan'] = "DataController/getKelurahan";
$route['getData/dapil'] = "DataController/getDapil";


//kelurahan
$route['kelurahan/createGrup'] = "KelurahanController/createGrup";
$route['kelurahan/get-grup'] = "KelurahanController/getGrup";
$route['kelurahan/upload-berkas'] = "KelurahanController/uploadBerkas";
$route['kelurahan/kirim-berkas'] = "KelurahanController/kirimBerkas";
$route['kelurahan/get-pdf/(:any)'] = "KelurahanController/getPdf/$1";

$route['data/export/(:any)'] = "Import/export/$1";
$route['data/import'] = "Import/import";

$route['kelurahan/kiriman/page-(:num)'] = "KelurahanController/getKiriman/$1";

$route['kelurahan/page-(:num)'] = "KelurahanController/getData/$1";
$route['kelurahan/create'] = "KelurahanController/create";
$route['kelurahan/update'] = "KelurahanController/update";
$route['kelurahan/delete'] = "KelurahanController/delete";
//.kelurahan

//kecamatan
$route['kecamatan/createGrup'] = "KecamatanController/createGrup";
$route['kecamatan/get-grup'] = "KecamatanController/getGrup";
$route['kecamatan/upload-berkas'] = "KecamatanController/uploadBerkas";
$route['kecamatan/kirim-berkas'] = "KecamatanController/kirimBerkas";
$route['kecamatan/get-pdf/(:any)'] = "KecamatanController/getPdf/$1";

$route['kecamatan/create-skor'] = "KecamatanController/createSkor";

$route['kecamatan/kiriman/page-(:num)'] = "KecamatanController/getKiriman/$1";

$route['kecamatan/page-(:num)'] = "KecamatanController/getData/$1";
$route['kecamatan/create'] = "KecamatanController/create";
$route['kecamatan/update'] = "KecamatanController/update";
$route['kecamatan/delete'] = "KecamatanController/delete";
//.kecamatan


//pokir
$route['pokir/createGrup'] = "PokirController/createGrup";
$route['pokir/get-grup'] = "PokirController/getGrup";
$route['pokir/upload-berkas'] = "PokirController/uploadBerkas";
$route['pokir/kirim-berkas'] = "PokirController/kirimBerkas";
$route['pokir/get-pdf/(:any)'] = "PokirController/getPdf/$1";

$route['pokir/create-skor'] = "PokirController/createSkor";

$route['pokir/kiriman/page-(:num)'] = "PokirController/getKiriman/$1";

$route['pokir/page-(:num)'] = "PokirController/getData/$1";
$route['pokir/create'] = "PokirController/create";
$route['pokir/update'] = "PokirController/update";
$route['pokir/delete'] = "PokirController/delete";
//.pokir

//admin
$route['musrenbang/kiriman-pokir/page-(:num)'] = "AdminController/getKirimanPokir/$1";
$route['musrenbang/kiriman/page-(:num)'] = "AdminController/getKiriman/$1";
$route['musrenbang/page-(:num)'] = "AdminController/getData/$1";
$route['admin/get-grup'] = "AdminController/getGrup";
$route['admin/get-pdf/(:any)'] = "AdminController/getPdf/$1";

//.admin

//api 
$route['api/musrenbang/kiriman-pokir/page-(:num)'] = "ApiController/getKirimanPokir/$1";
$route['api/musrenbang/kiriman/page-(:num)'] = "ApiController/getKiriman/$1";

$route['api/musrenbang/kiriman/update'] = "ApiController/update";

// $route['musrenbang/page-(:num)'] = "AdminController/getData/$1";
$route['akun/page-(:num)'] = "Akun/getData/$1";
$route['akun/create'] = "Akun/create";
$route['akun/update'] = "Akun/update";
$route['akun/delete'] = "Akun/delete";

$route['akun/ubah-password'] = "Akun/setPassword";

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
