<?php
include_once("acceso_datos.php");
//Si está entrando desde un enlace de eliminar realizamos la acción.
if (isset($_GET["eliminar"])) {
    $m = "El videojuego no se ha eliminado";

    if (deleteVideojuego($_GET['eliminar'])) {
        $m = "El videojuego se ha eliminado";

    }
    echo '<script>alert("', $m, '")</script>';
    //Esto es una redirección y nos sirve para que no se quede el parámetro eliminar en la URL
    header("Location: listar.php");
}
//RECUPERACION DE DATOS

//Si tiene filtros los agregamos a un array de filtros
$filtros = [];
foreach ($_REQUEST as $param => $value) {
    if (str_starts_with($param, 'fil_')) {
        $filtros[$param] = $value;
    }
}
//Si tiene un parámetro de ordenación lo recuperamos.
$orden = $_REQUEST["order"] ?? null;

//Si tiene orden lo aplicamos
if (isset($_REQUEST["order"])) {
    $videojuegos = getVideojuegos($filtros, $_REQUEST["order"]);
} else {
    $videojuegos = getVideojuegos($filtros);
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videojuegos</title>
</head>

<body>
    <!-- Filtros de búsqueda -->
    <fieldset>
        <legend>Filtros de búsqueda</legend>
        <!-- Si tenemos una ordenación se la pasamos como parámetro de la URL para mantenerla después de aplicar el filtro.-->
        <form action="<?=isset($order)?"order=$order":""?>" method="post">
            <label for="fil_nombre">Nombre</label>
            <input type="text" name="fil_nombre" value="<?=$_REQUEST['fil_nombre']??''?>"><br>
            <label for="fil_plataforma">Plataforma</label>
            <input type="text" name="fil_plataforma" value="<?=$_REQUEST['fil_plataforma']??''?>"><br>
            <label for="fil_lanzamiento">Año de lanzamiento</label>
            <input type="text" name="fil_lanzamiento" value="<?=$_REQUEST['fil_lanzamiento']??''?>"><br>
            <label for="fil_genero">Genero</label>
            <input type="text" name="fil_genero" value="<?=$_REQUEST['fil_genero']??''?>"><br>
            <button type="submit">Filtrar</button>
        </form>
    </fieldset>
    <h1>Videojuegos registrados</h1>
    <table>
        <?php
        //Para mantener los filtros de búsqueda anteriores, vamos a meterlos en la URL de cada enlace
        foreach ($filtros as $key => $value) {
            $params .= "&$key=$value";
        }

        echo "<tr>";
        echo "    <th><a href='?order=nombre$params'>Nombre</a></th>";
        echo "    <th><a href='?order=plataforma$params'>Plataforma</a></th>";
        echo "    <th><a href='?order=anio_lanzamiento$params'>Año</a></th>";
        echo "    <th><a href='?order=genero$params'>Género</a></th>";
        echo "    <th><a >Acciones</a></th>";
        echo "</tr>";

        foreach ($videojuegos as $v) {
            echo "<tr>";
            echo "<td>", $v->getNombre(), "</td>";
            echo "<td>", $v->getPlataforma(), "</td>";
            echo "<td>", $v->getLanzamiento(), "</td>";
            echo "<td>", $v->getGenero() ?? '-', "</td>";
            echo "<td> <a href='?eliminar=", $v->getId(), "'>Eliminar</a><br><a href='modificar.php?id=", $v->getId(), "'>Modificar</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
    <a href="crear.php">Nuevo videojuego</a>

</body>

</html>