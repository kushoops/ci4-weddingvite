<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('login', 'Home::login');

// Admin
$routes->group('admin', [], function($routes) {
  $routes->get('mempelai', 'AdminController::mempelai');
  $routes->get('tambah-mempelai', 'AdminController::tambahMempelai');
  $routes->get('data-undangan', 'AdminController::dataUndangan');
  $routes->get('tamu', 'AdminController::tamu');
  $routes->get('tambah-tamu', 'AdminController::tambahTamu');
  $routes->get('undangan', 'AdminController::undangan');
  $routes->get('tambah-undangan', 'AdminController::tambahUndangan');
  $routes->get('profile', 'AdminController::profile');
});

// Mempelai
$routes->group('mempelai', [], function($routes) {
  $routes->get('tamu', 'MempelaiController::tamu');
  $routes->get('tambah-tamu', 'MempelaiController::tambahTamu');
  $routes->get('undangan', 'MempelaiController::undangan');
  $routes->get('data-undangan', 'MempelaiController::dataUndangan');
  $routes->get('pesan-kiriman', 'MempelaiController::pesanKiriman');
  $routes->get('rsvp', 'MempelaiController::rsvp');
  $routes->get('ucapan', 'MempelaiController::ucapan');
  $routes->get('profile', 'MempelaiController::profile');
});

// Undangan
$routes->group('undangan', [], function($routes) {
  $routes->get('orange-10', 'UndanganController::orange10');
});

service('auth')->routes($routes);

// API Routes
$routes->group('api', ["namespace" => "App\Controllers\Api"], function($routes) {

  // Auth
  $routes->post('login', 'AuthController::login');
  $routes->get('auth/(:num)', 'AuthController::auth/$1');
  $routes->get('logout', 'AuthController::logout', ["filter" => "auth"]);
  $routes->get('invalid', 'AuthController::invalid');

  // Admin
  $routes->group('admin', ["namespace" => "App\Controllers\Api"], function($routes) {
    $routes->post('register', 'AdminController::register');
    $routes->get('single/(:num)', 'AdminController::single/$1', ["filter" => "auth"]);
    $routes->get('list', 'AdminController::list', ["filter" => "auth"]);
    $routes->delete('remove/(:num)', 'AdminController::remove/$1', ["filter" => "auth"]);
  });
  
  // Undangan
  $routes->group('undangan', ["namespace" => "App\Controllers\Api"], function($routes) {
    $routes->post('add', 'UndanganController::add', ["filter" => "auth"]);
    $routes->get('list', 'UndanganController::list', ["filter" => "auth"]);
    $routes->delete('remove/(:num)', 'UndanganController::remove/$1', ["filter" => "auth"]);
    $routes->get('undangan-mempelai/(:num)', 'UndanganController::undanganMempelai/$1');
    $routes->get('undangan-tamu/(:num)/(:num)', 'UndanganController::undanganTamu/$1/$2');
  });
  
  // Mempelai
  $routes->group('mempelai', ["namespace" => "App\Controllers\Api"], function($routes) {
    $routes->post('register', 'MempelaiController::register', ["filter" => "auth"]);
    $routes->get('list', 'MempelaiController::list', ["filter" => "auth"]);
    $routes->get('single/(:num)', 'MempelaiController::single/$1', ["filter" => "auth"]);
    $routes->put('change/(:num)', 'MempelaiController::change/$1', ["filter" => "auth"]);
    $routes->delete('remove/(:num)', 'MempelaiController::remove/$1', ["filter" => "auth"]);
  });
  
  // Tamu
  $routes->group('tamu', ["namespace" => "App\Controllers\Api"], function($routes) {
    $routes->post('add/(:num)', 'TamuController::add/$1', ["filter" => "auth"]);
    $routes->get('list/(:num)', 'TamuController::list/$1', ["filter" => "auth"]);
    $routes->get('single/(:num)', 'TamuController::single/$1', ["filter" => "auth"]);
    $routes->put('change/(:num)', 'TamuController::change/$1', ["filter" => "auth"]);
    $routes->put('change-opened/(:num)', 'TamuController::changeOpened/$1');
    $routes->put('change-rsvp/(:num)', 'TamuController::changeRSVP/$1');
    $routes->delete('remove/(:num)', 'TamuController::remove/$1', ["filter" => "auth"]);
  });
  
  // Ucapan
  $routes->group('ucapan', ["namespace" => "App\Controllers\Api"], function($routes) {
    $routes->post('add/(:num)/(:any)', 'UcapanController::add/$1/$2');
    $routes->get('list/(:num)', 'UcapanController::list/$1');
    $routes->delete('remove/(:num)', 'UcapanController::remove/$1', ["filter" => "auth"]);
  });
});