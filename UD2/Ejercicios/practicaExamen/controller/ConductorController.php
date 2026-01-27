<?php
namespace Ejercicios\practicaExamen\controller;
use Ejercicios\practicaExamen\model\ConductorModel;
use Ejercicios\practicaExamen\model\vo\ConductorVO;
use Exception;
class ProductoController extends Controller
{

    public function altaConductor()
    {
        try {
            $conductor = new ConductorVO();
            $conductor->setNombre($_REQUEST['nombre'] ?? '');
            $conductor->setApellido1($_REQUEST['apellido1'] ?? '');
            $conductor->setApellido2($_REQUEST['apellido2'] ?? '');
            $conductor->setLicencia($_REQUEST['licencia'] ?? '');
            if ($conductor->getNombre() == '' || $conductor->getApellido1() == '' || $conductor->getLicencia() == '') {
                $this->vista->show("formulario_add_conductor");
            } else if (!ConductorModel::addConductor($conductor)) {
                throw new Exception("Error agregando cliente: ");
            } else{
                $this->vista->show("add_conductor");
            }

        } catch (\Throwable $th) {
            error_log($th->getMessage());
            $this->vista->show("error_add");
        }
    }

}