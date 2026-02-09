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

    public static function deleteCliente(ClienteVO $vo): bool
    {
        $sql = 'DELETE FROM cliente WHERE cod_cliente = :id';
        $result = false;

        try {
            $db = self::getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':id', $vo->getCodCliente(), PDO::PARAM_INT);
            $result = $stmt->execute();
        } catch(PDOException $th) {
            error_log('Error al eliminar cliente: ' . $th->getMessage());
        } finally {
            $db = null;
        }

        return $result;
    }

    public static function updateCliente(ClienteVO $vo): ClienteVO|null
    {
        $sql = 'UPDATE cliente 
            SET nombre = :nombre,
                apellidos = :apellidos,
                telefono = :telefono,
                mail = :mail
                WHERE cod_cliente = :cod_cliente';
        $result = false;

        try {
            $db = self::getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':nombre', $vo->getNombre(), PDO::PARAM_STR);
            $stmt->bindValue(':apellidos', $vo->getApellidos(), PDO::PARAM_STR);
            $stmt->bindValue(':telefono', $vo->getTelefono(), PDO::PARAM_INT);
            $stmt->bindValue(':mail', $vo->getMail(), PDO::PARAM_STR);
            $stmt->bindValue(':cod_cliente', $vo->getCodCliente(), PDO::PARAM_INT);

            $result = $stmt->execute();
        } catch (PDOException $th) {
            error_log('Error al modificar cliente ' . $th->getMessage());
        } finally {
            $db = null;
        }

        return $result ? self::getCliente($vo->getCodCliente()) : null;
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
