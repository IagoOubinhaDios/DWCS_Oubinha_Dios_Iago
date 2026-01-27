<?php
namespace Ejercicios\practicaExamen\model\vo;

class CocheVO implements Vo
{
    private ?int $cod_coche;
    private ?string $matricula;
    private ?string $marca;
    private ?string $modelo;
    private ?string $color;

    public function __construct(
        ?int $cod_coche = null,
        ?string $matricula = null,
        ?string $marca = null,
        ?string $modelo = null,
        ?string $color = null
    ) {
        $this->cod_coche = $cod_coche;
        $this->matricula = $matricula;
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->color = $color;
    }


    /**
     * Get the value of cod_coche
     */ 
    public function getCod_coche()
    {
        return $this->cod_coche;
    }

    /**
     * Set the value of cod_coche
     *
     * @return  self
     */ 
    public function setCod_coche($cod_coche)
    {
        $this->cod_coche = $cod_coche;

        return $this;
    }

    /**
     * Get the value of matricula
     */ 
    public function getMatricula()
    {
        return $this->matricula;
    }

    /**
     * Set the value of matricula
     *
     * @return  self
     */ 
    public function setMatricula($matricula)
    {
        $this->matricula = $matricula;

        return $this;
    }

    /**
     * Get the value of marca
     */ 
    public function getMarca()
    {
        return $this->marca;
    }

    /**
     * Set the value of marca
     *
     * @return  self
     */ 
    public function setMarca($marca)
    {
        $this->marca = $marca;

        return $this;
    }

    /**
     * Get the value of modelo
     */ 
    public function getModelo()
    {
        return $this->modelo;
    }

    /**
     * Set the value of modelo
     *
     * @return  self
     */ 
    public function setModelo($modelo)
    {
        $this->modelo = $modelo;

        return $this;
    }

    /**
     * Get the value of color
     */ 
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set the value of color
     *
     * @return  self
     */ 
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }
}