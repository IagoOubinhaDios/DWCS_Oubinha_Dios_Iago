<?php
//Funcion que recibe un array indexado de enteros y devuelve otro con la forma ["menor"=>x, "mayor=>y, "media"=>z]
function indicadores(array $numeros)
{
    //Ordeno el array de forma ascendente. La función sort no se comporta como la mayoría de funciones de PHP ya que recibe una referencia
    //del array y por lo tanto modifica su contenido.
    sort($numeros, SORT_NUMERIC);
    $resultado = [
        "menor" => $numeros[0], //Solo puedo acceder por índice si estoy seguro que el array es un array indexado. CUIDADO CON ESTO!
        "mayor" => $numeros[count($numeros) - 1]
    ];

    //Ahora calculo la media.
    $media = 0;
    foreach ($numeros as $n) {
        $media += $n;
    }

    $resultado["media"] = $media / count($numeros);

    return $resultado;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1.1.9</title>
</head>

<body>
    <h1>Introduce 5 números</h1>
    <form action="" method="post">
        <!-- Asocio un array a varios inputs -->
        <input type="number" name="nums[]" required>
        <input type="number" name="nums[]" required>
        <input type="number" name="nums[]" required>
        <input type="number" name="nums[]" required>
        <input type="number" name="nums[]" required><br>
        <button type="submit">Calcular</button>
    </form>

    <?php
        //Comprobamos que el array existe y que tiene elementos
        if (isset($_POST["nums"]) && is_array($_POST["nums"]) && count($_POST["nums"])>0) {
            $indicadores = indicadores($_POST["nums"]);
            echo "<ul>";
            echo "<li>Menor:",$indicadores["menor"],"</li>";
            echo "<li>Mayor:",$indicadores["mayor"],"</li>"; 
            echo "<li>Media:",$indicadores["media"],"</li>"; 
            echo "</ul>"; 
        }
    ?>

</body>

</html>