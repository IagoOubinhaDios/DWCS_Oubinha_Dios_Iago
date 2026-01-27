<?php
namespace Ejercicios\act32\controller;
use Ejercicios\act32\view\View;
class Controller
{
    protected View $vista;

    public function __construct()
    {
        $this->vista = new View();
    }
}