<?php

namespace Ejercicios\act41\controller;
use Ejercicios\act41\core\Request;
use Ejercicios\act41\model\BandaModel;
use Ejercicios\act41\model\vo\BandaVo;
use Ejercicios\act41\core\Response;
use Exception;
class AuthController
{
    private Request $request;

    public function __construct(){
        $this->request = new Request();
    }

    public function index()
    {
        try {
            //Obtener todos los bandas
            $bandas = BandaModel::getFilter();
            $json = [];
            foreach ($bandas as $banda) {
                $json[] = $banda->toArray();
            }
            //Devolver los bandas en formato json (HTTP RESPONSE).
            Response::json($json, 200);
        } catch (\Throwable $th) {
            error_log("BandaController->index()" . $th->getMessage());
            Response::serverError();
        }
    }

    public function show(int $id)
    {
        try {
            $banda = BandaModel::getById($id);
            if (!isset($banda)) {
                Response::notFound();
                return;
            }
            Response::json($banda->toArray(), 200);
        } catch (\Throwable $th) {
            error_log("BandaController->show()" . $th->getMessage());
            Response::serverError();
        }
    }

    public function store()
    {
        try {
            //Obtener el BandaVo de la petición
            $this->request->validate([
                'nombre'=>'required|string|max:100',
                'num_integrantes'=>'required|int|max:99|min:1',
                'genero'=>'required|string|max:50',
                'nacionalidad'=>'string|max:50'
            ]);
            $data = $this->request->body();
            $banda = BandaVo::fromArray($data);
            $banda = BandaModel::add($banda);
            if ($banda === null){
                throw new Exception("No se ha agregado la banda".implode(',', $data));
            }
            //Devolver los bandas en formato json (HTTP RESPONSE).
            Response::json($banda->toArray(), 201);
        } catch (\Throwable $th) {
            error_log("BandaController->store()" . $th->getMessage());
            Response::serverError();
        }
    }

    public function update(int $id)
    {
        try {
            //Obtener el BandaVo de la petición
            $banda = BandaModel::getById($id);
            if (!isset($banda)) {
                Response::notFound();
                return;
            }
            $this->request->validate([
                'nombre'=>'required|string|max:100',
                'num_integrantes'=>'required|int|max:99|min:1',
                'genero'=>'required|string|max:50',
                'nacionalidad'=>'string|max:50'
            ]);
            $data = $this->request->body();
            $banda->updateVoParams(BandaVo::fromArray($data));

            // $banda->setIdBanda($id);
            if (BandaModel::update($banda)) {
                throw new Exception("No se ha actualizado la banda".implode(',', $data));
            }
            //Devolver los bandas en formato json (HTTP RESPONSE).
            Response::json($banda->toArray(), 200);
        } catch (\Throwable $th) {
            error_log("BandaController->update()" . $th->getMessage());
            Response::serverError();
        }
    }

    public function destroy(int $id)
    {
        try {
            if (BandaModel::delete($id)) {
                Response::json(['mensaje' => "banda $id eliminado."], 200);
            } else {
                Response::notFound();
            }
        } catch (\Throwable $th) {
            error_log("BandaController->destroy()" . $th->getMessage());
            Response::serverError();
        }
    }

}