<?php
include_once "e03.php";
class Estudiante extends Persona{
    private $grado;
    private $calificaciones;
    
    public function __construct($nombre, $edad, Direccion $direccion, $grado){
        parent::__construct($nombre, $edad, $direccion);
        $this->grado = $grado;
        $this->calificaciones = [];
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
}

//Prueba

// $d = new Direccion("plaza mayor, 3", "Vilagarcía", "36250");
// $estudiante = new Estudiante("Pedro", 20, $d, "Desarrollo Web");
// $estudiante->addCalificacion(5)
//             ->addCalificacion(7)
//             ->addCalificacion(8);
// echo $estudiante->mostrarInformacion();
// echo "<br>PROMEDIO: ",$estudiante->getMedia();
