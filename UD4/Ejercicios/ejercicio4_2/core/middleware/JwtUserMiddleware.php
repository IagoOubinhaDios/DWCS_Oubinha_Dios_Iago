<?php
//TODO
namespace Ejercicios\ejercicio4_2\core\middleware;
use Ejercicios\ejercicio4_2\core\Request;
use Ejercicios\ejercicio4_2\core\Response;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
class JwtUserMiddleware implements Middleware{
    public function handle(Request $request) {
        $token = $request->getHeader('Authorization');
        $token = str_replace('Bearer ','',$token);

        if(!isset($token)){
            Response::json(["messaje"=>"Usuario no autenticado."],401);
            return;
        }

        try {
            $payload = JWT::decode($token, new Key($_ENV['JWT_SECRET_KEY'],$_ENV['JWT_ALGO']));
            if($payload->rol != 'user') {
                Response::json(["messaje"=>"Token incorrecto para usuario."],401);
                exit;
            }

            Response::json(["messaje"=>"Usuario con id $payload->sub. Autenticado!!"],200);
        } catch (Exception $th) {
            Response::json(["messaje"=>"Usuario no autenticado."],401);
        }
    }
}