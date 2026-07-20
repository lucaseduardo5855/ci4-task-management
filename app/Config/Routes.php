<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

//CRUD Tasks
$routes->get('/', 'TaskController::index');
$routes->get('/create', 'TaskController::create');
$routes->post('/store', 'TaskController::store');
$routes->get('/edit/(:num)', 'TaskController::edit/$1');
$routes->post('/update/(:num)', 'TaskController::update/$1');
$routes->get('/delete/(:num)', 'TaskController::delete/$1');

