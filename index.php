<?php
session_start();
error_reporting(E_ALL); 
ini_set('display_errors', 'On'); 
require_once 'class/users.php';
include('class/conexao.php');
if(isset($_SESSION['id_user'])){
    header("location: AreaPrivada.php");
    exit;
}

$u = new Users;

if(isset($_POST['login'])){
    $login = addslashes($_POST['login']);
    $password = addslashes($_POST['password']);

    if (!empty($login) && !empty($password)){
        $u->conectar($bd,$hostname,$user,$passwordBD);
        if($u->msgErro == ""){
            if($u->logar($login, md5($password))){
                header("location: home.php");
            }else{
                ?>
                <div class ="msg-erro">
                Login ou senha estão incorretos!
                </div>
                <?php
            }
        }else {
            echo "Erro: ".$u->msgErro;
        }
    }else {
        ?>
            <div class ="msg-erro">
                Preencha todos os campos !
            </div>
        <?php
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NewFlix</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/logo_n.png">
</head>
<body>
    <div id="eu_fundo"></div>
    <a href="index.php" ><img class="imglogo" src="img/logo.png" alt=""></a>
    <form class="form" method="POST">
        <div class="card">
            <div class="card_cont">
                <h2 class="title"> Entrar</h2>
                <input type="text" name="login" id="text_input" placeholder="Seu Login">
                <input type="password" name="password" id="password_input" placeholder="Sua Senha">
                <button class="button" type="submit">Entrar</button>
            </div>
        </div>
    </form>
    <div class="inf_login">
        <table>
            <tr>Usuario Comum</tr>
            <tr>
                <td>Login</td><td>Senha</td>
            </tr>
            <tr>
                <td>teste</td><td>teste</td>
            </tr>
        </table>
        <table>
            <tr>Usuario Admin</tr>
            <tr>
                <td>Login</td><td>Senha</td>
            </tr>
            <tr>
                <td>testeAdmin</td><td>testeadmin</td>
            </tr>
        </table>
    </div>
 

</body>
</html>