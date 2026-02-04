<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Pages;
use App\Controllers\Alumnos;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');//main page
$routes->get('alumnos', [Alumnos::class, 'index']); //muestra la lista de alumnos
$routes->get('alumnos/create', [Alumnos::class, 'renderCreate']);   //muestra el formulario de creación de alumno
$routes->post('alumnos/create', [Alumnos::class, 'create']);    //crea un nuevo alumno
$routes->get('alumnos/edit/(:num)', [Alumnos::class, 'renderEdit']);   //muestra el formulario de edición de alumno
$routes->post('alumnos/edit/(:num)', [Alumnos::class, 'edit']);    //actualiza un alumno existente
$routes->get('alumnos/delete/(:num)', [Alumnos::class, 'delete']);    //elimina un alumno
