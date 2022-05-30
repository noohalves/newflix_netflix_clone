<?php
include('class/conexao.php');
require_once 'class/users.php';
if(!isset($_SESSION['id_user'])){
    header("location: index.php");
    exit;
}else {
    $id = $_SESSION['id_user'];

    $user = "SELECT * FROM users WHERE id = $id";
    $usuario =  $mysqli->query($user) or die ($mysqli->error);
    $usuario1 = $usuario->fetch_array();

    $u = new Users;
    $u->conectar($bd,$hostname,$user,$passwordBD);

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
}


?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>📺 Início - NewFlix</title>
    <link rel="icon" href="img/logo_n.png">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/areaprivada.css">
    <link rel="stylesheet" href="css/like.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <script src="https://owlcarousel2.github.io/OwlCarousel2/assets/vendors/jquery.min.js"></script>
	<script src="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/owl.carousel.js"></script>


    <div class="top" id="top">
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <div class= "top-esquerda">
            <a href="index.php" ><img class="imglogo" src="img/logo.png" alt=""></a>
            <ul class="ul-e">
                <li class="li-e"><a class="a-e" href="movies.php">Filmes</a></li>
                <li class="li-e"><a class="a-e" href="series.php">Series</a></li>
                <li id="testtt" class="li-e"><a class="a-e" >Tv online</a></li>
                <li class="li-e"><a class="a-e" href="favoritos.php">Meus Favoritos</a></li>
            </ul>
        </div>
        <div class="top-direita" >
            <form id="search_bar_form">
                <img id="search-icon" src="img/search3.png"></img>
                <input type="text" name="search-bar" id="search-bar" placeholder="Filmes/Series"> </input>
            </form>
            <ul class="ul-d-img">
                <?php if($_COOKIE['session_status'] == 1){ ?>
                <li class="li-d"> <img class="imgprofile" src="<?=$usuario1['user1'];?>" alt=""><img id="seta_baixo_feito" src="img/icons/seta_baixo.png" />
                <?php }?>
                <?php if($_COOKIE['session_status'] == 2){ ?>
                <li class="li-d"> <img class="imgprofile" src="<?=$usuario1['user2'];?>" alt=""><img id="seta_baixo_feito" src="img/icons/seta_baixo.png" />
                <?php }?>
                <?php if($_COOKIE['session_status'] == 3){ ?>
                <li class="li-d"> <img class="imgprofile" src="<?=$usuario1['user3'];?>" alt=""><img id="seta_baixo_feito" src="img/icons/seta_baixo.png" />
                <?php }?>
                <?php if($_COOKIE['session_status'] == 4){ ?>
                <li class="li-d"> <img class="imgprofile" src="<?=$usuario1['user4'];?>" alt=""><img id="seta_baixo_feito" src="img/icons/seta_baixo.png" />
                <?php }?>
                    <ul class="li-d-img-pos">
                        <?php if($_COOKIE['session_status'] == 1){ ?>
                            <form id="form_pos" action="" method="post">
                                <button type="submit" id="user" name="user2"><li><img class="imguser" src="<?=$usuario1['user2'];?>" alt=""> <?=$usuario1['nameuser2'] ?></button>
                                <button type="submit" id="user" name="user3"><li><img class="imguser" src="<?=$usuario1['user3'];?>" alt=""> <?=$usuario1['nameuser3'] ?></button>
                                <button type="submit" id="user" name="user4"><li><img class="imguser" src="<?=$usuario1['user4'];?>" alt=""> <?=$usuario1['nameuser4'] ?></button>
                            </form>
                        <?php }?>  
                        <?php if($_COOKIE['session_status'] == 2){ ?>
                            <form id="form_pos" action="" method="post">
                                <button type="submit" id="user" name="user1"><li><img class="imguser" src="<?=$usuario1['user1'];?>" alt=""> <?=$usuario1['nameuser1'] ?></button>
                                <button type="submit" id="user" name="user3"><li><img class="imguser" src="<?=$usuario1['user3'];?>" alt=""> <?=$usuario1['nameuser3'] ?></button>
                                <button type="submit" id="user" name="user4"><li><img class="imguser" src="<?=$usuario1['user4'];?>" alt=""> <?=$usuario1['nameuser4'] ?></button>
                            </form>
                        <?php }?>  
                        <?php if($_COOKIE['session_status'] == 3){ ?>
                            <form id="form_pos" action="" method="post">
                                <button type="submit" id="user" name="user1"><li><img class="imguser" src="<?=$usuario1['user1'];?>" alt=""> <?=$usuario1['nameuser1'] ?></button>
                                <button type="submit" id="user" name="user2"><li><img class="imguser" src="<?=$usuario1['user2'];?>" alt=""> <?=$usuario1['nameuser2'] ?></button>
                                <button type="submit" id="user" name="user4"><li><img class="imguser" src="<?=$usuario1['user4'];?>" alt=""> <?=$usuario1['nameuser4'] ?></button>
                            </form>
                        <?php }?>  
                        <?php if($_COOKIE['session_status'] == 4){ ?>
                            <form id="form_pos" action="" method="post">
                                <button type="submit" id="user" name="user1"><li><img class="imguser" src="<?=$usuario1['user1'];?>" alt=""> <?=$usuario1['nameuser1'] ?></button>
                                <button type="submit" id="user" name="user2"><li><img class="imguser" src="<?=$usuario1['user2'];?>" alt=""> <?=$usuario1['nameuser2'] ?></button>
                                <button type="submit" id="user" name="user3"><li><img class="imguser" src="<?=$usuario1['user3'];?>" alt=""> <?=$usuario1['nameuser3'] ?></button>
                            </form>
                        <?php }?>  

                        <li><a href="gerenciadorp.php" class="user-g"> Gerenciar perfis</a>
                        <li><a href="gerenciadorp.php" class="user-g"> Conta</a>
                        <li><a href="gerenciadorp.php" class="user-c"> Centro de ajuda</a>
                        <img class="bg" src="img/branco.jpg" alt="">
                        <li class="li-d-pos"><a class="a-d" href="sair.php">Sair da NewFlix</a></li>  
                    </ul>
                </li>
            </ul>
        </div>
   </div>

</head>
<body>