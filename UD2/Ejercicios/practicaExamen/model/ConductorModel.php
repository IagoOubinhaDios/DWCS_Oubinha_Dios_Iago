<?php
namespace Ejercicios\practicaExamen\model;

use PDOException;
use PDO;
use Ejercicios\practicaExamen\model\vo\ConductorVO;

class ConductorModel extends Model{

    public static function addConductor(ConductorVO $conductor): bool
    {
        $resultado = false;
        try {
            $sql = "INSERT INTO `producto`(`nombre`, `apellido1`, `apellido2`, `licencia`) 
            VALUES (:nombre, :apellido1, :apellido2, :licencia)";
            $db = self::getConnection();
            $statement = $db->prepare($sql);
            $statement->bindValue('nombre', $conductor->getNombre(), PDO::PARAM_STR);
            $statement->bindValue('apellido1', $conductor->getApellido1(), PDO::PARAM_STR);
            $statement->bindValue('apellido2', $conductor->getApellido2(), PDO::PARAM_STR);
            $statement->bindValue('licencia', $conductor->getLicencia(), PDO::PARAM_STR);
            $resultado = $statement->execute();
        } catch (PDOException $th) {
            error_log($th->getMessage());
        } finally {
            $db = null;
        }

        return $resultado;
    }
}