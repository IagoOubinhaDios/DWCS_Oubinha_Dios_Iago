<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partidas Jugador</title>
</head>
<body>
    <form action="" method="post">
        <label for="nombre">Nombre</label><br>
        <input type="text" name="nombre"><br>
        <button type="submit">Buscar</button>
    </form>
    <?php
    require_once "model.php";
    if(isset($_POST['nombre'])){
        $jugador = new Jugador();
        $jugador->nombre = $_POST['nombre'];
        $partidas = getPartidasJugador($jugador);
    }
    ?>
    <table>
        <tr>
            <th>Jugador</th>
            <th>Intentos</th>
            <th>Segundos</th>
            <th>Número</th>
        </tr>
    
    <?php
    foreach($partidas as $p){
        echo "<tr>";
        echo "<td>",$p->jugador->nombre,"</td>";
        echo "<td>",$p->intentos,"</td>";
        echo "<td>",$p->segundos,"</td>";
        echo "<td>",$p->numero,"</td>";
        echo "</tr>";

    }
    ?>
    </table>
</body>
</html>