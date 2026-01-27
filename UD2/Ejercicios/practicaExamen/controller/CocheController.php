<?php
namespace Ejercicios\practicaExamen\controller;
use Ejercicios\practicaExamen\model\CocheModel;
use Exception;
class CocheController extends Controller
{

    public function listarCoches()
    {
        $coches = CocheModel::getCoches();
        if (isset($coches)) {
            $this->vista->show("lista_productos", $coches);
        } else {
            $this->vista->show("error_lista");
        }
    }

}