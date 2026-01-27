<?php
require_once "controller.php";
if(!getJugadorActual()){
    header("Location:access.php");
    exit;
}

if(!jugando()){
    iniciarJuego();
}else{
    $num = $_POST['num']??null;
    if(!isset($num)){
        $error = "Falta el número.";
    }else{
        if(!filter_var($num, FILTER_VALIDATE_INT, ['options'=>["max_range"=>1000,"min_range"=>1]])){
            $error = "Tiene que ser un número entre 1 y 1000";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego</title>
</head>
<body>
    <h1>Estoy pensando un número entre 1 y 1000</h1>
    <h2>¿Lo adivinas?</h2>

    <form action="" method="post">
        <label for="num">Número</label><br>
        <input type="number" name="num"><br>
        <?php
        if(isset($error)){
            echo $error, "<br>";
        }
        ?>
        <button type="submit">Comprobar</button>
    </form>
    <div id="resultado">
        <?php
        if(!isset($error)){
            $dif = comprobarNumero($num);
            if(getIntentos()==MAX_INTENTS && $dif){
                echo "Has perdido! El número era: ",getNumAleatorio();
                echo "<br><a href=''>Volver a empezar</a>";
                finalizarJuego();
                exit;
            }

            if($dif == 0){
                echo "Enhorabuena, has acertad, el número era $num y has necesitado ", getIntentos(), " intentos.";
                echo "<br><a href=''>Volver a empezar</a>";
                registrarPartida();
                finalizarJuego();
            }else{
                $msg = $dif > 0? "inferior":"superior";
                echo "El número es $msg que $num.<br> Llevas ",getIntentos(), " intentos";
            }
        }
        ?>

    </div>
</body>
</html>