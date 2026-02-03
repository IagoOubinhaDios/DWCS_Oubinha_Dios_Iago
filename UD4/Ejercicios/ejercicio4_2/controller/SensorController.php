<?php
//TODO
namespace Ejercicios\ejercicio4_2\controller;
use Ejercicios\ejercicio4_2\core\Request;
use Ejercicios\ejercicio4_2\core\Response;
use Ejercicios\ejercicio4_2\model\SensorModel;
use Ejercicios\ejercicio4_2\model\vo\SensorVo;
use Exception;
use Firebase\JWT\JWT;

class SensorController extends Controller {

    public function index() {
        // $sensores = SensorModel::get();
    }

    public function show(string $mac) {
        try {
            $sensor = SensorModel::getByMac($mac);
            if ($sensor === null) {
                Response::notFound();
                return;
            }

            Response::json($sensor->toArray(), 200);
        } catch (\Throwable $th) {
            error_log("SensorController->show() " . $th->getMessage());
            Response::serverError();
        }
    }

    public function store() {
        try {
            $this->request->validate([
                'mac'=>'required|string|max:17|min:17',
                'localizacion'=>'required|string|max:50'
            ]);
            $usuarioActual = $this->request->usuario;
            $data = $this->request->body();
            $sensor = new SensorVo($data['mac'], $data['localizacion'], $usuarioActual->getCasaId());
            $sensor = SensorModel::add($sensor);
            if ($sensor == null) {
                throw new Exception('No se ha agregado el sensor'.implode($data));
            }

            $data = $sensor->toArray();
            $data['token'] = self::generateJwt($sensor, 5184000);
            Response::json($data, 201);
        } catch(\Throwable $th) {
            error_log("SensorController->store()" . $th->getMessage());
            Response::serverError();
        }
    }

    public function update(string $mac) {
        try {
            $this->request->validate([
                'localizacion'=>'string|max:50',
                'casa_id'=>'int'
            ]);
            $data = $this->request->body();

            $sensor = SensorModel::getByMac($mac);
            if ($sensor == null) {
                Response::notFound();
                exit;
            }

            $sensor->updateVoParams(SensorVo::fromArray($data));
            if (!SensorModel::update($sensor)){
                throw new Exception('No se ha actualizado el sensor'.implode($data));
            }
            Response::json($sensor->toArray(), 201);
        } catch(\Throwable $th) {
            error_log("SensorController->update()" . $th->getMessage());
            Response::serverError();
        }
    }

    private function generateJWT(SensorVo $sensor, int $expireSeconds):string {
        $payload = [
            "sub" => $sensor->getMac(),
            "iat" => time(),
            "exp" => time() + $expireSeconds,
            "rol" => 'sensor'
        ];
        
        $jwt = JWT::encode($payload, $_ENV['JWT_SECRET_KEY'], $_ENV['JWT_ALGO']);

        return $jwt;
    }
}