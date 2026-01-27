<?php
namespace Ejercicios\act31\model\vo;
use DateTime;
class AlumnoVO implements Vo
{
    public ?int $codAlumno;
    public ?string $nombre;
    public ?string $apellido1;
    public ?string $apellido2;
    public ?DateTime $fecha_naci;
    public ?string $sexo;

    public function __construct(
        ?int $codAlumno = null,
        ?string $nombre = null,
        ?string $apellido1 = null,
        ?string $apellido2 = null,
        DateTime|string|null $fecha_naci = null,
        ?string $sexo = null
    ) {
        $this->codAlumno = $codAlumno;
        $this->nombre = $nombre;
        $this->apellido1 = $apellido1;
        $this->apellido2 = $apellido2;
        $this->fecha_naci = $this->convertirHora($fecha_naci);
        $this->sexo = $sexo;
    }

    /**
     * Get the value of cod_alumno
     */
    public function getCod_alumno()
    {
        return $this->codAlumno;
    }

    /**
     * Set the value of cod_alumno
     *
     * @return  self
     */
    public function setCod_alumno($codAlumno)
    {
        $this->codAlumno = $codAlumno;

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
     * Get the value of sexo
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * Set the value of sexo
     *
     * @return  self
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;

        return $this;
    }

    /**
     * Convierte un valor a DateTime si llega como string "HH:MM" o "HH:MM:SS".
     * Si ya es DateTime, lo devuelve igual.
     * Si es null, devuelve null.
     */
    private function convertirHora(DateTime|string|null $valor): ?DateTime
    {
        if ($valor === null) {
            return null;
        }

        if ($valor instanceof DateTime) {
            return $valor;
        }

        // Si llega como texto
        // Normalizamos a formato H:i:s si es necesario con una expresion regular.
        if (preg_match('/^\d{2}:\d{2}$/', $valor)) {
            $valor .= ':00';
        }

        return DateTime::createFromFormat('H:i:s', $valor);
    }
}