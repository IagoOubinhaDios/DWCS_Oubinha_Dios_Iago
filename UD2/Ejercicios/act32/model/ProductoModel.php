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

    public static function updateProducto(ProductoVO $vo): ProductoVO|null
    {
        $sql = 'UPDATE producto 
            SET denominacion = :denominacion,
                descripcion = :descripcion,
                precio = :precio,
                cantidad = :cantidad
                WHERE cod_producto = :cod_producto';
        $result = false;

        try {
            $db = self::getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':denominacion', $vo->getDenominacion(), PDO::PARAM_STR);
            $stmt->bindValue(':descripcion', $vo->getDescripcion(), PDO::PARAM_STR);
            $stmt->bindValue(':precio', $vo->getPrecio());
            $stmt->bindValue(':cantidad', $vo->getCantidad(), PDO::PARAM_INT);
            $stmt->bindValue(':cod_producto', $vo->getCodProducto(), PDO::PARAM_INT);

            $result = $stmt->execute();
        } catch (PDOException $th) {
            error_log('Error al modificar producto ' . $th->getMessage());
        } finally {
            $db = null;
        }

        return $result ? self::getProducto($vo->getCodProducto()) : null;
    }

    public static function deleteProducto(ProductoVO $vo): bool
    {
        $sql = 'DELETE FROM producto WHERE cod_producto = :id';
        $result = false;

        try {
            $db = self::getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':id', $vo->getCodProducto(), PDO::PARAM_INT);
            $result = $stmt->execute();
        } catch(PDOException $th) {
            error_log('Error al eliminar producto: ' . $th->getMessage());
        } finally {
            $db = null;
        }

        return $result;
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
