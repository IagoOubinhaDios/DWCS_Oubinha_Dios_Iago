<?php
namespace Ejercicios\act31\controller;
use Ejercicios\act31\model\AlumnoModel;
use Ejercicios\act31\model\EscuelaModel;
class AlumnoController extends Controller
{

    public function matricularAlumno()
    {
        try {
            $cod_alumno = $_REQUEST['cod_alumno'] ?? '';
            $cod_escuela = $_REQUEST['cod_escuela'] ?? '';
            $anho = $_REQUEST['anho'] ?? '';
            $alumno = AlumnoModel::getAlumno($cod_alumno);
            $escuela = EscuelaModel::getEscuela($cod_escuela);
            if (isset($alumno) && isset($escuela) && isset($anho)) {
                AlumnoModel::matricularAlumno($alumno, $escuela, $anho);
            }
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            $this->vista->showView('error_matricular_alumno');
        }
    }
}

