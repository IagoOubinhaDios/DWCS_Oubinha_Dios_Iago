<?php
include_once "clasemadre.php";
class ClaseHija extends ClaseMadre{
    private $apellido;

    public function __construct($nombre, $apellido){
        parent::__construct($nombre);
        $this->apellido = $apellido;
    }

    public function repetir(): string{
        return parent::repetir().$this->apellido;
    }
}