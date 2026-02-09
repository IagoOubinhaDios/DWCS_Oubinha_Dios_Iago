<?php
namespace Ejercicios\act32\controller;
use Ejercicios\act32\model\ProductoModel;
use Ejercicios\act32\model\vo\ProductoVO;
use Exception;
class ProductoController extends Controller
{

    public function listarProductos()
    {
        $productos = ProductoModel::getProductos();
        if (isset($productos)) {
            $this->vista->showView("lista_productos", $productos);
        } else {
            $this->vista->showView("error_lista");
        }
    }

    public function addProducto()
    {
        try {
            $producto = new ProductoVO();
            $producto->setDenominacion($_REQUEST['denominacion'] ?? '');
            $producto->setDescripcion($_REQUEST['descripcion'] ?? '');
            $producto->setPrecio(is_numeric($_REQUEST['precio']) ? $_REQUEST['precio'] : 0.0);
            $producto->setCantidad(is_numeric($_REQUEST['cantidad']) ? $_REQUEST['cantidad'] : 0);
            if ($producto->getDenominacion() == '' || $producto->getDescripcion() == '' ||
                $producto->getPrecio() == 0.0 || $producto->getCantidad() == 0) {
                $this->vista->showView("formulario_add_producto");
            }else if (!ProductoModel::addProducto($producto)) {
                throw new Exception("Error agregando producto: ");
            } else {
                $this->vista->showView("add_producto");
            }
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            $this->vista->showView("error_add_producto");
        }
    }

    public function updateProducto() {
        try {
            $Producto = new ProductoVO();
            $producto->setDenominacion($_REQUEST['denominacion'] ?? '');
            $producto->setDescripcion($_REQUEST['descripcion'] ?? '');
            $producto->setPrecio(is_numeric($_REQUEST['precio']) ? $_REQUEST['precio'] : 0.0);
            $producto->setCantidad(is_numeric($_REQUEST['cantidad']) ? $_REQUEST['cantidad'] : 0);
            if (!ProductoModel::updateProducto($producto)) {
                throw new Exception('Error al modificar producto: ');
            } else {
                $this->vista->showView('update_producto');
            }
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            $this->vista->showView('error_update_producto');
        }
    }

    public function deleteProducto() {
        try {
            $producto = ProductoModel::getProducto($_REQUEST['cod_producto']);
            if (!ProductoModel::deleteProducto($producto)) {
                throw new Exception('No se pudo eliminar el producto.');
            }
        } catch(\Throwable $th) {
            error_log($th->getMessage());
            $this->vista->showView('error_delete_producto');
        }
    }
}
