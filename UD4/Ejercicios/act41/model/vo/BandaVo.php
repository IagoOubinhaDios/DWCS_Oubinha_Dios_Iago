<?php
namespace Ejercicios\act41\model\vo;

class BandaVo implements Vo
{
    private ?int $idBanda;
    private string $nombre;
    private ?int $num_integrantes;
    private string $genero;
    private string $nacionalidad;

    public function __construct(
        ?int $idBanda,
        string $nombre,
        ?int $num_integrantes,
        string $genero,
        string $nacionalidad
    ) {
        $this->idBanda = $idBanda;
        $this->nombre = $nombre;
        $this->num_integrantes = $num_integrantes;
        $this->genero = $genero;
        $this->nacionalidad = $nacionalidad;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->idBanda,
            'nombre' => $this->nombre,
            'num_integrantes' => $this->num_integrantes,
            'genero' => $this->genero,
            'nacionalidad' => $this->nacionalidad
        ];
    }

    public static function fromArray(array $data): BandaVo
    {
        return new BandaVo(
            $data['id'] ?? null,
            $data['nombre'],
            (int)$data['num_integrantes'],
            $data['genero'],
            $data['nacionalidad'] ?? null
        );
    }

    public function updateVoParams(Vo $vo): void
    {
        if (!$vo instanceof BandaVo) {
            return;
        }

        $this->nombre = $vo->nombre;
        $this->num_integrantes = $vo->num_integrantes;
        $this->genero = $vo->genero;
        $this->nacionalidad = $vo->nacionalidad;
    }

    /**
     * Get the value of idBanda
     */ 
    public function getIdBanda()
    {
        return $this->idBanda;
    }

    /**
     * Set the value of idBanda
     *
     * @return  self
     */ 
    public function setIdBanda($idBanda)
    {
        $this->idBanda = $idBanda;

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
     * Get the value of num_integrantes
     */ 
    public function getNum_integrantes()
    {
        return $this->num_integrantes;
    }

    /**
     * Set the value of num_integrantes
     *
     * @return  self
     */ 
    public function setNum_integrantes($num_integrantes)
    {
        $this->num_integrantes = $num_integrantes;

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

    /**
     * Get the value of nacionalidad
     */ 
    public function getNacionalidad()
    {
        return $this->nacionalidad;
    }

    /**
     * Set the value of nacionalidad
     *
     * @return  self
     */ 
    public function setNacionalidad($nacionalidad)
    {
        $this->nacionalidad = $nacionalidad;

        return $this;
    }
}