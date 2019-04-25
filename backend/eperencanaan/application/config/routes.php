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



// rpjmd


$route['rpjmd/login/(:num)'] = "rpjmd/LoginController/login/$1";


$route['rpjmd/get-data'] = "rpjmd/SetController";



$route['rpjmd/menyusun/visi/page-(:num)'] = "rpjmd/VisiController/getData/$1";
$route['rpjmd/menyusun/visi/create'] = "rpjmd/VisiController/create";
$route['rpjmd/menyusun/visi/update'] = "rpjmd/VisiController/update";
$route['rpjmd/menyusun/visi/delete'] = "rpjmd/VisiController/delete";
$route['rpjmd/menyusun/visi/save/(:any)'] = "rpjmd/VisiController/getData/1/$1";

$route['rpjmd/menyusun/visi-penjelasan/page-(:num)'] = "rpjmd/VisiPenjelasanController/getData/$1";
$route['rpjmd/menyusun/visi-penjelasan/create'] = "rpjmd/VisiPenjelasanController/create";
$route['rpjmd/menyusun/visi-penjelasan/update'] = "rpjmd/VisiPenjelasanController/update";
$route['rpjmd/menyusun/visi-penjelasan/delete'] = "rpjmd/VisiPenjelasanController/delete";
$route['rpjmd/menyusun/visi-penjelasan/save/(:any)'] = "rpjmd/VisiPenjelasanController/getData/1/$1";

$route['rpjmd/menyusun/misi/page-(:num)'] = "rpjmd/MisiController/getData/$1";
$route['rpjmd/menyusun/misi/create'] = "rpjmd/MisiController/create";
$route['rpjmd/menyusun/misi/update'] = "rpjmd/MisiController/update";
$route['rpjmd/menyusun/misi/delete'] = "rpjmd/MisiController/delete";
$route['rpjmd/menyusun/misi/save/(:any)'] = "rpjmd/MisiController/getData/1/$1";

$route['rpjmd/menyusun/tujuan/page-(:num)'] = "rpjmd/TujuanController/getData/$1";
$route['rpjmd/menyusun/tujuan/create'] = "rpjmd/TujuanController/create";
$route['rpjmd/menyusun/tujuan/update'] = "rpjmd/TujuanController/update";
$route['rpjmd/menyusun/tujuan/delete'] = "rpjmd/TujuanController/delete";
$route['rpjmd/menyusun/tujuan/save/(:any)'] = "rpjmd/TujuanController/getData/1/$1";

$route['rpjmd/menyusun/sasaran/page-(:num)'] = "rpjmd/SasaranController/getData/$1";
$route['rpjmd/menyusun/sasaran/create'] = "rpjmd/SasaranController/create";
$route['rpjmd/menyusun/sasaran/update'] = "rpjmd/SasaranController/update";
$route['rpjmd/menyusun/sasaran/delete'] = "rpjmd/SasaranController/delete";
$route['rpjmd/menyusun/sasaran/save/(:any)'] = "rpjmd/SasaranController/getData/1/$1";

$route['rpjmd/menyusun/indikator/page-(:num)'] = "rpjmd/IndikatorController/getData/$1";
$route['rpjmd/menyusun/indikator/create'] = "rpjmd/IndikatorController/create";
$route['rpjmd/menyusun/indikator/update'] = "rpjmd/IndikatorController/update";
$route['rpjmd/menyusun/indikator/delete'] = "rpjmd/IndikatorController/delete";
$route['rpjmd/menyusun/indikator/save/(:any)'] = "rpjmd/IndikatorController/getData/1/$1";

$route['rpjmd/menyusun/rumusan-masalah/page-(:num)'] = "rpjmd/RumusanMasalahController/getData/$1";
$route['rpjmd/menyusun/rumusan-masalah/create'] = "rpjmd/RumusanMasalahController/create";
$route['rpjmd/menyusun/rumusan-masalah/update'] = "rpjmd/RumusanMasalahController/update";
$route['rpjmd/menyusun/rumusan-masalah/delete'] = "rpjmd/RumusanMasalahController/delete";
$route['rpjmd/menyusun/rumusan-masalah/save/(:any)'] = "rpjmd/RumusanMasalahController/getData/1/$1";

$route['rpjmd/menyusun/isu-strategi/page-(:num)'] = "rpjmd/IsuStrategiController/getData/$1";
$route['rpjmd/menyusun/isu-strategi/create'] = "rpjmd/IsuStrategiController/create";
$route['rpjmd/menyusun/isu-strategi/update'] = "rpjmd/IsuStrategiController/update";
$route['rpjmd/menyusun/isu-strategi/delete'] = "rpjmd/IsuStrategiController/delete";
$route['rpjmd/menyusun/isu-strategi/save/(:any)'] = "rpjmd/IsuStrategiController/getData/1/$1";

$route['rpjmd/menyusun/tujuan-sasaran/page-(:num)'] = "rpjmd/TujuanSasaranController/getData/$1";
$route['rpjmd/menyusun/tujuan-sasaran/create'] = "rpjmd/TujuanSasaranController/create";
$route['rpjmd/menyusun/tujuan-sasaran/update'] = "rpjmd/TujuanSasaranController/update";
$route['rpjmd/menyusun/tujuan-sasaran/delete'] = "rpjmd/TujuanSasaranController/delete";
$route['rpjmd/menyusun/tujuan-sasaran/save/(:any)'] = "rpjmd/TujuanSasaranController/getData/1/$1";

$route['rpjmd/menyusun/strategi-kebijakan/page-(:num)'] = "rpjmd/StrategiKebijakanController/getData/$1";
$route['rpjmd/menyusun/strategi-kebijakan/create'] = "rpjmd/StrategiKebijakanController/create";
$route['rpjmd/menyusun/strategi-kebijakan/update'] = "rpjmd/StrategiKebijakanController/update";
$route['rpjmd/menyusun/strategi-kebijakan/delete'] = "rpjmd/StrategiKebijakanController/delete";
$route['rpjmd/menyusun/strategi-kebijakan/save/(:any)'] = "rpjmd/StrategiKebijakanController/getData/1/$1";

$route['rpjmd/menyusun/perumusan-program/page-(:num)'] = "rpjmd/PerumusanProgramController/getData/$1";
$route['rpjmd/menyusun/perumusan-program/create'] = "rpjmd/PerumusanProgramController/create";
$route['rpjmd/menyusun/perumusan-program/update'] = "rpjmd/PerumusanProgramController/update";
$route['rpjmd/menyusun/perumusan-program/delete'] = "rpjmd/PerumusanProgramController/delete";
$route['rpjmd/menyusun/perumusan-program/save/(:any)'] = "rpjmd/PerumusanProgramController/getData/1/$1";

$route['rpjmd/menyusun/pagu-indikatif/page-(:num)'] = "rpjmd/PaguIndikatifController/getData/$1";
$route['rpjmd/menyusun/pagu-indikatif/update'] = "rpjmd/PaguIndikatifController/update";
$route['rpjmd/menyusun/pagu-indikatif/save/(:any)'] = "rpjmd/PaguIndikatifController/getData/1/$1";

$route['rpjmd/menyusun/analisis-keuangan/page-(:num)'] = "rpjmd/AnalisisKeuanganController/getData/$1";
$route['rpjmd/menyusun/analisis-keuangan/create'] = "rpjmd/AnalisisKeuanganController/create";
$route['rpjmd/menyusun/analisis-keuangan/update'] = "rpjmd/AnalisisKeuanganController/update";
$route['rpjmd/menyusun/analisis-keuangan/delete'] = "rpjmd/AnalisisKeuanganController/delete";
$route['rpjmd/menyusun/analisis-keuangan/save/(:any)'] = "rpjmd/AnalisisKeuanganController/getData/1/$1";

$route['rpjmd/menyusun/proyeksi-keuangan/page-(:num)'] = "rpjmd/ProyeksiKeuanganController/getData/$1";
$route['rpjmd/menyusun/proyeksi-keuangan/create'] = "rpjmd/ProyeksiKeuanganController/create";
$route['rpjmd/menyusun/proyeksi-keuangan/update'] = "rpjmd/ProyeksiKeuanganController/update";
$route['rpjmd/menyusun/proyeksi-keuangan/delete'] = "rpjmd/ProyeksiKeuanganController/delete";
$route['rpjmd/menyusun/proyeksi-keuangan/save/(:any)'] = "rpjmd/ProyeksiKeuanganController/getData/1/$1";

$route['rpjmd/menyusun/perumusan-pagu/page-(:num)'] = "rpjmd/PerumusanPaguController/getData/$1";
$route['rpjmd/menyusun/perumusan-pagu/update'] = "rpjmd/PerumusanPaguController/update";
$route['rpjmd/menyusun/perumusan-pagu/save/(:any)'] = "rpjmd/PerumusanPaguController/getData/1/$1";


$route['rpjmd/menyusun/strategi/page-(:num)'] = "rpjmd/StrategiController/getData/$1";
$route['rpjmd/menyusun/strategi/create'] = "rpjmd/StrategiController/create";
$route['rpjmd/menyusun/strategi/update'] = "rpjmd/StrategiController/update";
$route['rpjmd/menyusun/strategi/delete'] = "rpjmd/StrategiController/delete";

$route['rpjmd/data/indikator/page-(:num)'] = "rpjmd/DataController/getIndikator";

$route['rpjmd/tampil/strategi/page-(:num)'] = "rpjmd/TampilController/getStrategi/$1";
$route['rpjmd/tampil/kebijakan/pagu/page-(:num)'] = "rpjmd/TampilController/getKebijakan/$1";
$route['rpjmd/tampil/kebijakan/pagu/update'] = "rpjmd/TampilController/getKebijakanUpdate/$1";

$route['rpjmd/get-data/bidang'] = "rpjmd/DataController/getBidang";
$route['rpjmd/get-data/program'] = "rpjmd/DataController/getProgram";
$route['rpjmd/get-data/opd'] = "rpjmd/DataController/getOpd";
$route['rpjmd/get-data/satuan'] = "rpjmd/DataController/getSatuan";
$route['rpjmd/get-data/rek-5'] = "rpjmd/DataController/getRek5";

$route['rpjmd/get-data/misi'] = "rpjmd/DataController/getMisi";
$route['rpjmd/get-data/tujuan'] = "rpjmd/DataController/getTujuan";
$route['rpjmd/get-data/sasaran'] = "rpjmd/DataController/getSasaran";
$route['rpjmd/get-data/indikator'] = "rpjmd/DataController/getIndikator";
$route['rpjmd/get-data/isu-strategi'] = "rpjmd/DataController/getIsuStrategi";
$route['rpjmd/get-data/tujuan-sasaran'] = "rpjmd/DataController/getTujuanSasaran";
$route['rpjmd/get-data/strategi-kebijakan'] = "rpjmd/DataController/getStrategiKebijakan";






//.rpjmd

// opd
$route['opd/menyusun/pegawai/page-(:num)'] = "opd/CrudController/getData/opd_pegawai/$1";
$route['opd/menyusun/pegawai/create'] = "opd/CrudController/create/opd_pegawai";
$route['opd/menyusun/pegawai/update'] = "opd/CrudController/update/opd_pegawai";
$route['opd/menyusun/pegawai/delete'] = "opd/CrudController/delete/opd_pegawai";
$route['opd/menyusun/pegawai/save/(:any)'] = "opd/CrudController/getData/opd_pegawai/1/$1";

$route['opd/menyusun/visi/page-(:num)'] = "opd/CrudController/getData/opd_visi/$1";
// $route['opd/menyusun/visi/create'] = "opd/CrudController/create/opd_visi";
$route['opd/menyusun/visi/update'] = "opd/CrudController/update/opd_visi";
// $route['opd/menyusun/visi/delete'] = "opd/CrudController/delete/opd_visi";
$route['opd/menyusun/visi/save/(:any)'] = "opd/CrudController/getData/opd_visi/1/$1";



$route['opd/menyusun/visi-penjelasan/page-(:num)'] = "opd/CrudController/getData/opd_visi_penjelasan/$1";
$route['opd/menyusun/visi-penjelasan/create'] = "opd/CrudController/create/opd_visi_penjelasan";
$route['opd/menyusun/visi-penjelasan/update'] = "opd/CrudController/update/opd_visi_penjelasan";
$route['opd/menyusun/visi-penjelasan/delete'] = "opd/CrudController/delete/opd_visi_penjelasan";
$route['opd/menyusun/visi-penjelasan/save/(:any)'] = "opd/CrudController/getData/opd_visi_penjelasan/1/$1";

$route['opd/menyusun/misi/page-(:num)'] = "opd/CrudController/getData/opd_misi/$1";
$route['opd/menyusun/misi/create'] = "opd/CrudController/create/opd_misi";
$route['opd/menyusun/misi/update'] = "opd/CrudController/update/opd_misi";
$route['opd/menyusun/misi/delete'] = "opd/CrudController/delete/opd_misi";
$route['opd/menyusun/misi/save/(:any)'] = "opd/CrudController/getData/opd_misi/1/$1";

$route['opd/menyusun/tujuan/page-(:num)'] = "opd/CrudController/getData/opd_tujuan/$1";
$route['opd/menyusun/tujuan/create'] = "opd/CrudController/create/opd_tujuan";
$route['opd/menyusun/tujuan/update'] = "opd/CrudController/update/opd_tujuan";
$route['opd/menyusun/tujuan/delete'] = "opd/CrudController/delete/opd_tujuan";
$route['opd/menyusun/tujuan/save/(:any)'] = "opd/CrudController/getData/opd_tujuan/1/$1";


$route['opd/menyusun/sasaran/page-(:num)'] = "opd/CrudController/getData/opd_sasaran/$1";
$route['opd/menyusun/sasaran/create'] = "opd/CrudController/create/opd_sasaran";
$route['opd/menyusun/sasaran/update'] = "opd/CrudController/update/opd_sasaran";
$route['opd/menyusun/sasaran/delete'] = "opd/CrudController/delete/opd_sasaran";
$route['opd/menyusun/sasaran/save/(:any)'] = "opd/CrudController/getData/opd_sasaran/1/$1";

$route['opd/menyusun/indikator/page-(:num)'] = "opd/CrudController/getData/opd_indikator/$1";
$route['opd/menyusun/indikator/create'] = "opd/CrudController/create/opd_indikator";
$route['opd/menyusun/indikator/update'] = "opd/CrudController/update/opd_indikator";
$route['opd/menyusun/indikator/delete'] = "opd/CrudController/delete/opd_indikator";
$route['opd/menyusun/indikator/save/(:any)'] = "opd/CrudController/getData/opd_indikator/1/$1";

$route['opd/menyusun/pagu/page-(:num)'] = "opd/CrudController/getData/opd_pagu/$1";
$route['opd/menyusun/pagu/create'] = "opd/CrudController/create/opd_pagu";
$route['opd/menyusun/pagu/update'] = "opd/CrudController/update/opd_pagu";
$route['opd/menyusun/pagu/delete'] = "opd/CrudController/delete/opd_pagu";

////////
$route['opd/menyusun/renstra-kab/page-(:num)'] = "opd/CrudController/getData/opd_renstra_kab/$1";
$route['opd/menyusun/renstra-kab/create'] = "opd/CrudController/create/opd_renstra_kab";
$route['opd/menyusun/renstra-kab/update'] = "opd/CrudController/update/opd_renstra_kab";
$route['opd/menyusun/renstra-kab/delete'] = "opd/CrudController/delete/opd_renstra_kab";

$route['opd/menyusun/renstra-opd/page-(:num)'] = "opd/CrudController/getData/opd_renstra_opd/$1";
$route['opd/menyusun/renstra-opd/create'] = "opd/CrudController/create/opd_renstra_opd";
$route['opd/menyusun/renstra-opd/update'] = "opd/CrudController/update/opd_renstra_opd";
$route['opd/menyusun/renstra-opd/delete'] = "opd/CrudController/delete/opd_renstra_opd";
$route['opd/menyusun/renstra-opd/save/(:any)'] = "opd/CrudController/getData/opd_renstra_opd/1/$1";

$route['opd/menyusun/rkpd-awal/page-(:num)'] = "opd/CrudController/getData/opd_rkpd_awal/$1";
$route['opd/menyusun/rkpd-awal/create'] = "opd/CrudController/create/opd_rkpd_awal";
$route['opd/menyusun/rkpd-awal/update'] = "opd/CrudController/update/opd_rkpd_awal";
$route['opd/menyusun/rkpd-awal/delete'] = "opd/CrudController/delete/opd_rkpd_awal";

$route['opd/menyusun/hasil-musrenbang/page-(:num)'] = "opd/CrudController/getData/opd_hasil_musrenbang/$1";
$route['opd/menyusun/hasil-musrenbang/create'] = "opd/CrudController/create/opd_hasil_musrenbang";
$route['opd/menyusun/hasil-musrenbang/update'] = "opd/CrudController/update/opd_hasil_musrenbang";
$route['opd/menyusun/hasil-musrenbang/delete'] = "opd/CrudController/delete/opd_hasil_musrenbang";

$route['opd/menyusun/hasil-pokir/page-(:num)'] = "opd/CrudController/getData/opd_hasil_pokir/$1";
$route['opd/menyusun/hasil-pokir/create'] = "opd/CrudController/create/opd_hasil_pokir";
$route['opd/menyusun/hasil-pokir/update'] = "opd/CrudController/update/opd_hasil_pokir";
$route['opd/menyusun/hasil-pokir/delete'] = "opd/CrudController/delete/opd_hasil_pokir";

$route['opd/menyusun/rkpd-verifikasi/page-(:num)'] = "opd/CrudController/getData/opd_rkpd_verifikasi/$1";
$route['opd/menyusun/rkpd-verifikasi/create'] = "opd/CrudController/create/opd_rkpd_verifikasi";
$route['opd/menyusun/rkpd-verifikasi/update'] = "opd/CrudController/update/opd_rkpd_verifikasi";
$route['opd/menyusun/rkpd-verifikasi/delete'] = "opd/CrudController/delete/opd_rkpd_verifikasi";
$route['opd/menyusun/rkpd-verifikasi/save/(:any)'] = "opd/CrudController/getData/opd_rkpd_verifikasi/1/$1";

$route['opd/menyusun/rkpd-final/page-(:num)'] = "opd/CrudController/getData/opd_rkpd_final/$1";
$route['opd/menyusun/rkpd-final/create'] = "opd/CrudController/create/opd_rkpd_final";
$route['opd/menyusun/rkpd-final/update'] = "opd/CrudController/update/opd_rkpd_final";
$route['opd/menyusun/rkpd-final/delete'] = "opd/CrudController/delete/opd_rkpd_final";

$route['opd/menyusun/renja-awal/page-(:num)'] = "opd/CrudController/getData/opd_renja_awal/$1";
$route['opd/menyusun/renja-awal/create'] = "opd/CrudController/create/opd_renja_awal";
$route['opd/menyusun/renja-awal/update'] = "opd/CrudController/update/opd_renja_awal";
$route['opd/menyusun/renja-awal/delete'] = "opd/CrudController/delete/opd_renja_awal";
$route['opd/menyusun/renja-awal/kirim'] = "opd/CrudController/other/opd_renja_awal";

$route['opd/menyusun/rka-pra/page-(:num)'] = "opd/CrudController/getData/opd_pra_rka/$1";
$route['opd/menyusun/rka-pra/create'] = "opd/CrudController/create/opd_pra_rka";
$route['opd/menyusun/rka-pra/update'] = "opd/CrudController/update/opd_pra_rka";
$route['opd/menyusun/rka-pra/delete'] = "opd/CrudController/delete/opd_pra_rka";
$route['opd/menyusun/rka-pra/kirim'] = "opd/CrudController/other/opd_pra_rka";
$route['opd/menyusun/rka-pra/save/(:any)'] = "opd/CrudController/getData/opd_pra_rka/1/$1";

// perubahan
$route['opd/menyusun/rkpd-perubahan/page-(:num)'] = "opd/CrudController/getData/opd_rkpd_perubahan/$1";
$route['opd/menyusun/rkpd-perubahan/create'] = "opd/CrudController/create/opd_rkpd_perubahan";
$route['opd/menyusun/rkpd-perubahan/update'] = "opd/CrudController/update/opd_rkpd_perubahan";
$route['opd/menyusun/rkpd-perubahan/delete'] = "opd/CrudController/delete/opd_rkpd_perubahan";

$route['opd/menyusun/renja-perubahan/page-(:num)'] = "opd/CrudController/getData/opd_renja_perubahan/$1";
$route['opd/menyusun/renja-perubahan/create'] = "opd/CrudController/create/opd_renja_perubahan";
$route['opd/menyusun/renja-perubahan/update'] = "opd/CrudController/update/opd_renja_perubahan";
$route['opd/menyusun/renja-perubahan/delete'] = "opd/CrudController/delete/opd_renja_perubahan";
$route['opd/menyusun/renja-perubahan/kirim'] = "opd/CrudController/other/opd_renja_perubahan";

$route['opd/menyusun/rka-pra-perubahan/page-(:num)'] = "opd/CrudController/getData/opd_pra_rka_perubahan/$1";
$route['opd/menyusun/rka-pra-perubahan/create'] = "opd/CrudController/create/opd_pra_rka_perubahan";
$route['opd/menyusun/rka-pra-perubahan/update'] = "opd/CrudController/update/opd_pra_rka_perubahan";
$route['opd/menyusun/rka-pra-perubahan/delete'] = "opd/CrudController/delete/opd_pra_rka_perubahan";
$route['opd/menyusun/rka-pra-perubahan/kirim'] = "opd/CrudController/other/opd_pra_rka_perubahan";

$route['opd/get-data/kegiatan'] = "opd/DataController/getKegiatan";
$route['opd/get-data/rkpd'] = "opd/DataController/selectRkpd";



$route['opd/get-export/kegiatan'] = "opd/ImportController/export/kegiatan";



//.opd

// admin
$route['admin/user/page-(:num)'] = "administrator/CrudController/getData/admin_user/$1";
$route['admin/user/create'] = "administrator/CrudController/create/admin_user";
$route['admin/user/update'] = "administrator/CrudController/update/admin_user";
$route['admin/user/delete'] = "administrator/CrudController/delete/admin_user";

// .admin

// sotk
$route['sotk/fungsi/page-(:num)'] = "sotk/FungsiController/getData/$1";
$route['sotk/fungsi/create'] = "sotk/FungsiController/create";
$route['sotk/fungsi/update'] = "sotk/FungsiController/update";
$route['sotk/fungsi/delete'] = "sotk/FungsiController/delete";

$route['sotk/bidang/page-(:num)'] = "sotk/BidangController/getData/$1";
$route['sotk/bidang/create'] = "sotk/BidangController/create";
$route['sotk/bidang/update'] = "sotk/BidangController/update";
$route['sotk/bidang/delete'] = "sotk/BidangController/delete";

$route['sotk/urusan/page-(:num)'] = "sotk/UrusanController/getData/$1";
$route['sotk/urusan/create'] = "sotk/UrusanController/create";
$route['sotk/urusan/update'] = "sotk/UrusanController/update";
$route['sotk/urusan/delete'] = "sotk/UrusanController/delete";

$route['sotk/sub-unit/page-(:num)'] = "sotk/SubUnitController/getData/$1";
$route['sotk/sub-unit/create'] = "sotk/SubUnitController/create";
$route['sotk/sub-unit/update'] = "sotk/SubUnitController/update";
$route['sotk/sub-unit/delete'] = "sotk/SubUnitController/delete";

//. sotk

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
// $route['musrenbang/page-(:num)'] = "AdminController/getData/$1";
$route['akun/page-(:num)'] = "Akun/getData/$1";
$route['akun/create'] = "Akun/create";
$route['akun/update'] = "Akun/update";
$route['akun/delete'] = "Akun/delete";

$route['akun/ubah-password'] = "Akun/setPassword";

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
