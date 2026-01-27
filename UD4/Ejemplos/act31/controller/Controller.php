<?php
namespace Ejemplos\act31\controller;
use Ejemplos\act31\view\View;
class Controller
{
    protected View $vista;

    public function __construct()
    {
        $this->vista = new View();
    }
}