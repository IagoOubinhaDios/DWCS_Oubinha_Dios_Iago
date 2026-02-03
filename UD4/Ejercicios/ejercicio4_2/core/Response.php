<?php
namespace Ejercicios\ejercicio4_2\core;

class Response{
    public static function json(array $data, int $status){
        //TODO
        http_response_code($status);
        header('Content-Type:application/json');
        echo json_encode($data);
    }

    public static function notFound(){
        //TODO
        http_response_code(404);
        header('Content-Type:application/json');
        echo json_encode(['error' => 'Recurso no encontrado']);
    }

    public static function serverError(){
        //TODO
        http_response_code(500);
        header('Content-Type:application/json');
        echo json_encode(['error' => 'Se ha producido un error.']);
    }
}