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

    public static function calcularPromedio(array $notas){
        $media = 0;
        foreach($notas as $nota){
            $media += $nota;
        }

        $media = $media / count($notas);
        return $media;
    }
}

//Prueba
// $notas = array(5,5,7,7);
$notas = [5,5,7,7];
$promedio = Estudiante::calcularPromedio($notas);
echo "La media es $promedio";
