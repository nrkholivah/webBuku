<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/beranda', 'Books::beranda');           // Halaman Beranda
$routes->get('/tentang', 'Books::tentang');     // Halaman Tentang
$routes->get('/hubungi', 'Books::hubungi');

$routes->get('/', 'Books::index');
$routes->get('/books', 'Books::index');

$routes->get('/books/tambah', 'Books::tambah');         // Form tambah
$routes->post('/books', 'Books::save');                 // Proses tambah

$routes->get('/books/edit/(:segment)', 'Books::edit/$1');    // Form edit
$routes->post('/books/update/(:num)', 'Books::update/$1');  // Proses update

$routes->delete('/books/(:num)', 'Books::delete/$1');       // Hapus
$routes->post('/books/(:num)', 'Books::delete/$1');

$routes->get('/books/(:segment)', 'Books::detail/$1');      // Detail
