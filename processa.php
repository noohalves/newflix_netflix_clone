<?php
session_start();
include('class/conexao.php');
require_once 'class/movies.php';
require_once 'class/users.php';
$id_user = $_SESSION['id_user'];
$campo ="%".$_POST['search-bar']."%";
$u = new Users;
$u->conectar($bd,$hostname,$user,$passwordBD);
global $pdo;

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$sql=$mysqli->prepare("SELECT id,img,movie FROM movies WHERE title LIKE ? UNION SELECT id,img,movie FROM series WHERE title LIKE ?");
$sql->bind_param("ss",$campo,$campo);
$sql->execute();
$sql->bind_result($id,$img,$movie);
$sql->store_result();

$com=$mysqli->prepare("SELECT id FROM movies UNION SELECT id FROM series");
$com->execute();
$com->bind_result($id_movie);
$com->store_result();

$movie=$mysqli->prepare("SELECT id FROM movies UNION SELECT id FROM series");
$movie->execute();
$movie->bind_result($id_movie2);
$movie->store_result();

$fav=$pdo->prepare("SELECT * FROM fav WHERE id_user = :d");
$fav->bindValue(":d",$id_user);
$fav->execute();

$gostei=$pdo->prepare("SELECT * FROM gostei WHERE id_user = :d");
$gostei->bindValue(":d",$id_user);
$gostei->execute();

$gostei2=$pdo->prepare("SELECT * FROM gostei WHERE id_user = :d");
$gostei2->bindValue(":d",$id_user);
$gostei2->execute();

$cont_fav = [];  $cont_filmes = []; $cont_gostei2 = []; $cont_filmess = []; $cont_gostei = []; $cont_id_gostei = [];

//COMPARAÇÃO DE FILMES COM LIKE
while($comparaca22 = $gostei->fetch()){
                    
    $cont_gostei2[]= $comparaca22['id_movie'];
            
}
while($movie->fetch()){ 
            
    $cont_filmess[]= $id_movie2;

}
$cont_int = 0;
while ($xd = $gostei2->fetch()) {
    $cont_id_gostei[] = $xd['id_movie'];
    $cont_gostei[] = $xd['gostei'];
    $cont_int++;
}
$arraycompp2 = array_diff($cont_filmess, $cont_gostei2);

while($comparaca = $fav->fetch()){
                        
    $cont_fav[]= $comparaca['id_movie'];
                
}
while($com->fetch()){ 
                
    $cont_filmes[]= $id_movie;
    
}
            
$arraycomp = array_intersect($cont_filmes, $cont_fav);
$arraycomp2 = array_diff($cont_filmes, $cont_fav);

while($sql->fetch()){?>
        <div class="card newresult"> 
            <img class="imgcapa" src="<?=$img?>" alt="">
                            
            <div class="item_filmes">
                <img class="img_filmes" src="<?=$img?>" alt="">
                <?php if($movie == 'movie'){ ?>
                    <a id="inf_filmes" class="button_filmes" style="margin-top:215px;" href="videoplayer.php?movie=<?=$id?>"> <img style="width: 28px;height: 30px;" class="img_icon" src="../img/icons/icon-play.png" alt=""> </a>
                <?php }else { ?>
                    <a id="inf_filmes" class="button_filmes" style="margin-top:215px;" href="videoplayerserie.php?movie=<?=$id?>"> <img style="width: 28px;height: 30px;" class="img_icon" src="../img/icons/icon-play.png" alt=""> </a>
                <?php } ?>
                 
                <?php 
                    foreach($arraycomp2 as $ma) {
                        if ($id == $ma) {?>
                        <div class="add_remove_pesquisa_<?=$id?>">
                        </div>
                       <a id="add_<?=$id?>" class="button_filmes2" adc="<?=$id?>"> <img class="img_icon" src="../img/icons/icon-+.png" alt=""> </a> 
                       <script>           
                            $('#add_<?=$id?>').on('click', function(){
                                var add = document.getElementById('add_<?=$id?>');
                                add.style.display = "none";
                                $.ajax({
                                    url: 'addf.php',
                                    type: 'POST',
                                    dataType: 'html',
                                    data: {
                                        moviepesquisa: $("#add_<?=$id?>").attr("adc")
                                    },
                                    success: function(data) {
                                        $('.add_remove_pesquisa_<?=$id?>').empty().html(data);
                                    }               
                                });
                            });
                    
                        </script>
                    <?php } } 
                     
                    foreach($arraycomp as $ma) {
                        if ($id == $ma) {?>
                            <div class="add_remove_pesquisa_<?=$id?>">
                            </div>
                            <a id="remove_<?=$id?>" class="button_filmes2" style="margin-top:-50px;" adc="<?=$id?>"> <img class="img_icon" src="../img/icons/icon-+.png" alt=""> </a> 
                           <script>           
                                $('#remove_<?=$id?>').on('click', function(){
                                    var remove = document.getElementById('remove_<?=$id?>');
                                    remove.style.display = "none";
                                    $.ajax({
                                        url: 'removef.php',
                                        type: 'POST',
                                        dataType: 'html',
                                        data: {
                                            moviepesquisa: $("#remove_<?=$id?>").attr("adc")
                                        },
                                        success: function(data) {
                                            $('.add_remove_pesquisa_<?=$id?>').empty().html(data);
                                        }               
                                    });
                                });
                        
                            </script>
                    <?php }} 
                    
                    $objeto = new Movies();
                    $objeto->Curtidas($cont_int,$id,$cont_id_gostei,$cont_gostei,$arraycompp2);
                    
                    ?>
                

            </div> 
        </div> 
<?php }


?>