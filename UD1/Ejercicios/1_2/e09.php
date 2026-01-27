<?php
abstract class PersonaAbstracta{
    protected $edad;
    protected $nombre;
    public function __construct($nombre, $edad){
        $this->nombre = $nombre;
        $this->edad = $edad;
    }
    public abstract function mostrarInformacion();
    public abstract function esMayorDeEdad();
}

class Estudiante extends PersonaAbstracta{
    private $grado;
    private $calificaciones;
    
    public function __construct($nombre, $edad, $grado){
        parent::__construct($nombre, $edad);
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

    public function esMayorDeEdad(){
        return $this->edad>=18;
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