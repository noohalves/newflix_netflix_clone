<?php
require_once '../class/users.php';
include('../class/conexao.php');
include('class/painelFunctions.php');
session_start ();
if(!isset($_SESSION['id_user'])){
    header("location: ../index.php");
    exit;
}else {
    $u = new Users;
    $u->conectar($bd,$hostname,$user,$passwordBD);
    $id = $_SESSION['id_user'];

    $user = $pdo->prepare("SELECT * FROM users WHERE id = :d");
    $user->bindValue(":d",$id);
    $user->execute();
    $usuario = $user->fetch();

    $functionClass = new PainelFunctions();

    $tal = $usuario['admin'];

    if(!$tal == 1){
        header("location: ../index.php");
        exit;   
    }else {
        $usuarioInf = $pdo->prepare("SELECT * FROM users WHERE id = :d");
        $usuarioInf->bindValue(":d",$id);
        $usuarioInf->execute();
        $usuario2 = $usuarioInf->fetch();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel - NewFlix</title>
    <link rel="stylesheet" href="../css/painel.css">
    <link rel="stylesheet" href="../css/calendario.css">
    <link rel="icon" href="../img/logo_n.png">
    <link rel="shortcut icon" href="#">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../js/calendario.js"></script>
    <script src="../js/locale/pt-br.js"></script>
    <script src="../js/painel.js" defer></script>
</head>
<body>

    <div class="user_login">
        <img id="dashboard" class="img_icon" src="../img/icons/dashboard.png">
        <img id="comentario" class="img_icon" src="../img/icons/comentarios.png">
        <img id="email_button" class="img_icon" src="../img/icons/envelope.png">
        <img id="calendario" class="img_icon" src="../img/icons/calendario.png">
        <img class="img_icon_d" src="../<?=$usuario2['user1']?>">
        <span class="n_s"><?=$usuario2['nameuser1']?></span>
        <img id="lupa" class="img_icon_lupa" src="../img/icons/lupa.png">  
        <div id="pesquisar2"><input id="pesquisar"><div class="img_lupa"><img id="lupa2" src="../img/voltar.png"></div> </input></div>
    </div>

    
    <div id="btn_esconder" class="img_e">↪</div>
    <div class="menu_painel">
        <img id="logo" class="img_l" src="../img/logo.png">
        <li class="btn_menu" id="dashboard2"> <img id="sumidao2" class="img_menu" src="../img/icons/dashboard.png"> <div id="sumidao2"> DashBoard </div> </img></li>
        <li class="btn_menu" id="comentario2"> <img id="sumidao2" class="img_menu" src="../img/icons/comentarios.png"> <div id="sumidao2"> Comentarios </div></img></li>
        <li class="btn_menu" id="email_button2"> <img id="sumidao2" class="img_menu" src="../img/icons/envelope.png"> <div id="sumidao2"> Email </div></img></li>
        <li class="btn_menu" id="calendario2"> <img id="sumidao2" class="img_menu" src="../img/icons/calendario.png"> <div id="sumidao2"> Calendario </div></img></li>

        <li class="btn_menu" id="config"> <img class="img_menu" src="../img/icons/config_icon.png"> <div id="sumidao"> Configurações </div> <div id="sumidao2"> Configurações </div></li>
        <li class="btn_menu" id="addf"> <img class="img_menu" src="../img/icons/mais-preto.png"> <div id="sumidao"> ADD Filmes</div> <div id="sumidao2"> ADD Filmes </div></li>
        <li class="btn_menu" id="adds"> <img class="img_menu" src="../img/icons/mais-preto.png"> <div id="sumidao"> ADD Series</div> <div id="sumidao2"> ADD Series </div></li>
        <li class="btn_menu" id="addc"> <img class="img_menu" src="../img/icons/mais-preto.png"> <div id="sumidao"> ADD Categoria</div> <div id="sumidao2"> ADD Categoria </div></li>
    </div>

    <div class="tudo_mobile">
        <div class="melhor_user">
            <?php $functionClass->melhorFilme(); ?>
        </div>
        <div class="j_q">
            <div class="quant_user">
            </div>

            <div class="quant_filme">
            </div>
        </div>

        <div class="acesso_site">
        </div>

        <div class="suport">
        </div>
    </div>

    <div id="calendar" class="c_bla"></div>

    <div id="email" class="email">
        <div class="msg_pessoa">
            <img class="user_msg" src="../img/icons/user.png">
            <h3 class="nick_email">Rogerio</h3>
            <h4 class="email_send">Tenho uma assinatura da NewFlix e optei pelo plano de 2 telas. Contudo somos 5 pessoas em casa e cada vez que alguém tenta acessar e as duas telas o sistema informa que já tem 2 Aparelhos conectados e pergunta se vc deseja sair ou alterar????
                Neste momento qualquer usuario pode digitar para alterar emular o plano, aumentando o valor a pagar.
                A NewFlix, precisa inserir em seu sistema uma forma de autenticação/autorização para mudança do plano, somente pelo titular da conta através de senha. Como ocorre nas operadoras de TV a cabo.
                É inadmissível que qualquer um possa alterar o plano. É uma falha de segurança e contratual.
                Ao contactar o sac, a NewFlix informa que esse controle deve ser feito através de conscientização dos usuários. Mas como fazer isso com adolescentes que querem assistir e não tem paciência para esperar a liberação de ima tela?
                A possibilidade de mudança de pkano, repito, deve ser exclusiva do titular do plano.
                Esse recurso a meu ver é feito de propósito a fim de aumentar faturamento da empresa.
                Precisa ser corrigido....
            </h4>
            <button class="r_button">Responder</button>
            <img class="user_bg" src="../img/branco.jpg">
        </div>

    </div>

    <div id="content"> <?php $functionClass->AddC(); ?></div>
    <div id="contentF"> <?php $functionClass->AddF(); ?></div>
    <div id="contentS"> <?php $functionClass->AddS(); ?></div>
    <div id="contentEP"></div>

    <script src="../js/cat.js"></script>
</body>
</html>