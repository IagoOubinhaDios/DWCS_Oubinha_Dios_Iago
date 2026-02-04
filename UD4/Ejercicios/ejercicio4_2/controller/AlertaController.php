<?php
//TODO
namespace Ejercicios\ejercicio4_2\controller;
use Ejercicios\ejercicio4_2\core\Response;
use Ejercicios\ejercicio4_2\model\AlertaModel;
use Ejercicios\ejercicio4_2\model\vo\AlertaVo;
use Exception;

class AlertaController extends Controller {
    

    public function store() {
        try {
            $sensorActual = $this->request->sensor;
            $data = $this->request->body();
            $alerta = new AlertaVo($data['id'], $sensorActual->getMac());
            $alerta = AlertaModel::add($sensorActual->getMac());
            if ($alerta == null) {
                throw new Exception('No se ha agregado la alerta'.implode($data));
            }

            Response::json($alerta->toArray(), 201);
        } catch(\Throwable $th) {
            error_log("AlertaController->store()" . $th->getMessage());
            Response::serverError();
        }
    }
}