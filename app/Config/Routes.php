<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

//Rotas Tasks
$routes->get('/', 'TaskController::index');
$routes->get('/create', 'TaskController::create');
$routes->post('/store', 'TaskController::store');
$routes->get('/edit/(:num)', 'TaskController::edit/$1');
$routes->post('/update/(:num)', 'TaskController::update/$1');
$routes->get('/delete/(:num)', 'TaskController::delete/$1');

// Rotas API
$routes->group('api', static function($routes) {
    // Get Geral: Lista todas as tarefas
    $routes->get('tasks', 'TaskApiController::index');
    
    // Get por ID
    $routes->get('tasks/(:num)', 'TaskApiController::show/$1');
    
    // POST: Cria uma nova tarefa 
    $routes->post('tasks', 'TaskApiController::create');

    // PUT: Atualiza uma tarefa existente
    $routes->put('tasks/(:num)', 'TaskApiController::update/$1');

    // DELETE: Remove uma tarefa existente
    $routes->delete('tasks/(:num)',
    'TaskApiController::delete/$1');
});