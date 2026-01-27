<?php
require_once "model.php";
define("COOKIE_RAND", "rand");
define("COOKIE_INTENT", "intent");
define("MAX_INTENTS", 10);
define("COOKIE_PLAYER", "player");
define("COOKIE_INIT", "init");

function iniciarJuego()
{
    $num = rand(1, 1000);
    setcookie(COOKIE_INTENT, '1', time() + 600);
    setcookie(COOKIE_RAND, $num, time() + 3600);
    setcookie(COOKIE_INIT, time(), time() + 3600);
}

function jugando(): bool
{
    return isset($_COOKIE[COOKIE_RAND]) && isset($_COOKIE[COOKIE_INTENT]);
}

function finalizarJuego()
{
    setcookie(COOKIE_INTENT, '', time() - 600);
    setcookie(COOKIE_RAND, "", time() - 600);
    setcookie(COOKIE_PLAYER, "", time() - 600);
}

function getIntentos()
{
    if (jugando()) {
        return intval($_COOKIE[COOKIE_INTENT]);
    }
    return false;
}

function getSegundosIniciales()
{
    if (jugando()) {
        return intval($_COOKIE[COOKIE_INIT]);
    }
    return false;
}

function getJugadorActual()
{
    $jugador = false;

    $jugador = new Jugador();
    $jugador->id = intval($_COOKIE[COOKIE_PLAYER]);
    $jugador = getJugador($jugador);
    return $jugador;
}

function getNumAleatorio()
{
    if (jugando()) {
        return intval($_COOKIE[COOKIE_RAND]);
    }
    return false;
}

function setIntentos($numIntentos)
{
    setcookie(COOKIE_INTENT, $numIntentos, time() + 600);
}

/**
 * Devuelve 0 si el número coincide con el aleatorio, un número positivo si es superior al aleatorio o un negativo si es inferior.
 * @param int $num
 * @return int
 */
function comprobarNumero(int $num)
{
    if ($num != getNumAleatorio()) {
        setIntentos(getIntentos() + 1);
    }

    return $num - getNumAleatorio();

}

function registrarJugador(string $nombre)
{
    $jugador = new Jugador();
    $jugador->nombre = $nombre;
    addJugador($jugador);
    $jugador = getJugador($jugador);
    if ($jugador) {
        setcookie(COOKIE_PLAYER, $jugador->id, time() + 600);
        return true;
    }
    return false;

}

function registrarPartida()
{
    $segundos = time() - getSegundosIniciales();
    $partida = new Partida(getNumAleatorio(), getIntentos(), $segundos, getJugadorActual());
    return addPartida($partida);

}