<?php
namespace Ejemplos\act31\model;
use Ejemplos\act31\model\vo\AlumnoVO;
use Ejemplos\act31\model\vo\EscuelaVO;
use PDOException;
use Pdo;
class AlumnoModel extends Model
{
    public static function getAlumno(int $cod_alumno): AlumnoVO|null
    {
        $alu = null;
        try {
            $db = self::getConnection();
            $statement = $db->prepare('SELECT nombre, apellido1, apellido2, sexo FROM alumno WHERE cod_alumno=:cod_alumno');
            $statement->bindValue('cod_alumno', $cod_alumno, PDO::PARAM_INT);
            $statement->execute();
            $row = $statement->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $th) {
            error_log($th->getMessage());
            $alu = null;
        } finally {
            $db = null;
        }

        return isset($row) && $row ? self::rowToVO($row) : null;
    }

    public static function matricularAlumno(AlumnoVO $alumno, EscuelaVO $escuela, int $anho)
    {
        $resultado = false;
        try {
            $sql = "INSERT INTO `matricula`(`cod_alumno`, `cod_escuela`, `anho`) 
            VALUES (:cod_alumno, :cod_escuela, :anho)";
            $db = self::getConnection();
            $statement = $db->prepare($sql);
            $statement->bindValue('cod_alumno', $alumno->getCod_alumno(), PDO::PARAM_INT);
            $statement->bindValue('cod_escuela', $escuela->getCodEscuela(), PDO::PARAM_INT);
            $statement->bindValue('anho', $anho, PDO::PARAM_INT);
            $resultado = $statement->execute();
        } catch (PDOException $th) {
            error_log($th->getMessage());
        } finally {
            $db = null;
        }

        return $resultado;
    }

    private static function rowToVO(array $row): AlumnoVO
    {
        return new AlumnoVO(
            (int) $row['cod_alumno'],
            $row['nombre'],
            $row['apellido1'],
            (int) $row['apellido2'],
            $row['fecha_naci'],
            $row['sexo']
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