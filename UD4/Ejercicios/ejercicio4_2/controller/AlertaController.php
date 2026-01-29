<?php
namespace Ejercicios\ejercicio4_2\controller;
use Ejercicios\ejercicio4_2\core\Request;
use Ejercicios\ejercicio4_2\core\Response;
use Ejercicios\ejercicio4_2\model\AlertaModel;
use Ejercicios\ejercicio4_2\model\vo\AlertaVo;
use Exception;

class AlertaController {
    
    private Request $request;

    public function __construct()
    {
        $this->request = new Request();
    }

    public function store() {
        try {
            $this->request->validate([
                'sensor_mac'=>'string|max:17'
            ]);
            $data = $this->request->body();
            $alerta = AlertaVo::fromArray($data);
            $alerta = AlertaModel::add($data['sensor_mac']);
            if ($alerta == null) {
                throw new Exception('No se ha agregado el sensor'.implode($data));
            }

            Response::json($alerta->toArray(), 201);
        } catch(\Throwable $th) {
            error_log("AlertaController->store()" . $th->getMessage());
            Response::serverError();
        }
    }
}