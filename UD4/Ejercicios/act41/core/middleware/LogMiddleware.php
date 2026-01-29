<?php 
namespace Ejercicios\act41\core\middleware;
use Ejercicios\act41\core\Request;
class LogMiddleware implements Middleware{
    public function handle(Request $request){
        error_log("Acceso capturado ".$request->uri());
    }
}