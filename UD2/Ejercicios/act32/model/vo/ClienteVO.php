<?php
namespace Ejercicios\act32\model\vo;

class ClienteVO implements Vo
{
    private ?int $cod_cliente;
    private ?string $nombre;
    private ?string $apellidos;
    private ?int $telefono;
    private ?string $mail;

    public function __construct(
        ?int $codCliente = null,
        ?string $nombre = null,
        ?string $apellidos = null,
        ?int $telefono = null,
        ?string $mail = null
    ) {
        $this->cod_cliente = $codCliente;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->telefono = $telefono;
        $this->mail = $mail;
    }

    

    /**
     * Get the value of codCliente
     */ 
    public function getCodCliente()
    {
        return $this->cod_cliente;
    }

    /**
     * Set the value of codCliente
     *
     * @return  self
     */ 
    public function setCodCliente($codCliente)
    {
        $this->cod_cliente = $codCliente;

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
     * Get the value of apellidos
     */ 
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set the value of apellidos
     *
     * @return  self
     */ 
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get the value of telefono
     */ 
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set the value of telefono
     *
     * @return  self
     */ 
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get the value of mail
     */ 
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set the value of mail
     *
     * @return  self
     */ 
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }
}