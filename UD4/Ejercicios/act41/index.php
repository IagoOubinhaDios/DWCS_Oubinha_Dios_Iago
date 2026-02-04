<?php
use Ejercicios\act41\core\Request;
use Ejercicios\act41\core\Router;

// Cargamos configuración 
$_ENV = parse_ini_file(__DIR__.'/config/.env');

spl_autoload_register(function ($clase) {

    $ruta = $_SERVER['DOCUMENT_ROOT'] . '/' . str_replace('\\', '/', $clase) . '.php';
    if (file_exists($ruta)) {
        require_once $ruta;
    } else {
        error_log("No se encuentra la clase : $ruta");
    }
});

$request = new Request();
$router = new Router();

require_once 'config/routes.php';

$router->dispatch($request);
