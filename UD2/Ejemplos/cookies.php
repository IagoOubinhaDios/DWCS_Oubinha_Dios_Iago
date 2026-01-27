<?php
//Leer
// $_COOKIE['nombre_cookie'];
// No puedo hacer un echo antes de enviar una cookie.
// echo "<h1>Hola</h1>";
if (isset($_COOKIE['mi_cookie'])) {
    echo "Capturada la cookie mi_cookie: ", $_COOKIE['mi_cookie'];
} else {
    setcookie("mi_cookie", "Hola mundo!", time() + 3600, "/", "", true, true);
    echo "Cookie creada<br>";
}

