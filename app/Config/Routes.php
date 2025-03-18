<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('login', 'Auth::login');
$routes->get('register', 'Auth::register');
$routes->post('auth/processLogin', 'Auth::processLogin');
$routes->get('logout', 'Auth::logout');
$routes->get('dashboard', 'Dashboard::index');
$routes->get('/test-db', 'DatabaseTest::testConnection');
$routes->get('/test-register', 'Auth::testRegister');
$routes->post('/auth/processRegister', 'Auth::processRegister');


