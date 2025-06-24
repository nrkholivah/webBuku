<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/beranda', 'Books::beranda');
$routes->get('/tentang', 'Books::tentang');
$routes->get('/hubungi', 'Books::hubungi');

$routes->get('/', 'Books::index');
$routes->get('/books', 'Books::index');
$routes->get('/books/tambah', 'Books::tambah'); // form tambah
$routes->post('/books', 'Books::save');         // proses tambah
$routes->get('/books/edit/(:segment)', 'Books::edit/$1');
$routes->post('/books/update/(:num)', 'Books::update/$1');
$routes->delete('/books/(:segment)', 'Books::delete/$1');
$routes->post('/books/(:num)', 'Books::delete/$1');

$routes->get('/books/(:segment)', 'Books::detail/$1');
$routes->get('/penulis', 'Penulis::index');
