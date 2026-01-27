<?php
$nombre = $_POST['nombre'] ?? '';
$apellidos = $_POST['apellidos'] ?? '';
$telefono = $_POST['telefono'] ?? 0;
$mail = $_POST['mail'] ?? '';

$errores = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        isset($nombre) && isset($apellidos) && isset($telefono) && isset($mail)
    ) {
        if ($nombre == '') {
            $errores[] = 'Campo de nombre vacío';
        }
        if ($apellidos == '') {
            $errores[] = 'Campo de apellidos vacío';
        }
        if ($telefono == '') {
            $errores[] = 'Campo de telefono vacío';
        } else if (!filter_var($telefono, FILTER_VALIDATE_INT)) {
            $errores[] = 'Formato de telefono incorrecto';
        }
        if ($mail == '') {
            $errores[] = 'Campo de mail vacío';
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errores[] = 'Formato de email incorrecto';
        }

        if (count($errores) == 0) {
            header(`Location: index.php?controller=ClienteController&action=addCliente&
            nombre=$nombre&apellidos=$apellidos&telefono=$telefono&mail=$mail`);
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos del nuevo cliente</title>
</head>

<body>
    <h1>Datos del nuevo cliente</h1>
    <form action="" method="POST">
        <p><label for="nombre">Nombre:</label>
            <input name="nombre" type="text">
        </p>
        <p><label for="apellidos">Apellidos:</label>
            <input name="apellidos" type="text">
        </p>
        <p><label for="telefono">Telefono:</label>
            <input name="telefono" type="text">
        </p>
        <p><label for="mail">Correo electrónico:</label>
            <input name="mail" type="text">
        </p>
        <button type="submit">Enviar</button>
        <p><a href="http://localhost/Ejercicios/act32/index.php?controller=OpcionesController&action=opciones">Volver</a></p>
        <?php
        if (count($errores) > 0) {
            foreach ($errores as $error) {
                echo "<p>" . $error . "</p>";
            }
        }
        ?>
    </form>
</body>

</html>