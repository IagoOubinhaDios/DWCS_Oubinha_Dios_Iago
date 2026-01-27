<?php
//Necesito importar los ficheros donde están las clases que voy a usar.
include_once "miclase.php";
include_once "clasemadre.php";
include_once "clasehija.php";
include_once "cuadrado.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POO</title>
</head>

<body>
    <h1>Probando MiClase</h1>
    <?php
    $miObjeto = new Miclase();
    echo '$miObjeto->getVar1()<br>';
    echo $miObjeto->getVar1();
    echo '<br>$miObjeto->setVar1("Cambio var1 ")<br>';
    $miObjeto->setVar1("Cambio var1 ");
    echo '<br>$miObjeto->print()<br>';
    echo $miObjeto->print();

    echo "<br>Fluent interface<br>";
    $miObjeto->setVar1("Bla bla sin fluen interface");
    $miObjeto->setVar2("Var 2 Sin fluen interface");

    //Fluent interface
    $miObjeto->setVar1("ffff")
        ->setVar2("xxx");
    ?>

    <h1>Herencia</h1>
    <h2>Clase madre (superclase)</h2>
    <?php
    $madre = new ClaseMadre("Lola");
    var_dump($madre);
    ?>
    <h2>Clase hija (subclase)</h2>
    <?php
    $hija = new ClaseHija("Marta", "López");
    var_dump($hija);
    echo '<br>$madre->repetir();<br>';
    echo $madre->repetir();
    echo '<br>$hija->repetir();<br>';
    echo $hija->repetir();
    ?>

    <h1>Clase abstracta</h1>
    <?php
        $miCuadrado = new Cuadrado(5);
        $peri = $miCuadrado->getPerimetro();
        $area = $miCuadrado->getArea();
        echo "El perímetro del cuadrado es $peri<br>";
        echo "El área del cuadrado es $area<br>";
    ?>

    <h1>Método estático</h1>
    <?php
        echo Miclase::saludo();
    ?>
</body>

</html>