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
    $routes->post('enviar_credenciales_correo', 'LoginController::enviarCredencialesCorreo');
});

$routes->get('/', 'PageController::index');
$routes->post('enviar_correo', 'ContactoController::enviarCorreo');

$routes->group('acceso', ['filter' => 'CambioFilter'], function ($routes) {
    $routes->post('clave', 'LoginController::changePassword');
});

// $routes->group('dashboard', ['filter' => 'AuthFilter'], function ($routes) {
//     $routes->get('/', 'Home::index');
//     $routes->get('index', 'Home::index');
// });

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
    $routes->get('obtener_areas', 'GaleriaController::obtenerAreas');
    $routes->get('obtener_detalles', 'GaleriaController::obtenerDetalles');
    $routes->post('editar', 'GaleriaController::update');
    $routes->post('eliminar_detalle', 'GaleriaController::delete');
    $routes->post('insertar_detalle', 'GaleriaController::insertar');
    $routes->post('editar_galeria', 'GaleriaController::updateGaleria');
    $routes->get('imagenes_locales', 'GaleriaController::listarImagenesUploads');
    $routes->post('eliminar_imagen', 'GaleriaController::eliminarImagenLocal');
});

$routes->group('testimonios', ['filter' => 'AuthFilter'], function ($routes) {
    $routes->get('index', 'TestimoniosController::index');
    $routes->get('obtener_areas', 'TestimoniosController::obtenerAreas');
    $routes->get('obtener_detalles', 'ServiciosController::obtenerDetalles');
    $routes->post('editar_detalle', 'TestimoniosController::updateTestimonio');
    $routes->post('insertar_detalle', 'TestimoniosController::insertar');
    $routes->post('eliminar_detalle', 'TestimoniosController::delete');
    $routes->post('editar', 'TestimoniosController::update');
});

$routes->group('contacto', ['filter' => 'AuthFilter'], function ($routes) {
    $routes->get('index', 'ContactoController::index');
    $routes->get('obtener_areas', 'ContactoController::obtenerAreas');
    $routes->post('editar', 'ContactoController::update');
});

$routes->group('head', ['filter' => 'AuthFilter'], function ($routes) {
    $routes->get('index', 'HeadController::index');
    $routes->get('obtener_areas', 'HeadController::obtenerAreas');
    $routes->post('editar', 'HeadController::update');
    $routes->post('editar_detalle', 'HeadController::updateDetalle');
});


$routes->group('usuarios', ['filter' => 'AuthFilter'], function ($routes) {
    $routes->get('index', 'UsuariosController::index');
    $routes->get('obtener_usuarios', 'UsuariosController::getAllUsers');
});

