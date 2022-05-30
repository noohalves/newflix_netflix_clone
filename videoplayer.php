<?php
session_start ();
include("class/conexao.php");
require_once 'class/users.php';


if(!isset($_SESSION['id_user'])){
    header("location: index.php");
    exit;
}else{
	$u = new Users;
	$u->conectar($bd,$hostname,$user,$passwordBD);
	global $pdo;
	$logado = 0;
	$pos = $_COOKIE['session_status'] - 1;

	$sql = $pdo->prepare("SELECT * FROM sessions WHERE session_user_id = :x AND session_token = :tk");
	$sql->bindValue(":x", $_SESSION['id_user']);
	$sql->bindValue(":tk", $_COOKIE['session_token']);
	$sql->execute();
	$dado2 = $sql->fetch();

	if($dado2['session_serial'] == $_COOKIE['session_serial']){
		$id = $_GET['movie'];

		$consulta = $pdo->prepare("SELECT * FROM movies WHERE id = :d");
		$consulta->bindValue(":d",$id);
		$consulta->execute();
		$dado = $consulta->fetch();
	}else{
		$logado = 1;
	}
	if($dado2['session_serial'] == ""){
		//SET SERIAL
		$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuwxyz0123456789";
        $randomSerial = '';
        for($i = 0; $i < 20; $i = $i+1){
            $randomSerial .= $chars[mt_rand(0,60)];
        }

		$sql4 = $pdo->prepare("UPDATE sessions SET session_serial = :se WHERE session_user_id= :xx AND session_status = :st ");
        $sql4->bindValue(":se", $randomSerial);
        $sql4->bindValue(":xx", $_SESSION['id_user']);
		$sql4->bindValue(":st", $_COOKIE['session_status']);
        $sql4->execute();

        setcookie('session_serial', $randomSerial);
        setcookie('session_status', $_COOKIE['session_status']);
		header("Refresh: 0");

	}
	if(isset($_POST["botao"])){
		$sql4 = $pdo->prepare("UPDATE sessions SET session_serial = :se WHERE session_user_id= :xx AND session_token= :ss");
        $sql4->bindValue(":se", $_COOKIE['session_serial']);
        $sql4->bindValue(":xx", $_SESSION['id_user']);
		$sql4->bindValue(":ss", $_COOKIE['session_token']);
        $sql4->execute();

        setcookie('session_serial', $_COOKIE['session_serial']);
        setcookie('session_status', $_COOKIE['session_status']);
		header("Refresh: 0");
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem vindo ao NewFlix</title>
    <link rel="icon" href="img/logo_n.png">
    <link rel="stylesheet" href="css/videoplayer.css" />
	<link rel="stylesheet" href="css/like.css" />
 
</head>
<body>    
	
	<?php
	if($logado == 1) {

		$cont = rand(1, 5);
	?>
	<div id="content">	
		<?php if($cont == 1){ ?>
			<video id="videoPlayer" width="100%" height="100%" poster="" autoplay>
				<source src="videoPublicidade/btv1.mp4"  type="video/mp4"  />
			</video>
		<?php }?>
		<?php if($cont == 2){ ?>
			<video id="videoPlayer" width="100%" height="100%" poster="" autoplay>
				<source src="videoPublicidade/btv2.mp4"  type="video/mp4"  />
			</video>
		<?php }?>
		<?php if($cont == 3){ ?>
			<video id="videoPlayer" width="100%" height="100%" poster="" autoplay>
				<source src="videoPublicidade/btv3.mp4"  type="video/mp4"  />
			</video>
		<?php }?>
		<?php if($cont == 4){ ?>
			<video id="videoPlayer" width="100%" height="100%" poster="" autoplay>
				<source src="videoPublicidade/btv4.mp4"  type="video/mp4"  />
			</video>
		<?php }?>
		<?php if($cont == 5){ ?>
			<video id="videoPlayer" width="100%" height="100%" poster="" autoplay>
				<source src="videoPublicidade/btv5.mp4"  type="video/mp4"  />
			</video>
		<?php }?>
		<div id="logado"><span>Clicar em "SIM" vai fazer a outra pessoa parar de assistir, Continar assim mesmo ? <form action="" method="post">
     																										<input type="submit" value="SIM" name="botao">
																										</form> 
						</span>
		</div>
		<div id="controls">
			<a id="homeButton" onclick="homeButton();"></a>
            <a id="logoplay" href="AreaPrivada.php"> <img id="logoplay" src="img/logo_n.png"> </a>
            <div id="panelVolume">
                <a id="somButton" onclick="mute();"><img id="somButton" src="img/icons/volume.png"></a>
                <a id="somMutedButton" onclick="mute();"><img id="somMutedButton" src="img/icons/volume-desligado.png"></a>
                <a id="somAumentarButton" onclick="somAumentarButton();"><span><img id="somAumentarButton" src="img/icons/mais-preto.png"></span></a>
                <a id="somDiminuirButton" onclick="somDiminuirButton();"><span><img id="somDiminuirButton" src="img/icons/menos.png"></span></a>
            </div>
			<div id="panel">
				<div id="buttons">
					<a id="playButton"><span>Play</span></a>
					<a id="pauseButton"><span>Pause</span></a>
					<a id="stopButton"><span>Stop</span></a>
					<a id="backwardButton"><span>Backward</span></a>
					<a id="forwardButton"><span>Forward</span></a>
					<a id="fullscreenButton"><span>Fullscreen</span></a>
				</div>
			</div>
			<div id="progress">
				<div id="loading"></div>
				<div id="playing"></div>
				<div id="restoTime"></div>
			</div>
		</div>
	</div>

	<script src="js/jquery.js"></script>
	<script src="js/jquery.video.js"></script>
	<script src="js/jquery.swfobject.js"></script>
	<script src="js/jquery.timers.js"></script>
	<script src="js/flashjavascriptbridge.js"></script>
	<script src="js/videoplayer.js"></script>
	<?php
	}else{
	?>

	<div id="content_next"></div>
    <div id="content">	
			<video id="videoPlayer" width="100%" height="100%" poster="<?=$dado["img"];?>" autoplay>
				<source src="<?=$dado["link720"];?>"  type="video/mp4"  />
			</video>
		
		
		<div id="controls">
			<a id="homeButton" onclick="homeButton();"></a>
            <a id="logoplay" href="AreaPrivada.php"> <img id="logoplay" src="img/logo_n.png"> </a>
            <div id="panelVolume">
                <a id="somButton" onclick="mute();"><img id="somButton" src="img/icons/volume.png"></a>
                <a id="somMutedButton" onclick="mute();"><img id="somMutedButton" src="img/icons/volume-desligado.png"></a>
                <a id="somAumentarButton" onclick="somAumentarButton();"><span><img id="somAumentarButton" src="img/icons/mais-preto.png"></span></a>
                <a id="somDiminuirButton" onclick="somDiminuirButton();"><span><img id="somDiminuirButton" src="img/icons/menos.png"></span></a>
            </div>
			<div id="panel">
				<div id="buttons">
					<a id="playButton"><span>Play</span></a>
					<a id="pauseButton"><span>Pause</span></a>
					<a id="stopButton"><span>Stop</span></a>
					<a id="backwardButton"><span>Backward</span></a>
					<a id="forwardButton"><span>Forward</span></a>
					<a id="fullscreenButton"><span>Fullscreen</span></a>
				</div>
			</div>
			<div id="progress">
				<div id="loading"></div>
				<div id="playing"></div>
				<div id="restoTime"></div>
			</div>
		</div>
		
		
	</div>

		<script src="js/jquery.js"></script>
		<script src="js/jquery.video.js"></script>
		<script src="js/jquery.swfobject.js"></script>
		<script src="js/jquery.timers.js"></script>
		<script src="js/flashjavascriptbridge.js"></script>

		<?php $numbertop10Update = $dado["top10"]; ?>
		<script>
			var elem = document.getElementById('videoPlayer');
			var valortop10 = <?=$numbertop10Update?>+ 1 ;
			var id = <?=$id?>;
			var duration = 0;
			var execute = false;

			
			elem.ontimeupdate = function() { TempoDeVideo(); TimeNextElement(); };

			function TempoDeVideo() {
				var currentTimeT = elem.currentTime;
				var durationTime = elem.duration;
        		document.getElementById('restoTime').innerHTML = sToTime(durationTime - currentTimeT);
		
			}

			function TimeNextElement () {
				if (elem.currentTime >= (elem.duration-10) && !execute) {
					$.ajax({
						url: 'updatetop10.php',
						type: 'POST',
						dataType: 'html',
						data: {
							top10: valortop10,
							id: id
						},
						success: function(data) {
							$('#content_next').empty().html(data);
						}
					});
					execute = true;
				}
			}
			
			function sToTime(t) {
				return padZero(parseInt((t / (60 * 60)) % 24)) + ":" +
					padZero(parseInt((t / (60)) % 60)) + ":" + 
					padZero(parseInt((t) % 60));
			}
			function padZero(v) {
				return (v < 10) ? "0" + v : v;
			}

		</script>

        <script src="js/videoplayer.js"></script>
	
	<?php } ?>

		

		
		
    
</body>
</html>
 