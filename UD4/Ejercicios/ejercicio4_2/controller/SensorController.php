<?php
namespace Ejercicios\ejercicio4_2\controller;
use Ejercicios\ejercicio4_2\core\Request;
use Ejercicios\ejercicio4_2\core\Response;
use Ejercicios\ejercicio4_2\model\SensorModel;
use Ejercicios\ejercicio4_2\model\vo\SensorVo;
use Exception;

class SensorController{

    private Request $request;

    public function __construct(){
        $this->request = new Request();
    }

    public function index() {
        // $sensores = SensorModel::get();
    }

    public function show(string $mac) {
        try {
            $sensor = SensorModel::get($mac);
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
                'localizacion'=>'string|max:50',
                'casa_id'=>'int'
            ]);
            $data = $this->request->body();
            $sensor = SensorVo::fromArray($data);
            $sensor = SensorModel::add($sensor);
            if ($sensor == null) {
                throw new Exception('No se ha agregado el sensor'.implode($data));
            }

            Response::json($sensor->toArray(), 201);
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

            $sensor = SensorModel::get($mac);
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
}