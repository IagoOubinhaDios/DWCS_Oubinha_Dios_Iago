<?php
namespace Ejercicios\practicaExamen\model\vo;

class ConductorVO implements Vo
{
    private ?int $cod_conductor;
    private ?string $nombre;
    private ?string $apellido1;
    private ?string $apellido2;
    private ?string $licencia;

    public function __construct(
        ?int $cod_conductor = null,
        ?string $nombre = null,
        ?string $apellido1 = null,
        ?string $apellido2 = null,
        ?string $licencia = null
    ) {
        $this->cod_conductor = $cod_conductor;
        $this->nombre = $nombre;
        $this->apellido1 = $apellido1;
        $this->apellido2 = $apellido2;
        $this->licencia = $licencia;
    }

    /**
     * Get the value of cod_conductor
     */ 
    public function getCod_conductor()
    {
        return $this->cod_conductor;
    }

    /**
     * Set the value of cod_conductor
     *
     * @return  self
     */ 
    public function setCod_conductor($cod_conductor)
    {
        $this->cod_conductor = $cod_conductor;

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
     * Get the value of apellido1
     */ 
    public function getApellido1()
    {
        return $this->apellido1;
    }

    /**
     * Set the value of apellido1
     *
     * @return  self
     */ 
    public function setApellido1($apellido1)
    {
        $this->apellido1 = $apellido1;

        return $this;
    }

    /**
     * Get the value of apellido2
     */ 
    public function getApellido2()
    {
        return $this->apellido2;
    }

    /**
     * Set the value of apellido2
     *
     * @return  self
     */ 
    public function setApellido2($apellido2)
    {
        $this->apellido2 = $apellido2;

        return $this;
    }

        /**
         * Get the value of licencia
         */ 
        public function getLicencia()
        {
                return $this->licencia;
        }

        /**
         * Set the value of licencia
         *
         * @return  self
         */ 
        public function setLicencia($licencia)
        {
                $this->licencia = $licencia;

                return $this;
        }
}