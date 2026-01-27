<?php
class Direccion
{
    private $calle;
    private $ciudad;
    private $cp;

    public function __construct($calle, $ciudad, $cp)
    {
        $this->calle = $calle;
        $this->ciudad = $ciudad;
        $this->cp = $cp;
    }

    /**
     * Get the value of calle
     */
    public function getCalle()
    {
        return $this->calle;
    }

    /**
     * Set the value of calle
     *
     * @return  self
     */
    public function setCalle($calle)
    {
        $this->calle = $calle;

        return $this;
    }

    /**
     * Get the value of ciudad
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * Set the value of ciudad
     *
     * @return  self
     */
    public function setCiudad($ciudad)
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    /**
     * Get the value of cp
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Set the value of cp
     *
     * @return  self
     */
    public function setCp($cp)
    {
        $this->cp = $cp;

        return $this;
    }

    public function print()
    {
        return $this->calle . ", " . $this->ciudad . " (" . $this->cp . ")";
    }

}

class Persona
{
    private $nombre;
    private $edad;

    private Direccion $direccion;

    public function __construct($nombre, $edad, Direccion $direccion)
    {
        $this->nombre = $nombre;
        $this->edad = $edad;
        $this->direccion = $direccion;
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
     * Get the value of edad
     */
    public function getEdad()
    {
        return $this->edad;
    }

    /**
     * Set the value of edad
     *
     * @return  self
     */
    public function setEdad($edad)
    {
        if (is_int($edad) && $edad > 0) {

            $this->edad = $edad;
        }

        return $this;
    }

    public function esMayorDeEdad(): bool
    {
        return $this->edad >= 18;
    }

    public function printDireccion(){
        return $this -> direccion->print();
    }

    public function mostrarInformacion(){
        return "$this->nombre, $this->edad años, ".$this->direccion->print();
    }


}

//Prueba
// $d = new Direccion("plaza mayor, 3", "Vilagarcía", "36250");
// $p = new Persona("Pedro", 20, $d);
// echo "La persona ", $p->getNombre(), " vive en ", $p->printDireccion();