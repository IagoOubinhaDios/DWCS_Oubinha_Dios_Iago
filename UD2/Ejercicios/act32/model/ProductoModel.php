<?php
namespace Ejercicios\act32\model;

use PDOException;
use PDO;
use Ejercicios\act32\model\vo\ProductoVO;

class ProductoModel extends Model{

    public static function getProductos(): array|null
    {
        try {
            $db = self::getConnection();
            $res = $db->query('SELECT cod_producto, denominacion, descripcion, precio, cantidad FROM producto');
            $arr = [];
            while ($row = $res->fetch()) {
                $pro = self::rowToVO($row);
                $arr[] = $pro;
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

    public static function addProducto(ProductoVO $producto): bool
    {
        $resultado = false;
        try {
            $sql = "INSERT INTO `producto`(`denominacion`, `descripcion`, `precio`, `cantidad`) 
            VALUES (:denominacion, :descripcion, :precio, :cantidad)";
            $db = self::getConnection();
            $statement = $db->prepare($sql);
            $statement->bindValue('denominacion', $producto->getDenominacion(), PDO::PARAM_STR);
            $statement->bindValue('descripcion', $producto->getDescripcion(), PDO::PARAM_STR);
            $statement->bindValue('precio', $producto->getPrecio());
            $statement->bindValue('cantidad', $producto->getCantidad(), PDO::PARAM_INT);
            $resultado = $statement->execute();
        } catch (PDOException $th) {
            error_log($th->getMessage());
        } finally {
            $db = null;
        }

        return $resultado;
    }

    private static function rowToVO(array $row): ProductoVO
    {
        return new ProductoVO(
            (int) $row['cod_producto'],
            $row['denominacion'],
            $row['descripcion'],
            (float) $row['precio'],
            (int) $row['cantidad']
        );
    }

}
