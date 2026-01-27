<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista clientes</title>
</head>

<body>
    <h1>Listado de clientes</h1>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Teléfono</th>
            <th>Email</th>
        </tr>
        <?php
        if (isset($data)){
            foreach ($data as $row) {
                echo "<tr>";
                echo "<td> " . $row->getNombre() . " </td>";
                echo "<td> " . $row->getApellidos() . " </td>";
                echo "<td> " . $row->getTelefono() . " </td>";
                echo "<td> " . $row->getMail() . " </td>";
                echo "</tr>";
            }
        }
        ?>
    </table>
    <a href="http://localhost/Ejercicios/act32/index.php?controller=OpcionesController&action=opciones">Volver</a>
</body>

</html>