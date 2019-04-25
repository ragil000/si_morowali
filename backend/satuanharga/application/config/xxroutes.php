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
$route['default_controller'] = 'welcome';


$route['admin/ssh'] = "RefSshController";
//$route['admin/ssh/set'] = "RefSshController/setSsh";
$route['admin/ssh/page-(:num)'] = "RefSshController/index/$1/$2";
$route['admin/ssh/(:any)'] = "RefSshController/index/1/$1";
$route['admin/ssh/get-ssh(:num)/(:any)'] = "RefSshController/getSSh/$1/$2";
$route['admin/ssh/load-data-ssh/(:num)'] = "RefSshController/loadDataHspk/$1";

$route['admin/ssh1'] = "RefSsh1Controller";
$route['admin/ssh1/page-(:num)'] = "RefSsh1Controller/index/$1/$2";
$route['admin/ssh1/(:any)'] = "RefSsh1Controller/index/1/$1";
$route['admin/ssh1/lastIdSsh(:num)/(:any)'] = "RefSsh1Controller/getLastId/$1/$2";

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




$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
