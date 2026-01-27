CREATE DATABASE ejercicio1;
USE ejercicio1;

CREATE TABLE usuarios(
    nic VARCHAR(30) PRIMARY KEY,
    nombre VARCHAR(60) NOT NULL,
    apellido1 VARCHAR(100) NOT NULL,
    apellido2 VARCHAR(100),
    email VARCHAR(320) NOT NULL UNIQUE,
    contrasena CHAR(60)
);