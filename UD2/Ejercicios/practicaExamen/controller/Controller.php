<?php
namespace Ejercicios\practicaExamen\controller;
use Ejercicios\practicaExamen\view\View;
class Controller
{
    protected View $vista;

    public function __construct()
    {
        $this->vista = new View();
    }
}