<?php
define('DB_DSN', 'mysql:host=mariadb;dbname=ejercicio1');
define('DB_USER', 'root');
define('DB_PASS', 'bitnami');
//Establecer conexion
function conexionBD()
{
    try {
        $db = new PDO(DB_DSN, DB_USER, DB_PASS);
    } catch (PDOException $th) {
        die("Fallo accediendo a la BD" . $th->getMessage());
    }
    return $db;
}

//addUsuario
function addUser($nic, $nombre, $ap1, $ap2, $email, $pass)
{
    $pass = password_hash($pass, PASSWORD_DEFAULT);
    $sql = "INSERT INTO usuarios(nic, nombre, apellido1, apellido2, email, contrasena) 
            VALUES ('$nic', '$nombre', '$ap1', '$ap2', '$email', '$pass')";
    $db = conexionBD();
    $resultado = $db->exec($sql);

    $db = null;

    return $resultado == 1;
}

//getUsuario
function getUsuario($nic)
{
    $sql = "SELECT nic, nombre, apellido1, apellido2, email, contrasena FROM usuarios WHERE nic='$nic'";
    $db = conexionBD();
    $statement = $db->query($sql);
    $usuario = $statement->fetch();
    $statement->closeCursor();
    $db = null;
    return $usuario;
}