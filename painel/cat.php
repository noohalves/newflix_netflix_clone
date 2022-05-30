<?php
include("../class/conexao.php");
session_start();
if(isset($_SESSION['id_user'])){

    if(isset($_POST['removeC'])){
        include('class/painelFunctions.php');
        $id = $_POST['removeC'];
        
        $cate1 = "SELECT * FROM categoria WHERE id_categoria = $id";
        $cate2 =  $mysqli->query($cate1) or die ($mysqli->error); 
        $cate = $cate2->fetch_array();
      
        $sql = "DELETE FROM categoria WHERE id_categoria = $id";

        if ($mysqli->query($sql) === TRUE) { 
            $functionClass = new PainelFunctions();
            $functionClass->AddC();    
        }else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
        $mysqli->close();

    }
    if(isset($_POST['addC'])){
        include('class/painelFunctions.php');
        $id = $_POST['addC'];

        $cate1 = "SELECT * FROM categoria";
        $cate2 =  $mysqli->query($cate1) or die ($mysqli->error); 
        while($cate = $cate2->fetch_array()){
            $id_c = $cate["id_categoria"];
        }
        $id_somado = $id_c +1;
        
        $sql = "INSERT INTO categoria (id_categoria,categoria) VALUES ('$id_somado','$id')";

        if ($mysqli->query($sql) === TRUE) { 
        
            $functionClass = new PainelFunctions();
            $functionClass->AddC();
        
        }else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
        $mysqli->close();

    }
    if(isset($_POST['title'])){
        include_once '../class/users.php';
        include('class/painelFunctions.php');
        $u = new Users;
        $u->conectar($bd,$hostname,$user,$passwordBD);
        global $pdo; 
        
        $cate1 = "SELECT * FROM movies";
        $cate2 =  $mysqli->query($cate1) or die ($mysqli->error); 
        date_default_timezone_set('America/Sao_Paulo');
        while($cate = $cate2->fetch_array()){
            $id = $cate["id"];
        }
        $id_somado = $id +2;

        /* Pegar valores dos input */
        $title = $_POST['title'];
        $description = $_POST['description'];
        $idade = $_POST['idade']; 
        $destaque = $_POST['destaque'];
        $categoria = $_POST['categoria'];

        /* Obter o nome do arquivo feito upload*/
        $filenameCapa = $_FILES['capa']['name'];
        $filenameFundo = $_FILES['fundo']['name'];
        
        $uniqName = "NEWFLIX_".rand(0,999999);

        /* Atribuindo nomes diferentes */
        $capa = "img/capa/".$uniqName.$filenameCapa;
        $fundo = "img/fundo/".$uniqName.$filenameFundo;

        /* Escolha onde salvar o arquivo carregado */
        $locationCapa = "../".$capa;
        $locationFundo = "../".$fundo;

        /* Salve o arquivo carregado no sistema de arquivos local */
        move_uploaded_file($_FILES['capa']['tmp_name'], $locationCapa);
        move_uploaded_file($_FILES['fundo']['tmp_name'], $locationFundo);

        $dataHoje = date("Y-m-d H:i:s");
        
        /* Filme Comparar se é link ou update */
        if(isset($_POST['filmelink'])) {
            $filme = $_POST['filmelink']; 
        } else {
            $locationFilme = $_FILES['filme']['name'];
            $filme = "filmes/".$uniqName.$locationFilme;
            $locationFilme = "../".$filme;
            move_uploaded_file($_FILES['filme']['tmp_name'], $locationFilme);
        }
        
        /* Trailer, Comparar se esta vazio ou nao*/
        if($_FILES['trailer']['name'] == ""){
            $trailer = "";
        }else {
            $filenameTrailer = $_FILES['trailer']['name'];
            $trailer = "trailers/".$uniqName.$filenameTrailer;
            $locationTrailer = "../".$trailer;
            move_uploaded_file($_FILES['trailer']['tmp_name'], $locationTrailer);
        }
        
        /* Inserir no banco de dados */ 
        /*$sql = "INSERT INTO movies (id,title,description,img,imgcapa,link_trailer,link720,idade,destaque,id_category,data_env) 
        VALUES ('$id_somado','$title','$description','$fundo','$capa','$trailer','$filme','$idade','$destaque','$categoria','$dataHoje')";*/
        $data = array($id_somado,$title,$description,$fundo,$capa,$trailer,$filme,$idade,$destaque,$categoria,$dataHoje);
        $sql = "INSERT INTO movies (id,title,description,img,imgcapa,link_trailer,link720,idade,destaque,id_category,data_env) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        $stmt= $pdo->prepare($sql);
        $stmt->execute($data);

        //if ($mysqli->query($sql) === TRUE) {  
        ?>
            <script src="../js/onefunction.js" defer></script> <span id="alert" style="color:green;margin-left:auto;margin-right:auto;position:fixed;margin-top:15%;text-align:center;">ADICIONADO COM SUCESSO</span>
            <?php
            $functionClass = new PainelFunctions();
            $functionClass->AddF();
        
        /*}else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
        $mysqli->close();   */
    }
    if(isset($_POST['removeF'])){
        include_once '../class/users.php';
        include('class/painelFunctions.php');
        $u = new Users;
        $u->conectar($bd,$hostname,$user,$passwordBD);
        $id = $_POST['removeF'];
        global $pdo; 
        
        $sql = "DELETE FROM movies WHERE id= ?";
        $stmt= $pdo->prepare($sql);
        $stmt->execute([$id]);

        $movie2 = $pdo->prepare("SELECT * FROM movies");
        $movie2->execute();

        $categoria = $pdo->prepare("SELECT * FROM categoria");
        $categoria->execute();
        
        ?>
        <script src="../js/onefunction.js" defer></script> <span id="alert" style="color:green;margin-left:auto;margin-right:auto;position:fixed;margin-top:15%;text-align:center;">DELETADO COM SUCESSO</span>
        <?php
        $functionClass = new PainelFunctions();
        $functionClass->AddF();

    }
    if(isset($_POST['titleSerie'])){
        include_once '../class/users.php';
        include('class/painelFunctions.php');
        $u = new Users;
        $u->conectar($bd,$hostname,$user,$passwordBD);
        global $pdo; 
        
        $series = $pdo->prepare("SELECT * FROM series");
        $series->execute();
        date_default_timezone_set('America/Sao_Paulo');
        while($cate = $series->fetch()){
            $id = $cate["id"];
        }
        $id_somado = $id +2;

        /* Pegar valores dos input */
        $title = $_POST['titleSerie'];
        $description = $_POST['descriptionSerie'];
        $idade = $_POST['idadeSerie']; 
        $destaque = $_POST['destaqueSerie'];
        $categoria = $_POST['categoriaSerie'];

        /* Obter o nome do arquivo feito upload*/
        $filenameCapa = $_FILES['capaSerie']['name'];
        $filenameFundo = $_FILES['fundoSerie']['name'];
        
        $uniqName = "NEWFLIX_".rand(0,999999);

        /* Atribuindo nomes diferentes */
        $capa = "img/capa/".$uniqName.$filenameCapa;
        $fundo = "img/fundo/".$uniqName.$filenameFundo;

        /* Escolha onde salvar o arquivo carregado */
        $locationCapa = "../".$capa;
        $locationFundo = "../".$fundo;

        /* Salve o arquivo carregado no sistema de arquivos local */
        move_uploaded_file($_FILES['capaSerie']['tmp_name'], $locationCapa);
        move_uploaded_file($_FILES['fundoSerie']['tmp_name'], $locationFundo);

        $dataHoje = date("Y-m-d H:i:s");
        
        /* Trailer, Comparar se esta vazio ou nao*/
        if($_FILES['trailerSerie']['name'] == ""){
            $trailer = "";
        }else {
            $filenameTrailer = $_FILES['trailerSerie']['name'];
            $trailer = "trailers/".$uniqName.$filenameTrailer;
            $locationTrailer = "../".$trailer;
            move_uploaded_file($_FILES['trailerSerie']['tmp_name'], $locationTrailer);
        }
        
        /* Inserir no banco de dados */ 
        $sql = "INSERT INTO series (id,title,description,img,imgcapa,link_trailer,idade,destaque,id_category,data_env) 
        VALUES ('$id_somado','$title','$description','$fundo','$capa','$trailer','$idade','$destaque','$categoria','$dataHoje')";

        if ($mysqli->query($sql) === TRUE) {
            $movie2 = $pdo->prepare("SELECT * FROM series");
            $movie2->execute();

            $categoria = $pdo->prepare("SELECT * FROM categoria");
            $categoria->execute();?>
        <script src="../js/onefunction.js" defer></script> <span id="alert" style="color:green;margin-left:auto;margin-right:auto;position:fixed;margin-top:15%;text-align:center;">ADICIONADO COM SUCESSO</span>

        <?php
        $functionClass = new PainelFunctions();
        $functionClass->AddS();

        }else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
        $mysqli->close();  
    }
    if(isset($_POST['removeS'])){
        include_once '../class/users.php';
        include('class/painelFunctions.php');
        $u = new Users;
        $u->conectar($bd,$hostname,$user,$passwordBD);
        $id = $_POST['removeS'];
        global $pdo; 
        
        $sql = "DELETE FROM series WHERE id= ?";
        $stmt= $pdo->prepare($sql);
        $stmt->execute([$id]);

        $movie2 = $pdo->prepare("SELECT * FROM series");
        $movie2->execute();

        $categoria = $pdo->prepare("SELECT * FROM categoria");
        $categoria->execute();
        
        ?>
        <script src="../js/onefunction.js" defer></script> <span id="alert" style="color:green;margin-left:auto;margin-right:auto;position:fixed;margin-top:15%;text-align:center;">DELETADO COM SUCESSO</span>
        <?php
        $functionClass = new PainelFunctions();
        $functionClass->AddS();

    }
    if(isset($_POST['addEp'])){
        $id = $_POST['addEp'];
        include('class/painelFunctions.php');
        $functionClass = new PainelFunctions();
        $functionClass->AddEP($id); ?>
        <script src="../js/cat.js"></script>
        <?php
    }
    if(isset($_POST['titleEp'])){
        include_once '../class/users.php';
        include('class/painelFunctions.php');
        $u = new Users;
        $u->conectar($bd,$hostname,$user,$passwordBD);
        global $pdo; 

        $title = $_POST['titleEp'];
        $description = $_POST['descriptionEp'];
        if($_POST['linkEp'] != ""){
            $epsodio = $_POST['linkEp'];
        }else {
            $uniqName = "NEWFLIX_".rand(0,999999);
            $filenameEp = $_FILES['EpFile']['name'];
            $epsodio = "series/".$uniqName.$filenameEp;
            $locationEp = "../".$epsodio;
            move_uploaded_file($_FILES['EpFile']['tmp_name'], $locationEp);
        }
        $id = $_POST['id_ep'];
        $temporada = $_POST['tempEp'];
        $ordem = $_POST['ordemEp'];
        
        $sql = "INSERT INTO episodios (title_ep,description_ep,link,id_ep,ordem_ep,id_temp) VALUES ('$title','$description','$epsodio','$id','$ordem','$temporada')";
        $stmt= $pdo->prepare($sql);
        $stmt->execute([$id]); 
        
        $movies = $pdo->prepare("SELECT * FROM series WHERE id = :d");
        $movies->bindValue(':d', $id);
        $movies->execute();
        $filme = $movies->fetch(); 
        
        $Ep = $pdo->prepare("SELECT * FROM episodios WHERE id_ep = :d ORDER BY ordem_ep ASC");
        $Ep->bindValue(':d', $id);
        $Ep->execute();
        ?><script src="../js/onefunction.js" defer></script> <span id="alert" style="color:green;margin-left:auto;margin-right:auto;position:fixed;margin-top:15%;text-align:center;">ENVIADO COM SUCESSO</span><?php
        $functionClass = new PainelFunctions();
        $functionClass->AddEP($id); ?>
        <?php

    }
    if(isset($_POST['removeEp'])){
        include_once '../class/users.php';
        include('class/painelFunctions.php');
        $u = new Users;
        $u->conectar($bd,$hostname,$user,$passwordBD);
        $id = $_POST['removeEp'];
        $id_serie = $_POST['idSerie'];
        global $pdo; 
        
        $sql = "DELETE FROM episodios WHERE id= ?";
        $stmt= $pdo->prepare($sql);
        $stmt->execute([$id]);

        $movie2 = $pdo->prepare("SELECT * FROM series");
        $movie2->execute();

        $categoria = $pdo->prepare("SELECT * FROM categoria");
        $categoria->execute();
        
        ?>
        <script src="../js/onefunction.js" defer></script> <span id="alert" style="color:green;margin-left:auto;margin-right:auto;position:fixed;margin-top:15%;text-align:center;">DELETADO COM SUCESSO</span>
        <?php
        $functionClass = new PainelFunctions();
        $functionClass->AddEP($id_serie); ?>
        <script>document.location.reload(true);</script> 
        <?php

    }

}

?>