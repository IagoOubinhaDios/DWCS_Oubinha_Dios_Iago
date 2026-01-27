<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validación</title>
</head>

<body>
    <form action="" method="post">
        <label for="nombre">Nombre</label>
        <input name="nombre"><br>
        <label for="numero">Número decimal </label>
        <input name="numero"><br>
        <label for="email">Correo</label>
        <input name="email"><br>
        <button type="submit">Enviar</button>
    </form>

    <?php
        $nombre = $_POST['nombre'] ?? '';
        $numero = $_POST['numero'] ?? '';
        $email = $_POST['email'] ?? '';

        if($nombre !=''){
            $nombre = filter_var($nombre, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            echo $nombre;
        }

        if($email !=''){
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                echo $email;
            }else{
                echo "El correo es incorrecto.";
            }
            
        }
        $opciones = [
            'options'=>['decimal'=>',']
        ];
        if($numero!=''){
            if(filter_var($numero, FILTER_VALIDATE_FLOAT,$opciones)){
                echo "Número $numero correcto.";
            }else{
                echo "Número incorrecto.";
            }
        }
    ?>
</body>

</html>