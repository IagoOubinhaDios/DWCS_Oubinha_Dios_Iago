<?php
//TODO
namespace Ejercicios\ejercicio4_2\core\middleware;
use Ejercicios\ejercicio4_2\core\Request;
use Ejercicios\ejercicio4_2\core\Response;
use Ejercicios\ejercicio4_2\model\SensorModel;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
class SensorMiddleware implements Middleware{
    public function handle(Request $request) {
        $token = $request->getHeader('Authorization');
        $token = str_replace('Bearer ','',$token);

        if(!isset($token)){
            Response::json(["messaje"=>"Sensor no autenticado."],401);
            return;
        }

        try {
            $payload = JWT::decode($token, new Key($_ENV['JWT_SECRET_KEY'],$_ENV['JWT_ALGO']));
            if($payload->rol != 'sensor') {
                Response::json(["messaje"=>"Token incorrecto para sensor."],401);
                exit;
            }
            
            // Response::json(["messaje"=>"Sensor con mac $payload->sub. Autenticado!!"],200);
            $request->sensor = SensorModel::getByMac($payload->sub);
        } catch (Exception $th) {
            Response::json(["messaje"=>"Sensor no autenticado."],401);
        }
    }
}