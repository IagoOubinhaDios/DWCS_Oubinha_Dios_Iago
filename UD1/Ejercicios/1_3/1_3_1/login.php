<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>


</head>

<body>
    <form action="" method="POST">

        <label for="nic">Nic</label>
        <input type="text" name="nic" value="<?= $nic ?>"><br>

        <label for="pass">Contraseña</label>
        <input type="password" name="pass"><br>

        <button type="submit">Login</button>
    </form>

    <?php
    include_once "usuarios_db.php";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $usuario = getUsuario($_POST['nic']);
        if($usuario){
            $loged = password_verify($_POST['pass'],$usuario['contrasena']);
        }

        if (isset($loged) && $loged) {
            echo "Autenticado con éxito" . $loged['nombre'] . " " . $loged['apellido1'];
        } else {
            echo "Error de autenticación";
        }
    }

    ?>
</body>

</html>