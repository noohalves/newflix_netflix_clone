<?php
include('class/conexao.php');
require_once 'class/users.php';
session_start ();
if(!isset($_SESSION['id_user'])){
    header("location: index.php");
    exit;
}

$id = $_SESSION['id_user'];

$u = new Users;
$u->conectar($bd,$hostname,$user,$passwordBD);
global $pdo;

$user = $pdo->prepare("SELECT * FROM users WHERE id = :d");
$user->bindValue(":d", $id);
$user->execute();

$img = $pdo->prepare("SELECT * FROM users_img");
$img->execute();

$img_pos = [];
$cont_img = 0;

while($user2 = $user->fetch()){
    $usuario1 = $user2["nameuser1"];
    $usuario2 = $user2["nameuser2"];
    $usuario3 = $user2["nameuser3"];
    $usuario4 = $user2["nameuser4"];
    $img1 = $user2["user1"];
    $img2 = $user2["user2"];
    $img3 = $user2["user3"];
    $img4 = $user2["user4"];
}
while($imagens = $img->fetch()){
    $img_pos [] = $imagens['destino'];
    $cont_img++;
} 
$img_user = array(
    "1" => $img1,
    "2" => $img2,
    "3" => $img3,
    "4" => $img4,
);
$name_user = array(
    "1" => $usuario1,
    "2" => $usuario2,
    "3" => $usuario3,
    "4" => $usuario4,
);

if(isset($_POST['submit'])){
    $destino = "img/imgusers/";
    $customer_id= $c_id;
    $c_name= $_POST['c_name'];
    $c_email= $_POST['c_email'];
    $c_pass= $_POST['c_pass'];
    $c_image= $_FILES['c_image']['name'];
    $c_image_temp=$_FILES['c_image']['tmp_name'];

    if($c_image_temp != "")
    {
        move_uploaded_file($c_image_temp , "$destino"."$c_image");
        $c_update="update costumers set customer_name='$c_name', customer_email='$c_email', customer_pass='$c_pass',  customer_image= '$c_image'
        where customer_id='$customer_id'";   
    }else
    {
        $c_update="update costumers set customer_name='$c_name', customer_email='$c_email', customer_pass='$c_pass'
        where customer_id='$customer_id'";
    }

    $run_update=mysqli_query($con, $c_update);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NewFlix</title>
    <link rel="stylesheet" href="css/gerencia.css">
    <link rel="icon" href="img/logo_n.png">
    <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
</head>
<body>
    <a href="index.php" ><img class="imglogo" src="img/logo.png" alt=""></a>
    <div class ="gerencia">
        <h1>Gerenciar perfis :</h1>
        <div class="gerencia-card">
            <?php for ($i=1; $i <= 4; $i++) { ?>
            <div id="user<?=$i?>" class="card">
                <img class="img_edit" src="img/Lapis-icon.png" alt=""></img>
                <img class="imgcard" src="<?=$img_user[$i]?>" alt=""></img>

                <?=$name_user[$i]?>
            </div>
            <?php } ?>
        </div>
        <a href="home.php" class="btncard">Concluído</a>
    </div>
    
    <?php for ($i=1; $i <= 4; $i++) { ?>
        <div class="container" id="containerUser<?=$i?>">
            <div id="x<?=$i?>"><img id="x_icon" src="img/icons/x.png" alt=""></div> 
            <div id="container_img_pos" class="container<?=$i?>">
                <div id="a_<?=$i?>">
                <img class="edit_img" id="edit_img<?=$i?>" ac="<?=$i?>" src="<?=$img_user[$i]?>"><span id="atual">Atual</span></img></div><br>
                <span>Selecione uma imagem...</span><br><br>
                <?php for ($j=0; $j < $cont_img; $j++) { ?>
                    <img class="select_img" id="select_img<?=$j?>_<?=$i?>" src="<?=$img_pos[$j]?>">

                <script>
                    $('#select_img<?=$j?>_<?=$i?>').on('click', function(){
                        $.ajax({
                            url: 'addf.php',
                            type: 'POST',
                            dataType: 'html',
                            data: {
                                id_img: <?=$i?>,
                                link_img: $("#select_img<?=$j?>_<?=$i?>").attr("src"),
                            },
                            success: function(data) {
                                $('#a_<?=$i?>').empty().html(data);
                            }              
                        });
                    });     
                </script>

                <?php }?>
                <br><br>
                <input type='text' id="name<?=$i?>" name='name<?=$i?>' value="<?=$name_user[$i]?>"><br><br>
                <input id="salvar<?=$i?>" type='submit' name='submit' value='Salvar'>
                <span id="error"></span>

                <script>
                    
                        $('#salvar<?=$i?>').on('click', function(){
                            if($('#name<?=$i?>').val().length > 12){
                                document.getElementById("error").style.display = "block";
                                document.getElementById("error").innerHTML = "Nome maior que 12 Caracteres !";
                            }else if ($('#name<?=$i?>').val().length < 5) {
                                document.getElementById("error").style.display = "block";
                                document.getElementById("error").innerHTML = "Nome menor que 5 Caracteres !";
                            }else if ($('#name<?=$i?>').val() == "") {
                                document.getElementById("error").style.display = "block";
                                document.getElementById("error").innerHTML = "Você não colocou nada no nome";
                            }else {
                                $.ajax({
                                    url: 'addf.php',
                                    type: 'POST',
                                    dataType: 'html',
                                    data: {
                                        id: <?=$i?>,
                                        img: $("#edit_img<?=$i?>").attr("src"),
                                        nick_name: $("#name<?=$i?>").val(),
                                    },
                                    success: function (response) {
                                        location.reload();
                                    }
                                });
                            }
                        });  
                    
                       
                </script>
            </div>
        </div>

    <?php } ?>

    
    <script type="text/javascript" src="js/gerencia.js"></script>

</body>
</html>