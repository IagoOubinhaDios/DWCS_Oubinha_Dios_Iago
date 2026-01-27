<?php
$denominacion = $_POST['denominacion'] ?? '';
$descripcion = $_POST['descripcion'] ?? '';
$precio = $_POST['precio'] ?? 0.0;
$cantidad = $_POST['cantidad'] ?? 0;

$errores = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        isset($denominacion) && isset($descripcion) && isset($precio) && isset($cantidad)
    ) {
        if ($denominacion == '') {
            $errores[] = 'Campo de denominacion vacío';
        }
        if ($descripcion == '') {
            $errores[] = 'Campo de descripcion vacío';
        }
        if ($precio == '') {
            $errores[] = 'Campo de precio vacío';
        } else if (!filter_var($precio, FILTER_VALIDATE_FLOAT)) {
            $errores[] = 'Formato de precio incorrecto';
        }
        if ($cantidad == '') {
            $errores[] = 'Campo de cantidad vacío';
        } else if (!filter_var($cantidad, FILTER_VALIDATE_INT)) {
            $errores[] = 'Formato de cantidad incorrecto';
        }

        if (count($errores) == 0) {
            header(`Location: index.php?controller=ProductoController&action=addProducto&
            denominacion=$denominacion&descripcion=$descripcion&precio=$precio&cantidad=$cantidad`);
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
    <title>Datos del nuevo producto</title>
</head>

<body>
    <h1>Datos del nuevo producto</h1>
    <form action="" method="POST">
        <p><label for="denominacion">Denominacion:</label>
            <input name="denominacion" type="text">
        </p>
        <p><label for="descripcion">Descripcion:</label>
            <input name="descripcion" type="text">
        </p>
        <p><label for="precio">Precio:</label>
            <input name="precio" type="text">
        </p>
        <p><label for="cantidad">Cantidad:</label>
            <input name="cantidad" type="number">
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