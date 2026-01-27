<!DOCTYPE html>
<?php
    $num = $_POST['num'];
    if(isset($num) && !empty($num)){
        $resultado = "cero";
        if($num > 0){
            $resultado = "positivo";
        }

        if($num < 0){
            $resultado = "negativo";
        }
    }
?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1.1.6</title>
</head>
<body>
    <form action="" method="POST">
        <label for="num">Número</label>
        <input type="number" name="num" value="<?php echo $num;?>"><br>
        <button type="submit">Comprobar</button>
        <?php
            if(isset($resultado)){
                echo "<h1>El número $num es $resultado</h1>";
            }
        ?>
    </form>
</body>
</html>