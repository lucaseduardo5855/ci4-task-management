<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');


//CRUD
$routes->get('/register', 'TaskController::register');
$routes->post('/register', 'TaskController::doRegister');
$routes->get('/list', 'TaskController::list');
