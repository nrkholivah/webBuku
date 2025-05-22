<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Books::index');
//$routes->get('/books', 'Books::index');
$routes->get('/books/(:segment)', 'Books::detail/$1');
$routes->get('/tambah', 'Books::tambah');
$routes->delete('books/(:num)', 'Books::delete/$1');
$routes->get('/books/edit/(:segment)', 'Books::edit/$1');
