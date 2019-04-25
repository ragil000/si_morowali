import React from 'react';
import DefaultLayout from './containers/DefaultLayout';


const Dashboard = React.lazy(() => import('./component/Dashboard'));
const Tahapan = React.lazy(() => import('./component/Tahapan'));
const PenetapanRPJMD = React.lazy(() => import('./component/PenetapanRPJMD'));
const VisiMisi = React.lazy(() => import('./component/VisiMisi'));
const GambaranUmum = React.lazy(() => import('./component/GambaranUmum'));
const RumusanMasalah = React.lazy(() => import('./component/RumusanMasalah'));
const Strategi = React.lazy(() => import('./component/Strategi'));
const Sasaran = React.lazy(() => import('./component/Sasaran'));
// const StrategiKebijakan = React.lazy(() => import('./component/StrategiKebijakan'));
// const Kebijakan = React.lazy(() => import('./component/Kebijakan'));
// const Pembangunan = React.lazy(() => import('./component/Pembangunan'));
const Indikatif = React.lazy(() => import('./component/Indikatif'));

const DaftarRenstra = React.lazy(() => import('./component/DaftarRenstra'));

const ProgramKegiatan = React.lazy(() => import('./component/ProgramKegiatan'));
const ManajemenUser = React.lazy(() => import('./component/ManajemenUser'));

const VisiCreate = React.lazy(() => import('./rpjmd/VisiCreate'));
const MisiCreate = React.lazy(() => import('./rpjmd/MisiCreate'));
const TujuanCreate = React.lazy(() => import('./rpjmd/TujuanCreate'));
const SasaranCreate = React.lazy(() => import('./rpjmd/SasaranCreate'));
const IndikatorCreate = React.lazy(() => import('./rpjmd/IndikatorCreate'));
const StrategiCreate = React.lazy(() => import('./rpjmd/StrategiCreate'));
const ViewStrategiKebijakan = React.lazy(() => import('./rpjmd/ViewStrategiKebijakan'));
const ViewKebijakan = React.lazy(() => import('./rpjmd/ViewKebijakan'));
const ViewPembangunan = React.lazy(() => import('./rpjmd/ViewPembangunan'));

const ViewRumusanMasalah = React.lazy(() => import('./rpjmd/ViewRumusanMasalah'));
const ViewPerumusanIsuStrategis = React.lazy(() => import('./rpjmd/ViewPerumusanIsuStrategis'));
const ViewPerumusanTujuanSasaran = React.lazy(() => import('./rpjmd/ViewPerumusanTujuanSasaran'));
const ViewPerumusanStrategi = React.lazy(() => import('./rpjmd/ViewPerumusanStrategi'));
const ViewPerumusanProgram = React.lazy(() => import('./rpjmd/ViewPerumusanProgram'));


const ProyeksiKeuanganCreate = React.lazy(() => import('./rpjmd/ProyeksiKeuanganCreate'));
const PerumusanPaguCreate = React.lazy(() => import('./rpjmd/PerumusanPaguCreate'));


//opd
const OpdVisiCreate = React.lazy(() => import('./opd/VisiCreate'));
const OpdMisiCreate = React.lazy(() => import('./opd/MisiCreate'));
const OpdTujuanCreate = React.lazy(() => import('./opd/TujuanCreate'));
const OpdSasaranCreate = React.lazy(() => import('./opd/SasaranCreate'));
const OpdIndikatorCreate = React.lazy(() => import('./opd/IndikatorCreate'));
const PegawaiCreate = React.lazy(() => import('./opd/PegawaiCreate'));
const RenstraKabCreate = React.lazy(() => import('./opd/RenstraKabCreate'));
const RenstraOpdCreate = React.lazy(() => import('./opd/RenstraOpdCreate'));
const MusrenbangCreate = React.lazy(() => import('./opd/MusrenbangCreate'));
const PokirCreate = React.lazy(() => import('./opd/PokirCreate'));
const RkpdAwalCreate = React.lazy(() => import('./opd/RkpdAwalCreate'));
const RkpdVerifikasiCreate = React.lazy(() => import('./opd/RkpdVerifikasiCreate'));
const RkpdFinalCreate = React.lazy(() => import('./opd/RkpdFinalCreate'));
const RenjaAwalCreate = React.lazy(() => import('./opd/RenjaAwalCreate'));
const PraRkaCreate = React.lazy(() => import('./opd/PraRkaCreate'));
const OpdPaguCreate = React.lazy(() => import('./opd/OpdPaguCreate'));
const RkpdPerubahanCreate = React.lazy(() => import('./opd/RkpdPerubahanCreate'));
const RenjaPerubahanCreate = React.lazy(() => import('./opd/RenjaPerubahanCreate'));

//sotk
const FungsiCreate = React.lazy(() => import('./sotk/FungsiCreate'));
const BidangCreate = React.lazy(() => import('./sotk/BidangCreate'));
const UrusanCreate = React.lazy(() => import('./sotk/UrusanCreate'));
const SubUnitCreate = React.lazy(() => import('./sotk/SubUnitCreate'));

// admin
const UserCreate = React.lazy(() => import('./admin/UserCreate'));

//.sotk
const test = React.lazy(() => import('./rpjmd/SasaranCreate2'));


// https://github.com/ReactTraining/react-router/tree/master/packages/react-router-config
const routes = [
  { path: '/', exact: true, name: 'Home', component: DefaultLayout },
  { path: '/dashboard', name: 'Dashboard', component: Dashboard },
  // { path: '/theme', exact: true, name: 'Theme', component: Colors },
  // { path: '/theme/colors', name: 'Colors', component: Colors },
  // { path: '/theme/typography', name: 'Typography', component: Typography },
  // { path: '/base', exact: true, name: 'Base', component: Cards },
  // { path: '/base/cards', name: 'Cards', component: Cards },
  // { path: '/base/forms', name: 'Forms', component: Forms },
  // { path: '/base/switches', name: 'Switches', component: Switches },
  // { path: '/base/tables', name: 'Tables', component: Tables },
  // { path: '/base/tabs', name: 'Tabs', component: Tabs },
  // { path: '/base/breadcrumbs', name: 'Breadcrumbs', component: Breadcrumbs },
  // { path: '/base/carousels', name: 'Carousel', component: Carousels },
  // { path: '/base/collapses', name: 'Collapse', component: Collapses },
  // { path: '/base/dropdowns', name: 'Dropdowns', component: Dropdowns },
  // { path: '/base/jumbotrons', name: 'Jumbotrons', component: Jumbotrons },
  // { path: '/base/list-groups', name: 'List Groups', component: ListGroups },
  // { path: '/base/navbars', name: 'Navbars', component: Navbars },
  // { path: '/base/navs', name: 'Navs', component: Navs },
  // { path: '/base/paginations', name: 'Paginations', component: Paginations },
  // { path: '/base/popovers', name: 'Popovers', component: Popovers },
  // { path: '/base/progress-bar', name: 'Progress Bar', component: ProgressBar },
  // { path: '/base/tooltips', name: 'Tooltips', component: Tooltips },
  // { path: '/buttons', exact: true, name: 'Buttons', component: Buttons },
  // { path: '/buttons/buttons', name: 'Buttons', component: Buttons },
  // { path: '/buttons/button-dropdowns', name: 'Button Dropdowns', component: ButtonDropdowns },
  // { path: '/buttons/button-groups', name: 'Button Groups', component: ButtonGroups },
  // { path: '/buttons/brand-buttons', name: 'Brand Buttons', component: BrandButtons },
  // { path: '/icons', exact: true, name: 'Icons', component: CoreUIIcons },
  // { path: '/icons/coreui-icons', name: 'CoreUI Icons', component: CoreUIIcons },
  // { path: '/icons/flags', name: 'Flags', component: Flags },
  // { path: '/icons/font-awesome', name: 'Font Awesome', component: FontAwesome },
  // { path: '/icons/simple-line-icons', name: 'Simple Line Icons', component: SimpleLineIcons },
  // { path: '/notifications', exact: true, name: 'Notifications', component: Alerts },
  // { path: '/notifications/alerts', name: 'Alerts', component: Alerts },
  // { path: '/notifications/badges', name: 'Badges', component: Badges },
  // { path: '/notifications/modals', name: 'Modals', component: Modals },
  // { path: '/widgets', name: 'Widgets', component: Widgets },
  // { path: '/charts', name: 'Charts', component: Charts },
  // { path: '/users', exact: true,  name: 'Users', component: Users },
  // { path: '/users/:id', exact: true, name: 'User Details', component: User },


  

  { path: '/tahapan', exact: true, name: 'Tahapan Penyusunan RPJMD', component: Tahapan },
  { path: '/tahapan/penetapan-rpjmd', exact: true, name: 'Penetapan Akhir RPJMD', component: PenetapanRPJMD },
  { path: '/tahapan/penetapan-rpjmd/visi-misi', name: 'Visi & Misi', component: VisiMisi },
  { path: '/tahapan/penetapan-rpjmd/gambaran-umum', name: 'Gambaran Umum Daerah', component: GambaranUmum },
  { path: '/tahapan/penetapan-rpjmd/rumusan-masalah', name: 'Rumusan Masalah & Akar Masalah', component: RumusanMasalah },
  { path: '/tahapan/penetapan-rpjmd/strategi-rpjmd', name: 'Isu Strategis RPJMD', component: Strategi },
  { path: '/tahapan/penetapan-rpjmd/tujuan-sarana', name: 'tEs', component: RumusanMasalah },
  { path: '/tahapan/penetapan-rpjmd/sasaran', name: 'Tujuan & Sasaran RPJMD', component: Sasaran },
  { path: '/tahapan/penetapan-rpjmd/strategi', name: 'Strategi & Arah Kebijakan', component: ViewStrategiKebijakan },
  { path: '/tahapan/penetapan-rpjmd/kebijakan', name: 'Arah Kebijakan Keuangan Daerah', component: ViewKebijakan },
  { path: '/tahapan/penetapan-rpjmd/pembangunan', name: 'Program Pembangunan', component: ViewPembangunan },
  { path: '/tahapan/penetapan-rpjmd/indikatif', name: 'Program & Pagu Indikatif', component: Indikatif },
  { path: '/tahapan/penetapan-rpjmd/lampiran', name: 'Lampiran', component: RumusanMasalah },
  { path: '/tahapan/penetapan-rpjmd/daftar-renstra', name: 'Daftar OPD telah Upload', component: DaftarRenstra },

  { path: '/program-kegiatan', name: 'Program & Kegiatan', component: ProgramKegiatan },
  { path: '/manajemen-user', name: 'Manajemen User', component: ManajemenUser },


  //create
  { path: '/menyusun/visi', name: 'Menyusun Visi', component: VisiCreate },
  { path: '/menyusun/misi', name: 'Menyusun Misi', component: MisiCreate },
  { path: '/menyusun/tujuan', name: 'Menyusun Tujuan', component: TujuanCreate },
  { path: '/menyusun/sasaran', name: 'Menyusun Sasaran', component: SasaranCreate },
  { path: '/menyusun/indikator', name: 'Menyusun Indikator', component: IndikatorCreate },
  { path: '/menyusun/strategi', name: 'Menyusun Strategi dan Program', component: StrategiCreate },
  { path: '/menyusun/keuangan', name: 'Menyusun Arah Kebijakan Keuangan Daerah', component: ViewKebijakan },
  { path: '/menyusun/rumusan-masalah', name: 'Menyusun Rumusan Masalah', component: ViewRumusanMasalah },
  { path: '/menyusun/isu-strategi', name: 'Menyusun Rumusan Masalah', component: ViewPerumusanIsuStrategis },
  { path: '/menyusun/tujuan-sasaran', name: 'Menyusun Rumusan Masalah', component: ViewPerumusanTujuanSasaran },
  { path: '/menyusun/perumusan-strategi', name: 'Menyusun Rumusan Masalah', component: ViewPerumusanStrategi },
  { path: '/menyusun/perumusan-program', name: 'Menyusun Rumusan Masalah', component: ViewPerumusanProgram },

  { path: '/menyusun/proyeksi-keuangan', name: 'Menyusun Rumusan Masalah', component: ProyeksiKeuanganCreate },
  { path: '/menyusun/perumusan-pagu', name: 'Menyusun Pagu Indikatif Pertahun', component: PerumusanPaguCreate },
  
  
  //opd
  { path: '/menyusun/opd/visi', name: 'Menyusun Visi', component: OpdVisiCreate },
  { path: '/menyusun/opd/misi', name: 'Menyusun Misi', component: OpdMisiCreate, },
  { path: '/menyusun/opd/tujuan', name: 'Menyusun Tujuan', component: OpdTujuanCreate },
  { path: '/menyusun/opd/sasaran', name: 'Menyusun Sasaran', component: OpdSasaranCreate },
  { path: '/menyusun/opd/indikator', name: 'Menyusun Indikator', component: OpdIndikatorCreate },
  { path: '/menyusun/opd/pegawai', name: 'Menyusun Pegawai OPD', component: PegawaiCreate },
  { path: '/menyusun/opd/renstra-kab', name: 'Menyusun Pegawai OPD', component: RenstraKabCreate },
  { path: '/menyusun/opd/renstra-opd', name: 'Menyusun Pegawai OPD', component: RenstraOpdCreate },
  { path: '/menyusun/opd/pagu', name: 'Menyusun Renja Awal', component: OpdPaguCreate },

  { path: '/menyusun/rkpd/rkpd-awal', name: 'Menyusun RKPD Awal', component: RkpdAwalCreate },
  { path: '/menyusun/rkpd/hasil-musrenbang', name: 'Hasil Musrenbang', component: MusrenbangCreate },
  { path: '/menyusun/rkpd/hasil-pokir', name: 'Hasil Pokir', component: PokirCreate },
  { path: '/menyusun/rkpd/rkpd-verifikasi', name: 'Menyusun RKPD Verifikasi', component: RkpdVerifikasiCreate },

  { path: '/menyusun/rkpd/rkpd-final', name: 'Menyusun RKPD Final', component: RkpdFinalCreate },
  { path: '/menyusun/rkpd/renja-awal', name: 'Menyusun Renja Awal', component: RenjaAwalCreate },

  { path: '/menyusun/rkpd/rkpd-perubahan', name: 'Menyusun RKPD Final', component: RkpdPerubahanCreate },
  { path: '/menyusun/rkpd/renja-perubahan', name: 'Menyusun Renja Awal', component: RenjaPerubahanCreate },

  { path: '/menyusun/rka/pra-rka', name: 'Menyusun RKPD Final', component: PraRkaCreate },

  // admin
  
  { path: '/admin/user', name: 'Mengolah User', component: UserCreate },

  //sotk
  { path: '/sotk/fungsi', name: 'Menyusun Fungsi', component: FungsiCreate },
  { path: '/sotk/bidang', name: 'Menyusun Bidang', component: BidangCreate },
  { path: '/sotk/urusan', name: 'Menyusun Urusan', component: UrusanCreate },
  { path: '/sotk/sub-unit', name: 'Menyusun Sub Unit', component: SubUnitCreate },
  
  //.sotk
  
  { path: '/test', name: 'Menyusun Sub Unit', component: test },
];

export default routes;
