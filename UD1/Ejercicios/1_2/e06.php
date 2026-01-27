<?php

include_once "e03.php";

class Profesor extends Persona{
    private $especialidad;
    public function __construct($nombre, $edad, Direccion $direccion, $especialidad){
        parent::__construct($nombre, $edad, $direccion);
        $this->especialidad = $especialidad;
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
}

//Prueba
$d = new Direccion("plaza mayor, 3", "Vilagarcía", "36250");
$profe = new Profesor("Pedro", 20, $d, "Educación Física");
echo $profe->mostrarInformacion();