import React from 'react';
import DefaultLayout from './containers/DefaultLayout';

const Dashboard = React.lazy(() => import('./views/Dashboard'));
const Akun = React.lazy(() => import('./views/Akun'));
const Kelurahan = React.lazy(() => import('./views/Kelurahan'));
const KecamatanTambah = React.lazy(() => import('./views/KecamatanTambah'));
const PokirTambah = React.lazy(() => import('./views/PokirTambah'));

const AdminMusrenbang = React.lazy(() => import('./views/AdminTambah'));
const AdminPokir = React.lazy(() => import('./views/AdminUsulanPokir'));

const AdminImport = React.lazy(() => import('./views/Import'));
const KecamatanImport = React.lazy(() => import('./views/ImportKecamatan'));


// https://github.com/ReactTraining/react-router/tree/master/packages/react-router-config
const routes = [
  { path: '/', exact: true, name: 'Home', component: DefaultLayout },
  { path: '/dashboard', name: 'Dashboard', component: Dashboard },
  { path: '/kelurahan/tambah-usulan', name: 'Tambah Usulan Kelurahan', component: Kelurahan },
  { path: '/kelurahan/data-usulan', name: 'Data Usulan Kelurahan', component: Kelurahan },
  { path: '/kecamatan/tambah-usulan', name: 'Tambah Usulan Kecamatan', component: KecamatanTambah },
  { path: '/kecamatan/data-usulan', name: 'Data Usulan Kecamatan', component: Kelurahan },
  { path: '/pokir/tambah-usulan', name: 'Tambah Usulan Pokir', component: PokirTambah },
  { path: '/pokir/data-usulan', name: 'Data Usulan Pokir', component: Kelurahan },
  { path: '/usulan/data-musrenbang', name: 'Data Usulan Musrenbang', component: AdminMusrenbang },
  { path: '/usulan/data-pokir', name: 'Data Usulan Pokir', component: AdminPokir },
  // { path: '/admin/table', name: 'Table', component: Tables },
  // { path: '/admin/form', name: 'Form', component: Forms },
  { path: '/akun', name: 'Akun', component: Akun },
  { path: '/import', name: 'Import Export', component: AdminImport },
  { path: '/kecamatan/import', name: 'Import Kecamatan', component: KecamatanImport },
];

export default routes;
