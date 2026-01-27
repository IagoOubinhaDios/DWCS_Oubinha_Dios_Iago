<?php
require_once "control_acceso.php";
try {
    if (!ControlAcceso::hasAccessCurrentUser(ControlAcceso::PAGE_VER_PROYECTOS)) {
        header('HTTP/1.1 403 Forbidden');
        exit;
    }
} catch (UserNotLogedException $th){
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver proyectos</title>
</head>
<body>
    <h1>Vista programador</h1>
</body>
</html>