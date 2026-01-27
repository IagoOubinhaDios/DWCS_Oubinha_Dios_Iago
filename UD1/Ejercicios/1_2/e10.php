<?php

include_once "e03.php";

interface Identificable{
    public function getIdentificador();
}


class Estudiante extends Persona implements Identificable{
    private $grado;
    private $calificaciones;
    private $numEstudiante;
    
    public function __construct($nombre, $edad, Direccion $direccion, $grado){
        parent::__construct($nombre, $edad, $direccion);
        $this->grado = $grado;
        $this->calificaciones = [];
        $this->numEstudiante = rand(1, 1000);
    }

    /**
     * Get the value of grado
     */ 
    public function getGrado()
    {
        return $this->grado;
    }

    /**
     * Set the value of grado
     *
     * @return  self
     */ 
    public function setGrado($grado)
    {
        $this->grado = $grado;

        return $this;
    }

    public function mostrarInformacion(){
        return "Estudiante ".$this->getNombre()." de ".$this->getEdad()." años. Estudia el grado ".$this->grado;
    }

    public static function calcularPromedio(array $notas){
        $media = 0;
        foreach($notas as $nota){
            $media += $nota;
        }

        $media = $media / count($notas);
        return $media;
    }

    public function addCalificacion(int $calificacion){
        $this->calificaciones[] = $calificacion;
        return $this;
    }

    public function getMedia(){
        return Estudiante::calcularPromedio($this->calificaciones);
    }

    public function getIdentificador(){
        return $this->numEstudiante;
    }
}

class Profesor extends Persona implements Identificable{
    private $especialidad;
    private $numEmpleado;
    public function __construct($nombre, $edad, Direccion $direccion, $especialidad){
        parent::__construct($nombre, $edad, $direccion);
        $this->especialidad = $especialidad;
        $this->numEmpleado = rand(1,100);
    }

    /**
     * Get the value of especialidad
     */ 
    public function getEspecialidad()
    {
        return $this->especialidad;
    }

    /**
     * Set the value of especialidad
     *
     * @return  self
     */ 
    public function setEspecialidad($especialidad)
    {
        $this->especialidad = $especialidad;

        return $this;
    }

    public function mostrarInformacion(){
        return parent::mostrarInformacion()." especialidad: $this->especialidad ";
    }

    public function getIdentificador(){
        return $this->numEmpleado;
    }

}

function showIds(array $identificables){
    foreach($identificables as $objeto){
        if($objeto instanceof Identificable){
            echo "ID: ".$objeto->getIdentificador()."<br>";
        }else{
            die();
        }
    }
}

//PRUEBA

$d = new Direccion("plaza mayor, 3", "Vilagarcía", "36250");
$estudiante = new Estudiante("Pedro", 20, $d, "Desarrollo Web");
$estudiante->addCalificacion(5)
    ->addCalificacion(7)
    ->addCalificacion(8);
$e2 = clone ($estudiante);
$e2->setNombre("María")
    ->setEdad(32);

$prof = new Profesor("Julián", 44, $d, "Ciencias Sociales" );
$lista = [$estudiante, $e2, $prof];

showIds($lista);