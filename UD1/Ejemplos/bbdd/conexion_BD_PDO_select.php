<?php
function getClients()
{
    //1- Establecer conexion
    //Cadena de conexion: conector:host=xx;dbname=bbdd
    $dsn = "mysql:host=mariadb;dbname=mi_base_de_datos";
    try{
        $db = new PDO($dsn,"usuarioBD","abc123");
    }catch(PDOException $ex){
        echo "Se ha producido un error";
        die();
    }

    //2- Realizar operaciones
    $sql = "SELECT id_cliente, nombre, telefono FROM clientes ORDER BY nombre ASC";
    //PDOStatement
    $resultado = $db->query($sql);
    $datos = $resultado->fetchAll();
    //3- Cerrar conexion
    $resultado->closeCursor();
    $db = null;

    return $datos;
}

$datos = getClients();
echo "<ul>";
foreach($datos as $fila){
    echo "<li>",$fila["nombre"]," (",$fila["telefono"],")";
}
echo "</ul>";
?>
<br>
<a href="conexion_BD_mysqli_insert.php">Nuevo cliente</a>