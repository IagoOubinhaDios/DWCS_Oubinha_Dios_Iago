<?php
namespace Ejercicios\act41\model\vo;

class DiscoVo implements Vo
{
    private ?int $idDisco;
    private string $titulo;
    private ?int $anho;
    private ?int $idBanda;

    public function __construct(
        ?int $idDisco,
        string $titulo,
        ?int $anho,
        ?int $idBanda
    ) {
        $this->idDisco = $idDisco;
        $this->titulo = $titulo;
        $this->anho = $anho;
        $this->idBanda = $idBanda;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->idDisco,
            'titulo' => $this->titulo,
            'anho' => $this->anho,
            'id_banda' => $this->idBanda
        ];
    }

    public static function fromArray(array $data): DiscoVo
    {
        return new DiscoVo(
            $data['id'] ?? null,
            $data['titulo'],
            (int)$data['anho'],
            (int)$data['id_banda']
        );
    }

    public function updateVoParams(Vo $vo): void
    {
        if (!$vo instanceof DiscoVo) {
            return;
        }

        $this->titulo = $vo->titulo;
        $this->anho = $vo->anho;
        $this->idBanda = $vo->idBanda;
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
     * Get the value of anho
     */ 
    public function getAnho()
    {
        return $this->anho;
    }

    /**
     * Set the value of anho
     *
     * @return  self
     */ 
    public function setAnho($anho)
    {
        $this->anho = $anho;

        return $this;
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
}