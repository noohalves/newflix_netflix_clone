<?php
session_start ();
include('class/conexao.php');
require_once 'class/moviestop10.php';
require_once 'class/movies.php';

if(!isset($_SESSION['id_user'])){
    header("location: index.php");
    exit;
}

$m = new Movies();
$top = new MoviesTop10();

$categoriaa = "SELECT * FROM categoria";
$categoriaa1 =  $mysqli->query($categoriaa) or die ($mysqli->error);

$contcategory = 0;

while($categoriaa2 = $categoriaa1->fetch_array()){
    $contcategory += 1;
}
include 'header.php';
?>
<div class="tudo">
    <div class="search">
    <div class="test">
        <?php
        //FILME DESTAQUE
        $m->destaque();?>

        <div class="test2">
        <div class="top10_movie_serie">
            <?php

            //TOP 10
            $top->top10();
             ?> </div> <?php

            //FILMES/SERIES
            for ($i=1; $i <= $contcategory ; $i++) { 
                $m->filme($i);
            }
            ?>
        </div>
    </div> 
    </div>

    <div class="resultado">
    </div>

</div>

<?php  

include 'footer.php'; 

?>