<?php
namespace Ejercicios\ejercicio4_2\core\middleware;
use Ejercicios\ejercicio4_2\core\Request;
class LogMiddleware implements Middleware{
    public function handle(Request $request) {
        error_log("Acceso capturado ".$request->uri());
    }
}