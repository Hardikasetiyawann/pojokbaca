<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->setDefaultNamespace('App\Controllers');
$routes->get('uploads/(:any)', 'App\Controllers\UploadController::getFile/$1');

$routes->get('/', 'Home::index');

// Buku
$routes->get('Buku/rekomendasi', 'Buku::rekomendasi');
$routes->resource('Buku');
$routes->get('buku/user/(:num)', 'Buku::getBooksByUser/$1');
$routes->get('/dashboard', 'DashboardController::getStats');


// Peminjaman
$routes->group('Peminjaman', function($routes) {
    $routes->get('/', 'Peminjaman::index');
    $routes->post('/', 'Peminjaman::create');
    $routes->get('user/(:num)', 'Peminjaman::getByUser/$1');
    $routes->delete('(:num)', 'Peminjaman::delete/$1');
});

// Pengguna
$routes->resource('Pengguna');
$routes->post('login', 'Auth::login');



// Resource lainnya
$routes->resource('Admin');
$routes->resource('Genre');
$routes->resource('Kategori');
$routes->resource('Penulis');
$routes->resource('Penerbit');
$routes->resource('PenilaianBuku');
