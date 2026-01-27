<?php
namespace Ejercicios\act32\model\vo;

class ProductoVO implements Vo
{
    private ?int $cod_producto;
    private ?string $denominacion;
    private ?string $descripcion;
    private ?float $precio;
    private ?int $cantidad;

    public function __construct(
        ?int $codProducto = null,
        ?string $denominacion = null,
        ?string $descripcion = null,
        ?float $precio = null,
        ?int $cantidad = null
    ) {
        $this->cod_producto = $codProducto;
        $this->denominacion = $denominacion;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->cantidad = $cantidad;
    }

    /**
     * Get the value of codProducto
     */ 
    public function getCodProducto()
    {
        return $this->cod_producto;
    }

    /**
     * Set the value of codProducto
     *
     * @return  self
     */ 
    public function setCodProducto($codProducto)
    {
        $this->cod_producto = $codProducto;

        return $this;
    }

    /**
     * Get the value of denominacion
     */ 
    public function getDenominacion()
    {
        return $this->denominacion;
    }

    /**
     * Set the value of denominacion
     *
     * @return  self
     */ 
    public function setDenominacion($denominacion)
    {
        $this->denominacion = $denominacion;

        return $this;
    }

    /**
     * Get the value of descripcion
     */ 
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set the value of descripcion
     *
     * @return  self
     */ 
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get the value of precio
     */ 
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set the value of precio
     *
     * @return  self
     */ 
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get the value of cantidad
     */ 
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set the value of cantidad
     *
     * @return  self
     */ 
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }
}