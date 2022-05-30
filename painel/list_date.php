<?php
include('../class/conexao.php');
require_once '../class/users.php';

$u = new Users;
$u->conectar($bd,$hostname,$user,$passwordBD);
global $pdo;


$filmes = $pdo->prepare("SELECT id,title,imgcapa,link_trailer,data_env FROM movies UNION SELECT id,title,imgcapa,link_trailer,data_env FROM series");
$filmes->execute();

$events = [];

while ($row = $filmes->fetch()){
    $events[] = [
        'id' => $row['id'],
        'title' => $row['title'],
        'image_url' => '../'.$row['imgcapa'],
        'url' => '../'.$row['link_trailer'],
        'start' => $row['data_env'],
    ];
}

echo json_encode($events);

?>