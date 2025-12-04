<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->group('login', function ($routes) {
    $routes->get('/', 'LoginController::index');
    $routes->post('login', 'LoginController::LogueoIngreso');
    $routes->get('logout', 'LoginController::salir');
    $routes->get('unauthorized', 'LoginController::unauthorized');
    $routes->post('enviar_credenciales_correo', 'LoginController::EnviarCredencialesCorreo');
});

$routes->group('', ['filter' => 'AuthFilter'], function ($routes) {
    $routes->get('/', 'Home::index');
    $routes->get('dashboard', 'Home::index');
});

