<?php
Class MoviesTop10{

    public function top10() { ?>
        <?php 
            global $pdo;
            $id_user = $_SESSION['id_user'];
            $token = $_COOKIE['session_token'];

            $filme = $pdo->prepare("SELECT * FROM movies WHERE data_env >= (NOW() - INTERVAL 1 MONTH) ORDER BY top10 DESC LIMIT 0, 10");
            $filme->execute();

            $fav = $pdo->prepare("SELECT * FROM fav WHERE id_token = :d");
            $fav->bindValue(":d", $token);
            $fav->execute();

            $movies = $pdo->prepare("SELECT id FROM movies WHERE data_env >= (NOW() - INTERVAL 1 MONTH) ORDER BY top10 DESC LIMIT 0, 10");
            $movies->execute();

            $gostei = $pdo->prepare("SELECT * FROM gostei WHERE id_token = :d");
            $gostei->bindValue(":d", $token);
            $gostei->execute();

            $gostei2 = $pdo->prepare("SELECT * FROM gostei WHERE id_token = :d");
            $gostei2->bindValue(":d", $token);
            $gostei2->execute();

            $movies2 = $pdo->prepare("SELECT id,top10 FROM movies WHERE data_env >= (NOW() - INTERVAL 1 MONTH) ORDER BY top10 DESC LIMIT 0, 10");
            $movies2->execute();

            $cont_fav = [];  $cont_filmes = []; $cont_gostei = []; $cont_filmess = []; $cont_gostei2 = []; $cont_id_gostei = [];

            //COMPARAÇÃO DE FILMES COM LIKE
            while($comparaca2 = $gostei->fetch()){
                        
                $cont_gostei[]= $comparaca2['id_movie'];
                
            }
            while($movie3 = $movies2->fetch()){ 
                
                $cont_filmess[]= $movie3['id'];

            }
            $cont_int = 0;
            while ($xd = $gostei2->fetch()) {
                $cont_id_gostei[] = $xd['id_movie'];
                $cont_gostei2[] = $xd['gostei'];
                $cont_int++;
            }
            $arraycompp = array_intersect($cont_filmess, $cont_gostei);
            $arraycompp2 = array_diff($cont_filmess, $cont_gostei);
        
        ?>


        <h3> Top 10 Filmes NewFlix Hoje </h3>
        <div class="overflow">
        <div id="moviesTop" class="owl-carousel owl-theme">
            <?php $i = 1 ; $cont_fav = [];
            while($filmes = $filme->fetch()){ 

                while($comparaca = $fav->fetch()){
                        
                    $cont_fav[]= $comparaca['id_movie'];
                        
                }
                while($movie = $movies->fetch()){ 
                        
                    $cont_filmes[]= $movie['id'];
            
                }
                    
                $arraycomp = array_intersect($cont_filmes, $cont_fav);
                $arraycomp2 = array_diff($cont_filmes, $cont_fav);
                

                
                ?>
            <div class="item">
                <?php if($i < 10){?>
                <h4 class="numeroitem"><?=$i?></h4>
                <?php }else{?>
                <h4 class="numeroitem10"><?=$i?></h4>
                <?php }?>
                <img class="imgtop10" src="<?=$filmes['imgcapa']?>" alt="">
                <div class="item_filmes2">
                <?php if($filmes['link_trailer'] == "") {?> 
                                <a href="videoplayer.php?movie=<?=$filmes['id']?>"><img class="img_filmes" src="<?=$filmes['img']?>" alt=""></a>
                                <?php }else {?>
                                    <a href="videoplayer.php?movie=<?=$filmes['id']?>"><video id="videoPlayerPreview" muted autoplay loop>
                                        <source src="<?=$filmes['link_trailer']?>" type="video/mp4">
                                    </video> </a>  
                                <?php }?>
                    <a id="inf_filmes" class="button_filmes" href="videoplayer.php?movie=<?=$filmes['id'];?>"> <img class="img_icon" src="../img/icons/icon-play.png" alt=""> </a>
                    <?php 
                    foreach($arraycomp2 as $ma) {
                        if ($filmes['id'] == $ma) {?>
                        <div class="add2_remove_<?=$filmes['id']?> button_filmes22">
                        </div>
                       <li id="add2_<?=$filmes['id']?>" class="button_filmes22" adc="<?=$filmes['id']?>"><a class="a-e" ><img class="img_icon" src="../img/icons/icon-+.png" ></a></li>
                       <script>           
                            $('#add2_<?=$filmes['id']?>').on('click', function(){
                                var add = document.getElementById('add2_<?=$filmes['id']?>');
                                add.style.display = "none";
                                $.ajax({
                                    url: 'addf.php',
                                    type: 'POST',
                                    dataType: 'html',
                                    data: {
                                        movietop: $("#add2_<?=$filmes['id']?>").attr("adc")
                                    },
                                    success: function(data) {
                                        $('.add2_remove_<?=$filmes['id']?>').empty().html(data);
                                    }               
                                });
                            });
                    
                        </script>
                    <?php } } 
                     
                    foreach($arraycomp as $ma) {
                    if ($filmes['id'] == $ma) {?>
                    <div class="add2_remove_<?=$filmes['id']?> button_filmes22">
                    </div>
                    <a id="remove2_<?=$filmes['id']?>" class="button_filmes22" adc="<?=$filmes['id']?>"> <img class="img_icon" src="../img/icons/verifica.png" alt=""> </a>   
                        <script>   
                            
                            $('#remove2_<?=$filmes['id']?>').on('click', function(){
                                var remove = document.getElementById('remove2_<?=$filmes['id']?>');  
                                remove.style.display = "none";
                                $.ajax({
                                    url: 'removef.php',
                                    type: 'POST',
                                    dataType: 'html',
                                    data: {
                                        movietop: $("#remove2_<?=$filmes['id']?>").attr("adc")
                                    },
                                    success: function(data) {
                                        $('.add2_remove_<?=$filmes['id']?>').empty().html(data);
                                    }               
                                });
                            });                               
                        </script>
                        
                    <?php }} 

                    
                    $this->CurtidasTop($cont_int,$filmes['id'],$cont_id_gostei,$cont_gostei2,$arraycompp2);

                    ?> 
                    
                </div> 
            </div>

            <?php $i++; }?>
            
        </div>
        </div>
    <?php }

    public function top10Series() { ?>
        <?php 
        global $pdo;
        $id_user = $_SESSION['id_user'];
        $token = $_COOKIE['session_token'];

        $filme = $pdo->prepare("SELECT * FROM series WHERE data_env >= (NOW() - INTERVAL 1 MONTH) ORDER BY top10 DESC LIMIT 0, 10");
        $filme->execute();

        $fav = $pdo->prepare("SELECT * FROM fav WHERE id_token = :d");
        $fav->bindValue(":d", $token);
        $fav->execute();

        $movies = $pdo->prepare("SELECT id FROM series WHERE data_env >= (NOW() - INTERVAL 1 MONTH) ORDER BY top10 DESC LIMIT 0, 10");
        $movies->execute();

        $gostei = $pdo->prepare("SELECT * FROM gostei WHERE id_token = :d");
        $gostei->bindValue(":d", $token);
        $gostei->execute();

        $gostei2 = $pdo->prepare("SELECT * FROM gostei WHERE id_token = :d");
        $gostei2->bindValue(":d", $token);
        $gostei2->execute();

        $movies2 = $pdo->prepare("SELECT id,top10 FROM series WHERE data_env >= (NOW() - INTERVAL 1 MONTH) ORDER BY top10 DESC LIMIT 0, 10");
        $movies2->execute();

        $cont_fav = [];  $cont_filmes = []; $cont_gostei = []; $cont_filmess = []; $cont_gostei2 = []; $cont_id_gostei = [];

        //COMPARAÇÃO DE FILMES COM LIKE
        while($comparaca2 = $gostei->fetch()){
                    
            $cont_gostei[]= $comparaca2['id_movie'];
            
        }
        while($movie3 = $movies2->fetch()){ 
            
            $cont_filmess[]= $movie3['id'];

        }
        $cont_int = 0;
        while ($xd = $gostei2->fetch()) {
            $cont_id_gostei[] = $xd['id_movie'];
            $cont_gostei2[] = $xd['gostei'];
            $cont_int++;
        }
        $arraycompp = array_intersect($cont_filmess, $cont_gostei);
        $arraycompp2 = array_diff($cont_filmess, $cont_gostei);
        
        ?>


        <h3> Top 10 Series NewFlix Hoje </h3>
        <div class="overflow">
        <div id="moviesTop" class="owl-carousel owl-theme">
            <?php $i = 1 ; $cont_fav = [];
            while($filmes = $filme->fetch()){ 

                while($comparaca = $fav->fetch()){
                        
                    $cont_fav[]= $comparaca['id_movie'];
                        
                }
                while($movie = $movies->fetch()){ 
                        
                    $cont_filmes[]= $movie['id'];
            
                }
                    
                $arraycomp = array_intersect($cont_filmes, $cont_fav);
                $arraycomp2 = array_diff($cont_filmes, $cont_fav);
                
                
                ?>
            <div class="item">
                <?php if($i < 10){?>
                <h4 class="numeroitem"><?=$i?></h4>
                <?php }else{?>
                <h4 class="numeroitem10"><?=$i?></h4>
                <?php }?>
                <img class="imgtop10" src="<?=$filmes['imgcapa']?>" alt="">
                <div class="item_filmes2">
                        <?php if($filmes['link_trailer'] == "") {?> 
                                <a href="videoplayerserie.php?movie=<?=$filmes['id']?>"><img class="img_filmes" src="<?=$filmes['img']?>" alt=""></a>
                        <?php }else {?>
                                    <a href="videoplayerserie.php?movie=<?=$filmes['id']?>"><video id="videoPlayerPreview" muted autoplay loop>
                                        <source src="<?=$filmes['link_trailer']?>" type="video/mp4">
                                    </video> </a>  
                        <?php }?>
                    <a id="inf_filmes" class="button_filmes" href="videoplayerserie.php?movie=<?=$filmes['id'];?>"> <img class="img_icon" src="../img/icons/icon-play.png" alt=""> </a>
                    <?php 
                    foreach($arraycomp2 as $ma) {
                        if ($filmes['id'] == $ma) {?>
                        <div class="add2_remove_<?=$filmes['id']?> button_filmes22">
                        </div>
                       <li id="add2_<?=$filmes['id']?>" class="button_filmes22" adc="<?=$filmes['id']?>"><a class="a-e" ><img class="img_icon" src="../img/icons/icon-+.png" ></a></li>
                       <script>           
                            $('#add2_<?=$filmes['id']?>').on('click', function(){
                                var add = document.getElementById('add2_<?=$filmes['id']?>');
                                add.style.display = "none";
                                $.ajax({
                                    url: 'addf.php',
                                    type: 'POST',
                                    dataType: 'html',
                                    data: {
                                        movietop: $("#add2_<?=$filmes['id']?>").attr("adc")
                                    },
                                    success: function(data) {
                                        $('.add2_remove_<?=$filmes['id']?>').empty().html(data);
                                    }               
                                });
                            });
                    
                        </script>
                    <?php } } 
                     
                    foreach($arraycomp as $ma) {
                    if ($filmes['id'] == $ma) {?>
                    <div class="add2_remove_<?=$filmes['id']?> button_filmes22">
                    </div>
                    <a id="remove2_<?=$filmes['id']?>" class="button_filmes22" adc="<?=$filmes['id']?>"> <img class="img_icon" src="../img/icons/verifica.png" alt=""> </a>   
                        <script>   
                            
                            $('#remove2_<?=$filmes['id']?>').on('click', function(){
                                var remove = document.getElementById('remove2_<?=$filmes['id']?>');  
                                remove.style.display = "none";
                                $.ajax({
                                    url: 'removef.php',
                                    type: 'POST',
                                    dataType: 'html',
                                    data: {
                                        movietop: $("#remove2_<?=$filmes['id']?>").attr("adc")
                                    },
                                    success: function(data) {
                                        $('.add2_remove_<?=$filmes['id']?>').empty().html(data);
                                    }               
                                });
                            });                               
                        </script>
                        
                    <?php }} 
                    
                    $this->CurtidasTop($cont_int,$filmes['id'],$cont_id_gostei,$cont_gostei2,$arraycompp2);
                    
                    ?> 
                    
                </div> 
            </div>

            <?php $i++; }?>
            
        </div>
        </div>
    <?php }

    public function top10SeriesFilmes() { ?>
        <?php 
        global $pdo;
        $id_user = $_SESSION['id_user'];
        $token = $_COOKIE['session_token'];

        $serie = $pdo->prepare("(SELECT id,img,imgcapa,top10,movie,link_trailer,data_env FROM series WHERE data_env >= (NOW() - INTERVAL 1 MONTH)) UNION ALL (SELECT id,img,imgcapa,top10,movie,link_trailer,data_env FROM movies WHERE data_env >= (NOW() - INTERVAL 1 MONTH)) ORDER BY top10 DESC LIMIT 0, 10");
        $serie->execute();

        $fav = $pdo->prepare("SELECT * FROM fav WHERE id_token = :d");
        $fav->bindValue(":d", $token);
        $fav->execute();

        $movies = $pdo->prepare("(SELECT id,top10,data_env FROM series WHERE data_env >= (NOW() - INTERVAL 1 MONTH)) UNION ALL (SELECT id,top10,data_env FROM movies WHERE data_env >= (NOW() - INTERVAL 1 MONTH)) ORDER BY top10 DESC LIMIT 0, 11");
        $movies->execute();

        $gostei = $pdo->prepare("SELECT * FROM gostei WHERE id_token = :d");
        $gostei->bindValue(":d", $token);
        $gostei->execute();

        $gostei2 = $pdo->prepare("SELECT * FROM gostei WHERE id_token = :d");
        $gostei2->bindValue(":d", $token);
        $gostei2->execute();

        $movie = $pdo->prepare("(SELECT id,top10,data_env FROM series WHERE data_env >= (NOW() - INTERVAL 1 MONTH)) UNION ALL (SELECT id,top10,data_env FROM movies WHERE data_env >= (NOW() - INTERVAL 1 MONTH)) ORDER BY top10 DESC LIMIT 0, 11");
        $movie->execute();

        $cont_fav = [];  $cont_filmes = []; $cont_gostei = []; $cont_filmess = []; $cont_gostei2 = []; $cont_id_gostei = [];

        //COMPARAÇÃO DE FILMES COM LIKE
        while($comparaca2 = $gostei->fetch()){
                    
            $cont_gostei[]= $comparaca2['id_movie'];
            
        }
        while($movie3 = $movie->fetch()){ 
            
            $cont_filmess[]= $movie3['id'];

        }
        $cont_int = 0;
        while ($xd = $gostei2->fetch()) {
            $cont_id_gostei[] = $xd['id_movie'];
            $cont_gostei2[] = $xd['gostei'];
            $cont_int++;
        }
        $arraycompp = array_intersect($cont_filmess, $cont_gostei);
        $arraycompp2 = array_diff($cont_filmess, $cont_gostei);
        
        ?>

        <h3> Top 10 no NewFlix Hoje </h3>
        <div class="overflow">
        <div id="moviesTop" class="owl-carousel owl-theme">
            <?php $i = 1 ; 
            while($series = $serie->fetch()){ 
                //COMPARAÇÃO DE FILMES COM FAVORITOS
                while($comparaca = $fav->fetch()){
                    
                    $cont_fav[]= $comparaca['id_movie'];
                    
                }
                while($movie = $movies->fetch()){ 
                    
                    $cont_filmes[]= $movie['id'];
        
                }

                $arraycomp = array_intersect($cont_filmes, $cont_fav);
                $arraycomp2 = array_diff($cont_filmes, $cont_fav);
                
                
                ?>      
                  
            <div class="item">
                <?php if($i < 10){?>
                <h4 class="numeroitem"><?=$i?></h4>
                <?php }else{?>
                <h4 class="numeroitem10"><?=$i?></h4>
                <?php }?>
                <img class="imgtop10" src="<?=$series['imgcapa']?>" alt="">
                <div class="item_filmes2">
                    <?php if($series['link_trailer'] == "") {?>
                            <?php if($series['movie'] == "movie"){ ?>
                                <a href="videoplayer.php?movie=<?=$series['id']?>"><img class="img_filmes" src="<?=$series['img']?>" alt=""></a>
                            <?php }else{ ?>
                                <a href="videoplayerserie.php?movie=<?=$series['id']?>"><img class="img_filmes" src="<?=$series['img']?>" alt=""></a>
                            <?php } ?>
                    <?php }else {?>
                            <?php if($series['movie'] == "movie"){ ?>
                                <a href="videoplayer.php?movie=<?=$series['id']?>"><video id="videoPlayerPreview" muted autoplay loop>
                                    <source src="<?=$series['link_trailer']?>" type="video/mp4">
                                </video> </a>
                            <?php }else{ ?>
                                <a href="videoplayerserie.php?movie=<?=$series['id']?>"><video id="videoPlayerPreview" muted autoplay loop>
                                    <source src="<?=$series['link_trailer']?>" type="video/mp4">
                                </video> </a>
                            <?php } ?>
                    <?php }?>
                    <div class="balao_play"><div class="balao_embaixo"></div>Clique para assistir</div>
                    <div class="balao_play_f"><div class="balao_embaixo_f"></div>Remove Favoritos</div>
                    <?php if($series['movie'] == "movie"){ ?>
                        <a id="inf_filmes" class="button_filmes"  href="videoplayer.php?movie=<?=$series['id']?>"> <img class="img_icon" src="../img/icons/icon-play.png" alt=""> </a>
                    <?php }else { ?>
                        <a id="inf_filmes" class="button_filmes"  href="videoplayerserie.php?movie=<?=$series['id']?>"> <img class="img_icon" src="../img/icons/icon-play.png" alt=""> </a>
                    <?php } ?>
                    <?php 
                    foreach($arraycomp2 as $ma) {
                        if ($series['id'] == $ma) {?>
                        <div class="add2_remove_<?=$series['id']?> button_filmes22">
                        </div>
                       <div id="clic_inf"><li id="add2_<?=$series['id']?>" class="button_filmes22" adc="<?=$series['id']?>"><a class="a-e" ><img class="img_icon" src="../img/icons/icon-+.png" ></a> </li></div>
                       <script>           
                            $('#add2_<?=$series['id']?>').on('click', function(){
                                var add = document.getElementById('add2_<?=$series['id']?>');
                                add.style.display = "none";
                                $.ajax({
                                    url: 'addf.php',
                                    type: 'POST',
                                    dataType: 'html',
                                    data: {
                                        movietop: $("#add2_<?=$series['id']?>").attr("adc")
                                    },
                                    success: function(data) {
                                        $('.add2_remove_<?=$series['id']?>').empty().html(data);
                                    }               
                                });
                            });
                    
                        </script>
                    <?php } } 
                     
                    foreach($arraycomp as $ma) {
                    if ($series['id'] == $ma) {?>
                    <div class="add2_remove_<?=$series['id']?> button_filmes22">
                    </div>
                    <div id="clic_inf"><a id="remove2_<?=$series['id']?>" class="button_filmes22" adc="<?=$series['id']?>"> <img class="img_icon" src="../img/icons/verifica.png" alt=""> </a></div>
                        <script>   
                            
                            $('#remove2_<?=$series['id']?>').on('click', function(){
                                var remove = document.getElementById('remove2_<?=$series['id']?>');  
                                remove.style.display = "none";
                                $.ajax({
                                    url: 'removef.php',
                                    type: 'POST',
                                    dataType: 'html',
                                    data: {
                                        movietop: $("#remove2_<?=$series['id']?>").attr("adc")
                                    },
                                    success: function(data) {
                                        $('.add2_remove_<?=$series['id']?>').empty().html(data);
                                    }               
                                });
                            });                               
                        </script>
                        
                    <?php }} 

                    $this->CurtidasTop($cont_int,$series['id'],$cont_id_gostei,$cont_gostei2,$arraycompp2);

                    ?>
                    
                </div> 
            </div>           
            <?php $i++; }?>
            
        </div>
        </div>
    <?php }

    public function CurtidasTop($a ,$b ,$e ,$c ,$d ){

        for ($i=0; $i < $a; $i++) { 

            if($e[$i] == $b && $c[$i] == "50") {?>
                <div id="2like_main_<?=$b?>" class="like_main">
                <div class="gostei"><div class="balao_play_l"><div class="balao_embaixo_l"></div>Retirar Gostei</div><a id="2like_medio_pos_<?=$b?>" class="like_medio" adl="<?=$b?>"><img class="img_icon" src="../img/icons/icon-like_pos.png" alt=""></a></div>
                    
                </div>
            <?php }
         
            if($e[$i] == $b && $c[$i] == "0") {?>
                <div id="2like_main_<?=$b?>" class="like_main">
                    <div class="odiei"><div class="balao_play_l"><div class="balao_embaixo_l"></div>Retirar Odiei</div><a id="2dislike_pos_<?=$b?>" class="like_medio" adl="<?=$b?>"><img class="img_icon" src="../img/icons/icon-des_pos.png" alt=""></a></div>
                    
                </div>
            <?php }

            if($e[$i] == $b && $c[$i] == "100") {?>
                <div id="2like_main_<?=$b?>" class="like_main">
                    <div class="amei"><div class="balao_play_l"><div class="balao_embaixo_l"></div>Retirar Amei</div><a id="2like_pos_<?=$b?>" class="like_medio" adl="<?=$b?>"><img class="img_icon" src="../img/icons/Icon-coracao_pos.png" alt=""></a></div>
                    
                </div>
            <?php }
        }
    

        foreach($d as $ma ) {
            if($b == $ma){ ?> 
                <div id="2like_main_<?=$b?>" class="like_main">
                    <div class="gostei"><div class="balao_play_l"><div class="balao_embaixo_l"></div>Gostei</div><a id="2like_medio_<?=$b?>" class="like_medio" adl="<?=$b?>"><img class="img_icon" src="../img/icons/icon-like.png" alt=""></a></div>
                    <div id="2like_filho_<?=$b?>" class="like_filho">
                        <div class="odiei"><div class="balao_play_l"><div class="balao_embaixo_l"></div>Odiei</div><a id="2dislike_<?=$b?>" class="dislike" adl="<?=$b?>"><img class="img_icon" src="../img/icons/icon-des.png" alt=""></a></div>
                        <div class="amei"><div class="balao_play_l"><div class="balao_embaixo_l"></div>Amei</div><a id="2like_<?=$b?>" class="like" adl="<?=$b?>"><img class="img_icon" src="../img/icons/icon-coracao.png" alt=""></a></div>
                    </div>
                </div>
        <?php } } ?>
        <script>   
            $('#2like_medio_<?=$b?>').on('click', function(){
                $.ajax({
                    url: 'addLike.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        movieLikeMedio: $("#2like_medio_<?=$b?>").attr("adl")
                    },
                    success: function(data) {
                        $('#2like_main_<?=$b?>').empty().html(data);
                    }               
                });
            }); 
            $('#2dislike_<?=$b?>').on('click', function(){
                $.ajax({
                    url: 'addLike.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        dislike: $("#2dislike_<?=$b?>").attr("adl")
                    },
                    success: function(data) {
                        $('#2like_main_<?=$b?>').empty().html(data);
                    }               
                });
            });  
            $('#2like_<?=$b?>').on('click', function(){
                $.ajax({
                    url: 'addLike.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        like: $("#2like_<?=$b?>").attr("adl")
                    },
                    success: function(data) {
                        $('#2like_main_<?=$b?>').empty().html(data);
                    }               
                });
            });
            $('#2like_medio_pos_<?=$b?>').on('click', function(){
                $.ajax({
                    url: 'addLike.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        removeLikeMedio: $("#2like_medio_pos_<?=$b?>").attr("adl")
                    },
                    success: function(data) {
                        $('#2like_main_<?=$b?>').empty().html(data);
                    }               
                });
            }); 
            $('#2dislike_pos_<?=$b?>').on('click', function(){
                $.ajax({
                    url: 'addLike.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        removeDislike: $("#2dislike_pos_<?=$b?>").attr("adl")
                    },
                    success: function(data) {
                        $('#2like_main_<?=$b?>').empty().html(data);
                    }               
                });
            });  
            $('#2like_pos_<?=$b?>').on('click', function(){
                $.ajax({
                    url: 'addLike.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        removeLike: $("#2like_pos_<?=$b?>").attr("adl")
                    },
                    success: function(data) {
                        $('#2like_main_<?=$b?>').empty().html(data);
                    }               
                });
            });                        
        </script>
    <?php   
    }   

} ?>