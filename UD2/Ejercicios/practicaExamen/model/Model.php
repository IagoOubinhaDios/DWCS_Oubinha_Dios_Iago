<?php
namespace Ejercicios\practicaExamen\model;
use Pdo;
class Model
{
    protected static function getConnection()
    {
        $db = new PDO('mysql:host=mariadb; dbname=coches', 'root', 'bitnami');
        return $db;
    }

}