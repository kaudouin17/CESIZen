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
$routes->get('/admin', 'Admin::index', ['filter' => 'adminAuth']);
$routes->get('/admin/users', 'Admin::users');
$routes->get('/admin/users/edit/(:num)', 'Admin::editUser/$1');
$routes->post('/admin/users/update/(:num)', 'Admin::updateUser/$1');
$routes->get('/admin/users/delete/(:num)', 'Admin::deleteUser/$1');
$routes->get('/admin/users/toggle/(:num)', 'Admin::toggleStatus/$1');
$routes->get('/admin/users/filter', 'Admin::filterUsers');
$routes->get('/admin/users/filter', 'User::filter');
$routes->get('/admin/users/create', 'Admin::createUser');
$routes->post('/admin/users/store', 'Admin::storeUser');
    





