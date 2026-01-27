<?php
namespace Ejercicios\act42\model;
use Pdo;

abstract class Model
{
    protected static function getConnection()
    {
        $db = new PDO('mysql:host=mariadb; dbname=usuarios', 'root', 'bitnami');
        return $db;
    }


}