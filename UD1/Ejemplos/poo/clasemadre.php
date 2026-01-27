<?php

class ClaseMadre{
    private $secreto;
    protected $nombre;

    function __construct($nombre){
        $this->nombre = $nombre;
        $this->secreto = rand(1,100);
    }

    public function repetir(){
        $toret = "";
        for($i=0;$i<$this->secreto;$i++){
            $toret .= $this->nombre;
        }

        return $toret;
    }
}