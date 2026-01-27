<?php
namespace Ejercicios\act41\model\vo;

class PistaVo implements Vo
{
    private int $idDisco;
    private int $numero;
    private string $titulo;
    private ?int $duracion;

    public function __construct(
        ?int $idDisco,
        ?int $numero,
        string $titulo,
        ?int $duracion
    ) {
        $this->idDisco = $idDisco;
        $this->numero = $numero;
        $this->titulo = $titulo;
        $this->duracion = $duracion;
    }

    public function toArray(): array
    {
        return [
            'id_disco' => $this->idDisco,
            'numero' => $this->numero,
            'titulo' => $this->titulo,
            'duracion' => $this->duracion
        ];
    }

    public static function fromArray(array $data): PistaVo
    {
        return new PistaVo(
            (int)$data['id_disco'],
            (int)$data['numero'],
            $data['titulo'],
            $data['duracion'] ?? null
        );
    }

    public function updateVoParams(Vo $vo): void
    {
        if (!$vo instanceof PistaVo) {
            return;
        }

        $this->titulo = $vo->titulo;
        $this->duracion = $vo->duracion;
    }

    /**
     * Get the value of idDisco
     */ 
    public function getIdDisco()
    {
        return $this->idDisco;
    }

    /**
     * Set the value of idDisco
     *
     * @return  self
     */ 
    public function setIdDisco($idDisco)
    {
        $this->idDisco = $idDisco;

        return $this;
    }

    /**
     * Get the value of numero
     */ 
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set the value of numero
     *
     * @return  self
     */ 
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get the value of titulo
     */ 
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set the value of titulo
     *
     * @return  self
     */ 
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get the value of duracion
     */ 
    public function getDuracion()
    {
        return $this->duracion;
    }

    /**
     * Set the value of duracion
     *
     * @return  self
     */ 
    public function setDuracion($duracion)
    {
        $this->duracion = $duracion;

        return $this;
    }
}