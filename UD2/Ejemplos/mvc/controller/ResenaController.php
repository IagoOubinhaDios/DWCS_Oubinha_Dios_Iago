<?php
namespace Ejemplos\mvc\controller;
use Ejemplos\mvc\model\ArticuloModel;
use Ejemplos\mvc\model\ResenaModel;
use Ejemplos\mvc\model\Resena;
use Exception;
class ResenaController extends Controller
{

    public function nuevaResena(){
        $codArticulo = $_REQUEST['cod_articulo']??null;
        if(!isset($codArticulo)){
            $error = new ErrorController();
            $error->pageNotFound();
        }

        $articulo = ArticuloModel::getArticulo($codArticulo);
    }

    public function addResena()
    {
        
       try {
            $resena = new Resena();
            $resena->codArticulo = $_REQUEST['cod_articulo'] ?? 4;
            $resena->descripcion = $_REQUEST['descripcion'] ?? 'Borra muy mal y deja los folios destrozados';
            $resena->setFechaHora("now");
            if(!ResenaModel::addResena($resena)){
                throw new Exception("Error agregando resena: ");
            }
            $articulo = new ArticuloController();
            $articulo->listarResenas();
            
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            $this->vista->showView('error_add_resena');
        }
    }
}