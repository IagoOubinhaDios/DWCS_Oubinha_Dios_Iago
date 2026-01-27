<?php
//Definicion de la funcion potencia.
function potencia(int $a, int $b)
{
    return $a ** $b;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1.1.8</title>
    <style>
        body {
            display: grid;
            place-items: center;
        }
        
        div * {
            display: block;
        }

        form {
            display: flex;
        }

        div {
            margin-right: 10px;
        }

        input {
            width: 100px;
        }
    </style>
</head>

<body>
    <h1>Calculadora de potencias</h1>
    <form action="" method="post">
        <div>
            <label for="base">Base</label>
            <input type="number" name="base">
        </div>
        <div>
            <label for="exponente">Exponente</label>
            <input type="number" name="exponente">
        </div>
        <button type="submit">Calcular</button>
    </form>
    <?php
    //Mostramos resultados unicamente si tenemos los valores y son números.
    $base = $_POST["base"];
    $exponente = $_POST["exponente"];
    if (isset($base) && isset($exponente) && is_numeric($base) && is_numeric($exponente)) {
        echo "<h2>";
        echo "$base<sup>$exponente</sup> = ";
        //En PHP no podemos interpolar funciones en strings :(
        echo potencia($base, $exponente);
        echo "</h2>";
    }
    ?>

</body>

</html>