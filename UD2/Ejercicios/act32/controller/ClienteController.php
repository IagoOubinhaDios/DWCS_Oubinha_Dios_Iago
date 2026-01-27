<?php
namespace Ejercicios\act32\controller;
use Ejercicios\act32\model\ClienteModel;
use Ejercicios\act32\model\vo\ClienteVO;
use Exception;
class ClienteController extends Controller
{

    public function listarClientes()
    {
        $clientes = ClienteModel::getClientes();
        if (isset($clientes)) {
            $this->vista->showView("lista_clientes", $clientes);
        } else {
            $this->vista->showView("error_lista");
        }
    }


    public function addCliente()
    {
        try {
            $cliente = new ClienteVO();
            $cliente->setNombre($_REQUEST['nombre'] ?? '');
            $cliente->setApellidos($_REQUEST['apellidos'] ?? '');
            $cliente->setTelefono(is_numeric($_REQUEST['telefono']) ? $_REQUEST['telefono'] : 0);
            $cliente->setMail($_REQUEST['mail'] ?? '');
            if ($cliente->getNombre() == '' || $cliente->getApellidos() == '' ||
                $cliente->getTelefono() == 0 || $cliente->getMail() == '') {
                $this->vista->showView("formulario_add_cliente");
            } else if (!ClienteModel::addCliente($cliente)) {
                throw new Exception("Error agregando cliente: ");
            } else{
                $this->vista->showView("add_cliente");
            }

        } catch (\Throwable $th) {
            error_log($th->getMessage());
            $this->vista->showView("error_add_cliente");
        }
    }
}
