<?php
define("DSN", "mysql:host=mariadb;dbname=numero_secreto");
define("DB_USER", "root");
define("DB_PASS", "bitnami");

class Jugador
{
    public $id;
    public $nombre;
}

class Partida
{
    public $id;
    public $intentos;
    public $numero;
    public $segundos;
    public $jugador;

    public function __construct(int $numero, int $intentos, int $segundos, Jugador $jugador, $id = null)
    {
        $this->id = $id;
        $this->intentos = $intentos;
        $this->numero = $numero;
        $this->segundos = $segundos;
        $this->jugador = $jugador;
    }
}

function getConnection()
{
    try {
        $db = new PDO(DSN, DB_USER, DB_PASS);
    } catch (PDOException $th) {
        die("Error de conexion con la BD: " . $th->getMessage());
    }

    return $db;
}

/**
 * Devuelve todas las partidas
 * @return array
 */
function getPartidas()
{
    $partidas = [];
    $sql = "SELECT p.id, 
            segundos,
            numero,
            intentos,
            jugador_id, j.nombre as jugador_nombre
            FROM partida p INNER JOIN jugador j ON p.jugador_id = j.id";

    try {
        $db = getConnection();
        $stm = $db->query($sql);

        foreach ($stm as $row) {
            $p = new Partida();
            $p->id = $row['id'];
            $p->segundos = $row['segundos'];
            $p->intentos = $row['intentos'];
            $p->numero = $row['numero'];
            $j = new Jugador();
            $j->id = $row['jugador_id'];
            $j->nombre = $row['jugador_nombre'];
            $p->jugador = $j;
            $partidas[] = $p;
        }
    } catch (PDOException $th) {
        error_log($th->getMessage());
    } finally {
        $stm->closeCursor();
        $db = null;
    }


    return $partidas;
}

/**
 * Devuelve las partidas de un jugador
 * @param mixed $jugadorId
 * @return array
 */
function getPartidasJugador(Jugador $jugador)
{
    $partidas = [];
    $sql = "SELECT p.id, 
            segundos,
            numero,
            intentos,
            jugador_id, j.nombre as jugador_nombre
            FROM partida p INNER JOIN jugador j ON p.jugador_id = j.id
            WHERE j.nombre = :nombre_jugador";
    try {
        $db = getConnection();
        $stm = $db->prepare($sql);
        //Preparar la consulta.
        $stm->bindValue('nombre_jugador', $jugador->nombre, PDO::PARAM_STR);
        $stm->execute();
        foreach ($stm as $row) {
            $p = new Partida();
            $p->id = $row['id'];
            $p->segundos = $row['segundos'];
            $p->intentos = $row['intentos'];
            $p->numero = $row['numero'];
            $j = new Jugador();
            $j->id = $row['jugador_id'];
            $j->nombre = $row['jugador_nombre'];
            $p->jugador = $j;
            $partidas[] = $p;
        }
    } catch (PDOException $th) {
        error_log($th->getMessage());
    } finally {
        $stm->closeCursor();
        $db = null;
    }


    return $partidas;
}

function getJugador(Jugador $jugador)
{
    //Si el jugador no tiene parámetros devuelvo falso.
    if(!isset($jugador->id) && !isset($jugador->nombre)){
        return false;
    }

    $resultado = false;
    $sql = "SELECT id, nombre FROM jugador WHERE 1=1 ";
    if (isset($jugador->id)) {
        $sql .= " AND id = :id";
    }

    if (isset($jugador->nombre)) {
        $sql .= " AND nombre = :nombre";
    }
    try {
        $db = getConnection();
        $stm = $db->prepare($sql);
        
        if (isset($jugador->id)) {
            $stm->bindValue("id",$jugador->id,PDO::PARAM_INT);
        }

        if (isset($jugador->nombre)) {
            $stm->bindValue("nombre",$jugador->nombre,PDO::PARAM_STR);
        }
        $stm->execute();
        $row = $stm->fetch();
        if($row){
            $resultado = new Jugador();
            $resultado->id = $row['id'];
            $resultado->nombre = $row['nombre'];
        }
    } catch (PDOException $th) {
        error_log($th->getMessage());
    } finally {
        $stm->closeCursor();
        $db = null;
    }

    return $resultado;
}

/**
 * Agrega, si puede, un jugador.
 * @param Jugador $jugador Jugador a dar de alta
 * @return bool Verdadero si lo inserta falso en caso contrario.
 */
function addJugador(Jugador $jugador): bool
{
    $agregado = false;
    $sql = "INSERT INTO jugador (nombre) VALUES(:nombre)";
    try {
        $db = getConnection();
        $stm = $db->prepare($sql);
        $stm->bindValue('nombre', $jugador->nombre);
        $agregado = $stm->execute();
    } catch (PDOException $th) {
        error_log($th->getMessage());
    } finally {
        $db = null;
    }
    return $agregado;
}

function addPartida(Partida $partida): bool
{
    $agregado = false;
    $sql = "INSERT INTO partida( segundos, numero, intentos, jugador_id) VALUES (:segundos,:numero, :intentos, :jugador_id)";
    try {
        $db = getConnection();
        $stm = $db->prepare($sql);
        $stm->bindValue('segundos', $partida->segundos);
        $stm->bindValue('numero', $partida->numero);
        $stm->bindValue('intentos', $partida->intentos);
        $stm->bindValue('jugador_id', $partida->jugador->id);

        $agregado = $stm->execute();
    } catch (PDOException $th) {
        error_log($th->getMessage());
    } finally {
        $db = null;
    }
    return $agregado;
}