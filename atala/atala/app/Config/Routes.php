<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Root');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->add('/', 'Root::index');
$routes->add('/login', 'Root::proseslogin');
$routes->add('/logout', 'Root::proseslogout');
$routes->add('/daftar', 'Root::tampildaftar');
$routes->add('/registers', 'Root::prosesregister');
//===========================================================
//============= Administrator
$routes->add('/admin', 'Admin::index');
$routes->add('/admin/profil', 'Admin::tampilprofil');
$routes->add('/admin/profil/ubah', 'Admin::ubahprofil');
$routes->add('/tolak/(:any)', 'Admin::tolakakun/$1');
$routes->add('/terima/(:any)', 'Admin::terimaakun/$1');

$routes->add('/pengguna', 'Pengguna::index');
$routes->add('/pengguna/simpan', 'Pengguna::simpandata');
$routes->add('/pengguna/ubah', 'Pengguna::ubahdata');

$routes->add('/kriteria', 'Kriteria::index');
$routes->add('/kriteria/simpan', 'Kriteria::simpandata');
$routes->add('/kriteria/ubah', 'Kriteria::ubahdata');

$routes->add('/indikator', 'Indikator::index');
$routes->add('/indikator/simpan', 'Indikator::simpandata');
$routes->add('/indikator/ubah', 'Indikator::ubahdata');

$routes->add('/proyek', 'Proyek::index');
$routes->add('/proyek/simpan', 'Proyek::simpandata');
$routes->add('/proyek/ubah', 'Proyek::ubahdata');
$routes->add('/skema', 'Proyek::tampilskema');
$routes->add('/skema/tampil', 'Proyek::tampilskemaproyek');
$routes->add('/skema/simpan', 'Proyek::simpanskema');

$routes->add('/nilai', 'Nilai::index');
$routes->add('/nilai/tampil', 'Nilai::tampildata');
$routes->add('/nilai/ubah', 'Nilai::ubahdata');

$routes->add('/proses', 'Proses::index');
$routes->add('/proses/analisa/(:any)', 'Proses::analisadata/$1');
$routes->add('/proses/tampil', 'Proses::tampildata');

$routes->add('/laporan', 'Laporan::index');
$routes->add('/laporan/cetak/(:any)', 'Laporan::cetakdata/$1');

//============= Supplier
$routes->add('/supplier', 'Supplier::index');
$routes->add('/supplier/profil', 'Supplier::tampilprofil');
$routes->add('/supplier/profil/ubah', 'Supplier::ubahprofil');
$routes->add('/simpanberkas', 'Supplier::simpanberkas');

$routes->add('/register', 'Register::index');
$routes->add('/register/ambil/(:any)', 'Register::simpandata/$1');
$routes->add('/register/batal/(:any)', 'Register::hapusdata/$1');

$routes->add('/penilaian', 'Penilaian::index');
$routes->add('/penilaian/simpan', 'Penilaian::simpandata');
$routes->add('/result', 'Penilaian::tampilhasil');
$routes->add('/result/detail/(:any)', 'Penilaian::detailhasil/$1');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
