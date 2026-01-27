<?php
include_once "e03.php";
class Estudiante extends Persona{
    private $grado;
    
    public function __construct($nombre, $edad, Direccion $direccion, $grado){
        parent::__construct($nombre, $edad, $direccion);
        $this->grado = $grado;
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
}

//Prueba
$d = new Direccion("plaza mayor, 3", "Vilagarcía", "36250");
$estudiante = new Estudiante("Pedro", 20, $d, "Desarrollo Web");
echo $estudiante->mostrarInformacion();
