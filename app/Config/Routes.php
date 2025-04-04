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
$routes->get('/admin', 'Admin::dashboard', ['filter' => 'adminAuth']);
$routes->get('/admin/users', 'Admin::users');
$routes->get('/admin/users/edit/(:num)', 'Admin::editUser/$1');
$routes->post('/admin/users/update/(:num)', 'Admin::updateUser/$1');
$routes->get('/admin/users/delete/(:num)', 'Admin::deleteUser/$1');
$routes->get('/admin/users/toggle/(:num)', 'Admin::toggleStatus/$1');
$routes->get('/admin/users/filter', 'Admin::filterUsers');
$routes->get('/admin/users/filter', 'User::filter');
$routes->get('/admin/users/create', 'Admin::createUser');
$routes->post('/admin/users/store', 'Admin::storeUser');
$routes->get('/profile', 'Profile::index');
$routes->post('/profile/update', 'Profile::update');
$routes->get('/profile/edit', 'Profile::edit');
$routes->get('/profile/avatar', 'Profile::avatar');
$routes->post('/profile/update-avatar', 'Profile::updateAvatar');
$routes->get('/informations', 'Informations::index');
$routes->get('/informations/(:num)', 'Informations::show/$1');
$routes->get('/admin/informations', 'Admin::informations', ['filter' => 'adminAuth']);
$routes->get('/admin/informations/filter', 'Admin::filterInformations', ['filter' => 'adminAuth']);
$routes->get('/admin/informations/create', 'Admin::createArticle', ['filter' => 'adminAuth']);
$routes->post('/admin/informations/store', 'Admin::storeArticle', ['filter' => 'adminAuth']);
$routes->get('/admin/informations/edit/(:num)', 'Admin::editArticle/$1');
$routes->post('/admin/informations/update/(:num)', 'Admin::updateArticle/$1');
$routes->get('/admin/informations/delete/(:num)', 'Admin::deleteArticle/$1', ['filter' => 'adminAuth']);
$routes->get('/exercises', 'Exercises::index');
$routes->post('exercises/terminer', 'Exercises::terminer');
$routes->get('/mentions-legales', 'Pages::mentionsLegales');
$routes->get('/contact', 'Pages::contact');
$routes->get('/a-propos', 'Pages::aPropos');












