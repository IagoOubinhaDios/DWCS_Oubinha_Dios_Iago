<?php
include_once "e07.php";
class Curso
{

    private $estudiantes;
    private $nombre;
    public function __construct($nombre)
    {
        $this->nombre = $nombre;
        $this->estudiantes = [];
    }

    public function addEstudiante(Estudiante $e)
    {
        $this->estudiantes[] = $e;
    }

    public function mostrarEstudiantes()
    {
        $toret = '';
        foreach ($this->estudiantes as $e) {
            $toret .= "<br>" . $e->mostrarInformacion();
        }

        return $toret;
    }

}

$d = new Direccion("plaza mayor, 3", "Vilagarcía", "36250");
$estudiante = new Estudiante("Pedro", 20, $d, "Desarrollo Web");
$estudiante->addCalificacion(5)
    ->addCalificacion(7)
    ->addCalificacion(8);
$e2 = clone ($estudiante);
$e2->setNombre("María")
    ->setEdad(32);
$curso = new Curso("DAW2-A");
$curso->addEstudiante($estudiante);
$curso->addEstudiante($e2);

echo $curso->mostrarEstudiantes();
