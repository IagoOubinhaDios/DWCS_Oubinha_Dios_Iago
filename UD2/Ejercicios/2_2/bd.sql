CREATE DATABASE numero_secreto;
USE numero_secreto;

CREATE TABLE jugador(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(20) NOT NULL UNIQUE
);

CREATE TABLE partida(
    id INT AUTO_INCREMENT PRIMARY KEY,
    segundos INT NOT NULL,
    numero DECIMAL(4,0),
    intentos DECIMAL(2,0),
    jugador_id INT NOT NULL,
    CONSTRAINT fk_victoria_jugador FOREIGN KEY(jugador_id) REFERENCES jugador(id)
);

INSERT INTO jugador(nombre) VALUES ('pedro'), ('maria');
INSERT INTO partida(segundos, numero, intentos, jugador_id) VALUES (200,25,10,1), (500,250,8,1), (220,500,5,2), (4000,589,7,2);