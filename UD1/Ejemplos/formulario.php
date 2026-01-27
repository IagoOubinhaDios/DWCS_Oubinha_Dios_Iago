<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manejo de formularios</title>
</head>

<body>
    <h1>Formulario por POST</h1>
    Este formulario envía los datos por POST al mismo script formulario.php.
    Este es el comportamiento por defecto cuando dejamos el parámetro action ="".
    <form action="" method="POST">
        <label for="nombre">Nombre</label>
        <input name="nombre" type="text"><br>
        <label for="edad">Edad</label>
        <input name="edad" type="text"><br>
        <button type="submit">Enviar</button>

        <?php
        //Aqui procesamos las peticiones entrantes.
        /*Comprobamos que en la petición existan los parámetros nombre y edad, ya que cuando
        la petición entre por GET (la primera vez) no existirán dichos parámetros.
        De esta forma solo enseñamos el resultado si existen.
        */
        if (
            isset($_POST["nombre"]) && $_POST["nombre"] == ""
            && isset($_POST["edad"]) && $_POST["edad"] == ""
        ) {
            echo "Hola ", $_POST["nombre"], " de ", $_POST["edad"], " años.";
        }
        ?>
    </form>
</body>

</html>