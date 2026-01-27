<?php
namespace Ejercicios\act31\controller;

use Ejercicios\act31\model\MunicipioModel;
class MunicipioController extends Controller
{
    function getMunicipiosProvinciaJSON()
    {
        $filterProvincia = isset($_REQUEST['cod_provincia']) ? ['cod_provincia' => (int) $_REQUEST['cod_provincia']] : null;

        $municipios = MunicipioModel::getFilter($filterProvincia);

        $jsonArray = [];
        foreach ($municipios as $m) {
            $jsonArray[] = [
                'cod_municipio' => $m->getCodMunicipio(),
                'nombre' => $m->getNombre()
            ];
        }

        $json = json_encode($jsonArray, JSON_UNESCAPED_UNICODE);
        header('Content-Type: aplication/json; charset=utf-8');
        echo $json;
    }
}