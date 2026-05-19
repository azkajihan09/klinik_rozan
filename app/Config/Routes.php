<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Dashboard::index');
$routes->match(['get','post'], 'login', 'Auth::login');
$routes->get('logout', 'Auth::logout');
$routes->get('dashboard', 'Dashboard::index');

$routes->get('module/(:segment)', 'Module::index/$1');
$routes->get('module/(:segment)/new', 'Module::create/$1');
$routes->post('module/(:segment)', 'Module::store/$1');
$routes->get('module/(:segment)/edit/(.+)', 'Module::edit/$1/$2');
$routes->post('module/(:segment)/update/(.+)', 'Module::update/$1/$2');
$routes->post('module/(:segment)/delete/(.+)', 'Module::delete/$1/$2');

$routes->get('pasien/riwayat/(.+)', 'Pasien::riwayat/$1');
$routes->get('registrasi/create-no-rawat', 'Registrasi::createNoRawat');
$routes->get('billing/hitung/(.+)', 'Billing::hitung/$1');
