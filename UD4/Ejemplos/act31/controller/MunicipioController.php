<?php
namespace Ejemplos\act31\controller;

use Ejemplos\act31\core\Request;
use Ejemplos\act31\model\MunicipioModel;
use Ejemplos\act31\model\vo\MunicipioVO;
use Ejemplos\act31\core\Response;
class MunicipioController extends Controller
{

    public function index(){
        //Obtener todos los municipios
        $municipios = MunicipioModel::getFilter();
        $json = [];
        foreach($municipios as $municipio){
            $json[] = $municipio->toArray();
        }
        //Devolver los municipios en formato json (HTTP RESPONSE).
        Response::json($json, 200);
    }

    public function show(int $id){
        //Obtener todos los municipios
        $municipio = MunicipioModel::getMunicipio($id);
        if(!isset($municipio)){
            Response::notFound();
            return;
        }
        Response::json($municipio->toArray(), 200);
    }

    public function store(){
        //Obtener el MunicipioVO de la petición
        $request = new Request();
        $municipio = MunicipioVO::fromArray($request->body());
        $municipio = MunicipioModel::add($municipio);
        //Devolver los municipios en formato json (HTTP RESPONSE).
        Response::json($municipio->toArray(), 201);
    }

    public function update(int $id){
        //Obtener el MunicipioVO de la petición
        $request = new Request();
        $municipio = MunicipioModel::getMunicipio($id);
        if(!isset($municipio)){
            Response::notFound();
            return;
        }
        $municipio->updateVoParams(MunicipioVO::fromArray($request->body()));

        $municipio->setCodMunicipio($id);
        $municipio = MunicipioModel::update($municipio);
        //Devolver los municipios en formato json (HTTP RESPONSE).
        Response::json($municipio->toArray(),200);
    }

    public function destroy(int $id){
       
        if(MunicipioModel::delete($id)) {
            Response::json(['mensaje'=> "Municipio $id eliminado."],200);
        }else{
            Response::notFound();
        }            
        
       
    }
}