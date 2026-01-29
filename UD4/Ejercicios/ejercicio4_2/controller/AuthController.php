<?php
namespace Ejercicios\ejercicio4_2\controller;
use Ejercicios\ejercicio4_2\core\Request;
use Ejercicios\ejercicio4_2\core\Response;
use Ejercicios\ejercicio4_2\model\UsuarioModel;
use Ejercicios\ejercicio4_2\model\vo\UsuarioVo;
use Exception;
use Firebase\JWT\JWT;
class AuthController
{

    private Request $request;

    public function __construct()
    {
        $this->request = new Request();
    }
    
    public function login()
    {
        try {
            $this->request->validate([
                'nombre' => 'string|max:50',
                'apellido1' => 'string|max:50',
                'apellido2' => 'string|max:50',
                'email' => 'required|string|max:256',
                'password' => 'string|max:255',
                'casa_id' => 'int'
            ]);
            $data = $this->request->body();
            $user = UsuarioModel::getByEmailPassword($data['email'], $data['password']);
            if ($user === null) {
                Response::json(['message' => 'No autenticado. Revise credenciales.'], 401);
                return;
            }
            $token = self::createJwt($user, 3600);
            Response::json(['token' => $token], 200);
        } catch (\Throwable $th) {
            error_log("AuthController->login()" . $th->getMessage());
            Response::serverError();
        }
    }

    private function createJwt(UsuarioVo $vo,  $expireSeconds){
        
        $payload = [
            "sub" => $vo->getId(),
            "email" => $vo->getEmail(),
            "iat" => time(),
            "exp" => time() + $expireSeconds
        ];
        
        $jwt = JWT::encode($payload, $_ENV['JWT_SECRET_KEY'], $_ENV['JWT_ALGO']);

        return $jwt;
    }
}