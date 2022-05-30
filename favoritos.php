<?php
session_start();
include("class/conexao.php");
require_once 'class/movies.php';


if(isset($_SESSION['id_user'])){
    
    $id = $_SESSION['id_user'];
    $token = $_COOKIE['session_token'];

    $comp = "SELECT * FROM fav WHERE id_token = '$token'";
    $comp2 =  $mysqli->query($comp) or die ($mysqli->error);
    $comparacao2 = $comp2->fetch_array();

    $compe = "SELECT * FROM fav WHERE id_token = '$token'";
    $compe2 =  $mysqli->query($compe) or die ($mysqli->error);

    $movies1 = "SELECT id,img,movie FROM movies UNION ALL SELECT id,img,movie FROM series";
    $movies2 =  $mysqli->query($movies1) or die ($mysqli->error);

    $com2222 = "SELECT * FROM gostei WHERE id_user = $id";
    $com222 =  $mysqli->query($com2222) or die ($mysqli->error);

    $xd22 = "SELECT * FROM gostei WHERE id_user = $id";
    $xd11 =  $mysqli->query($xd22) or die ($mysqli->error);

    $movie122 = "SELECT id FROM movies UNION SELECT id FROM series";
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

    if($comparacao2 == ""){
        $variavelcomp = 0;
    }else {
        while($comparacao = $compe2->fetch_array()){

            $cont_fav[]= $comparacao['id_movie'];

        }
        while($movies = $movies2->fetch_array()){ 

            $cont_filmes[]= $movies['id'];

        }
        $arraycomp = array_intersect($cont_filmes, $cont_fav); 
        $variavelcomp = 1; 
    }

        

}else {
    header("Location: index.php");
}?>

<div class= "refresh">
<?php
include 'header.php';

?>

<div class="tudo">
<div class="search">
<div class="test">
<div class="tudao">
    <?php
    if($variavelcomp == "0"){
        echo"<h2 class='a_x_v' style='margin-left:2%;margin-bottom:5%'> Você não tem favorito por enquanto !</h2>";
    }else{
     
    foreach($arraycomp as $ma){
        $movie1 = "SELECT id,img,movie,link_trailer FROM movies WHERE id = $ma UNION ALL SELECT id,img,movie,link_trailer FROM series WHERE id = $ma";
        $movie2 =  $mysqli->query($movie1) or die ($mysqli->error);

        while($movie = $movie2->fetch_array()){ ?>
                
                    <div class="card newresult"> 
                        <img class="imgcapa" src="<?=$movie['img']?>" alt="">                 
                        <div class="item_filmes">
                            <?php if($movie['link_trailer'] == "") {?>
                            <a href="videoplayer.php?movie=<?=$movie['id']?>"><img class="img_filmes" src="<?=$movie['img']?>" alt=""></a>
                            <?php }else {?>
                                <video id="videoPlayerPreview" muted autoplay>
                                    <source src="<?=$movie['link_trailer']?>" type="video/mp4">
                                </video>
                            <?php }?>
                            <?php if($movie == 'movie'){ ?>
                                <a id="inf_filmes" class="button_filmes" href="videoplayer.php?movie=<?=$movie['id']?>"> <img style="width: 28px;height: 30px;" class="img_icon" src="../img/icons/icon-play.png" alt=""> </a>
                            <?php }else { ?>
                                <a id="inf_filmes" class="button_filmes" href="videoplayerserie.php?movie=<?=$movie['id']?>"> <img style="width: 28px;height: 30px;" class="img_icon" src="../img/icons/icon-play.png" alt=""> </a>
                            <?php } ?>
                            <a id="remove_fav_<?=$movie['id']?>" class="button_filmes22" adc="<?=$movie['id']?>"> <img class="img_icon" src="../img/icons/verifica.png" alt=""> </a> 
                                <script>           
                                        $('#remove_fav_<?=$movie['id']?>').on('click', function(){
                                            var remove = document.getElementById('remove_fav_<?=$movie['id']?>');
                                            remove.style.display = "none";
                                            $.ajax({
                                                url: 'removef.php',
                                                type: 'POST',
                                                dataType: 'html',
                                                data: {
                                                    moviefav: $("#remove_fav_<?=$movie['id']?>").attr("adc")
                                                },
                                                success: function(data) {
                                                    $('.refresh').empty().html(data);
                                                }               
                                            });
                                        });
                                
                                </script>
                            <?php

                                $objeto = new Movies();
                                $objeto->Curtidas($cont_int1,$movie['id'],$cont_id_gostei1,$cont_gostei22,$arraycompp22);  

                            ?>
                        </div> 
                    </div><?php
                    
            
        } 
       

    } }?>
</div>
</div>
</div>
<div class="resultado">
</div> 
</div>
    <?php
    
include 'footer.php'; 
    ?>
</div>
