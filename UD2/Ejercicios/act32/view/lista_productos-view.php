<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista productos</title>
</head>

<body>
    <h1>Listado de productos</h1>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Precio</th>
            <th>Cantidad</th>
        </tr>
        <?php
        foreach ($data as $row) {
            echo "<tr>";
            echo "<td> " . $row->getDenominacion() . " </td>";
            echo "<td> " . $row->getDescripcion() . " </td>";
            echo "<td> " . $row->getPrecio() . " </td>";
            echo "<td> " . $row->getCantidad() . " </td>";
            echo "</tr>";
        }
        ?>
    </table>
    <a href="http://localhost/Ejercicios/act32/index.php?controller=OpcionesController&action=opciones">Volver</a>
</body>

</html>