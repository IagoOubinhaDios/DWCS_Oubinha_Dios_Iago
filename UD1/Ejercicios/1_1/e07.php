<!DOCTYPE html>
<?php

    function esAnagrama($p1, $p2){
        if(strlen($p1)!=strlen($p2)){
            return false;
        }

        $p1 = strtoupper($p1);
        $p2 = strtoupper($p2);

        if($p1 == $p2){
            return false;
        }

        $arrayP1 = str_split($p1);
        foreach($arrayP1 as $letra){
            if(($i = strpos($p2, $letra))===false){
                return false;
            }else{
                $p2 = substr_replace($p2, '',$i, 1 );
            }
        }

        return true;

    }
?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1.1.7</title>
</head>
<body>
    <form action="" method="POST">
        <label for="palabra1">Palabra 1</label>
        <input name="palabra1" value="<?php echo $_POST['palabra1']; ?>"><br>
        <label for="palabra2">Palabra 2</label>
        <input name="palabra2" value="<?php echo $_POST['palabra2']; ?>"><br>
        <button type="submit">¿Anagrama?</button>
        <?php
            if(isset($_POST['palabra1']) && isset($_POST['palabra2'])){
                echo "<h1>",esAnagrama($_POST['palabra1'], $_POST['palabra2'])?"Son ANAGRAMAS":"No son ANAGRAMAS","</h1>";
            }
        ?>
    </form>
</body>
</html>