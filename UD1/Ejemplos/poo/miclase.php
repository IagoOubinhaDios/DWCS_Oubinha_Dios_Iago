<?php
class Miclase{
    private $var1;
    private $var2;

    public function __construct(){
        $this->var1 = "Soy var 1";
        $this->var2 = "Soy var2";
    }

    //Metodo estatico
    public static function saludo(){
        return "Soy la clase!";
    }
    
    public function getVar1(){
        return $this->var1;
    }

    public function setVar1($var1){
        $this->var1 = $var1;
        return $this;
    }

    public function setVar2($var2){
        $this->var2 = $var2;
        return $this;
    }

    private function concat(){
        return $this->var1.$this->var2;
    }

    public function print(){
        return $this->concat();
    }
}



