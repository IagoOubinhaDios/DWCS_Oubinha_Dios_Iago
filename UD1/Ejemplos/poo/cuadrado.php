<?php
include_once "poligono.php";

class Cuadrado extends Poligono{
    public function __construct($lado){
        $lados = array($lado, $lado, $lado, $lado);
        parent::__construct($lados);
    }

    public function getArea(){
        return $this->lados[0]**2;
    }
}