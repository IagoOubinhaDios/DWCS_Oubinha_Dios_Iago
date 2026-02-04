<?php
//TODO
namespace Ejercicios\ejercicio4_2\controller;
use Ejercicios\ejercicio4_2\core\Response;
use Ejercicios\ejercicio4_2\model\UsuarioModel;
use Ejercicios\ejercicio4_2\model\vo\UsuarioVo;
use Exception;
use Firebase\JWT\JWT;
class AuthController extends Controller {
    
    public function login()
    {
        try {
            $this->request->validate([
                'email' => 'required|string|max:256',
                'password' => 'required|string|max:255'
            ]);
            $user = $this->request->body();
            $user = UsuarioModel::getByEmailPassword($user['email'], $user['password']);
            if ($user === null) {
                Response::json(['error' => 'No autenticado. Revise credenciales.'], 401);
                return;
            }

            //Devolver el token JWT
            $token = self::createJwt($user, 3600);
            Response::json(['token' => $token], 200);
        } catch (\Throwable $th) {
            error_log("AuthController->login()" . $th->getMessage());
            Response::serverError();
        }
    }

    private function createJwt(UsuarioVo $vo,  $expireSeconds){
        
        //Payload para el token JWT
        $payload = [
            "sub" => $vo->getId(),
            "iat" => time(),
            "exp" => time() + $expireSeconds,
            "rol" => 'user'
        ];
        
        $jwt = JWT::encode($payload, $_ENV['JWT_SECRET_KEY'], $_ENV['JWT_ALGO']);

        return $jwt;
    }
}