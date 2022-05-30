<?php


Class PainelFunctions {

    public function AddC() {
        global $mysqli;
        $id_user = $_SESSION['id_user'];

        $cat1 = "SELECT * FROM categoria";
        $cat2 =  $mysqli->query($cat1) or die ($mysqli->error);
        ?>

        <div class="addCategoria" style="text-align:center;"> 
            <h2 style="margin-button:20px">Adicionar Categoria</h1>

            <input id="valor_add" type="text" placeholder="Exemplo : Ação"> </input>
            <button class="btn_c" id="add_c">Adicionar</button>

            <h2 style="margin-top:20px">Categorias Atuais</h1>

            <table class="table_cat">
                <tr>
                    <td class="l_t">Categorias</td>
                    <td class="l_t">Função</td>
                </tr>
                <?php while($cat = $cat2->fetch_array()) { ?>  
                    <tr>
                        <td class="l_t"><?=$cat['categoria'] ?></td>
                        <td class="l_t"><button class="btn_c" id="deletar_c_<?=$cat['id_categoria']?>" adc="<?=$cat['id_categoria']?>">Deletar</button></td>
                    </tr>
                    <script>
                        $('#deletar_c_<?=$cat['id_categoria']?>').click(function(){
                            $.ajax({
                                url: 'cat.php',
                                type: 'POST',
                                dataType: 'html',
                                data: {
                                    removeC: $("#deletar_c_<?=$cat['id_categoria']?>").attr("adc")
                                },
                                success: function(data) {
                                    $('#content').empty().html(data);
                                }             
                            });
                        });

                    </script> 
                        
                <?php } ?>
                <script>
                    $('#add_c').click(function(){
                        $.ajax({
                            url: 'cat.php',
                            type: 'POST',
                            dataType: 'html',
                            data: {
                                addC: $("#valor_add").val()
                            },
                            success: function(data) {
                                $('#content').empty().html(data);
                            }             
                        });
                    });
                </script>
            </table>  
                   

        </div>
        
        <?php
    }
    public function AddF() {
        global $mysqli;
        $id_user = $_SESSION['id_user'];

        $movie1 = "SELECT * FROM movies";
        $movie2 =  $mysqli->query($movie1) or die ($mysqli->error);

        $cat2 = "SELECT * FROM categoria";
        $cat1 =  $mysqli->query($cat2) or die ($mysqli->error);

        ?>

        <div class="addCategoria" style="text-align:center;"> 
            <h2 style="margin-button:20px">Adicionar Filme</h1>
            <div id="up_filme">
            <table id="update_filme">
                <form id="form_update_filme" onsubmit="return false">
                    <tr><td class="l_d"> Titulo : </td><td class="l_d"><input id="title" name='title' type="text" placeholder="Ex: DOIDO" /> </tr>
                    <tr><td class="l_d"> Descrição : </td><td class="l_d"><textarea class="long_text" id="description" name='description' type='text' placeholder="Ex: ERA UM VEZ UM DOIDO PULOU..." rows="4" cols="50"></textarea></td></tr>
                    <tr><td class="l_d"> Upload image Capa: </td><td class="l_d"><div id="label" class="valueCapa">Selecionar arquivo...</div><input id="capa" type='file' name='capa' value="" /> </td></tr>
                    <tr><td class="l_d"> Upload image Fundo: </td><td class="l_d"><div id="label" class="valueFundo">Selecionar arquivo...</div><input id="fundo" type='file' name='fundo' value="" /> </td></tr>
                    <tr><td class="l_d"> Trailer (Opcional) : </td><td class="l_d"><div id="label" class="valueTrailer">Selecionar arquivo...</div><input id="trailer" type='file' name='trailer' value="" /> </td></tr>
                    <tr><td class="l_d"> Filme... UPLOAD/LINK : </td><td class="l_d"><div id="label" class="valueFilme">Selecionar arquivo...</div><input id="filme" type='file' name='filme' value="" /><br> OU <br><input id="filmelink" name='filmelink' type="text" placeholder="Ex: http://filmes.com/video.mp4" /> </td></tr>
                    <tr><td class="l_d"> Idade Permitida : </td><td class="l_d"><input id="idade" name='idade' type="text" placeholder="Ex: 18" /> </tr>
                    <tr><td class="l_d"> Destaque 1-SIM/0-NAO : </td><td class="l_d"><input id="destaque" name='destaque' type="text" placeholder="Ex: 1 OU 0" /> </tr>
                    <tr><td class="l_d"> Categoria : </td><td class="l_d"><input id="categoria" name='categoria' type="text" placeholder="Categoria" list="cat" />
                                                                                                    <datalist id="cat">
                                                                                                        <option value="">Categorias:</option>
                                                                                                        <?php while ($cat = $cat1->fetch_array()){ ?>
                                                                                                        <option value="<?=$cat["id_categoria"]?>"><?=$cat["categoria"]?></option>
                                                                                                        <?php } ?>
                                                                                                    </datalist> </tr>
                    <table class="l_f">
                        <tr><td><button class="btn_ep" id="add_f" onclick="uploadFilme()">Adicionar</button></td></tr>
                    </table>
                </form>
                        <tr><td><span class="respostaTrue" id="respostaTrue">ABCD</span></td></tr>
                        <tr><td><span class="respostaFalse" id="respostaFalse">ABCD</span></td></tr>
                
            </table>
            </div>
            <h2 style="margin-top:20px">Filmes Atuais</h1>

            <table class="table_cat">
                <tr>
                    <td class="l_t">Capa</td>
                    <td class="l_t">Titulo</td>
                    <td class="l_t">Descrição</td>
                    <td class="l_t">Top 10</td>
                    <td class="l_t">Idade</td>
                    <td class="l_t">Destaque 1-True/0-False</td>
                    <td class="l_t">Função</td>
                </tr>
                <?php while($movie = $movie2->fetch_array()) { ?>  
                    <tr>
                        <td class="l_t"><img class="capa_img" src="../<?=$movie['imgcapa']?>"></td> 
                        <td class="l_t"><?=$movie['title']?></td>
                        <td class="l_t"><?=$movie['description']?></td>
                        <td class="l_t"><?=$movie['top10']?></td>
                        <td class="l_t"><?=$movie['idade']?></td>
                        <td class="l_t"><?=$movie['destaque']?></td>
                        <td class="l_t"><button class="btn_ep" id="deletar_f_<?=$movie['id']?>" adc="<?=$movie['id']?>">Deletar</button> 
                        <button class="btn_ep" id="editar_f_<?=$movie['id']?>" adc="<?=$movie['id']?>">Editar</button> </td>
                    </tr>

                    <script>

                        $('#deletar_f_<?=$movie['id']?>').click('click',function(){
                            if (window.confirm("Você realmente deseja deletar?")) {
                                $.ajax({
                                    url: 'cat.php',
                                    type: 'POST',
                                    dataType: 'html',
                                    data: {
                                        removeF: $("#deletar_f_<?=$movie['id']?>").attr("adc")
                                    },
                                    success: function(data) {
                                        $('#contentF').empty().html(data);
                                    },
                                    error: function (request, status, error) {
                                        alert(request.responseText);
                                    }            
                                });
                            }
                            
                        });

                    </script>
                                            
                <?php } ?>
                
            </table>  
            
        </div>
        
        <?php
    }
    public function AddS() {
        global $mysqli;
        $id_user = $_SESSION['id_user'];

        $movie1 = "SELECT * FROM series";
        $movie2 =  $mysqli->query($movie1) or die ($mysqli->error);

        $cat2 = "SELECT * FROM categoria";
        $cat1 =  $mysqli->query($cat2) or die ($mysqli->error);

        ?>

        <div class="addCategoria" style="text-align:center;"> 
            <h2 style="margin-button:20px">Adicionar Serie</h1>
            <div id="up_filme">
            <table id="update_filme">
                <form id="form_update_serie" onsubmit="return false">
                    <tr><td class="l_d"> Titulo : </td><td class="l_d"><input id="titleSerie" name='titleSerie' type="text" placeholder="Ex: DOIDO" /> </tr>
                    <tr><td class="l_d"> Descrição : </td><td class="l_d"><textarea class="long_text" id="descriptionSerie" name='descriptionSerie' type='text' placeholder="Ex: ERA UM VEZ UM DOIDO PULOU..." rows="4" cols="50"></textarea></td></tr>
                    <tr><td class="l_d"> Upload image Capa: </td><td class="l_d"><div id="label" class="valueCapaSerie">Selecionar arquivo...</div><input id="capaSerie" type='file' name='capaSerie' value="" /> </td></tr>
                    <tr><td class="l_d"> Upload image Fundo: </td><td class="l_d"><div id="label" class="valueFundoSerie">Selecionar arquivo...</div><input id="fundoSerie" type='file' name='fundoSerie' value="" /> </td></tr>
                    <tr><td class="l_d"> Trailer (Opcional) : </td><td class="l_d"><div id="label" class="valueTrailerSerie">Selecionar arquivo...</div><input id="trailerSerie" type='file' name='trailerSerie' value="" /> </td></tr>
                    <tr><td class="l_d"> Idade Permitida : </td><td class="l_d"><input id="idadeSerie" name='idadeSerie' type="text" placeholder="Ex: 18" /> </tr>
                    <tr><td class="l_d"> Destaque 1-SIM/0-NAO : </td><td class="l_d"><input id="destaqueSerie" name='destaqueSerie' type="text" placeholder="Ex: 1 OU 0" /> </tr>
                    <tr><td class="l_d"> Categoria : </td><td class="l_d"><input id="categoriaSerie" name='categoriaSerie' type="text" placeholder="Categoria" list="cat" />
                                                                                                    <datalist id="cat">
                                                                                                        <option value="">Categorias:</option>
                                                                                                        <?php while ($cat = $cat1->fetch_array()){ ?>
                                                                                                        <option value="<?=$cat["id_categoria"]?>"><?=$cat["categoria"]?></option>
                                                                                                        <?php } ?>
                                                                                                    </datalist> </tr>
                    <table class="l_f">
                        <tr><td><button class="btn_ep" id="add_f" onclick="uploadSerie()">Adicionar</button></td></tr>
                    </table>
                </form>
                        <tr><td><span class="respostaFalse" id="respostaFalseSerie">ABCD</span></td></tr>
                
            </table>
            </div>
            <h2 style="margin-top:20px">Series Atuais</h1>

            <table class="table_cat">
                <tr>
                    <td class="l_t">Capa</td>
                    <td class="l_t">Titulo/Temporada</td>
                    <td class="l_t">Descrição</td>
                    <td class="l_t">Top 10</td>
                    <td class="l_t">Idade</td>
                    <td class="l_t">Destaque 1-True/0-False</td>
                    <td class="l_t">Função</td>
                </tr>
                <?php while($movie = $movie2->fetch_array()) { ?>  
                    <tr>
                        <td class="l_t"><img class="capa_img" src="../<?=$movie['imgcapa']?>"></td> 
                        <td class="l_t"><?=$movie['title']?><br><span style="color:red;"><?=$movie['temporada']?> - Temporada<span></td>
                        <td class="l_t"><?=$movie['description']?></td>
                        <td class="l_t"><?=$movie['top10']?></td>
                        <td class="l_t"><?=$movie['idade']?></td>
                        <td class="l_t"><?=$movie['destaque']?></td>
                        <td class="l_t"><button class="btn_ep" id="deletar_s_<?=$movie['id']?>" adc="<?=$movie['id']?>">Deletar</button>
                         <button class="btn_ep" id="editar_s_<?=$movie['id']?>" adc="<?=$movie['id']?>">Editar</button> 
                         <button class="btn_ep" id="add_ep_<?=$movie['id']?>" adc="<?=$movie['id']?>">Add Ep...</button> </td>
                    </tr>

                    <script>

                        $('#deletar_s_<?=$movie['id']?>').click('click',function(){
                            if (window.confirm("Você realmente deseja deletar?")) {
                                $.ajax({
                                    url: 'cat.php',
                                    type: 'POST',
                                    dataType: 'html',
                                    data: {
                                        removeS: $("#deletar_s_<?=$movie['id']?>").attr("adc")
                                    },
                                    success: function(data) {
                                        $('#contentS').empty().html(data);
                                    },
                                    error: function (request, status, error) {
                                        alert(request.responseText);
                                    }            
                                });
                            }
                            
                        });
                        $('#add_ep_<?=$movie['id']?>').click('click',function(){
                            $("#contentEP").css("opacity", 1);
                            $("#contentEP").css("visibility", 'visible');
                            $("#contentEP").css("transition", 'all 0.5s');
                            $("#contentS").css("opacity", 0);
                            $("#contentS").css("visibility", 'hidden');
                            $("#contentS").css("transition", 'all 0.5s');
                                $.ajax({
                                    url: 'cat.php',
                                    type: 'POST',
                                    dataType: 'html',
                                    data: {
                                        addEp: $("#add_ep_<?=$movie['id']?>").attr("adc")
                                    },
                                    success: function(data) {
                                        $('#contentEP').empty().html(data);
                                    },
                                    error: function (request, status, error) {
                                        alert(request.responseText);
                                    }            
                                });
                            
                        });

                        //INPUT FUNCTION SERIES
                        window.onload=function(){
                            var valueCapaSerie = document.getElementsByClassName("valueCapaSerie")[0];
                            var capaSerie = document.getElementById("capaSerie");
                            
                            valueCapaSerie.addEventListener("click", function(){
                                capaSerie.click();
                            });
                            var valueFundoSerie = document.getElementsByClassName("valueFundoSerie")[0];
                            var fundoSerie = document.getElementById("fundoSerie");

                            valueFundoSerie.addEventListener("click", function(){
                                fundoSerie.click();
                            });
                            var valueTrailerSerie = document.getElementsByClassName("valueTrailerSerie")[0];
                            var trailerSerie = document.getElementById("trailerSerie");
                            
                            valueTrailerSerie.addEventListener("click", function(){
                                trailerSerie.click();
                            });

                            capaSerie.addEventListener("change", function(){
                                var nome = "Não há arquivo selecionado. Selecionar arquivo...";
                                if(capaSerie.files.length > 0) nome = capaSerie.files[0].name;
                                valueCapaSerie.innerHTML = nome;
                            });
                            
                            fundoSerie.addEventListener("change", function(){
                                var nome = "Não há arquivo selecionado. Selecionar arquivo...";
                                if(fundoSerie.files.length > 0) nome = fundoSerie.files[0].name;
                                valueFundoSerie.innerHTML = nome;
                            });
                            
                            trailerSerie.addEventListener("change", function(){
                                var nome = "Não há arquivo selecionado. Selecionar arquivo...";
                                if(trailerSerie.files.length > 0) nome = trailerSerie.files[0].name;
                                valueTrailerSerie.innerHTML = nome;
                            });
                        

                        }

                    </script>
                                            
                <?php } ?>
                
            </table>  
            
        </div>
        
        <?php
    }
    public function melhorFilme() {
        include('../class/conexao.php');
        require_once '../class/users.php';
        $u = new Users;
        $u->conectar($bd,$hostname,$user,$passwordBD);
        global $pdo;
        $id_user = $_SESSION['id_user'];

        $movies = $pdo->prepare("SELECT id_movie, COUNT(id_movie) AS `value_occurrence` FROM gostei GROUP BY id_movie ORDER BY `value_occurrence` DESC LIMIT 1");
        $movies->execute();
        $filme = $movies->fetch();

        $cont = 0;
        $porc = 0;
        $moviess = $pdo->prepare("SELECT gostei FROM gostei WHERE id_movie = :d");
        $moviess->bindValue(":d",$filme['id_movie']);
        $moviess->execute();
        while($filmes = $moviess->fetch()){
            $porc += $filmes ['gostei'];
            $cont++;
        }
        if ($porc == 0 && $cont == 0){
            $totalPorc = 0;
        }else {
            $totalPorc = $porc/$cont;
        }
        


        $movie = $pdo->prepare("SELECT id,img,title,description FROM movies WHERE id = :d UNION SELECT id,img,title,description FROM series WHERE id = :d");
        $movie->bindValue(":d", $filme['id_movie']);
        $movie->execute();
        $row = $movie->fetch();

        if($movies->rowCount() > 0) {
        ?>
            <img class="img_festa" src="../img/confetti-illustration.png">
            <img class="img_icon_m" src="../<?=$row['img']?>">
            <div id="margin_desc">
                <div id="margin_gostei"><div class="star-ratings"><div class="fill-ratings" style="width: <?=$totalPorc?>%;"><span>★★★★★</span></div><div class="empty-ratings"><span>★★★★★</span></div></div><br> <span class="xd"><?=substr($totalPorc, 0, 5)?>% LIKE</span></div>
                <h2><?=$row['title']?></h2>
                <h5><?=$row['description']?></h5>
            </div>
        <?php
        }else {
            ?>
            <img class="img_festa" src="../img/confetti-illustration.png">
            <img class="img_icon_m" src="../img/bg.jpg">
            <div id="margin_desc">
                <h2>Breve algum filme</h2>
                <h5>Esperando alguem dar gostei em algum filme ou serie !</h5>
            </div>
            <?php
        }

    }
    public function AddEP($id) {
        include('../class/conexao.php');
        require_once '../class/users.php';
        $u = new Users;
        $u->conectar($bd,$hostname,$user,$passwordBD);
        global $pdo;

        $movies = $pdo->prepare("SELECT * FROM series WHERE id = :d");
        $movies->bindValue(':d', $id);
        $movies->execute();
        $filme = $movies->fetch(); 
        
        $Ep = $pdo->prepare("SELECT * FROM episodios WHERE id_ep = :d ORDER BY ordem_ep ASC");
        $Ep->bindValue(':d', $id);
        $Ep->execute();
        
        
        ?>
        <div class="AddEP">
            <div class="AddEP_card">
                <form id="form_ep" onsubmit="return false">
                    <input type="text" id="titleEp" name="titleEp" placeholder="Titulo do Epsódio"></input>
                    <textarea class="long_text" name="descriptionEp" id="descriptionEp" placeholder="Descrição do Epsódio" cols="30" rows="10"></textarea>
                    <input type="text" id="linkEp" name="linkEp" placeholder="Link do Epsódio"></input> <br>OU 
                    <br><div id="label" class="valueEpFile">Selecionar arquivo...</div><input type="file" id="EpFile" name="EpFile" placeholder=""></input><br>
                    <input type="number" id="tempEp" name="tempEp" placeholder="Temporada 1, 2, 3..."><br>
                    <input type="number" id="ordemEp" name="ordemEp" placeholder="Ordem do Epsódio 0, 1, 2, 3..."><br>
                    <input id="id_ep_invisible" name="id_ep" type="text" value="<?=$id?>" />
                    <button class="btn_ep" id="enviarEP" onclick="sendEp()">Enviar</button>
                </form>
                <div id="errorEP"></div>
            </div>
            <div class="TodosEP_card">
                <?php 
                while($filmeEp = $Ep->fetch()){ ?>

                    <h5><?=$filmeEp['title_ep']?> - <span style='color:green;'><?=$filmeEp['id_temp']?> TEMPORADA</span> - <span style='color:red;'>ORDEM <?=$filmeEp['ordem_ep']?></span> </h5>
                    <h5 style='list-style: decimal;'><?=mb_strimwidth( $filmeEp['description_ep'], 0, 250, '...' )?></h5>
                    <button class="btn_ep" id="delEP<?=$filmeEp['id']?>" adc="<?=$filmeEp['id']?>" >Deletar</button><button class="btn_ep" id="editEP<?=$filmeEp['id']?>" adc="<?=$filmeEp['id']?>" >Editar</button>
                    <img class="img_bg_ep" src="../img/branco.jpg" alt="">

                    <script>

                        $('#delEP<?=$filmeEp['id']?>').click('click',function(){
                            if (window.confirm("Você realmente deseja deletar?")) {
                                $.ajax({
                                    url: 'cat.php',
                                    type: 'POST',
                                    dataType: 'html',
                                    data: {
                                        removeEp: $("#delEP<?=$filmeEp['id']?>").attr("adc"),
                                        idSerie: <?=$id?>
                                    },
                                    success: function(data) {
                                        $('.AddEP').empty().html(data);
                                    },
                                    error: function (request, status, error) {
                                        alert(request.responseText);
                                    }            
                                });
                            }
                            
                        });

                    </script>

                <?php 
                }
                ?>
            </div>
            
        </div>

        <?php
    }
    
}

?>