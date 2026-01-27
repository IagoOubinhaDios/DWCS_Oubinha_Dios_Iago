<?php
include_once("acceso_datos.php");
//Si llega por POST realizamos el alta.
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    if (isset($_POST['nombre']) && isset($_POST['plataforma']) && isset($_POST['lanzamiento'])) {
        //Aqui tendriamos que hacer validaciones...
        //Creamos el objeto
        $v = new Videojuego();
        $v->setNombre($_POST['nombre'])
            ->setLanzamiento($_POST['lanzamiento'])
            ->setPlataforma($_POST['plataforma'])
            ->setGenero(empty($_POST['genero']) ? null : $_POST['genero']);
        //Agregamos el videojuego.    
        if (addVideojuego($v)) {
            //Lo redirigimos a la pagina de busqueda
            header("Location: listar.php");
        } else {
            //Mostramos un error.
            echo "<script>alert('No se ha podido agregar el videojuego.');</script>";
        }
    }
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
    <form action="" method="POST">
        <label for="nombre">Nombre</label>
        <!-- Asignamos el valor actual a todos los input -->
        <input type="text" name="nombre" required><br>
        <label for="plataforma">Plataforma</label>
        <input type="text" name="plataforma" required><br>
        <label for="lanzamiento">Año de lanzamiento</label>
        <input type="number" name="lanzamiento" required><br>
        <label for="genero">Género</label>
        <input type="text" name="genero"><br>
        <button type="submit">Guardar</button>
        <a href="listar.php">Cancelar</a>
    </form>

</body>

</html>