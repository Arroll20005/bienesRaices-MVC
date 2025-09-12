<?php 
require_once __DIR__ . '/../includes/app.php';
use MVC\Router;
use Controllers\PropiedadController;
use Controllers\VendedoresController;

$router = new Router();
$router->get('/', [PropiedadController::class, 'inicio']);
$router->get('/admin', [PropiedadController::class, 'index']);
$router->get('/propiedades/crear', [PropiedadController::class, 'crear']);
$router->post('/propiedades/crear', [PropiedadController::class, 'crear']);
$router->get('/propiedades/actualizar', [PropiedadController::class, 'actualizar']);
$router->post('/propiedades/actualizar', [PropiedadController::class, 'actualizar']);
$router->post('/propiedades/eliminar', [PropiedadController::class, 'eliminar']);

$router->get('/vendedores/crear', [VendedoresController::class, 'crear']);
$router->post('/vendedores/crear', [VendedoresController::class, 'crear']);
$router->get('/vendedores/actualizar', [VendedoresController::class, 'actualizar']);
$router->post('/vendedores/actualizar', [VendedoresController::class, 'actualizar']);
$router->post('/vendedores/eliminar', [VendedoresController::class, 'eliminar']);

$router->comprobarRutas();




