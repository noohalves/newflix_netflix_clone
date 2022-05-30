<?php
include("class/conexao.php");
session_start();
if(isset($_SESSION['id_user'])){

    
    $id = $_SESSION['id_user'];

    if(isset($_POST['movie'])){
        $movie = $_POST['movie'];

        $token = $_COOKIE['session_token'];
        $comp = "SELECT * FROM fav WHERE id_movie = $movie AND id_token = '$token'";
        $comp2 =  $mysqli->query($comp) or die ($mysqli->error);

        $filmes1 = "SELECT id,img,movie FROM movies WHERE id = $movie UNION SELECT id,img,movie FROM series WHERE id = $movie";
        $filmes =  $mysqli->query($filmes1) or die ($mysqli->error);
        
        
        while($comparacao = $comp2->fetch_array()){
            if($comparacao['id_movie'] == $movie && $comparacao['id_user'] == $id ){
                $sql = "DELETE FROM fav WHERE id_user = $id AND id_movie = $movie AND id_token = '$token'";
                

                if ($mysqli->query($sql) === TRUE) {
                    $filme = $filmes->fetch_array(); ?>

                    <a id="add_<?=$filme['id']?>" class="button_filmes222" adc="<?=$filme['id']?>"> <img class="img_icon" src="../img/icons/icon-+.png" alt=""> </a>   
                                    
                    <script>
                                    
                        $('#add_<?=$filme['id']?>').on('click', function(){
                            
                            $.ajax({
                                url: 'addf.php',
                                type: 'POST',
                                dataType: 'html',
                                data: {
                                    movie: $("#add_<?=$filme['id']?>").attr("adc")
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
        }

    }else if(isset($_POST['movietop'])){
        $movietop = $_POST['movietop'];

        $token = $_COOKIE['session_token'];
        $com = "SELECT * FROM fav WHERE id_movie = $movietop AND id_token = '$token'";
        $com2 =  $mysqli->query($com) or die ($mysqli->error);

        $film1 = "SELECT id,img,movie FROM movies WHERE id = $movietop UNION SELECT id,img,movie FROM series WHERE id = $movietop";
        $film2 =  $mysqli->query($film1) or die ($mysqli->error);
        
        
        while($comparaca = $com2->fetch_array()){
            if($comparaca['id_movie'] == $movietop && $comparaca['id_user'] == $id ){
                $sql = "DELETE FROM fav WHERE id_user = $id AND id_movie = $movietop AND id_token = '$token'";
                

                if ($mysqli->query($sql) === TRUE) {
                    $film = $film2->fetch_array(); ?>

                    <a id="add2_<?=$film['id']?>" class="button_filmes222" adc="<?=$film['id']?>"> <img class="img_icon" src="../img/icons/icon-+.png" alt=""> </a>   
                                    
                    <script>
                                    
                        $('#add2_<?=$film['id']?>').on('click', function(){
                            
                            $.ajax({
                                url: 'addf.php',
                                type: 'POST',
                                dataType: 'html',
                                data: {
                                    movietop: $("#add2_<?=$film['id']?>").attr("adc")
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
        } 

    }else if(isset($_POST['moviedestaque'])){
        $moviedestaque = $_POST['moviedestaque'];

        $token = $_COOKIE['session_token'];
        $compp = "SELECT * FROM fav WHERE id_movie = $moviedestaque AND id_token = '$token'";
        $compp2 =  $mysqli->query($compp) or die ($mysqli->error);
        $compparacao = $compp2->fetch_array();

        $filmess1 = "SELECT id,img,movie FROM movies WHERE id = $moviedestaque UNION SELECT id,img,movie FROM series WHERE id = $moviedestaque";
        $filmess =  $mysqli->query($filmess1) or die ($mysqli->error);


        if($compparacao['id_movie'] == $moviedestaque && $compparacao['id_user'] == $id ){
            $sql = "DELETE FROM fav WHERE id_user = $id AND id_movie = $moviedestaque AND id_token = '$token'";
    
            if ($mysqli->query($sql) === TRUE) {  ?>
                <?php $filmee = $filmess->fetch_array(); ?>
    
                <li id="add_destaque" adc="<?=$filmee['id']?>"><a class = "button-ml"> + Minha Lista </a></li>
                                   
                <script>
                                 
                    $('#add_destaque').on('click', function(){
                        var remove = document.getElementById('add_destaque');
                        remove.style.display = "none";
                        $.ajax({
                            url: 'addf.php',
                            type: 'POST',
                            dataType: 'html',
                            data: {
                                moviedestaque: $("#add_destaque").attr("adc")
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
    }else if(isset($_POST['moviefav'])) {
        $moviefav = $_POST['moviefav'];

        $token = $_COOKIE['session_token'];
        $comppp = "SELECT * FROM fav WHERE id_movie = $moviefav AND id_token = '$token'";
        $comppp2 =  $mysqli->query($comppp) or die ($mysqli->error);
        $comppparacao = $comppp2->fetch_array();

        if($comppparacao['id_movie'] == $moviefav && $comppparacao['id_user'] == $id ){
            $sql = "DELETE FROM fav WHERE id_user = $id AND id_movie = $moviefav AND id_token = '$token'";
    
            if ($mysqli->query($sql) === TRUE) { 
                header('Location: favoritos.php');
            } else {
                echo "Error: " . $sql . "<br>" . $mysqli->error;
            }
    
            $mysqli->close();
        }

    }else if (isset($_POST['moviepesquisa'])){
        $moviepesquisa = $_POST['moviepesquisa'];

        $token = $_COOKIE['session_token'];
        $compppp = "SELECT * FROM fav WHERE id_movie = $moviepesquisa AND id_token = '$token'";
        $compp22 =  $mysqli->query($compppp) or die ($mysqli->error);
        $compparacaoo = $compp22->fetch_array();

        $filmess1 = "SELECT id,img,movie FROM movies WHERE id = $moviepesquisa UNION SELECT id,img,movie FROM series WHERE id = $moviepesquisa";
        $filmess =  $mysqli->query($filmess1) or die ($mysqli->error);


        if($compparacaoo['id_movie'] == $moviepesquisa && $compparacaoo['id_user'] == $id ){
            $sql = "DELETE FROM fav WHERE id_user = $id AND id_movie = $moviepesquisa AND id_token = '$token'";
    
            if ($mysqli->query($sql) === TRUE) {  ?>
                <a id="add_<?=$filmess['id']?>" class="button_filmes2" style="margin-top:-50px;" adc="<?=$filmess['id']?>"> <img class="img_icon" src="../img/icons/icon-+.png" alt=""> </a> 

                <script>           
                    $('#add_<?=$filmess['id']?>').on('click', function(){
                        var add = document.getElementById('add_<?=$filmess['id']?>');
                        add.style.display = "none";
                        $.ajax({
                            url: 'addf.php',
                            type: 'POST',
                            dataType: 'html',
                            data: {
                                moviepesquisa: $("#add_<?=$filmess['id']?>").attr("adc")
                            },
                            success: function(data) {
                                $('.add_remove_pesquisa_<?=$filmess['id']?>').empty().html(data);
                            }               
                        });
                    });

                </script>
    
            <?php } else {
                echo "Error: " . $sql . "<br>" . $mysqli->error;
            }
    
            $mysqli->close();
        }
    }

}else {
    header("Location: index.php");
}


?>