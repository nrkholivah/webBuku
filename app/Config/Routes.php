<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/beranda', 'Books::beranda');
$routes->get('/tentang', 'Books::tentang');
$routes->get('/hubungi', 'Books::hubungi');

$routes->get('/', 'Books::index');
$routes->get('/books/tambah', 'Books::tambah');
$routes->post('/books', 'Books::save');
$routes->get('/books/edit/(:segment)', 'Books::edit/$1');
$routes->post('/books/update/(:num)', 'Books::update/$1');
$routes->get('/books/(:segment)', 'Books::delete/$1');
$routes->delete('/books/(:num)', 'Books::delete/$1');
$routes->get('/books/(:segment)', 'Books::detail/$1');

