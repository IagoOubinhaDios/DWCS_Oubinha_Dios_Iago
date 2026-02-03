<?php
//TODO
namespace Ejercicios\ejercicio4_2\config;
use Ejercicios\ejercicio4_2\controller\SensorController;
use Ejercicios\ejercicio4_2\controller\AuthController;
use Ejercicios\ejercicio4_2\controller\AlertaController;
use Ejercicios\ejercicio4_2\core\middleware\JwtUserMiddleware;
use Ejercicios\ejercicio4_2\core\middleware\SensorMiddleware;

$router->get('/login', [AuthController::class, 'login'], [JwtUserMiddleware::class]);
$router->get('/sensores', [SensorController::class, 'index'], [JwtUserMiddleware::class]);
$router->post('/sensores', [SensorController::class, 'store'], [JwtUserMiddleware::class]);
$router->get('/sensores/{mac}', [SensorController::class, 'show']);
$router->put('/sensores/{mac}', [SensorController::class, 'update'], [SensorMiddleware::class]);
$router->get('/alerta', [AlertaController::class, 'store'], [SensorMiddleware::class]);