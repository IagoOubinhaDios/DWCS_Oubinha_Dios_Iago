<?php
include_once "usuarios_db.php";
//Recuperar parametros
$nombre = $_POST['nombre'] ?? '';
$ap1 = $_POST['ape1'] ?? '';
$ap2 = $_POST['ape2'] ?? '';
$nic = $_POST['nic'] ?? '';
$mail = $_POST['mail'] ?? '';
$pass = $_POST['pass'] ?? '';
$pass2 = $_POST['pass2'] ?? '';
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $errores = [];

    if ($nombre === '') {
        $errores[] = "El nombre es obligatorio";
    }

    if ($ap1 === '') {
        $errores[] = "El primer apellido es obligatorio";
    }

    if ($nic === '') {
        $errores[] = "El nic es obligatorio";
    }

    if (empty($mail)) {
        $errores[] = "El correo es obligatorio";
    }

    if ($pass === '') {
        $errores[] = "Tienes que poner una contraseña";
    }

    //Comprobar contraseñas iguales.

    if (empty($pass2) || empty($pass) || $pass !== $pass2) {
        $errores[] = "Las contraseñas no coinciden";
    }
    if (count($errores) == 0) {
        //Comprobar que el nic no existe.
        if(getUsuario($nic)){
            $errores[] = "El nic $nic ya está registrado. Utiliza otro.";
        }else{
            //Registrar en la base de datos.
            addUser($nic, $nombre,$ap1, $ap2, $mail, $pass);
        }
        
    }
}


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>

<body>
    <form action="" method="POST">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" value="<?php echo $nombre; ?>"><br>

        <label for="ape1">Apellido 1</label>
        <input type="text" name="ape1" value="<?= $ap1 ?>"><br>

        <label for="ape2">Apellido 2</label>
        <input type="text" name="ape2" value="<?= $ap2 ?>"><br>

        <label for="nic">Nic</label>
        <input type="text" name="nic" value="<?= $nic ?>"><br>

        <label for="mail">Correo</label>
        <input type="text" name="mail" value="<?= $mail ?>"><br>

        <label for="pass">Contraseña</label>
        <input type="password" name="pass"><br>

        <label for="pass2">Repita contraseña</label>
        <input type="password" name="pass2"><br>

        <button type="submit">Registrar</button>
    </form>
    <div class="resultado">
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (count($errores) > 0) {
                echo "Errores encontrados:<ul>";
                foreach ($errores as $er) {
                    echo "<li>$er</li>";
                }
                echo "</ul>";
            } else {
                echo "<h1>Usuario $nic registrado!</h1>";
            }
        }

        ?>
    </div>
    <a href="login.php">Login</a>
</body>

</html>