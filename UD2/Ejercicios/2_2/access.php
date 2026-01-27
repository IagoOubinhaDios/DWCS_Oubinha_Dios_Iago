<?php
require_once "controller.php";

if(jugando()){
    header("Location:index.php");
    exit;
}

if(isset($_POST['nombre_jugador']) && !empty($_POST['nombre_jugador'])){
    $nombre = filter_var($_POST['nombre_jugador'],FILTER_SANITIZE_SPECIAL_CHARS);
    if(registrarJugador($nombre)){
        header("Location:index.php");
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso</title>
</head>
<body>
    <form action="" method="post">
        <label for="nombre_jugador">Nombre</label><br>
        <input type="text" name="nombre_jugador"><br>
        <button type="submit">Empezar</button>
    </form>
</body>
</html>