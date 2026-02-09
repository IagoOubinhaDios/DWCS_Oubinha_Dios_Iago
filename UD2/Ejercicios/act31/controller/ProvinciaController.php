<?php
namespace Ejercicios\act31\controller;

class ProvinciaController extends Controller {

    public function eliminarProvincia() {
        try {
            $provincia = ProvinciaModel::getProvincia($_REQUEST['cod_provincia']);
            if (!ProvinciaModel::delete($provincia)) {
                throw new Exception('Error al borrar provincia');
            } else {
                $this->vista->showView('');
            }
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            $this->vista->showView('error_eliminar_provincia');
        }
    }   
}