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
$route['default_controller'] = 'GuessController';

$route['admin'] = "AdminController";
$route['admin/login'] = "AdminController/login";
$route['admin/logout'] = "AdminController/logout";

$route['admin/hspk'] = "RefHspkController";
$route['admin/hspk/page-(:num)'] = "RefHspkController/index/$1/$2";
$route['admin/hspk/(:any)'] = "RefHspkController/index/1/$1";
$route['admin/hspk/get-hspk(:num)/(:any)'] = "RefHspkController/get/$1/$2";
$route['admin/hspk/get-ssh(:num)/(:any)'] = "RefHspkController/getSSh/$1/$2";
$route['admin/hspk/set-data/(:num)'] = "RefHspkController/setData/$1";
$route['admin/hspk/set-data-hspk/(:num)'] = "RefHspkController/setDataHspk/$1";
$route['admin/hspk/load-data-hspk/(:num)'] = "RefHspkController/loadDataHspk/$1";
$route['admin/hspk/delete-data-ssh/(:num)'] = "RefHspkController/deleteDataSsh/$1";


$route['admin/asb'] = "RefAsbController";
$route['admin/asb/page-(:num)'] = "RefAsbController/index/$1/$2";
$route['admin/asb/(:any)'] = "RefAsbController/index/1/$1";
$route['admin/asb/get-asb(:num)/(:any)'] = "RefAsbController/getAsb/$1/$2";
$route['admin/asb/get-asbt(:num)/(:any)'] = "RefAsbController/getAsb2/$1/$2";
$route['admin/asb/get-hspk(:num)/(:any)'] = "RefAsbController/getHspk/$1/$2";
$route['admin/asb/get-ssh(:num)/(:any)'] = "RefAsbController/getSsh/$1/$2";
$route['admin/asb/set-data/(:num)'] = "RefAsbController/setData/$1";
$route['admin/asb/set-data-asb/(:num)'] = "RefAsbController/setDataAsb/$1";
$route['admin/asb/load-data-asb/(:num)'] = "RefAsbController/loadDataAsb/$1";
$route['admin/asb/delete-data-ssh/(:num)'] = "RefAsbController/deleteDataSsh/$1";

$route['admin/asb1'] = "refAsb/RefAsb1Controller";
$route['admin/asb1/page-(:num)'] = "refAsb/RefAsb1Controller/index/$1/$2";
$route['admin/asb1/(:any)'] = "refAsb/RefAsb1Controller/index/1/$1";								//for delete
$route['admin/asb1/get-asb/(:any)/(:any)'] = "refAsb/RefAsb1Controller/getAsb/$1/$2";   //for create record

$route['admin/asb2'] = "refAsb/RefAsb2Controller";
$route['admin/asb2/page-(:num)'] = "refAsb/RefAsb2Controller/index/$1/$2";
$route['admin/asb2/(:any)'] = "refAsb/RefAsb2Controller/index/1/$1";								//for delete
$route['admin/asb2/get-asb/(:any)/(:any)'] = "refAsb/RefAsb2Controller/getAsb/$1/$2";   //for create record

$route['admin/asb3'] = "refAsb/RefAsb3Controller";
$route['admin/asb3/page-(:num)'] = "refAsb/RefAsb3Controller/index/$1/$2";
$route['admin/asb3/(:any)'] = "refAsb/RefAsb3Controller/index/1/$1";								//for delete
$route['admin/asb3/get-asb/(:any)/(:any)'] = "refAsb/RefAsb3Controller/getAsb/$1/$2";   //for create record

$route['admin/asb4'] = "refAsb/RefAsb4Controller";
$route['admin/asb4/page-(:num)'] = "refAsb/RefAsb4Controller/index/$1/$2";
$route['admin/asb4/(:any)'] = "refAsb/RefAsb4Controller/index/1/$1";								//for delete
$route['admin/asb4/get-asb/(:any)/(:any)'] = "refAsb/RefAsb4Controller/getAsb/$1/$2";   //for create record

$route['admin/hspk1'] = "refHspk/RefHspk1Controller";
$route['admin/hspk1/page-(:num)'] = "refHspk/RefHspk1Controller/index/$1/$2";
$route['admin/hspk1/(:any)'] = "refHspk/RefHspk1Controller/index/1/$1";								//for delete
$route['admin/hspk1/get-hspk/(:any)/(:any)'] = "refHspk/RefHspk1Controller/getHspk/$1/$2";   //for create record

$route['admin/hspk2'] = "refHspk/RefHspk2Controller";
$route['admin/hspk2/page-(:num)'] = "refHspk/RefHspk2Controller/index/$1/$2";
$route['admin/hspk2/(:any)'] = "refHspk/RefHspk2Controller/index/1/$1";								//for delete
$route['admin/hspk2/get-hspk/(:any)/(:any)'] = "refHspk/RefHspk2Controller/getHspk/$1/$2";   //for create record

$route['admin/hspk3'] = "refHspk/RefHspk3Controller";
$route['admin/hspk3/page-(:num)'] = "refHspk/RefHspk3Controller/index/$1/$2";
$route['admin/hspk3/(:any)'] = "refHspk/RefHspk3Controller/index/1/$1";								//for delete
$route['admin/hspk3/get-hspk/(:any)/(:any)'] = "refHspk/RefHspk3Controller/getHspk/$1/$2";   //for create record

$route['admin/ssh'] = "RefSshController";
$route['admin/ssh/page-(:num)'] = "RefSshController/index/$1/$2";
$route['admin/ssh/(:any)'] = "RefSshController/index/1/$1";
$route['admin/ssh/get-ssh(:num)/(:any)'] = "RefSshController/getSSh/$1/$2";
$route['admin/ssh/load-data-ssh/(:num)'] = "RefSshController/loadDataHspk/$1";


$route['admin/ssh1'] = "refSsh/RefSsh1Controller";
$route['admin/ssh1/page-(:num)'] = "refSsh/RefSsh1Controller/index/$1/$2";
$route['admin/ssh1/(:any)'] = "refSsh/Refssh1Controller/index/1/$1";
$route['admin/ssh1/get-ssh/(:any)/(:any)'] = "refSsh/RefSsh1Controller/getSsh/$1/$2";

$route['admin/ssh2'] = "refSsh/RefSsh2Controller";
$route['admin/ssh2/page-(:num)'] = "refSsh/RefSsh2Controller/index/$1/$2";
$route['admin/ssh2/(:any)'] = "refSsh/RefSsh2Controller/index/1/$1";
$route['admin/ssh2/get-ssh/(:any)/(:any)'] = "refSsh/RefSsh2Controller/getSsh/$1/$2";

$route['admin/ssh3'] = "refSsh/RefSsh3Controller";
$route['admin/ssh3/page-(:num)'] = "refSsh/RefSsh3Controller/index/$1/$2";
$route['admin/ssh3/(:any)'] = "refSsh/RefSsh3Controller/index/1/$1";
$route['admin/ssh3/get-ssh/(:any)/(:any)'] = "refSsh/RefSsh3Controller/getSsh/$1/$2";

$route['admin/ssh4'] = "refSsh/RefSsh4Controller";
$route['admin/ssh4/page-(:num)'] = "refSsh/RefSsh4Controller/index/$1/$2";
$route['admin/ssh4/(:any)'] = "refSsh/RefSsh4Controller/index/1/$1";								//untuk menghapus
$route['admin/ssh4/get-ssh/(:any)/(:any)'] = "refSsh/RefSsh4Controller/getSsh/$1/$2";   //untuk display table

$route['admin/ssh5'] = "refSsh/RefSsh5Controller";
$route['admin/ssh5/page-(:num)'] = "refSsh/RefSsh5Controller/index/$1/$2";
$route['admin/ssh5/(:any)'] = "refSsh/RefSsh5Controller/index/1/$1";
$route['admin/ssh5/get-ssh/(:any)/(:any)'] = "refSsh/RefSsh5Controller/getSsh/$1/$2";
$route['admin/ssh5/get-view/(:any)/(:any)'] = "refSsh/RefSsh5Controller/getView/$1/$2";   //for display view

$route['admin/asb-pekerjaan'] = "RefAsbPekerjaanController";
$route['admin/asb-pekerjaan/page-(:num)'] = "RefAsbPekerjaanController/index/$1/$2";
$route['admin/asb-pekerjaan/(:any)'] = "RefAsbPekerjaanController/index/1/$1";
$route['admin/asb-pekerjaan/get-pekerjaan/(:any)/(:any)'] = "RefAsbPekerjaanController/getSsh/$1/$2";

$route['admin/laporan'] = "SaveController";
$route['admin/laporan/ssh'] = "SaveController/index/ssh";
$route['admin/laporan/hspk'] = "SaveController/index/hspk";
$route['admin/laporan/asb'] = "SaveController/index/asb";
$route['admin/laporan/aset'] = "SaveController/index/aset";
$route['admin/laporan/save/ssh'] = "SaveController/save/ssh";
$route['admin/laporan/save/hspk'] = "SaveController/save/hspk";
$route['admin/laporan/save/asb'] = "SaveController/save/asb";
$route['admin/laporan/save/aset'] = "SaveController/save/aset";

$route['admin/import'] = "ImportController/importData";

$route['admin/export-import'] = "ImportController/showExport";
$route['admin/export/ssh'] = "ImportController/export/ssh";
$route['admin/export/hspk'] = "ImportController/export/hspk";
$route['admin/export/asb'] = "ImportController/export/asb";

$route['admin/akun'] = "AkunController";
$route['admin/akun/page-(:num)'] = "AkunController/index/$1/$2";
$route['admin/akun/load-data'] = "AkunController/loadData";
$route['admin/akun/(:any)'] = "AkunController/index/1/$1";

$route['admin/password'] = "PasswordController";
$route['admin/password/page-(:num)'] = "PasswordController/index/$1/$2";
$route['admin/password/load-data'] = "PasswordController/loadData";
$route['admin/password/(:any)'] = "PasswordController/index/1/$1";


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
