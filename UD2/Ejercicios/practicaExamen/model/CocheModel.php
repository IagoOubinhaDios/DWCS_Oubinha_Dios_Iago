<?php
namespace Ejercicios\practicaExamen\model;

use PDOException;
use PDO;
use Ejercicios\practicaExamen\model\vo\CocheVO;

class CocheModel extends Model{

    public static function getCoches(){
        try {
            $db = self::getConnection();
            $res = $db->query('SELECT cod_coche, matricula, marca, modelo, color FROM coche');
            $arr = [];
            while ($row = $res->fetch()) {
                $coche = self::rowToVO($row);
                $arr[] = $coche;
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

    private static function rowToVO(array $row): CocheVO
    {
        return new CocheVO(
            (int) $row['cod_coche'],
            $row['matricula'],
            $row['marca'],
            $row['modelo'],
            $row['color']
        );
    }
}