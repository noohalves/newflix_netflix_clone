<?php
include("class/conexao.php");
session_start();
if(isset($_SESSION['id_user'])){
    $id = $_SESSION['id_user'];
    
    if (isset($_POST['movietop'])) {
        $movietop = $_POST['movietop'];

        $token = $_COOKIE['session_token'];
        $compe = "SELECT * FROM fav WHERE id_movie = $movietop AND id_token = '$token'";
        $compe2 =  $mysqli->query($compe) or die ($mysqli->error);
        $comparaca = $compe2->fetch_array();

        $filme1 = "SELECT id,img,movie FROM movies WHERE id = $movietop UNION SELECT id,img,movie FROM series WHERE id = $movietop";
        $filme =  $mysqli->query($filme1) or die ($mysqli->error);
        
        if($comparaca['id_movie'] == ""){
            $sql = "INSERT INTO fav (id_user,id_token,id_movie) VALUES ('$id','$token','$movietop')";
    
            if ($mysqli->query($sql) === TRUE) {  ?>
                <?php $film = $filme->fetch_array(); ?>
    
                <a id="remove2_<?=$film['id']?>" class="button_filmes222" adc="<?=$film['id']?>"> <img class="img_icon" src="../img/icons/verifica.png" alt=""> </a>   
                                   
                <script>
                                 
                    $('#remove2_<?=$film['id']?>').on('click', function(){
                        
                        $.ajax({
                            url: 'removef.php',
                            type: 'POST',
                            dataType: 'html',
                            data: {
                                movietop: $("#remove2_<?=$film['id']?>").attr("adc")
                            },
                            success: function(data) {
                                $('.add2_remove_<?=$film['id']?>').empty().html(data);
                            }               
                        });
                    });
                                            
                </script>
    
            <?php } else {
                echo "Error: " . $sql . "<br>" . $mysqli->error;
            }
    
            $mysqli->close();
        }
    }else if (isset($_POST['movie'])){

        $movie = $_POST['movie'];

        $token = $_COOKIE['session_token'];
        $comp = "SELECT * FROM fav WHERE id_movie = $movie AND id_token = '$token'";
        $comp2 =  $mysqli->query($comp) or die ($mysqli->error);
        $comparacao = $comp2->fetch_array();

        $filmes1 = "SELECT id,img,movie FROM movies WHERE id = $movie UNION SELECT id,img,movie FROM series WHERE id = $movie";
        $filmes =  $mysqli->query($filmes1) or die ($mysqli->error);


        if($comparacao['id_movie'] == ""){
            $sql = "INSERT INTO fav (id_user,id_token,id_movie) VALUES ('$id','$token','$movie')";
    
            if ($mysqli->query($sql) === TRUE) {  ?>
                <?php $filme = $filmes->fetch_array(); ?>
    
                <a id="remove_<?=$filme['id']?>" class="button_filmes222" adc="<?=$filme['id']?>"> <img class="img_icon" src="../img/icons/verifica.png" alt=""> </a>   
                                   
                <script>
                                 
                    $('#remove_<?=$filme['id']?>').on('click', function(){
                        
                        $.ajax({
                            url: 'removef.php',
                            type: 'POST',
                            dataType: 'html',
                            data: {
                                movie: $("#remove_<?=$filme['id']?>").attr("adc")
                            },
                            success: function(data) {
                                $('.add_remove_<?=$filme['id']?>').empty().html(data);
                            }               
                        });
                    });
                                            
                </script>
    
            <?php } else {
                echo "Error: " . $sql . "<br>" . $mysqli->error;
            }
    
            $mysqli->close();
        }
    }else if (isset($_POST['moviedestaque'])){
        $moviedestaque = $_POST['moviedestaque'];

        $token = $_COOKIE['session_token'];
        $compp = "SELECT * FROM fav WHERE id_movie = $moviedestaque AND id_token = '$token'";
        $compp2 =  $mysqli->query($compp) or die ($mysqli->error);
        $compparacao = $compp2->fetch_array();

        $filmess1 = "SELECT id,img,movie FROM movies WHERE id = $moviedestaque UNION SELECT id,img,movie FROM series WHERE id = $moviedestaque";
        $filmess =  $mysqli->query($filmess1) or die ($mysqli->error);
        

        if($compparacao['id_movie'] == ""){
            $sql = "INSERT INTO fav (id_user,id_token,id_movie) VALUES ('$id','$token','$moviedestaque')";
    
            if ($mysqli->query($sql) === TRUE) {  ?>
                <?php $filmee = $filmess->fetch_array(); ?>
                
                <li id="remove_destaque" adc="<?=$filmee['id']?>"><a class = "button-ml"> - Remover da Lista </a></li>
        
                <script>
                                 
                    $('#remove_destaque').on('click', function(){
                        var remove = document.getElementById('remove_destaque');
                        remove.style.display = "none";
                        $.ajax({
                            url: 'removef.php',
                            type: 'POST',
                            dataType: 'html',
                            data: {
                                moviedestaque: $("#remove_destaque").attr("adc")
                            },
                            success: function(data) {
                                $('.add_remove').empty().html(data);
                            }               
                        });
                    });
                                            
                </script>
    
            <?php } else {
                echo "Error: " . $sql . "<br>" . $mysqli->error;
            }
    
            $mysqli->close();
        }
    }else if (isset($_POST['moviepesquisa'])){
        $moviepesquisa = $_POST['moviepesquisa'];

        $token = $_COOKIE['session_token'];
        $comppp = "SELECT * FROM fav WHERE id_movie = $moviepesquisa AND id_token = '$token'";
        $comppp2 =  $mysqli->query($comppp) or die ($mysqli->error);
        $compparacaoo = $comppp2->fetch_array();

        $filmesss1 = "SELECT id FROM movies WHERE id = $moviepesquisa UNION SELECT id FROM series WHERE id = $moviepesquisa";
        $filmesss =  $mysqli->query($filmesss1) or die ($mysqli->error);
        


        if($compparacaoo['id_movie'] == ""){
            $sql = "INSERT INTO fav (id_user,id_token,id_movie) VALUES ('$id','$token','$moviepesquisa')";
    
            if ($mysqli->query($sql) === TRUE) {  ?>
            
                <a id="remove_<?=$filmesss['id']?>" class="button_filmes2" adc="<?=$filmesss['id']?>"> <img class="img_icon" src="../img/icons/verifica.png" alt=""> </a> 

                <script>           
                    $('#remove_<?=$filmesss['id']?>').on('click', function(){
                        var remove = document.getElementById('remove_<?=$filmesss['id']?>');
                        remove.style.display = "none";
                        $.ajax({
                            url: 'removef.php',
                            type: 'POST',
                            dataType: 'html',
                            data: {
                                moviepesquisa: $("#remove_<?=$filmesss['id']?>").attr("adc")
                            },
                            success: function(data) {
                                $('.add_remove_pesquisa_<?=$filmesss['id']?>').empty().html(data);
                            }               
                        });
                    });

                </script>
    
            <?php } else {
                echo "Error: " . $sql . "<br>" . $mysqli->error;
            }
    
            $mysqli->close();
        }
    }else if (isset($_POST['link_img'])){

        $img = $_POST['link_img'];
        $id_img = $_POST['id_img'];

        ?>
            <img class="edit_img" id="edit_img<?=$id_img?>" ac="<?=$id_img?>" src="<?=$img?>"><span id="atual">Atual</span></img>
        <?php
        

    }else if (isset($_POST['nick_name'])){
        $img = $_POST['img'];
        $id_img = $_POST['id'];
        $name = $_POST['nick_name'];

        if($id_img == 1){
            $sql = "UPDATE users SET nameuser1= '$name', user1= '$img' WHERE id = $id";
        }else if ($id_img == 2) {
            $sql = "UPDATE users SET nameuser2= '$name', user2= '$img' WHERE id = $id";
        }else if ($id_img == 3) {
            $sql = "UPDATE users SET nameuser3= '$name', user3= '$img' WHERE id = $id";
        }else if ($id_img == 4) {
            $sql = "UPDATE users SET nameuser4= '$name', user4= '$img' WHERE id = $id";
        }

        if ($mysqli->query($sql) === TRUE) {
            header("Refresh: 0");
        }else{
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
    
        $mysqli->close(); 
    }
    
}else {
    header("Location: index.php");
}
?>