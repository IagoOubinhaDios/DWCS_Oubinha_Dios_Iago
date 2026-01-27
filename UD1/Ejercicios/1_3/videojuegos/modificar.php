<?php
include_once "acceso_datos.php";
//Utilizo $_REQUEST para que obtenga el parámetro con independencia de si llega por get o por POST
if (isset($_REQUEST["id"])) {
    $v = getVideojuego($_GET["id"]);
}

//Si entro por POST, actualizo los valores en la base de datos.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $v->setNombre($_POST['nombre'])
        ->setLanzamiento($_POST['lanzamiento'])
        ->setPlataforma($_POST['plataforma'])
        ->setGenero(empty($_POST['genero']) ? null : $_POST['genero']);
    //Guardamos los cambios y avisamos al usuario.
    $m = "No se ha podido modificar el videojuego";
    if (updateVideojuego($v)) {
        $m = "El videojuego se ha modificado";

    }
    echo '<script>alert("', $m, '")</script>';

}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar </title>
</head>

<body>
    <!-- Al parametrizar el action de esta forma mantenemos el id al hacer el post. -->
    <form action="?id=<?= $v->getId() ?>" method="POST">
        <label for="nombre">Nombre</label>
        <!-- Asignamos el valor actual a todos los input -->
        <input type="text" name="nombre" required value="<?= $v->getNombre() ?>"><br>
        <label for="plataforma">Plataforma</label>
        <input type="text" name="plataforma" required value="<?= $v->getPlataforma() ?>"><br>
        <label for="lanzamiento">Año de lanzamiento</label>
        <input type="number" name="lanzamiento" required value="<?= $v->getLanzamiento() ?>"><br>
        <label for="genero">Género</label>
        <input type="text" name="genero" value="<?= $v->getGenero() ?? "" ?>"><br>
        <button type="submit">Guardar</button>
        <a href="listar.php">Cancelar</a>
    </form>

</body>

</html>