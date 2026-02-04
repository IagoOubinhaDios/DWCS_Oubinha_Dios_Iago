<?php
//TODO
namespace Ejercicios\ejercicio4_2\config;
use Ejercicios\ejercicio4_2\controller\SensorController;
use Ejercicios\ejercicio4_2\controller\AuthController;
use Ejercicios\ejercicio4_2\controller\AlertaController;
use Ejercicios\ejercicio4_2\core\middleware\JwtUserMiddleware;
use Ejercicios\ejercicio4_2\core\middleware\SensorMiddleware;

$router->post('/login', [AuthController::class, 'login']);
$router->get('/sensores', [SensorController::class, 'index'], [JwtUserMiddleware::class]);
$router->post('/sensores', [SensorController::class, 'store'], [JwtUserMiddleware::class]);
$router->get('/sensores/{mac}', [SensorController::class, 'show'], [SensorMiddleware::class]);
$router->put('/sensores/{mac}', [SensorController::class, 'update'], [JwtUserMiddleware::class]);
$router->post('/alerta', [AlertaController::class, 'store'], [SensorMiddleware::class]);