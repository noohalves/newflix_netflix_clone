<?php

$hostname = "localhost";
$bd = "newflix";
$user = "root";
$passwordBD = "";

$mysqli = new mysqli($hostname, $user, $passwordBD, $bd);
if($mysqli->connect_errno) {
    echo "Falha ao conectar : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

?>