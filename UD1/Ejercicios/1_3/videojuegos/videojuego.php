<?php
class Videojuego{
    private $id; 
    private $nombre;
    private $plataforma;
    private $lanzamiento;
    private $genero;

    // public function __construct($nombre, $plataforma, $lanzamiento, $genero=null, $id=null){
     
    // }

    

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of plataforma
     */ 
    public function getPlataforma()
    {
        return $this->plataforma;
    }

    /**
     * Set the value of plataforma
     *
     * @return  self
     */ 
    public function setPlataforma($plataforma)
    {
        $this->plataforma = $plataforma;

        return $this;
    }

    /**
     * Get the value of lanzamiento
     */ 
    public function getLanzamiento()
    {
        return $this->lanzamiento;
    }

    /**
     * Set the value of lanzamiento
     *
     * @return  self
     */ 
    public function setLanzamiento($lanzamiento)
    {
        $this->lanzamiento = $lanzamiento;

        return $this;
    }

    /**
     * Get the value of genero
     */ 
    public function getGenero()
    {
        return $this->genero;
    }

    /**
     * Set the value of genero
     *
     * @return  self
     */ 
    public function setGenero($genero)
    {
        $this->genero = $genero;

        return $this;
    }
}