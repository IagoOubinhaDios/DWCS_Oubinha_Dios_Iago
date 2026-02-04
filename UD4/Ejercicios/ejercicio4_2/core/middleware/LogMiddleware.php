<?php
namespace Ejercicios\ejercicio4_2\core\middleware;
use Ejercicios\ejercicio4_2\core\Request;
use Ejercicios\ejercicio4_2\core\Response;
use Ejercicios\ejercicio4_2\model\UsuarioModel;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
class LogMiddleware implements Middleware {

    public function handle(Request $request) {
        try {
            $token = $request->getHeader('Authorization');
            $token = str_replace('Bearer ', '', $token);

            if(!isset($token)) {
                Response::json(['error' => 'Usuario no autenticado'], 401);
                return;
            }

            $payload = JWT::decode($token, new Key($_ENV['JWT_SECRET_KEY'], $_ENV['JWT_ALGO']));

            if ($payload->rol != 'user') {
                Response::json(['error' => 'Token incorrecto para usuario'], 401);
                exit;
            }

            $request->usuario = UsuarioModel::get($payload->sub);
        } catch (Exception $th) {
            Response::json(['error' => 'Usuario no autenticado'], 401);
            return;
        }

    }
}