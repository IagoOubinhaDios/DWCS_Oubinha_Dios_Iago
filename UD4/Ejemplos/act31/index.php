<?php
require_once "globals.php";
use Ejemplos\act31\core\Request;

//Autoload
/**
 * Esta funcion registra un callback que PHP llamara cada vez que encuentre una clase que aun no esta cargada.
 * Ese callback se encarga de buscar el archivo correcto y hacer el require.
 * De este modo podemos indicar simplemente los namespaces que estamos usando (parecido a Java) y evitar porner
 * requires (o includes) cada vez que necesitamos usar una clase.
 */
spl_autoload_register(function ($clase) {

    $ruta = $_SERVER['DOCUMENT_ROOT'].'/'.str_replace('\\', '/', $clase) . '.php';
    if (file_exists($ruta)) {
        require_once $ruta;
    } else {
        error_log("No se encuentra la clase : $ruta");
    }
});

// 0.- Declarar endpoints
$endpoints = [
    ['method' => 'GET', 'uri' => '/municipios', 'handler' => ['MunicipioController', 'index']],
    ['method' => 'GET', 'uri' => '/municipios/{id}', 'handler' => ['MunicipioController', 'show']],
    ['method' => 'DELETE', 'uri' => '/municipios/{id}', 'handler' => ['MunicipioController', 'destroy']],
    ['method' => 'UPDATE', 'uri' => '/municipios/{id}', 'handler' => ['MunicipioController', 'update']],
    ['method' => 'POST', 'uri' => '/municipios', 'handler' => ['MunicipioController', 'store']],
];

$request = new Request();
$router = new Router();

require_once 'config/routes.php';

$router->dispatch($request);

// 1.- Obtener el método, url y body de la petición
$request = new Request();

// 2.- Localizar el endpoint
// Recorremos todos los endpoints declarados
foreach($endpoints as $route){
    // Comprobamos que el método coincide
    if($route['method'] == $request->method()){
        // Comprobamos que la uri encaja
        if($route['uri'] == $request->url()){
                
        }
    }
}