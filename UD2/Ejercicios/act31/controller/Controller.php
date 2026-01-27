<?php
namespace Ejercicios\act31\controller;
use Ejercicios\act31\view\View;
class Controller
{
    protected View $vista;

    public function __construct()
    {
        $this->vista = new View();
    }
}