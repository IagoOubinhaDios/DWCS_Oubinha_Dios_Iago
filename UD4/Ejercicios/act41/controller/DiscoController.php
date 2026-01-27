<?php

namespace Ejercicios\act41\controller;
use Ejercicios\act41\core\Request;
use Ejercicios\act41\model\DiscoModel;
use Ejercicios\act41\model\vo\DiscoVo;
use Ejercicios\act41\core\Response;
use Exception;

class DiscoController
{
    private Request $request;

    public function __construct(){
        $this->request = new Request();
    }


    public function index()
    {
        try {
            //Obtener todos los discos
            $discos = DiscoModel::getFilter();
            $json = [];
            foreach ($discos as $disco) {
                $json[] = $disco->toArray();
            }
            //Devolver los discos en formato json (HTTP RESPONSE).
            Response::json($json, 200);
        } catch (\Throwable $th) {
            error_log("DiscoController->index()" . $th->getMessage());
            Response::serverError();
        }
    }

    public function show(int $id)
    {
        try {
            //Obtener todos los discos
            $disco = DiscoModel::getById($id);
            if (!isset($disco)) {
                Response::notFound();
                return;
            }
            Response::json($disco->toArray(), 200);
        } catch (\Throwable $th) {
            error_log("DiscoController->show()" . $th->getMessage());
            Response::serverError();
        }
    }

    public function store()
    {
        try {
            //Obtener el discoVo de la petición
            $this->request->validate([
                'titulo'=>'required|string|max:100',
                'anho'=>'required|numeric',
                'id_banda'=>'required|int'
            ]);
            $data = $this->request->body();
            $disco = discoVo::fromArray($data);
            $disco = DiscoModel::add($disco);
            if ($disco === null){
                throw new Exception("No se ha agregado la disco".implode(',', $data));
            }
            //Devolver los discos en formato json (HTTP RESPONSE).
            Response::json($disco->toArray(), 201);
        } catch (\Throwable $th) {
            error_log("DiscoController->store()" . $th->getMessage());
            Response::serverError();
        }
    }

    public function update(int $id)
    {
        try {
            //Obtener el discoVo de la petición
            $disco = DiscoModel::getById($id);
            if (!isset($disco)) {
                Response::notFound();
                return;
            }
            $this->request->validate([
                'titulo'=>'required|string|max:100',
                'anho'=>'required|numeric',
                'id_banda'=>'required|int'
            ]);
            $data = $this->request->body();
            $disco->updateVoParams(discoVo::fromArray($data));

            // $disco->setIdDisco($id);
            if (DiscoModel::update($disco)) {
                throw new Exception("No se ha actualizado la disco".implode(',', $data));
            }
            //Devolver los discos en formato json (HTTP RESPONSE).
            Response::json($disco->toArray(), 200);
        } catch (\Throwable $th) {
            error_log("DiscoController->update()" . $th->getMessage());
            Response::serverError();
        }
    }

    public function destroy(int $id)
    {
        try {
            if (DiscoModel::delete($id)) {
                Response::json(['mensaje' => "disco $id eliminado."], 200);
            } else {
                Response::notFound();
            }
        } catch (\Throwable $th) {
            error_log("DiscoController->destroy()" . $th->getMessage());
            Response::serverError();
        }

    }

}