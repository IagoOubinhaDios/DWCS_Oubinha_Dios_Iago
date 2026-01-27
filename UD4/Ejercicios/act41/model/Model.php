<?php
namespace Ejercicios\act41\model;
use Pdo;

abstract class Model
{
    protected static function getConnection()
    {
        $db = new PDO('mysql:host=mariadb; dbname=musica', 'root', 'bitnami');
        return $db;
    }


}