<?php

namespace Ejercicios\act41\model;

use Ejercicios\act41\model\vo\BandaVo;
use PDO;
use PDOException;

class BandaModel extends Model
{
    public static function add(BandaVo $vo): ?BandaVo
    {
        $sql = "INSERT INTO banda (nombre, num_integrantes, genero, nacionalidad)
                VALUES (:nombre, :num_integrantes, :genero, :nacionalidad)";
        try {
            $db = self::getConnection();


            $stm = $db->prepare($sql);
            $params = $vo->toArray();
            unset($params['id']);
            $stm->execute($params);
            $banda_id = (int) $db->lastInsertId();
            $vo->setIdBanda($banda_id);
        } catch (PDOException $th) {
            error_log("Error agregando banda: " . $th->getMessage());
            $vo = null;
        } finally {
            $db = null;
        }

        return $vo;
    }

    public static function getById(int $id): ?BandaVo
    {
        $sql = "SELECT * FROM banda WHERE id = :id";
        $bandaVo = null;
        try {
            $db = self::getConnection();
            $stm = $db->prepare($sql);
            $stm->execute(['id' => $id]);
            $data = $stm->fetch();
            $bandaVo = $data ? BandaVo::fromArray($data) : null;
        } catch (PDOException $th) {
            error_log("Error obteniendo banda banda_id = $id: " . $th->getMessage());
        } finally {
            $db = null;
        }

        return $bandaVo;
    }

    public static function getFilter(
        ?string $nombre = null,
        ?string $genero = null,
        ?string $nacionalidad = null
    ): array {
        $bandas = [];
        $sql = "SELECT * FROM banda WHERE 1=1";
        $params = [];

        if ($nombre !== null) {
            $sql .= " AND nombre LIKE :nombre";
            $params['nombre'] = "%$nombre%";
        }
        if ($genero !== null) {
            $sql .= " AND genero = :genero";
            $params['genero'] = $genero;
        }
        if ($nacionalidad !== null) {
            $sql .= " AND nacionalidad = :nacionalidad";
            $params['nacionalidad'] = $nacionalidad;
        }
        try {
            $db = self::getConnection();
            $stm = $db->prepare($sql);
            foreach ($params as $param => $value) {
                $stm->bindValue($param, $value);
            }
            $stm->execute();
            foreach ($stm as $row) {
                $bandas[] = BandaVo::fromArray($row);
            }
        } catch (PDOException $th) {
            error_log("Error obteniendo bandas " . $th->getMessage());
        } finally {
            $db = null;
        }

        return $bandas;
    }

    public static function update(BandaVo $vo): bool
    {
        $resultado = false;
        $sql = "UPDATE banda
                SET nombre = :nombre,
                    num_integrantes = :num_integrantes,
                    genero = :genero,
                    nacionalidad = :nacionalidad
                WHERE id = :id";
        try {
            $db = self::getConnection();
            $stm = $db->prepare($sql);
            $stm->bindValue(":nombre", $vo->getNombre(), PDO::PARAM_STR);
            $stm->bindValue(":num_integrantes", $vo->getNum_integrantes(), PDO::PARAM_INT);
            $stm->bindValue(":genero", $vo->getGenero(), PDO::PARAM_STR);
            $stm->bindValue(":nacionalidad", $vo->getNacionalidad(), PDO::PARAM_STR);
            $resultado = $stm->execute();
            $resultado = $resultado && $stm->rowCount() == 1;
        } catch (PDOException $th) {
            error_log("Error actualizando banda: " . $th->getMessage());
        } finally {
            $db = null;
        }

        return $resultado;
    }

    public static function delete(int $id): bool
    {

        $resultado = false;
        $sql = "DELETE FROM banda WHERE id = :id";
        try {
            $db = self::getConnection();
            $stm = $db->prepare($sql);
            $stm->bindValue("id", $id);    
            $resultado = $stm->execute();
            $resultado = $resultado && $stm->rowCount() == 1;
        } catch (PDOException $th) {
            error_log("Error actualizando banda: " . $th->getMessage());
        } finally {
            $db = null;
        }

        return $resultado;
    }
}