<?php
namespace Ejercicios\act31\controller;
use DateTime;
use Ejercicios\act31\model\EscuelaModel;
use Ejercicios\act31\model\MunicipioModel;
use Ejercicios\act31\model\ProvinciaModel;
use Ejercicios\act31\model\vo\EscuelaVO;
use Exception;

class EscuelaController extends Controller
{

    public function addEscuela()
    {
        try {
            $escuela = new EscuelaVO();
            $escuela->setNombre($_REQUEST['nombre'] ?? 'Escola IES Armando Cotarelo');
            $escuela->setDireccion($_REQUEST['direccion'] ?? 'Súbida á Igrexa, nº 12');
            $escuela->setCodMunicipio($_REQUEST['cod_municipio'] ?? 36060);
            // $escuela->setHoraApertura($_REQUEST['hora_apertura'] ?? '08:00:00');
            // $escuela->setHoraCierre($_REQUEST['hora_cierre'] ?? '14:30:00');
            $escuela->setComedor($_REQUEST['comedor'] ?? false);
            if (!EscuelaModel::addEscuela($escuela)) {
                throw new Exception("Error agregando escuela: ");
            }

        } catch (\Throwable $th) {
            error_log($th->getMessage());
            $this->vista->showView("error_add_escuela");
        }
    }

    public function deleteEscuela()
    {

        try {
            // $escuela = new EscuelaVO();
            // $escuela->setCodEscuela($_REQUEST['cod_escuela'] ?? '');
            $escuela = EscuelaModel::getEscuela($_REQUEST['cod_escuela']);
            if (!EscuelaModel::deleteEscuela($escuela)) {
                throw new Exception("Error agregando escuela: ");
            }

        } catch (\Throwable $th) {
            error_log($th->getMessage());
            $this->vista->showView("error_delete_escuela");
        }
    }

    public function listarEscuelas()
    {
        $filterMunicipio = $_REQUEST['cod_municipio'] ?? '';
        $filterNombre = $_REQUEST['nombre'] ?? '';
        $filterProvincia = $_REQUEST['cod_provincia'] ?? '';
        $filters = ['nombre' => $filterNombre];
        if (!empty($filterMunicipio)) {
            $filters['cod_municipio'] = intval($filterMunicipio);
        }

        $provincias = ProvinciaModel::getFilter();
        $municipios = MunicipioModel::getFilter(!empty($filterProvincia) ? ['cod_provincia' => intval($filterProvincia)] : null);
        $escuelas = EscuelaModel::getFilter($filters);

        $this->vista->showView("lista_escuelas", ['municipios' => $municipios, 'escuelas' => $escuelas, 'provincias' => $provincias]);
    }
}