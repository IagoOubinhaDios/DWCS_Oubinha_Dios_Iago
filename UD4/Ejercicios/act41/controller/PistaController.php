<?php

namespace Ejercicios\act41\controller;
use Ejercicios\act41\core\Request;
use Ejercicios\act41\model\PistaModel;
use Ejercicios\act41\model\vo\PistaVo;
use Ejercicios\act41\core\Response;
use Exception;

class PistaController
{
    private Request $request;

    public function __construct(){
        $this->request = new Request();
    }

    public function index()
    {
        try {
            //Obtener todos los pistas
            $pistas = PistaModel::getFilter();
            $json = [];
            foreach ($pistas as $pista) {
                $json[] = $pista->toArray();
            }
            //Devolver los pistas en formato json (HTTP RESPONSE).
            Response::json($json, 200);
        } catch (\Throwable $th) {
            error_log("PistaController->index()" . $th->getMessage());
            Response::serverError();
        }
    }

    public function show(int $id, int $num)
    {
        try {
            //Obtener todos los pistas
            $pista = PistaModel::getById($id, $num);
            if (!isset($pista)) {
                Response::notFound();
                return;
            }
            Response::json($pista->toArray(), 200);
        } catch (\Throwable $th) {
            error_log("PistaController->show()" . $th->getMessage());
            Response::serverError();
        }
    }

    public function store(int $idDisco)
    {
        try {
            //Obtener el PistaVo de la petición
            $this->request->validate([
                'numero'=>'required|numeric',
                'titulo'=>'required|string|max:100'
            ]);
            $data = $this->request->body();
            $pista = new PistaVo($idDisco, $data['numero'], $data['titulo'], null);
            $pista = PistaModel::add($pista);
            if ($pista === null){
                throw new Exception("No se ha agregado la pista".implode(',', $data));
            }
            //Devolver los pistas en formato json (HTTP RESPONSE).
            Response::json($pista->toArray(), 201);
        } catch (\Throwable $th) {
            error_log("PistaController->store()" . $th->getMessage());
            Response::serverError();
        }
    }

    public function update(int $id, int $num)
    {
        try {
            //Obtener el PistaVo de la petición
            $pista = PistaModel::getById($id, $num);
            if (!isset($pista)) {
                Response::notFound();
                return;
            }
            $this->request->validate([
                'titulo'=>'required|string|max:100'
            ]);
            $data = $this->request->body();
            $pista->updateVoParams(PistaVo::fromArray($data));

            // $pista->setIdDisco($id);
            // $pista->setNumero($num);
            if (PistaModel::update($pista)) {
                throw new Exception("No se ha actualizado la pista".implode(',', $data));
            }
            //Devolver los pistas en formato json (HTTP RESPONSE).
            Response::json($pista->toArray(), 200);
        } catch (\Throwable $th) {
            error_log("PistaController->update()" . $th->getMessage());
            Response::serverError();
        }
    }

    public function destroy(int $id, int $num)
    {
        try {
            if (PistaModel::delete($id, $num)) {
                Response::json(['mensaje' => "pista $num eliminado."], 200);
            } else {
                Response::notFound();
            }
        } catch (\Throwable $th) {
            error_log("PistaController->destroy()" . $th->getMessage());
            Response::serverError();
        }
    }

}