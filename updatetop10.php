<?php
include("class/conexao.php");
require_once 'class/movies.php';
?>

<script src="js/jquery-1.9.1.min.js"></script>

<?php

if(isset($_POST['top10'])){
    $top10 = $_POST['top10'];
    $id = $_POST['id'];
    $sql = "UPDATE movies SET top10 = $top10 WHERE id = $id";

    $consulta = "SELECT * FROM movies WHERE id = $id";
    $con =  $mysqli->query($consulta) or die ($mysqli->error);
    $dado = $con->fetch_array();

    $consulta2 = "SELECT * FROM movies WHERE id != $id ORDER BY RAND() LIMIT 1";
    $con2 =  $mysqli->query($consulta2) or die ($mysqli->error);
    $dado2 = $con2->fetch_array();

    $com2222 = "SELECT * FROM gostei WHERE id_user = $id";
    $com222 =  $mysqli->query($com2222) or die ($mysqli->error);

    $xd22 = "SELECT * FROM gostei WHERE id_user = $id";
    $xd11 =  $mysqli->query($xd22) or die ($mysqli->error);

    $movie122 = "SELECT id FROM movies";
    $movie222 =  $mysqli->query($movie122) or die ($mysqli->error);

    $cont_fav = [];  $cont_filmes = []; $cont_gosteii = []; $cont_filmesss = []; $cont_gostei22 = []; $cont_id_gostei1 = [];

    //COMPARAÇÃO DE FILMES COM LIKE
    while($comparaca22 = $com222->fetch_array()){
                    
        $cont_gosteii[]= $comparaca22['id_movie'];
            
    }
    while($movie33 = $movie222->fetch_array()){ 
            
        $cont_filmesss[]= $movie33['id'];

    }
    $cont_int1 = 0;
    while ($xd2 = $xd11->fetch_array()) {
        $cont_id_gostei1[] = $xd2['id_movie'];
        $cont_gostei22[] = $xd2['gostei'];
        $cont_int1++;
    }
    $arraycompp22 = array_diff($cont_filmesss, $cont_gosteii);

    if ($mysqli->query($sql) === TRUE) { ?>
    
        
        <style>
            #content_next {
                display:block;
            }
            #content {
                position: relative;
                width: 350px;
                height: 350px;
                margin-top:50px;
                left:5%;
            }
            #panel {
                display:none;
            }
            #panelVolume {
                display:none;
            }
          
        </style>
        <div id="border_video">
        </div>
        <div class="video_tumbnail">
            <h4><?=$dado['title']?></h4>
            <?php 
            
            $objeto = new Movies();
            $objeto->Curtidas($cont_int1,$dado['id'],$cont_id_gostei1,$cont_gostei22,$arraycompp22);  
            
            ?>
        </div>
        <div class="video_restante">
            <h2> <?=$dado2['title']?> </h2>
            <h4> <?php echo mb_strimwidth( $dado2['description'] , 0, 200, '...' );?> </h4>
            <a id="assistir_outro" href="videoplayer.php?movie=<?=$dado2['id']; ?>"> ➤ ASSISTIR </a>
        </div>

        <img class="img_background" src="<?=$dado2['img']?>" alt="">

        <script>
            var border_video = document.getElementById("border_video");
            var content_next = document.getElementById("content_next");
            var content = document.getElementById("content");
            var panel = document.getElementById("panel");
            var panelVolume = document.getElementById("panelVolume");

            border_video.addEventListener('click',function(){
                content_next.style.display = "none";
                content.style.width = "100%";
                content.style.height = "100%";
                content.style.marginTop = "0";
                content.style.left = "0";
                panel.style.display = "block";
                panelVolume.style.display = "block";
            });
        </script>

    <?php } else {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    $mysqli->close();

}else if(isset($_POST['videofim'])){

    $top10_s = $_POST['videofim'];
    $id_s = $_POST['id_s'];

    $sql = "UPDATE series SET top10 = $top10_s WHERE id = $id_s";

    $consulta = "SELECT * FROM series WHERE id = $id";
    $con =  $mysqli->query($consulta) or die ($mysqli->error);
    $dado = $con->fetch_array();

    $consulta2 = "SELECT * FROM series ORDER BY RAND() LIMIT 1";
    $con2 =  $mysqli->query($consulta2) or die ($mysqli->error);
    $dado2 = $con2->fetch_array();

    $com2222 = "SELECT * FROM gostei WHERE id_user = $id";
    $com222 =  $mysqli->query($com2222) or die ($mysqli->error);

    $xd22 = "SELECT * FROM gostei WHERE id_user = $id";
    $xd11 =  $mysqli->query($xd22) or die ($mysqli->error);

    $movie122 = "SELECT id FROM series";
    $movie222 =  $mysqli->query($movie122) or die ($mysqli->error);

    $cont_fav = [];  $cont_filmes = []; $cont_gosteii = []; $cont_filmesss = []; $cont_gostei22 = []; $cont_id_gostei1 = [];

    //COMPARAÇÃO DE FILMES COM LIKE
    while($comparaca22 = $com222->fetch_array()){
                    
        $cont_gosteii[]= $comparaca22['id_movie'];
            
    }
    while($movie33 = $movie222->fetch_array()){ 
            
        $cont_filmesss[]= $movie33['id'];

    }
    $cont_int1 = 0;
    while ($xd2 = $xd11->fetch_array()) {
        $cont_id_gostei1[] = $xd2['id_movie'];
        $cont_gostei22[] = $xd2['gostei'];
        $cont_int1++;
    }
    $arraycompp22 = array_diff($cont_filmesss, $cont_gosteii);

    if ($mysqli->query($sql) === TRUE) { ?>

        <style>
            #content_next {
                display:block;
            }
            #content {
                position: relative;
                width: 350px;
                height: 350px;
                margin-top:50px;
                left:5%;
            }
            #panel {
                display:none;
            }
            #panelVolume {
                display:none;
            }
          
        </style>
        <div id="border_video">
        </div>
        <div class="video_tumbnail">
            <h4><?=$dado['title']?></h4>
            <?php 
            
            $objeto = new Movies();
            $objeto->Curtidas($cont_int1,$dado['id'],$cont_id_gostei1,$cont_gostei22,$arraycompp22);  
            
            ?>
        </div>
        <div class="video_restante">
            <h2> <?=$dado2['title']?> </h2>
            <h4> <?php echo mb_strimwidth( $dado2['description'] , 0, 200, '...' );?> </h4>
            <a id="assistir_outro" href="videoplayerserie.php?movie=<?=$dado2['id']; ?>"> ➤ ASSISTIR </a>
        </div>

        <img class="img_background" src="<?=$dado2['img']?>" alt="">

        <script>
            var border_video = document.getElementById("border_video");
            var content_next = document.getElementById("content_next");
            var content = document.getElementById("content");
            var panel = document.getElementById("panel");
            var panelVolume = document.getElementById("panelVolume");

            border_video.addEventListener('click',function(){
                console.log("Entrei Aqui");
                content_next.style.display = "none";
                content.style.width = "100%";
                content.style.height = "100%";
                content.style.marginTop = "0";
                content.style.left = "0";
                panel.style.display = "block";
                panelVolume.style.display = "block";
            });
        </script>

    <?php } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }   
}else {
    header("Location: index.php");
}


?>
