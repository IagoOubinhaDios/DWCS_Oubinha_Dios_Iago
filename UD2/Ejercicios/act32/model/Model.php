<?php
namespace Ejercicios\act32\model;
use Pdo;
class Model
{
    protected static function getConnection()
    {
        $db = new PDO('mysql:host=mariadb; dbname=tienda', 'root', 'bitnami');
        return $db;
    }

}