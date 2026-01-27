<?php
namespace Ejercicios\act31\model;
use PDOException;
use Pdo;
use Ejercicios\act31\model\vo\EscuelaVO;

class EscuelaModel extends Model
{

    public static function getEscuela(int $id): ?EscuelaVO
    {
        $sql = "SELECT * FROM escuela WHERE cod_escuela = :id";
        try {
            $db = self::getConnection();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $th) {
            error_log("Error obteniendo escuela por ID: " . $th->getMessage());
        } finally {
            $db = null;
        }

        return isset($row) && $row ? self::rowToVO($row) : null;
    }

    /**
     * Devuelve un array filtrado de escuelas. Los filtros son claves del array $data y pueden ser:
     * nombre (string), cod_municipio (int) y/o comedor (bool).
     * @param $data Filtros a aplicar.
     */
    public static function getFilter(?array $data): array
    {
        $sql = "SELECT * FROM escuela WHERE 1=1";
        $resultados = [];

        try {
            $db = self::getConnection();
            if (isset($data)) {
                if (isset($data['nombre'])) {
                    $sql .= " AND nombre LIKE :nombre";
                }

                if (isset($data['cod_municipio'])) {
                    $sql .= " AND cod_municipio = :cod_municipio";
                }

                if (isset($data['comedor'])) {
                    $sql .= " AND comedor = :comedor";
                }
            }

            $stmt = $db->prepare($sql);
            if (isset($data)) {
                if (isset($data['nombre'])) {
                    $stmt->bindValue(':nombre', "%" . $data['nombre'] . "%", PDO::PARAM_STR);
                }

                if (isset($data['cod_municipio'])) {
                    $stmt->bindValue(':cod_municipio', (int) $data['cod_municipio'], PDO::PARAM_INT);
                }

                if (isset($data['comedor'])) {
                    $stmt->bindValue(':comedor', $data['comedor'] ? 'S' : 'N', PDO::PARAM_STR);
                }
            }

            $stmt->execute();

            foreach ($stmt as $row) {
                $resultados[] = self::rowToVO($row);
            }

            $stmt->closeCursor();
        } catch (PDOException $th) {
            error_log("Error accediendo a la base de datos. " . $th->getMessage());
        } finally {
            $db = null;
        }

        return $resultados;
    }

    public static function addEscuela(EscuelaVO $escuela): bool
    {
        $resultado = false;
        try {
            $sql = "INSERT INTO `escuela`(`nombre`, `direccion`, `cod_municipio`, `hora_apertura`, `hora_cierre`, `comedor`) 
            VALUES (:nombre, :direccion, :cod_municipio, :hora_apertura, :hora_cierre, :comedor)";
            $db = self::getConnection();
            $statement = $db->prepare($sql);
            $statement->bindValue('nombre', $escuela->getNombre(), PDO::PARAM_STR);
            $statement->bindValue('direccion', $escuela->getDireccion(), PDO::PARAM_STR);
            $statement->bindValue('cod_municipio', $escuela->getCodMunicipio(), PDO::PARAM_INT);
            $statement->bindValue('hora_apertura', $escuela->getHoraApertura());
            $statement->bindValue('hora_cierre', $escuela->getHoraCierre());
            $statement->bindValue('comedor', $escuela->getComedor() ? 'S' : 'N', PDO::PARAM_STR);
            $resultado = $statement->execute();
        } catch (PDOException $th) {
            error_log($th->getMessage());
        } finally {
            $db = null;
        }

        return $resultado;
    }

    public static function deleteEscuela(EscuelaVO $escuela): bool
    {
        $resultado = false;
        try {
            $sql = "DELETE FROM `escuela` WHERE `cod_escuela` = :cod_escuela";
            $db = self::getConnection();
            $statement = $db->prepare($sql);
            $statement->bindValue('cod_escuela', $escuela->getCodEscuela(), PDO::PARAM_INT);
            $resultado = $statement->execute();
        } catch (PDOException $th) {
            error_log($th->getMessage());
        } finally {
            $db = null;
        }

        return $resultado;
    }

    private static function rowToVO(array $row): EscuelaVO
    {
        return new EscuelaVO(
            (int) $row['cod_escuela'],
            $row['nombre'],
            $row['direccion'],
            (int) $row['cod_municipio'],
            $row['hora_apertura'],
            $row['hora_cierre'],
            $row['comedor'] === 'S' ? true : false
        );
    }

    /**
     * Convierte DateTime → "HH:MM:SS" o null 
     */
    private static function formatoHora(?\DateTime $hora): ?string
    {
        return $hora ? $hora->format("H:i:s") : null;
    }
}