<?php
include("class/conexao.php");
session_start();
if(isset($_SESSION['id_user'])){

    $id = $_SESSION['id_user'];

    if(isset($_POST['movieLikeMedio'])){

        $movie1 = "(SELECT gostei,idade,top10 FROM series UNION SELECT gostei,idade,top10 FROM movies ) ORDER BY top10 DESC LIMIT 0, 10";
        $movie =  $mysqli->query($movie1) or die ($mysqli->error);

        if($comparacao['id_movie'] == $movie && $comparacao['id_user'] == $id ){
            $sql = "DELETE FROM gostei WHERE id_user = $id AND id_movie = $movie";

            if ($mysqli->query($sql) === TRUE) {

            }else {
                echo "Error: " . $sql . "<br>" . $mysqli->error;
            }
        }

        $mysqli->close();

    }
}