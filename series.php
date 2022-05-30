<?php
session_start ();
include('class/conexao.php');
require_once 'class/movies.php';
require_once 'class/moviestop10.php';

if(!isset($_SESSION['id_user'])){
    header("location: index.php");
    exit;
}

$m = new Movies();
$top = new MoviesTop10();

$categoriaa = "SELECT * FROM categoria";
$categoriaa1 =  $mysqli->query($categoriaa) or die ($mysqli->error);

$contcategory = 1;

while($categoriaa2 = $categoriaa1->fetch_array()){
    $contcategory += 1;
}
include 'header.php';
 
?>
<div class="tudo">
    <div class="search">
    <div class="test">
        <?php
        //SERIES DESTAQUE
        $m->destaqueSerie();?>

        <div class="test2">
        <div class="top10_movie_serie">
            <?php

            //TOP 10
            $top->top10Series();

            ?> </div> <?php

            //SERIES
            for ($i=1; $i <= $contcategory ; $i++) { 
                $m->serie($i);
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