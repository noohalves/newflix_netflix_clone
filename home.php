<?php
include('class/conexao.php');
require_once 'class/users.php';
session_start ();
if(!isset($_SESSION['id_user'])){
    header("location: index.php");
    exit;
}

$id = $_SESSION['id_user'];

$user = "SELECT * FROM users WHERE id = $id";
$user1 =  $mysqli->query($user) or die ($mysqli->error);

$u = new Users;
$u->conectar($bd,$hostname,$user,$passwordBD);

while($user2 = $user1->fetch_array()){
    $usuario1 = $user2["nameuser1"];
    $usuario2 = $user2["nameuser2"];
    $usuario3 = $user2["nameuser3"];
    $usuario4 = $user2["nameuser4"];
    $img1 = $user2["user1"];
    $img2 = $user2["user2"];
    $img3 = $user2["user3"];
    $img4 = $user2["user4"];
    $admin = $user2["admin"];
}

if(isset($_POST["user1"])){
    $u->userLogado(1);
}
if(isset($_POST["user2"])){
    $u->userLogado(2);
}
if(isset($_POST["user3"])){
    $u->userLogado(3);
}
if(isset($_POST["user4"])){
    $u->userLogado(4);
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NewFlix</title>
    <link rel="stylesheet" href="css/gerencia.css">
    <link rel="icon" href="img/logo_n.png">
</head>
<body>
    <a href="index.php" ><img class="imglogo" src="img/logo.png" alt=""></a>
    <div class ="gerencia">
        <?php if($admin == 1){?>
        <div class="Painel_admin">
            <span>Painel Admin</span>
            <span class="btn_panel"><a class="btn_panel_a" href="painel/painel.php"></a></span>
        </div>
        <?php }?>
        <h1>Continuar com :</h1>
        <div class="gerencia-card">
            <div class="card">
                <a class="nameu">
                    <form action="" method="post">
                        <button type="submit" id="user1" name="user1"><img class="imgcard" src="<?=$img1?>" alt=""/></button>
                            <?=$usuario1?>
                    </form>
                </a>
            </div>
            <div class="card">
                <a class="nameu">
                    <form action="" method="post">
                        <button type="submit" id="user1" name="user2"><img class="imgcard" src="<?=$img2?>" alt=""/></button>
                            <?=$usuario2?>
                    </form>
                </a>
            </div>
            <div class="card">
                <a class="nameu">
                    <form action="" method="post">
                        <button type="submit" id="user1" name="user3"><img class="imgcard" src="<?=$img3?>" alt=""/></button>
                            <?=$usuario3?>
                    </form>
                </a>
            </div>
            <div class="card">
                <a class="nameu">
                    <form action="" method="post">
                        <button type="submit" id="user1" name="user4"><img class="imgcard" src="<?=$img4?>" alt=""/></button>
                            <?=$usuario4?>
                    </form>
                </a>
            </div>
        </div>
        <a class="btncard" href="gerenciadorp.php">Gerenciar</a>
    </div>

</body>
</html>