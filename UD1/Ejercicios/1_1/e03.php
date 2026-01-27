<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1.1.3</title>
</head>

<body>

    <h1>Ejercicio 3</h1>
    <?php
    //Sumatorio de 5 numeros
    function sumatorio5($n1, $n2, $n3, $n4, $n5)
    {
        echo "sumatorio($n1, $n2, $n3, $n4, $n5) = ", $n1 + $n2 + $n3 + $n4 + $n5;
    }
    //Sumatorio generico
    function sumatorio($nums)
    {
        $sum = 0;
        $numeros = implode("+", $nums);
        foreach ($nums as $n) {
            $sum += $n;
        }
        echo "sumatorio($numeros) = ", $sum;
    }
    //Utilizando explode/implode para transformar string<->array
    $numeros = "3,4,5,7,89,2";
    $numeros = explode(",", $numeros);
    sumatorio($numeros);
    ?>
</body>

</html>