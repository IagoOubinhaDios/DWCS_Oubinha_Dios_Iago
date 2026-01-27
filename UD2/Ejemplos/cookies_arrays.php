<?php

$lista = ["manzanas","peras","mandarinas"];

if(isset($_COOKIE['frutas'])){
    // $lista_recuperada = explode(":",$_COOKIE['frutas']);
    // Con json
    $lista_recuperada = json_decode($_COOKIE['frutas'],true);
    echo "<ul>";
    foreach($lista_recuperada as $fruta){
        echo "<li>$fruta</li>";
    }
    echo "</ul>";
}else{
    //Establecer cookie.
    // Con implode
    // $array_string = implode(":",$lista);
    //Con un json
    $array_json = json_encode($lista);
    setcookie("frutas",$array_json, time()+1000);
    echo "Frutas cargadas.";
}