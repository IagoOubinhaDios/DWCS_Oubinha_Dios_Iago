<?php
function addClient($nombre, $telefono)
{
    //1- Establecer conexion
    //Cadena de conexion: conector:host=xx;dbname=bbdd
    $dsn = "mysql:host=mariadb;dbname=mi_base_de_datos";
    try {
        $db = new PDO($dsn, "usuarioBD", "abc123");
    } catch (PDOException $ex) {
        echo "Se ha producido un error";
        die();
    }
    //2- Realizar operaciones
    $sql = "INSERT INTO clientes(nombre, telefono) VALUES ('$nombre','$telefono')";
    $resultado = $db->exec($sql);
    //3- Cerrar conexion
    $db=null;
    return $resultado!=false;
}


//Logica para cuando recibo peticiones con datos.
$nombre = $_POST['nombre'] ?? null;
$telefono = $_POST['telf'] ?? null;
$resultado = false;
if (isset($nombre) && isset($telefono)) {
    $resultado = addClient($nombre, $telefono);
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo cliente</title>
</head>

<body>
    <?php if ($resultado): ?>
        <h1>Cliente agregado</h1>
        <a href="">Agregar nuevo cliente</a>

    <?php else: ?>

        <form action="" method="post">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" required><br>
            <label for="telf">Teléfono</label>
            <input type="text" name="telf" required><br>
            <button type="submit">Agregar</button>
        </form>
    <?php endif; ?>
    <br>
    <a href="conexion_BD_mysqli_select.php">Ver clientes</a>
</body>

</html>