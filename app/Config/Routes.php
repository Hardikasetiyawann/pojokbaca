<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->resource('Penggunaa');
$routes->resource('Admin');
$routes->resource('Buku');
$routes->resource('Genre');
$routes->resource('Kategori');
$routes->resource('Penulis');
$routes->resource('Penerbit');
$routes->resource('PenilaianBuku');

$routes->setDefaultNamespace('App\Controllers');
