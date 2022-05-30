<?php
include("class/conexao.php");
session_start();
if(isset($_SESSION['id_user'])){

    $id = $_SESSION['id_user'];

    if(isset($_POST['movieLikeMedio'])){
        $movieLikeMedio = $_POST['movieLikeMedio'];

        $movie1 = "SELECT id FROM series WHERE id = $movieLikeMedio UNION SELECT id FROM movies WHERE id = $movieLikeMedio";
        $movie =  $mysqli->query($movie1) or die ($mysqli->error);
        $moviee = $movie->fetch_array();

        $token = $_COOKIE['session_token'];
        $compp = "SELECT * FROM gostei WHERE id_movie = $movieLikeMedio AND id_token = '$token'";
        $compp2 =  $mysqli->query($compp) or die ($mysqli->error);
        $compparacao = $compp2->fetch_array();

        if($compparacao['id_movie'] == ""){
            $sql = "INSERT INTO gostei(id_user,id_movie,id_token,gostei) VALUES ('$id','$movieLikeMedio','$token','50')";

            if ($mysqli->query($sql) === TRUE) { ?>
                <div id="like_main_<?=$moviee['id']?>" class="like_main">
                    <div class="gostei"><div class="balao_play_l"><div class="balao_embaixo_l"></div>Retirar Gostei</div><a id="like_medio_pos_<?=$moviee['id']?>" class="like_medio" adl="<?=$moviee['id']?>"><img class="img_icon" src="../img/icons/icon-like_pos.png" alt=""></a></div>
                        
                </div>    
            <?php
            }else {
                echo "Error: " . $sql . "<br>" . $mysqli->error;
            }
        }else if($compparacao['id_movie'] == $movieLikeMedio || $compparacao['gostei'] = "50" || $compparacao['gostei'] = "100" || $compparacao['gostei'] = "0"){
            $sql = "UPDATE gostei SET gostei='50' WHERE id_token = '$token' AND id_movie = $movieLikeMedio";

            if ($mysqli->query($sql) === TRUE) { ?>
                <div id="like_main_<?=$moviee['id']?>" class="like_main">
                    <div class="gostei"><div class="balao_play_l"><div class="balao_embaixo_l"></div>Retirar Gostei</div><a id="like_medio_pos_<?=$moviee['id']?>" class="like_medio" adl="<?=$moviee['id']?>"><img class="img_icon" src="../img/icons/icon-like_pos.png" alt=""></a></div>
                        
                </div>
            <?php
            }else {
                echo "Error: " . $sql . "<br>" . $mysqli->error;
            }
        }
        $mysqli->close();?>
        <script>   
            $('#like_medio_<?=$moviee['id']?>').on('click', function(){
                $.ajax({
                    url: 'addLike.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        movieLikeMedio: $("#like_medio_<?=$moviee['id']?>").attr("adl")
                    },
                    success: function(data) {
                        $('#like_main_<?=$moviee['id']?>').empty().html(data);
                    }               
                });
            }); 
            $('#dislike_<?=$moviee['id']?>').on('click', function(){
                $.ajax({
                    url: 'addLike.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        dislike: $("#dislike_<?=$moviee['id']?>").attr("adl")
                    },
                    success: function(data) {
                        $('#like_main_<?=$moviee['id']?>').empty().html(data);
                    }               
                });
            });  
            $('#like_<?=$moviee['id']?>').on('click', function(){
                $.ajax({
                    url: 'addLike.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        like: $("#like_<?=$moviee['id']?>").attr("adl")
                    },
                    success: function(data) {
                        $('#like_main_<?=$moviee['id']?>').empty().html(data);
                    }               
                });
            });
            $('#like_medio_pos_<?=$moviee['id']?>').on('click', function(){
                $.ajax({
                    url: 'addLike.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        removeLikeMedio: $("#like_medio_pos_<?=$moviee['id']?>").attr("adl")
                    },
                    success: function(data) {
                        $('#like_main_<?=$moviee['id']?>').empty().html(data);
                    }               
                });
            }); 
            $('#dislike_pos_<?=$moviee['id']?>').on('click', function(){
                $.ajax({
                    url: 'addLike.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        removeDislike: $("#dislike_pos_<?=$moviee['id']?>").attr("adl")
                    },
                    success: function(data) {
                        $('#like_main_<?=$moviee['id']?>').empty().html(data);
                    }               
                });
            });  
            $('#like_pos_<?=$moviee['id']?>').on('click', function(){
                $.ajax({
                    url: 'addLike.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        removeLike: $("#like_pos_<?=$moviee['id']?>").attr("adl")
                    },
                    success: function(data) {
                        $('#like_main_<?=$moviee['id']?>').empty().html(data);
                    }               
                });
            });                        
        </script>

    <?php
    }else if(isset($_POST['dislike'])){
        $dislike = $_POST['dislike'];

        $movie1 = "SELECT id FROM series WHERE id = $dislike UNION SELECT id FROM movies WHERE id = $dislike";
        $movie =  $mysqli->query($movie1) or die ($mysqli->error);
        $moviee = $movie->fetch_array();

        $token = $_COOKIE['session_token'];
        $compp = "SELECT * FROM gostei WHERE id_movie = $dislike AND id_token = '$token'";
        $compp2 =  $mysqli->query($compp) or die ($mysqli->error);
        $compparacao = $compp2->fetch_array();

        if($compparacao['id_movie'] == ""){
            $sql = "INSERT INTO gostei(id_user,id_movie,id_token,gostei) VALUES ('$id','$dislike','$token','0')";

            if ($mysqli->query($sql) === TRUE) { ?>
                <div id="like_main_<?=$moviee['id']?>" class="like_main">
                    <div class="odiei"><div class="balao_play_l"><div class="balao_embaixo_l"></div>Retirar Odiei</div><a id="dislike_pos_<?=$moviee['id']?>" class="like_medio" adl="<?=$moviee['id']?>"><img class="img_icon" src="../img/icons/icon-des_pos.png" alt=""></a></div>        
                </div>
  
            <?php
            }else {
                echo "Error: " . $sql . "<br>" . $mysqli->error;
            }
        }else if($compparacao['id_movie'] == $dislike || $compparacao['gostei'] = "50" || $compparacao['gostei'] = "100" || $compparacao['gostei'] = "0"){
            $sql = "UPDATE gostei SET gostei='0' WHERE id_token = '$token' AND id_movie = $dislike";

            if ($mysqli->query($sql) === TRUE) { ?>
                <div id="like_main_<?=$moviee['id']?>" class="like_main">
                    <div class="odiei"><div class="balao_play_l"><div class="balao_embaixo_l"></div>Retirar Odiei</div><a id="dislike_pos_<?=$moviee['id']?>" class="like_medio" adl="<?=$moviee['id']?>"><img class="img_icon" src="../img/icons/icon-des_pos.png" alt=""></a></div>        
                </div>
            <?php
            }else {
                echo "Error: " . $sql . "<br>" . $mysqli->error;
            }
        }
        $mysqli->close();?>
        <script>   
            $('#like_medio_<?=$moviee['id']?>').on('click', function(){
                $.ajax({
                    url: 'addLike.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        movieLikeMedio: $("#like_medio_<?=$moviee['id']?>").attr("adl")
                    },
                    success: function(data) {
                        $('#like_main_<?=$moviee['id']?>').empty().html(data);
                    }               
                });
            }); 
            $('#dislike_<?=$moviee['id']?>').on('click', function(){
                $.ajax({
                    url: 'addLike.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        dislike: $("#dislike_<?=$moviee['id']?>").attr("adl")
                    },
                    success: function(data) {
                        $('#like_main_<?=$moviee['id']?>').empty().html(data);
                    }               
                });
            });  
            $('#like_<?=$moviee['id']?>').on('click', function(){
                $.ajax({
                    url: 'addLike.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        like: $("#like_<?=$moviee['id']?>").attr("adl")
                    },
                    success: function(data) {
                        $('#like_main_<?=$moviee['id']?>').empty().html(data);
                    }               
                });
            });
            $('#like_medio_pos_<?=$moviee['id']?>').on('click', function(){
                $.ajax({
                    url: 'addLike.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        removeLikeMedio: $("#like_medio_pos_<?=$moviee['id']?>").attr("adl")
                    },
                    success: function(data) {
                        $('#like_main_<?=$moviee['id']?>').empty().html(data);
                    }               
                });
            }); 
            $('#dislike_pos_<?=$moviee['id']?>').on('click', function(){
                $.ajax({
                    url: 'addLike.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        removeDislike: $("#dislike_pos_<?=$moviee['id']?>").attr("adl")
                    },
                    success: function(data) {
                        $('#like_main_<?=$moviee['id']?>').empty().html(data);
                    }               
                });
            });  
            $('#like_pos_<?=$moviee['id']?>').on('click', function(){
                $.ajax({
                    url: 'addLike.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        removeLike: $("#like_pos_<?=$moviee['id']?>").attr("adl")
                    },
                    success: function(data) {
                        $('#like_main_<?=$moviee['id']?>').empty().html(data);
                    }               
                });
            });                        
        </script>

    <?php
    }else if(isset($_POST['like'])){
        $like = $_POST['like'];

        $movie1 = "SELECT id FROM series WHERE id = $like UNION SELECT id FROM movies WHERE id = $like";
        $movie =  $mysqli->query($movie1) or die ($mysqli->error);
        $moviee = $movie->fetch_array();

        $token = $_COOKIE['session_token'];
        $compp = "SELECT * FROM gostei WHERE id_movie = $like AND id_token = '$token'";
        $compp2 =  $mysqli->query($compp) or die ($mysqli->error);
        $compparacao = $compp2->fetch_array();

        if($compparacao['id_movie'] == ""){
            $sql = "INSERT INTO gostei(id_user,id_movie,id_token,gostei) VALUES ('$id','$like','$token','100')";

            if ($mysqli->query($sql) === TRUE) { ?>
                <div id="like_main_<?=$moviee['id']?>" class="like_main">
                    <div class="amei"><div class="balao_play_l"><div class="balao_embaixo_l"></div>Retirar Amei</div><a id="like_pos_<?=$moviee['id']?>" class="like_medio" adl="<?=$moviee['id']?>"><img class="img_icon" src="../img/icons/Icon-coracao_pos.png" alt=""></a></div>     
                </div>
            <?php
            }else {
                echo "Error: " . $sql . "<br>" . $mysqli->error;
            }
        }else if($compparacao['id_movie'] == $like || $compparacao['gostei'] = "50" || $compparacao['gostei'] = "100" || $compparacao['gostei'] = "0"){
            $sql = "UPDATE gostei SET gostei='100' WHERE id_token = '$token' AND id_movie = $like";

            if ($mysqli->query($sql) === TRUE) { ?>
                <div id="like_main_<?=$moviee['id']?>" class="like_main">
                    <div class="amei"><div class="balao_play_l"><div class="balao_embaixo_l"></div>Retirar Amei</div><a id="like_pos_<?=$moviee['id']?>" class="like_medio" adl="<?=$moviee['id']?>"><img class="img_icon" src="../img/icons/Icon-coracao_pos.png" alt=""></a></div>     
                </div>
            <?php
            }else {
                echo "Error: " . $sql . "<br>" . $mysqli->error;
            }
        }
        $mysqli->close();?>
        <script>   
            $('#like_medio_<?=$moviee['id']?>').on('click', function(){
                $.ajax({
                    url: 'addLike.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        movieLikeMedio: $("#like_medio_<?=$moviee['id']?>").attr("adl")
                    },
                    success: function(data) {
                        $('#like_main_<?=$moviee['id']?>').empty().html(data);
                    }               
                });
            }); 
            $('#dislike_<?=$moviee['id']?>').on('click', function(){
                $.ajax({
                    url: 'addLike.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        dislike: $("#dislike_<?=$moviee['id']?>").attr("adl")
                    },
                    success: function(data) {
                        $('#like_main_<?=$moviee['id']?>').empty().html(data);
                    }               
                });
            });  
            $('#like_<?=$moviee['id']?>').on('click', function(){
                $.ajax({
                    url: 'addLike.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        like: $("#like_<?=$moviee['id']?>").attr("adl")
                    },
                    success: function(data) {
                        $('#like_main_<?=$moviee['id']?>').empty().html(data);
                    }               
                });
            });
            $('#like_medio_pos_<?=$moviee['id']?>').on('click', function(){
                $.ajax({
                    url: 'addLike.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        removeLikeMedio: $("#like_medio_pos_<?=$moviee['id']?>").attr("adl")
                    },
                    success: function(data) {
                        $('#like_main_<?=$moviee['id']?>').empty().html(data);
                    }               
                });
            }); 
            $('#dislike_pos_<?=$moviee['id']?>').on('click', function(){
                $.ajax({
                    url: 'addLike.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        removeDislike: $("#dislike_pos_<?=$moviee['id']?>").attr("adl")
                    },
                    success: function(data) {
                        $('#like_main_<?=$moviee['id']?>').empty().html(data);
                    }               
                });
            });  
            $('#like_pos_<?=$moviee['id']?>').on('click', function(){
                $.ajax({
                    url: 'addLike.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        removeLike: $("#like_pos_<?=$moviee['id']?>").attr("adl")
                    },
                    success: function(data) {
                        $('#like_main_<?=$moviee['id']?>').empty().html(data);
                    }               
                });
            });                        
        </script>

    <?php
    }else if(isset($_POST['removeLikeMedio'])){
        $removeLikeMedio = $_POST['removeLikeMedio'];

        $movie1 = "SELECT id FROM series WHERE id = $removeLikeMedio UNION SELECT id FROM movies WHERE id = $removeLikeMedio";
        $movie =  $mysqli->query($movie1) or die ($mysqli->error);
        $moviee = $movie->fetch_array();

        $token = $_COOKIE['session_token'];
        $compp = "SELECT * FROM gostei WHERE id_movie = $removeLikeMedio AND id_token = '$token'";
        $compp2 =  $mysqli->query($compp) or die ($mysqli->error);
        $compparacao = $compp2->fetch_array();

        if($compparacao['id_movie'] == $removeLikeMedio){
            $sql = "DELETE FROM gostei WHERE id_token = '$token' AND id_movie = $removeLikeMedio";

            if ($mysqli->query($sql) === TRUE){ ?>
                <div id="like_main_<?=$moviee['id']?>" class="like_main">
                    <div class="gostei"><div class="balao_play_l"><div class="balao_embaixo_l"></div>Gostei</div><a id="like_medio_<?=$moviee['id']?>" class="like_medio" adl="<?=$moviee['id']?>"><img class="img_icon" src="../img/icons/icon-like.png" alt=""></a></div>
                    <div id="like_filho_<?=$moviee['id']?>" class="like_filho">
                        <div class="odiei"><div class="balao_play_l"><div class="balao_embaixo_l"></div>Odiei</div><a id="dislike_<?=$moviee['id']?>" class="dislike" adl="<?=$moviee['id']?>"><img class="img_icon" src="../img/icons/icon-des.png" alt=""></a></div>
                        <div class="amei"><div class="balao_play_l"><div class="balao_embaixo_l"></div>Amei</div><a id="like_<?=$moviee['id']?>" class="like" adl="<?=$moviee['id']?>"><img class="img_icon" src="../img/icons/icon-coracao.png" alt=""></a></div>
                    </div>
                </div>
            <?php
            }else {
                echo "Error: " . $sql . "<br>" . $mysqli->error;
            }

        }
        $mysqli->close();?>
        <script>   
            $('#like_medio_<?=$moviee['id']?>').on('click', function(){
                $.ajax({
                    url: 'addLike.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        movieLikeMedio: $("#like_medio_<?=$moviee['id']?>").attr("adl")
                    },
                    success: function(data) {
                        $('#like_main_<?=$moviee['id']?>').empty().html(data);
                    }               
                });
            }); 
            $('#dislike_<?=$moviee['id']?>').on('click', function(){
                $.ajax({
                    url: 'addLike.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        dislike: $("#dislike_<?=$moviee['id']?>").attr("adl")
                    },
                    success: function(data) {
                        $('#like_main_<?=$moviee['id']?>').empty().html(data);
                    }               
                });
            });  
            $('#like_<?=$moviee['id']?>').on('click', function(){
                $.ajax({
                    url: 'addLike.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        like: $("#like_<?=$moviee['id']?>").attr("adl")
                    },
                    success: function(data) {
                        $('#like_main_<?=$moviee['id']?>').empty().html(data);
                    }               
                });
            });
            $('#like_medio_pos_<?=$moviee['id']?>').on('click', function(){
                $.ajax({
                    url: 'addLike.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        removeLikeMedio: $("#like_medio_pos_<?=$moviee['id']?>").attr("adl")
                    },
                    success: function(data) {
                        $('#like_main_<?=$moviee['id']?>').empty().html(data);
                    }               
                });
            }); 
            $('#dislike_pos_<?=$moviee['id']?>').on('click', function(){
                $.ajax({
                    url: 'addLike.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        removeDislike: $("#dislike_pos_<?=$moviee['id']?>").attr("adl")
                    },
                    success: function(data) {
                        $('#like_main_<?=$moviee['id']?>').empty().html(data);
                    }               
                });
            });  
            $('#like_pos_<?=$moviee['id']?>').on('click', function(){
                $.ajax({
                    url: 'addLike.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        removeLike: $("#like_pos_<?=$moviee['id']?>").attr("adl")
                    },
                    success: function(data) {
                        $('#like_main_<?=$moviee['id']?>').empty().html(data);
                    }               
                });
            });                        
        </script>

    <?php

    }else if(isset($_POST['removeDislike'])){
        $removeDislike = $_POST['removeDislike'];

        $movie1 = "SELECT id FROM series WHERE id = $removeDislike UNION SELECT id FROM movies WHERE id = $removeDislike";
        $movie =  $mysqli->query($movie1) or die ($mysqli->error);
        $moviee = $movie->fetch_array();

        $token = $_COOKIE['session_token'];
        $compp = "SELECT * FROM gostei WHERE id_movie = $removeDislike AND id_token = '$token'";
        $compp2 =  $mysqli->query($compp) or die ($mysqli->error);
        $compparacao = $compp2->fetch_array();

        if($compparacao['id_movie'] == $removeDislike){
            $sql = "DELETE FROM gostei WHERE id_token = '$token' AND id_movie = $removeDislike";

            if ($mysqli->query($sql) === TRUE){ ?>
                <div id="like_main_<?=$moviee['id']?>" class="like_main">
                    <div class="gostei"><div class="balao_play_l"><div class="balao_embaixo_l"></div>Gostei</div><a id="like_medio_<?=$moviee['id']?>" class="like_medio" adl="<?=$moviee['id']?>"><img class="img_icon" src="../img/icons/icon-like.png" alt=""></a></div>
                    <div id="like_filho_<?=$moviee['id']?>" class="like_filho">
                        <div class="odiei"><div class="balao_play_l"><div class="balao_embaixo_l"></div>Odiei</div><a id="dislike_<?=$moviee['id']?>" class="dislike" adl="<?=$moviee['id']?>"><img class="img_icon" src="../img/icons/icon-des.png" alt=""></a></div>
                        <div class="amei"><div class="balao_play_l"><div class="balao_embaixo_l"></div>Amei</div><a id="like_<?=$moviee['id']?>" class="like" adl="<?=$moviee['id']?>"><img class="img_icon" src="../img/icons/icon-coracao.png" alt=""></a></div>
                    </div>
                </div>
            <?php
            }else {
                echo "Error: " . $sql . "<br>" . $mysqli->error;
            }
        }
        $mysqli->close();?>
        <script>   
            $('#like_medio_<?=$moviee['id']?>').on('click', function(){
                $.ajax({
                    url: 'addLike.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        movieLikeMedio: $("#like_medio_<?=$moviee['id']?>").attr("adl")
                    },
                    success: function(data) {
                        $('#like_main_<?=$moviee['id']?>').empty().html(data);
                    }               
                });
            }); 
            $('#dislike_<?=$moviee['id']?>').on('click', function(){
                $.ajax({
                    url: 'addLike.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        dislike: $("#dislike_<?=$moviee['id']?>").attr("adl")
                    },
                    success: function(data) {
                        $('#like_main_<?=$moviee['id']?>').empty().html(data);
                    }               
                });
            });  
            $('#like_<?=$moviee['id']?>').on('click', function(){
                $.ajax({
                    url: 'addLike.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        like: $("#like_<?=$moviee['id']?>").attr("adl")
                    },
                    success: function(data) {
                        $('#like_main_<?=$moviee['id']?>').empty().html(data);
                    }               
                });
            });
            $('#like_medio_pos_<?=$moviee['id']?>').on('click', function(){
                $.ajax({
                    url: 'addLike.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        removeLikeMedio: $("#like_medio_pos_<?=$moviee['id']?>").attr("adl")
                    },
                    success: function(data) {
                        $('#like_main_<?=$moviee['id']?>').empty().html(data);
                    }               
                });
            }); 
            $('#dislike_pos_<?=$moviee['id']?>').on('click', function(){
                $.ajax({
                    url: 'addLike.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        removeDislike: $("#dislike_pos_<?=$moviee['id']?>").attr("adl")
                    },
                    success: function(data) {
                        $('#like_main_<?=$moviee['id']?>').empty().html(data);
                    }               
                });
            });  
            $('#like_pos_<?=$moviee['id']?>').on('click', function(){
                $.ajax({
                    url: 'addLike.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        removeLike: $("#like_pos_<?=$moviee['id']?>").attr("adl")
                    },
                    success: function(data) {
                        $('#like_main_<?=$moviee['id']?>').empty().html(data);
                    }               
                });
            });                        
        </script>

    <?php

    }else if(isset($_POST['removeLike'])){
        $removeLike = $_POST['removeLike'];

        $movie1 = "SELECT id FROM series WHERE id = $removeLike UNION SELECT id FROM movies WHERE id = $removeLike";
        $movie =  $mysqli->query($movie1) or die ($mysqli->error);
        $moviee = $movie->fetch_array();

        $token = $_COOKIE['session_token'];
        $compp = "SELECT * FROM gostei WHERE id_movie = $removeLike AND id_token = '$token'";
        $compp2 =  $mysqli->query($compp) or die ($mysqli->error);
        $compparacao = $compp2->fetch_array();

        if($compparacao['id_movie'] == $removeLike){
            $sql = "DELETE FROM gostei WHERE id_token = '$token' AND id_movie = $removeLike";

            if ($mysqli->query($sql) === TRUE){ ?>
                <div id="like_main_<?=$moviee['id']?>" class="like_main">
                    <div class="gostei"><div class="balao_play_l"><div class="balao_embaixo_l"></div>Gostei</div><a id="like_medio_<?=$moviee['id']?>" class="like_medio" adl="<?=$moviee['id']?>"><img class="img_icon" src="../img/icons/icon-like.png" alt=""></a></div>
                    <div id="like_filho_<?=$moviee['id']?>" class="like_filho">
                        <div class="odiei"><div class="balao_play_l"><div class="balao_embaixo_l"></div>Odiei</div><a id="dislike_<?=$moviee['id']?>" class="dislike" adl="<?=$moviee['id']?>"><img class="img_icon" src="../img/icons/icon-des.png" alt=""></a></div>
                        <div class="amei"><div class="balao_play_l"><div class="balao_embaixo_l"></div>Amei</div><a id="like_<?=$moviee['id']?>" class="like" adl="<?=$moviee['id']?>"><img class="img_icon" src="../img/icons/icon-coracao.png" alt=""></a></div>
                    </div>
                </div>
            <?php
            }else {
                echo "Error: " . $sql . "<br>" . $mysqli->error;
            }
        }
        $mysqli->close(); ?>
        <script>   
            $('#like_medio_<?=$moviee['id']?>').on('click', function(){
                $.ajax({
                    url: 'addLike.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        movieLikeMedio: $("#like_medio_<?=$moviee['id']?>").attr("adl")
                    },
                    success: function(data) {
                        $('#like_main_<?=$moviee['id']?>').empty().html(data);
                    }               
                });
            }); 
            $('#dislike_<?=$moviee['id']?>').on('click', function(){
                $.ajax({
                    url: 'addLike.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        dislike: $("#dislike_<?=$moviee['id']?>").attr("adl")
                    },
                    success: function(data) {
                        $('#like_main_<?=$moviee['id']?>').empty().html(data);
                    }               
                });
            });  
            $('#like_<?=$moviee['id']?>').on('click', function(){
                $.ajax({
                    url: 'addLike.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        like: $("#like_<?=$moviee['id']?>").attr("adl")
                    },
                    success: function(data) {
                        $('#like_main_<?=$moviee['id']?>').empty().html(data);
                    }               
                });
            });
            $('#like_medio_pos_<?=$moviee['id']?>').on('click', function(){
                $.ajax({
                    url: 'addLike.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        removeLikeMedio: $("#like_medio_pos_<?=$moviee['id']?>").attr("adl")
                    },
                    success: function(data) {
                        $('#like_main_<?=$moviee['id']?>').empty().html(data);
                    }               
                });
            }); 
            $('#dislike_pos_<?=$moviee['id']?>').on('click', function(){
                $.ajax({
                    url: 'addLike.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        removeDislike: $("#dislike_pos_<?=$moviee['id']?>").attr("adl")
                    },
                    success: function(data) {
                        $('#like_main_<?=$moviee['id']?>').empty().html(data);
                    }               
                });
            });  
            $('#like_pos_<?=$moviee['id']?>').on('click', function(){
                $.ajax({
                    url: 'addLike.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        removeLike: $("#like_pos_<?=$moviee['id']?>").attr("adl")
                    },
                    success: function(data) {
                        $('#like_main_<?=$moviee['id']?>').empty().html(data);
                    }               
                });
            });                        
        </script>

    <?php
    } 
} ?>

<script>
window.onload=function(){

}
    
</script>


