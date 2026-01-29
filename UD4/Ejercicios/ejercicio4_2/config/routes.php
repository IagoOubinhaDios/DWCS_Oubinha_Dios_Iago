<?php
namespace Ejercicios\ejercicio4_2\config;
use Ejercicios\ejercicio4_2\controller\SensorController;
use Ejercicios\ejercicio4_2\controller\AuthController;
use Ejercicios\ejercicio4_2\controller\AlertaController;
use Ejercicios\ejercicio4_2\core\middleware\LogMiddleware;
use Ejercicios\ejercicio4_2\core\middleware\SensorMiddleware;

$router->get('/login', [AuthController::class, 'login'], [LogMiddleware::class]);
$router->get('/sensores', [SensorController::class, 'index'], [LogMiddleware::class]);
$router->post('/sensores', [SensorController::class, 'store'], [LogMiddleware::class]);
$router->get('/sensores/{mac}', [SensorController::class, 'show'], [SensorMiddleware::class]);
$router->put('/sensores/{mac}', [SensorController::class, 'update'], [SensorMiddleware::class]);
$router->get('/alerta', [AlertaController::class, 'store'], [SensorMiddleware::class]);



