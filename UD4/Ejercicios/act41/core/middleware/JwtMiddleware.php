<?php
namespace Ejercicios\act41\core\middleware;
use Ejercicios\act41\core\Request;
use Ejercicios\act41\core\Response;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;
class JwtMiddleware implements Middleware {
    public function handle(Request $request) {
        $token = $request->getHeader('Authorization');

        if(!isset($token)){
            Response::json(["messaje"=>"Usuario no autenticado."],401);
            return;
        }

        $token = str_replace('Bearer ','',$token);

        try {
            $payload = JWT::decode($token, new Key($_ENV['JWT_SECRET_KEY'],$_ENV['JWT_ALGO']));
            Response::json(["messaje"=>"Usuario con id $payload->sub e email $payload->email. Autenticado!!"],200);
        } catch (Exception $th) {
            Response::json(["messaje"=>"Usuario no autenticado."],401);
        }
    }
}