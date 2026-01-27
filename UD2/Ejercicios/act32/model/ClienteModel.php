<?php
namespace Ejercicios\act32\model;

use PDOException;
use PDO;
use Ejercicios\act32\model\vo\ClienteVO;

class ClienteModel extends Model{

    public static function getClientes(): array|null
    {
        try {
            $db = self::getConnection();
            $res = $db->query('SELECT cod_cliente, nombre, apellidos, telefono, mail FROM cliente');
            $arr = [];
            while ($row = $res->fetch()) {
                $cli = self::rowToVO($row);
                $arr[] = $cli;
            }
            $res->closeCursor();
        } catch (PDOException $th) {
            error_log($th->getMessage());
            $arr = null;
        } finally {
            $db = null;
        }

        return $arr;
    }
    
    public static function addCliente(ClienteVO $cliente): bool
    {
        $resultado = false;
        try {
            $sql = "INSERT INTO `cliente`(`nombre`, `apellidos`, `telefono`, `mail`) 
            VALUES (:nombre, :apellidos, :telefono, :mail)";
            $db = self::getConnection();
            $statement = $db->prepare($sql);
            $statement->bindValue('nombre', $cliente->getNombre(), PDO::PARAM_STR);
            $statement->bindValue('apellidos', $cliente->getApellidos(), PDO::PARAM_STR);
            $statement->bindValue('telefono', $cliente->getTelefono(), PDO::PARAM_INT);
            $statement->bindValue('mail', $cliente->getMail(), PDO::PARAM_STR);
            $resultado = $statement->execute();
        } catch (PDOException $th) {
            error_log($th->getMessage());
        } finally {
            $db = null;
        }

        return $resultado;
    }

    private static function rowToVO(array $row): ClienteVO
    {
        return new ClienteVO(
            (int) $row['cod_cliente'],
            $row['nombre'],
            $row['apellidos'],
            (int) $row['telefono'],
            $row['mail']
        );
    }

}
