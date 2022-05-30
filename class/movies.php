<?php
Class Movies{
    
    
    public function destaque(){
        include("conexao.php");
        require_once 'users.php';
        $u = new Users;
        $pdo = $u->conectar($bd,$hostname,$user,$passwordBD);

        $destaque = 0;
        $id_user = $_SESSION['id_user'];
        $token = $_COOKIE['session_token'];

        $filmes = $pdo->prepare("SELECT * FROM movies WHERE destaque = :d");
        $filmes->bindValue(":d", 1);
        $filmes->execute();

        $fav = $pdo->prepare("SELECT * FROM fav WHERE id_token = :d");
        $fav->bindValue(":d", $token);
        $fav->execute();

        $movie = $pdo->prepare("SELECT id FROM movies WHERE destaque = 1 LIMIT 1");
        $movie->execute();

        while($filmes3 = $filmes->fetch()){
            $img = $filmes3["img"];
            $imgcapa = $filmes3["imgcapa"];
            $title = $filmes3["title"];
            $description = $filmes3["description"];
            $id_d = $filmes3["id"];
            $id_p = $filmes3["id_category"];
            $destaque = $filmes3["destaque"];
            $trailer = $filmes3["link_trailer"];
        }
        if($destaque == 1 ){
            $categoria = $pdo->prepare("SELECT * FROM categoria WHERE id_categoria = :d");
            $categoria->bindValue(":d", $id_p);
            $categoria->execute();
        }

        $cont_fav = [];
        $cont_filmes = [];

        while($comparacao = $fav->fetch()){
                        
            $cont_fav[]= $comparacao['id_movie'];
                
        }
        while($movies = $movie->fetch()){ 
                
            $cont_filmes[]= $movies['id'];
    
        }
            
        $arraycomp = array_intersect($cont_filmes, $cont_fav);
        $arraycomp2 = array_diff($cont_filmes, $cont_fav);

        if ($destaque == 1){?>
            <div class="imgfilme">
            <?php if ($trailer == ""){?>
                <img class="imgvideo" src="<?=$img?>" alt="">
                <?php }else{?>
                    <a href="videoplayer.php?movie=<?=$id_d?>"><video id="videoPlayerPreviewDestaque" autoplay loop>
                        <source src="<?=$trailer?>" type="video/mp4">
                    </video> </a>
                    <div id="muted"> <img id="muted_img" src="img/icons/volume-desligado.png" alt=""> <img id="volume_img" src="img/icons/volume.png" alt=""></div>
                <?php }?>
                <script>
                    
                    window.onscroll = function() {
                        VideoPause();
                    };
                    
                    var elem2 = document.getElementById("videoPlayerPreviewDestaque");
                    var btn_muted = document.getElementById("muted_img");
                    var btn_volume = document.getElementById("volume_img");
                    elem2.volume = 0;

                    function VideoPause() {
                        if (document.body.scrollTop > 0 || document.documentElement.scrollTop > 0) {
                            elem2.pause();
                            elem2.currentTime = 0;
                        } else {
                            elem2.play();
                        }
                    }

                    btn_muted.addEventListener('click', function(){
                        btn_muted.style.display = "none";
                        btn_volume.style.display = "block";
                        elem2.volume = 1;
                    });
                    btn_volume.addEventListener('click', function(){
                        btn_muted.style.display = "block";
                        btn_volume.style.display = "none";
                        elem2.volume = 0;
                    });

                </script>
            </div>
            </div>
            <div class="movie">
                <h1 class="item-title"><?=$title ?> </h1>
                <span class="item-description"><?=mb_substr( $description, 0, 150, 'UTF-8' );?> </span><br>
                <a class = "button-play" href="videoplayer.php?movie=<?=$id_d; ?>"> ➤ Play </a>
                <?php 
                    foreach($arraycomp2 as $ma) {
                        if ($id_d == $ma) {?>
                        <div class="add_remove">
                        </div>
                       <li id="add_destaque" adc="<?=$id_d?>"><a class = "button-ml"> + Minha Lista </a></li>
                       <script>           
                            $('#add_destaque').on('click', function(){
                                var add = document.getElementById('add_destaque');
                                add.style.display = "none";
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
                    <?php } } 
                     
                    foreach($arraycomp as $ma) {
                        if ($id_d == $ma) {?>
                            <div class="add_remove">
                            </div>
                           <li id="remove_destaque" adc="<?=$id_d?>"><a class = "button-ml"> - Remover da Lista </a></li>
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
                    <?php }} ?>
                <br><span class="category">Categoria :<?php while($dado2 = $categoria->fetch()){
                    $category2 = $dado2["categoria"]; ?> <?php echo " " .$category2; }?> 
                </span>
            </div>
            <?php }?>
              <?php  if ($destaque == 0) { ?>
                <style>
                    .test { 
                        margin-top: 100px;
                    }
                </style>
            <?php } $i=0; ?>
        <?php 
    }

    public function destaqueSerie(){
        include("conexao.php");
        require_once 'users.php';
        $u = new Users;
        $pdo = $u->conectar($bd,$hostname,$user,$passwordBD);
        
        $destaque = 0;
        $id_user = $_SESSION['id_user'];
        $token = $_COOKIE['session_token'];

        $filmes = $pdo->prepare("SELECT * FROM series WHERE destaque = 1 LIMIT 1");
        $filmes->execute();

        $fav = $pdo->prepare("SELECT * FROM fav WHERE id_token = :d");
        $fav->bindValue(":d", $token);
        $fav->execute();

        $movie = $pdo->prepare("SELECT id FROM series WHERE destaque = 1 LIMIT 1");
        $movie->execute();

        while($filme = $filmes->fetch()){
            $img = $filme["img"];
            $imgcapa = $filme["imgcapa"];
            $title = $filme["title"];
            $description = $filme["description"];
            $id_d = $filme["id"];
            $id_p = $filme["id_category"];
            $destaque = $filme["destaque"];
            $temporada = $filme["temporada"];
            $trailer = $filme["link_trailer"];
        }
        if($destaque == 1 ){
            $categoria = $pdo->prepare("SELECT * FROM categoria WHERE id_categoria = :d");
            $categoria->bindValue(":d", $id_p);
            $categoria->execute();
        }
        $cont_fav = [];
        $cont_filmes = [];

        while($comparacao = $fav->fetch()){
                        
            $cont_fav[]= $comparacao['id_movie'];
                
        }
        while($movies = $movie->fetch()){ 
                
            $cont_filmes[]= $movies['id'];
    
        }
            
        $arraycomp = array_intersect($cont_filmes, $cont_fav);
        $arraycomp2 = array_diff($cont_filmes, $cont_fav);


        if ($destaque == 1){?>
            <div class="imgfilme">
            <?php if ($trailer == ""){?>
                <img class="imgvideo" src="<?=$img?>" alt="">
                <?php }else{?>
                    <a href="videoplayerserie.php?movie=<?=$id_d?>"><video id="videoPlayerPreviewDestaque" autoplay loop>
                        <source src="<?=$trailer?>" type="video/mp4">
                    </video> </a>
                    <div id="muted"> <img id="muted_img" src="img/icons/volume-desligado.png" alt=""> <img id="volume_img" src="img/icons/volume.png" alt=""></div>
                <?php }?>
                <script>
                    

                    window.onscroll = function() {
                        VideoPause();
                    };
                    
                    var elem2 = document.getElementById("videoPlayerPreviewDestaque");
                    var btn_muted = document.getElementById("muted_img");
                    var btn_volume = document.getElementById("volume_img");
                    elem2.volume = 0;

                    function VideoPause() {
                        if (document.body.scrollTop > 0 || document.documentElement.scrollTop > 0) {
                            elem2.pause();
                            elem2.currentTime = 0;
                        } else {
                            elem2.play();
                        }
                    }

                    btn_muted.addEventListener('click', function(){
                        btn_muted.style.display = "none";
                        btn_volume.style.display = "block";
                        elem2.volume = 1;
                    });
                    btn_volume.addEventListener('click', function(){
                        btn_muted.style.display = "block";
                        btn_volume.style.display = "none";
                        elem2.volume = 0;
                    });

                </script>
            </div>
            <div class="movie">
                <h1 class="item-title"><?=$title ?> </h1>
                <span class="item-description"><?=mb_substr( $description, 0, 150, 'UTF-8' );?> </span><br>
                <a class = "button-play" href="videoplayerserie.php?movie=<?=$id_d; ?>"> ➤ Play </a>
                <?php 
                    foreach($arraycomp2 as $ma) {
                        if ($id_d == $ma) {?>
                        <div class="add_remove">
                        </div>
                       <li id="add_destaque" adc="<?=$id_d?>"><a class = "button-ml"> + Minha Lista </a></li>
                       <script>           
                            $('#add_destaque').on('click', function(){
                                var add = document.getElementById('add_destaque');
                                add.style.display = "none";
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
                    <?php } } 
                     
                    foreach($arraycomp as $ma) {
                        if ($id_d == $ma) {?>
                            <div class="add_remove">
                            </div>
                           <li id="remove_destaque" adc="<?=$id_d?>"><a class = "button-ml"> - Remover da Lista </a></li>
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
                    <?php }} ?>
                <span class="category"><?php echo $temporada. " Temporada"; ?></span>
                <br>
                <span class="category">Categoria :<?php while($dado2 = $categoria->fetch()){
                    $category2 = $dado2["categoria"]; ?> <?php echo " " .$category2; }?> 
                </span>
            </div>
            <?php }?>
            <?php  if ($destaque == 0) { ?>
                <style>
                    .test { 
                        margin-top: 100px;
                    }
                </style>
            <?php } $i=0; ?>
        <?php 
    }

    public function filme($id){
        include("conexao.php");
        require_once 'users.php';
        $u = new Users;
        $pdo = $u->conectar($bd,$hostname,$user,$passwordBD);

        $id_user = $_SESSION['id_user'];
        $token = $_COOKIE['session_token'];

        $category = $pdo->prepare("SELECT * FROM categoria WHERE id_categoria = :d");
        $category->bindValue(":d",$id);
        $category->execute();
        $categoria = $category->fetch();

        $filmes = $pdo->prepare("SELECT * FROM movies WHERE id_category = :d");
        $filmes->bindValue(":d",$id);
        $filmes->execute();

        $comp = $pdo->prepare("SELECT * FROM fav WHERE id_token = :d");
        $comp->bindValue(":d",$token);
        $comp->execute();

        $movies = $pdo->prepare("SELECT id FROM movies WHERE id_category = :d");
        $movies->bindValue(":d",$id);
        $movies->execute();

        $gostei = $pdo->prepare("SELECT * FROM gostei WHERE id_token = :d");
        $gostei->bindValue(":d",$token);
        $gostei->execute();

        $gostei2 = $pdo->prepare("SELECT * FROM gostei WHERE id_token = :d");
        $gostei2->bindValue(":d",$token);
        $gostei2->execute();

        $movie2 = $pdo->prepare("SELECT id FROM movies WHERE id_category = :d");
        $movie2->bindValue(":d",$id);
        $movie2->execute();

        $movie = $pdo->prepare("SELECT id FROM movies WHERE id_category = :d");
        $movie->bindValue(":d",$id);
        $movie->execute();

        $cont_fav = [];  $cont_filmes = []; $cont_gosteii = []; $cont_filmesss = []; $cont_gostei22 = []; $cont_id_gostei1 = [];

        //COMPARAÇÃO DE FILMES COM LIKE
        while($gostei1 = $gostei->fetch()){
                    
            $cont_gosteii[]= $gostei1['id_movie'];
            
        }
        while($movie33 = $movie2->fetch()){ 
            
            $cont_filmesss[]= $movie33['id'];

        }
        $cont_int1 = 0;
        while ($xd2 = $gostei2->fetch()) {
            $cont_id_gostei1[] = $xd2['id_movie'];
            $cont_gostei22[] = $xd2['gostei'];
            $cont_int1++;
        }
        $arraycompp22 = array_diff($cont_filmesss, $cont_gosteii);
        if($categoria['id_categoria'] == $id) {
            if($movie->rowCount() > 0){?>
                <h3> <?=$categoria['categoria'] ?> </h3>
            <?php } ?>
        <div class="owl-carousel owl-theme">
                <?php
                $cont_fav = []; $cont_filmes = [];
                while($filme = $filmes->fetch()) { 
                    
                    if($filme['id_category'] == $id) { 
                       
                        while($comparacao = $comp->fetch()){
                                
                            $cont_fav[]= $comparacao['id_movie'];
                                
                        }
                        while($movie = $movies->fetch()){ 
                                
                            $cont_filmes[]= $movie['id'];
                    
                        }
                            
                        $arraycomp = array_intersect($cont_filmes, $cont_fav);
                        $arraycomp2 = array_diff($cont_filmes, $cont_fav);
                        

                        ?>
                        <!-- Card -->
                        <div class="card"> 
                            <img class="imgcapa" src="<?=$filme['img'];?>" alt="">
                        
                            <div class="item_filmes">
                                <div id="play_"></div>
                                <?php if($filme['link_trailer'] == "") {?> 
                                <a href="videoplayer.php?movie=<?=$filme['id']?>"><img class="img_filmes" src="<?=$filme['img']?>" alt=""></a>
                                <?php }else {?>
                                    <a href="videoplayer.php?movie=<?=$filme['id']?>"><video id="videoPlayerPreview" muted autoplay loop>
                                        <source src="<?=$filme['link_trailer']?>" type="video/mp4">
                                    </video> </a>  
                                <?php }?>
                                <a id="inf_filmes" class="button_filmes" href="videoplayer.php?movie=<?=$filme['id'];?>"> <img class="img_icon" src="../img/icons/icon-play.png" alt=""> </a>
                                <?php 
                                foreach($arraycomp2 as $ma) {
                                    if ($filme['id'] == $ma) {?>
                                    <div class="add_remove_<?=$filme['id']?> button_filmes22">
                                    </div>
                                   <li id="add_<?=$filme['id']?>" class="button_filmes22" adc="<?=$filme['id']?>"><a class="a-e" ><img class="img_icon" src="../img/icons/icon-+.png" ></a></li>
                                   <script>           
                                        $('#add_<?=$filme['id']?>').on('click', function(){
                                            var add = document.getElementById('add_<?=$filme['id']?>');
                                            add.style.display = "none";
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
                                <?php } } 
                                 
                                foreach($arraycomp as $ma) {
                                if ($filme['id'] == $ma) {?>
                                <div class="add_remove_<?=$filme['id']?> button_filmes22">
                                </div>
                                <a id="remove_<?=$filme['id']?>" class="button_filmes22" adc="<?=$filme['id']?>"> <img class="img_icon" src="../img/icons/verifica.png" alt=""> </a>   
                                    <script>   
                                        
                                        $('#remove_<?=$filme['id']?>').on('click', function(){
                                            var remove = document.getElementById('remove_<?=$filme['id']?>');  
                                            remove.style.display = "none";
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
                                    
                                <?php }} 
                                
                                $this->Curtidas($cont_int1,$filme['id'],$cont_id_gostei1,$cont_gostei22,$arraycompp22);

                                ?> 
                                
                            </div> 
                        </div>  
                <?php } ?>
            <?php }?> 
        </div>
        <?php } 
    }

    public function filmeeserie($id){
        include("conexao.php");
        require_once 'users.php';
        $u = new Users;
        $pdo = $u->conectar($bd,$hostname,$user,$passwordBD);
        $id_user = $_SESSION['id_user'];
        $token = $_COOKIE['session_token'];

        $category = $pdo->prepare("SELECT * FROM categoria WHERE id_categoria = :d");
        $category->bindValue(":d",$id);
        $category->execute();
        $categoria = $category->fetch();

        $filmes = $pdo->prepare("SELECT id,img,movie,id_category,link_trailer FROM movies WHERE id_category = :d UNION SELECT id,img,movie,id_category,link_trailer FROM series WHERE id_category = :d");
        $filmes->bindValue(":d",$id);
        $filmes->execute();

        $comp = $pdo->prepare("SELECT * FROM fav WHERE id_token = :d");
        $comp->bindValue(":d",$token);
        $comp->execute();

        $movies = $pdo->prepare("SELECT id FROM movies WHERE id_category = :d UNION SELECT id FROM series WHERE id_category = :d");
        $movies->bindValue(":d",$id);
        $movies->execute();

        $gostei = $pdo->prepare("SELECT * FROM gostei WHERE id_token = :d");
        $gostei->bindValue(":d",$token);
        $gostei->execute();

        $gostei2 = $pdo->prepare("SELECT * FROM gostei WHERE id_token = :d");
        $gostei2->bindValue(":d",$token);
        $gostei2->execute();

        $movie2 = $pdo->prepare("SELECT id FROM movies WHERE id_category = :d UNION SELECT id FROM series WHERE id_category = :d");
        $movie2->bindValue(":d",$id);
        $movie2->execute();

        $movie = $pdo->prepare("SELECT id FROM movies WHERE id_category = :d UNION SELECT id FROM series WHERE id_category = :d");
        $movie->bindValue(":d",$id);
        $movie->execute();

        $cont_fav = [];  $cont_filmes = []; $cont_gosteii = []; $cont_filmesss = []; $cont_gostei22 = []; $cont_id_gostei1 = [];

        //COMPARAÇÃO DE FILMES COM LIKE
        while($comparaca22 = $gostei->fetch()){
                    
            $cont_gosteii[]= $comparaca22['id_movie'];
            
        }
        while($movie33 = $movie2->fetch()){ 
            
            $cont_filmesss[]= $movie33['id'];

        }
        $cont_int1 = 0;
        while ($xd2 = $gostei2->fetch()) {
            $cont_id_gostei1[] = $xd2['id_movie'];
            $cont_gostei22[] = $xd2['gostei'];
            $cont_int1++;
        }
        $arraycompp22 = array_diff($cont_filmesss, $cont_gosteii);

        if($categoria['id_categoria'] == $id) {
            if($movie->rowCount() > 0){?>
                <h3> <?=$categoria['categoria'] ?> </h3>
        <?php }?>
        <div class="owl-carousel owl-theme">
                <?php $cont_fav = [];
                while($filme = $filmes->fetch()) { 
                    if($filme['id_category'] == $id) {                        

                        while($comparacao = $comp->fetch()){
                                
                            $cont_fav[]= $comparacao['id_movie'];
                                
                        }
                        while($movie = $movies->fetch()){ 
                                
                            $cont_filmes[]= $movie['id'];
                    
                        }
                            
                        $arraycomp = array_intersect($cont_filmes, $cont_fav);
                        $arraycomp2 = array_diff($cont_filmes, $cont_fav);    
                        
                        ?>  
                        <!-- Filme -->
                        <div class="card"> 
                            <img class="imgcapa" src="<?=$filme['img'];?>" alt="">
                            <div class="item_filmes">
                                <?php $this->inFilmes($filme['id']); ?>
                                <?php if($filme['link_trailer'] == "") {?>
                                <?php if($filme['movie'] == "movie"){ ?>
                                    <a href="videoplayer.php?movie=<?=$filme['id']?>"><img class="img_filmes" src="<?=$filme['img']?>" alt=""></a>
                                <?php }else{ ?>
                                    <a href="videoplayerserie.php?movie=<?=$filme['id']?>"><img class="img_filmes" src="<?=$filme['img']?>" alt=""></a>
                                <?php } ?>
                                <?php }else {?>
                                    <?php if($filme['movie'] == "movie"){ ?>
                                        <a href="videoplayer.php?movie=<?=$filme['id']?>"><video id="videoPlayerPreview" muted autoplay loop>
                                            <source src="<?=$filme['link_trailer']?>" type="video/mp4">
                                        </video> </a>
                                    <?php }else{ ?>
                                        <a href="videoplayerserie.php?movie=<?=$filme['id']?>"><video id="videoPlayerPreview" muted autoplay loop>
                                            <source src="<?=$filme['link_trailer']?>" type="video/mp4">
                                        </video> </a>
                                    <?php } ?>
                                <?php }?>
                                
                                <?php if($filme['movie'] == "movie"){ ?>
                                <a id="inf_filmes" class="button_filmes" href="videoplayer.php?movie=<?=$filme['id'];?>"> <img class="img_icon" src="../img/icons/icon-play.png" alt=""> </a>
                                <?php }else{ ?>
                                <a id="inf_filmes" class="button_filmes" href="videoplayerserie.php?movie=<?=$filme['id'];?>"> <img class="img_icon" src="../img/icons/icon-play.png" alt=""> </a>
                                <?php } ?>
                                <?php 
                                foreach($arraycomp2 as $ma) {
                                    if ($filme['id'] == $ma) {?>
                                    <div class="add_remove_<?=$filme['id']?> button_filmes22">
                                    </div>
                                   <li id="add_<?=$filme['id']?>" class="button_filmes22" adc="<?=$filme['id']?>"><a class="a-e" ><img class="img_icon" src="../img/icons/icon-+.png" ></a></li>
                                   <script>           
                                        $('#add_<?=$filme['id']?>').on('click', function(){
                                            var add = document.getElementById('add_<?=$filme['id']?>');
                                            add.style.display = "none";
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
                                <?php } } 
                                 
                                foreach($arraycomp as $ma) {
                                if ($filme['id'] == $ma) {?>
                                <div class="add_remove_<?=$filme['id']?> button_filmes22">
                                </div>
                                <a id="remove_<?=$filme['id']?>" class="button_filmes22" adc="<?=$filme['id']?>"> <img class="img_icon" src="../img/icons/verifica.png" alt=""> </a>   
                                    <script>   
                                        
                                        $('#remove_<?=$filme['id']?>').on('click', function(){
                                            var remove = document.getElementById('remove_<?=$filme['id']?>');  
                                            remove.style.display = "none";
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
                                    
                                <?php }} 
                                
                                $this->Curtidas($cont_int1,$filme['id'],$cont_id_gostei1,$cont_gostei22,$arraycompp22);
                                
                                ?>                                        
                                
                                
                            </div> 
                        </div>
                    <?php } ?>
                <?php }?>
        </div>
        <?php } 
    }

    public function serie($id){
        include("conexao.php");
        require_once 'users.php';
        $u = new Users;
        $pdo = $u->conectar($bd,$hostname,$user,$passwordBD);
        
        $id_user = $_SESSION['id_user'];
        $token = $_COOKIE['session_token'];

        $category = $pdo->prepare("SELECT * FROM categoria WHERE id_categoria = :d");
        $category->bindValue(":d",$id);
        $category->execute();
        $categoria = $category->fetch();

        $series = $pdo->prepare("SELECT * FROM series WHERE id_category = :d");
        $series->bindValue(":d",$id);
        $series->execute();

        $comp = $pdo->prepare("SELECT * FROM fav WHERE id_token = :d");
        $comp->bindValue(":d",$token);
        $comp->execute();

        $movies = $pdo->prepare("SELECT id FROM series WHERE id_category = :d");
        $movies->bindValue(":d",$id);
        $movies->execute();

        $gostei = $pdo->prepare("SELECT * FROM gostei WHERE id_token = :d");
        $gostei->bindValue(":d",$token);
        $gostei->execute();

        $gostei2 = $pdo->prepare("SELECT * FROM gostei WHERE id_token = :d");
        $gostei2->bindValue(":d",$token);
        $gostei2->execute();

        $gostei3 = $pdo->prepare("SELECT id FROM series WHERE id_category = :d");
        $gostei3->bindValue(":d",$id);
        $gostei3->execute();

        $movie = $pdo->prepare("SELECT id FROM series WHERE id_category = :d");
        $movie->bindValue(":d",$id);
        $movie->execute();

        $cont_fav = [];  $cont_filmes = []; $cont_gosteii = []; $cont_filmesss = []; $cont_gostei22 = []; $cont_id_gostei1 = [];

        //COMPARAÇÃO DE FILMES COM LIKE
        while($comparacao2 = $gostei->fetch()){
                    
            $cont_gosteii[]= $comparacao2['id_movie'];
            
        }
        while($movie33 = $gostei3->fetch()){ 
            
            $cont_filmesss[]= $movie33['id'];

        }
        $cont_int1 = 0;
        while ($xd2 = $gostei2->fetch()) {
            $cont_id_gostei1[] = $xd2['id_movie'];
            $cont_gostei22[] = $xd2['gostei'];
            $cont_int1++;
        }
        $arraycompp22 = array_diff($cont_filmesss, $cont_gosteii);

        if($categoria['id_categoria'] == $id) {
            if($movie->rowCount() > 0){?>
                <h3> <?=$categoria['categoria'] ?> </h3>
            <?php }?>
        <div class="owl-carousel owl-theme">            
                <?php  $cont_fav = [];
                while($serie = $series->fetch()) {
                    if($serie['id_category'] == $id) {

                        while($comparacao = $comp->fetch()){
                    
                            $cont_fav[]= $comparacao['id_movie'];
                                
                        }
                        while($movie = $movies->fetch()){ 
                    
                            $cont_filmes[]= $movie['id'];
                    
                        }
                            
                        $arraycomp = array_intersect($cont_filmes, $cont_fav);
                        $arraycomp2 = array_diff($cont_filmes, $cont_fav);
                        
                        ?>  
                        <!-- Serie -->
                        <div class="card"> 
                            <img class="imgcapa" src="<?=$serie['img'];?>" alt="">
                            <div class="item_filmes">
                                <?php if($serie['link_trailer'] == "") {?> 
                                <a href="videoplayerserie.php?movie=<?=$serie['id']?>"><img class="img_filmes" src="<?=$serie['img']?>" alt=""></a>
                                <?php }else {?>
                                    <a href="videoplayerserie.php?movie=<?=$serie['id']?>"><video id="videoPlayerPreview" muted autoplay loop>
                                        <source src="<?=$serie['link_trailer']?>" type="video/mp4">
                                    </video> </a>  
                                <?php }?>
                                <a id="inf_filmes" class="button_filmes" href="videoplayerserie.php?movie=<?=$serie['id'];?>"> <img class="img_icon" src="../img/icons/icon-play.png" alt=""> </a>
                                <?php 
                                foreach($arraycomp2 as $ma) {
                                    if ($serie['id'] == $ma) {?>
                                    <div class="add_remove_<?=$serie['id']?> button_filmes22">
                                    </div>
                                   <li id="add_<?=$serie['id']?>" class="button_filmes22" adc="<?=$serie['id']?>"><a class="a-e" ><img class="img_icon" src="../img/icons/icon-+.png" ></a></li>
                                   <script>           
                                        $('#add_<?=$serie['id']?>').on('click', function(){
                                            var add = document.getElementById('add_<?=$serie['id']?>');
                                            add.style.display = "none";
                                            $.ajax({
                                                url: 'addf.php',
                                                type: 'POST',
                                                dataType: 'html',
                                                data: {
                                                    movie: $("#add_<?=$serie['id']?>").attr("adc")
                                                },
                                                success: function(data) {
                                                    $('.add_remove_<?=$serie['id']?>').empty().html(data);
                                                }               
                                            });
                                        });
                                
                                    </script>
                                <?php } } 
                                 
                                foreach($arraycomp as $ma) {
                                if ($serie['id'] == $ma) {?>
                                <div class="add_remove_<?=$serie['id']?> button_filmes22">
                                </div>
                                <a id="remove_<?=$serie['id']?>" class="button_filmes22" adc="<?=$serie['id']?>"> <img class="img_icon" src="../img/icons/verifica.png" alt=""> </a>   
                                    <script>   
                                        
                                        $('#remove_<?=$serie['id']?>').on('click', function(){
                                            var remove = document.getElementById('remove_<?=$serie['id']?>');  
                                            remove.style.display = "none";
                                            $.ajax({
                                                url: 'removef.php',
                                                type: 'POST',
                                                dataType: 'html',
                                                data: {
                                                    movie: $("#remove_<?=$serie['id']?>").attr("adc")
                                                },
                                                success: function(data) {
                                                    $('.add_remove_<?=$serie['id']?>').empty().html(data);
                                                }               
                                            });
                                        });                               
                                    </script>
                                    
                                <?php }}
                                
                                $this->Curtidas($cont_int1,$serie['id'],$cont_id_gostei1,$cont_gostei22,$arraycompp22);
                                
                                ?>  
                                
                            </div> 
                        </div>
                    <?php } ?>
                <?php }?> 
        </div>
        <?php } 
    }

    public function Curtidas($a ,$b ,$e ,$c ,$d ){

        for ($i=0; $i < $a; $i++) { 

                if($e[$i] == $b && $c[$i] == "50") {?>
                    <div id="like_main_<?=$b?>" class="like_main">
                    <div class="gostei"><div class="balao_play_l"><div class="balao_embaixo_l"></div>Retirar Gostei</div><a id="like_medio_pos_<?=$b?>" class="like_medio" adl="<?=$b?>"><img class="img_icon" src="../img/icons/icon-like_pos.png" alt=""></a></div>
                        
                    </div>
                <?php }
             
                if($e[$i] == $b && $c[$i] == "0") {?>
                    <div id="like_main_<?=$b?>" class="like_main">
                        <div class="odiei"><div class="balao_play_l"><div class="balao_embaixo_l"></div>Retirar Odiei</div><a id="dislike_pos_<?=$b?>" class="like_medio" adl="<?=$b?>"><img class="img_icon" src="../img/icons/icon-des_pos.png" alt=""></a></div>
                        
                    </div>
                <?php }
    
                if($e[$i] == $b && $c[$i] == "100") {?>
                    <div id="like_main_<?=$b?>" class="like_main">
                        <div class="amei"><div class="balao_play_l"><div class="balao_embaixo_l"></div>Retirar Amei</div><a id="like_pos_<?=$b?>" class="like_medio" adl="<?=$b?>"><img class="img_icon" src="../img/icons/Icon-coracao_pos.png" alt=""></a></div>
                        
                    </div>
                <?php }
        }
        

        foreach($d as $ma ) {
                if($b == $ma){ ?> 
                    <div id="like_main_<?=$b?>" class="like_main">
                        <div class="gostei"><div class="balao_play_l"><div class="balao_embaixo_l"></div>Gostei</div><a id="like_medio_<?=$b?>" class="like_medio" adl="<?=$b?>"><img class="img_icon" src="../img/icons/icon-like.png" alt=""></a></div>
                        <div id="like_filho_<?=$b?>" class="like_filho">
                            <div class="odiei"><div class="balao_play_l"><div class="balao_embaixo_l"></div>Odiei</div><a id="dislike_<?=$b?>" class="dislike" adl="<?=$b?>"><img class="img_icon" src="../img/icons/icon-des.png" alt=""></a></div>
                            <div class="amei"><div class="balao_play_l"><div class="balao_embaixo_l"></div>Amei</div><a id="like_<?=$b?>" class="like" adl="<?=$b?>"><img class="img_icon" src="../img/icons/icon-coracao.png" alt=""></a></div>
                        </div>
                    </div>
        <?php } } ?>
        <script>   
            $('#like_medio_<?=$b?>').on('click', function(){
                $.ajax({
                    url: 'addLike.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        movieLikeMedio: $("#like_medio_<?=$b?>").attr("adl")
                    },
                    success: function(data) {
                        $('#like_main_<?=$b?>').empty().html(data);
                    }               
                });
            }); 
            $('#dislike_<?=$b?>').on('click', function(){
                $.ajax({
                    url: 'addLike.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        dislike: $("#dislike_<?=$b?>").attr("adl")
                    },
                    success: function(data) {
                        $('#like_main_<?=$b?>').empty().html(data);
                    }               
                });
            });  
            $('#like_<?=$b?>').on('click', function(){
                $.ajax({
                    url: 'addLike.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        like: $("#like_<?=$b?>").attr("adl")
                    },
                    success: function(data) {
                        $('#like_main_<?=$b?>').empty().html(data);
                    }               
                });
            });
            $('#like_medio_pos_<?=$b?>').on('click', function(){
                $.ajax({
                    url: 'addLike.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        removeLikeMedio: $("#like_medio_pos_<?=$b?>").attr("adl")
                    },
                    success: function(data) {
                        $('#like_main_<?=$b?>').empty().html(data);
                    }               
                });
            }); 
            $('#dislike_pos_<?=$b?>').on('click', function(){
                $.ajax({
                    url: 'addLike.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        removeDislike: $("#dislike_pos_<?=$b?>").attr("adl")
                    },
                    success: function(data) {
                        $('#like_main_<?=$b?>').empty().html(data);
                    }               
                });
            });  
            $('#like_pos_<?=$b?>').on('click', function(){
                $.ajax({
                    url: 'addLike.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        removeLike: $("#like_pos_<?=$b?>").attr("adl")
                    },
                    success: function(data) {
                        $('#like_main_<?=$b?>').empty().html(data);
                    }               
                });
            });                        
        </script>
        <?php
    }

    public function inFilmes($id) {
        ?>

        <div class="inf_filmes">
            aa
        </div>

        <?php
    }

}

?>
<script>
window.onload=function(){

}
    
</script>