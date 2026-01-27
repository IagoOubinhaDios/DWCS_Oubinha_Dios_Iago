<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1.1.4</title>
</head>

<body>
    <h1>Ejercicio 4</h1>
    <?php
    function volumenCilindro($radio, $altura)
    {
        $numeroPi = 3.1416;
        return $radio ** 2 * $altura * $numeroPi;
    }
    
    $radio = 3;
    $altura = 6.23;
    echo "Cilindro de r = $radio y h=$altura =", volumenCilindro($radio, $altura);
    ?>

</body>

</html>