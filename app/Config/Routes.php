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

$routes->group('servicios', ['filter' => 'AuthFilter'], function ($routes) {
    $routes->get('index', 'ServiciosController::index');
    $routes->get('obtener_areas', 'ServiciosController::obtenerAreas');
    $routes->get('obtener_detalles', 'ServiciosController::obtenerDetalles');
    $routes->post('editar', 'ServiciosController::update');
    $routes->post('insertar_detalle', 'ServiciosController::insertar');
    $routes->post('editar_detalle', 'ServiciosController::updateDetalle');
    $routes->post('eliminar_detalle', 'ServiciosController::delete');
});

$routes->group('galeria', ['filter' => 'AuthFilter'], function ($routes) {
    $routes->get('index', 'GaleriaController::index');
    $routes->get('obtener_areas', 'ServiciosController::obtenerAreas');
    $routes->get('obtener_detalles', 'GaleriaController::obtenerDetalles');
    $routes->post('editar', 'ServiciosController::update');
    $routes->post('insertar_detalle', 'ServiciosController::insertar');
    $routes->post('editar_detalle', 'ServiciosController::updateDetalle');
    $routes->post('eliminar_detalle', 'ServiciosController::delete');

  $routes->post('actualizarFotoDetalle', 'GaleriaController::actualizarFotoDetalle');
  $routes->get('imagenes_locales', 'GaleriaController::listarImagenesUploads');
});

