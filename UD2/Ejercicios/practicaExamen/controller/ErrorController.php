<?php
namespace Ejercicios\practicaExamen\controller;
class ErrorController extends Controller
{
    public function pageNotFound()
    {
        $this->vista->show("page_not_found");
        header("HTTP/1.1 404 Page not found");
        exit;
    }
}