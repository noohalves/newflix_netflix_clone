<?php
session_start ();
require_once 'class/movies.php';
require_once 'class/users.php';
include('class/conexao.php');


if(!isset($_SESSION['id_user'])){
    header("location: index.php");
    exit;
}else {
  $u = new Users;
	$u->conectar($bd,$hostname,$user,$passwordBD);
	global $pdo;
	$logado = 0;
	$pos = $_COOKIE['session_status'] - 1;

	$sql = $pdo->prepare("SELECT * FROM sessions WHERE session_user_id = :x AND session_token = :tk");
	$sql->bindValue(":x", $_SESSION['id_user']);
	$sql->bindValue(":tk", $_COOKIE['session_token']);
	$sql->execute();
	$dado3 = $sql->fetch();

	if($dado3['session_serial'] == $_COOKIE['session_serial']){
    $id = $_GET['movie'];

    $consulta = "SELECT * FROM episodios WHERE id_ep = $id";
    $con =  $mysqli->query($consulta) or die ($mysqli->error);

    $consulta2 = "SELECT * FROM series WHERE id = $id";
    $con2 =  $mysqli->query($consulta2) or die ($mysqli->error);

    $temp2 = "SELECT * FROM episodios WHERE id_ep = $id order by ordem_ep ASC";
    $temp_2 =  $mysqli->query($temp2) or die ($mysqli->error); 

    $temp222 = "SELECT * FROM episodios WHERE id_ep = $id order by ordem_ep ASC";
    $temp_222 =  $mysqli->query($temp222) or die ($mysqli->error); 

    $temp2222 = "SELECT * FROM episodios WHERE id_ep = $id order by ordem_ep ASC";
    $temp_2222 =  $mysqli->query($temp2222) or die ($mysqli->error);

    $temp22 = "SELECT * FROM episodios WHERE id_ep = $id order by ordem_ep ASC";
    $temp_22 =  $mysqli->query($temp22) or die ($mysqli->error); 
    $cont_video = 0;
    while($temporada22 = $temp_22->fetch_array()) { 
      $cont_video++;

    }

    $m = new Movies;

    $dado = $con->fetch_array();

    $linkk = $dado['link'];

    $dado2 = $con2->fetch_array();
  }else {
    $logado = 1;
  }
  if($dado3['session_serial'] == ""){
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
  <link rel="stylesheet" href="css/videoserie.css">
</head>

<body>
    
<!-- A Aprtir daqui-->

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

  <div id="top10_update"> </div>
  <div id="content_next"></div>
  <div id="content">
    <div id="video-player" class="fullscreen-bg">	
			<video id="videoPlayer" width="100%" height="100%" preload poster="" autoplay>
				<source src="<?=$linkk?>"  type="video/mp4"  />
			</video>
		</div>	
		<div id="controls">
			<a id="homeButton" onclick="homeButton();"></a>
            <a id="logoplay" href="index.php"> <img id="logoplay" src="img/logo_n.png"> </a>
            <div class="controls2">
              <a id="nextvideo_text"> Próximo Vídeo </a>
            </div>
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
					<a id="previousButton"><span>Previous</span></a>
          <a id="nextButton"><span>Next</span></a>
          <div id="title_movie"></div>
				</div>
			</div>
      <div id="progress">
        <div id="loading"></div>
        <div id="playing"></div>
        <div id="restoTime"></div>
      </div>
		</div>



  </div>
  
  

<!-- termina aqui-->
  <script src="js/playlistSerie.js"></script>
  <script src="js/jquery.js"></script>
	<script src="js/jquery.video.js"></script>
	<script src="js/jquery.swfobject.js"></script>
	<script src="js/jquery.timers.js"></script>
	<script src="js/flashjavascriptbridge.js"></script>
  <script src="js/videoserie.js"></script>
  

<?php $numbertop10Update = $dado2["top10"]; ?>
  <script>
    var i = 1;
    var arr =[
      <?php while($temporada2 = $temp_2->fetch_array()) { ?>
      '<?=$temporada2['link'] ?>',
      <?php } ?>
    ];
    var arrTitle =[
      <?php while($temporada222 = $temp_222->fetch_array()) { ?>
      '<?=$temporada222['title_ep'] ?>',
      <?php } ?>
    ];
    var arrTemp =[
      <?php while($temporada2222 = $temp_2222->fetch_array()) { ?>
      '<?=$temporada2222['id_temp'] ?>',
      <?php } ?>
    ];
    var elem = document.getElementById('videoPlayer');
    var valortop10_s = <?=$numbertop10Update; ?>+ 1 ;
		var id_s = "<?=$id;?>";
    execute = false;
    var controls = document.querySelector(".controls2");

    elem.ontimeupdate = function() { TempoDeVideo(); NextTitleEp(); fimSerie();};

			function TempoDeVideo() {
				var currentTimeT = elem.currentTime;
				var durationTime = elem.duration;
        document.getElementById('restoTime').innerHTML = sToTime(durationTime - currentTimeT);
			}

			function TimeNextElement () {
				if (elem.currentTime >= (elem.duration-15) && !execute) {
          
          $.ajax({
						url: 'updatetop10.php',
						type: 'POST',
						dataType: 'html',
						data: {
							top10_s: valortop10_s,
							id_s: id_s
						},
						success: function(data) {
							$('#top10_update').empty().html(data);
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
      
      var btn_next = document.getElementById('nextButton');
      var btn_previous = document.getElementById('previousButton');
      btn_previous.style.display ="none";
      btn_next.style.display ="block";

      btn_next.addEventListener("click", function(){
        NextFunction();
      });
      btn_previous.addEventListener("click", function(){
        PreviousFunction();
      });

      elem.addEventListener('ended', (event) => {
        NextFunction();

      }); 
      var video_count = 0;

      function NextTitleEp(){
        document.getElementById("title_movie").innerHTML = "Temporada "+arrTemp[video_count]+" - "+arrTitle[video_count];
      }
      var executar = false;
      function NextFunction (){
        video_count++;
        var cont_video = <?=$cont_video?>;
        if (video_count > 0){ btn_previous.style.display ="block"; }
        if (video_count > cont_video-2){ btn_next.style.display ="none"; executar=true; }

        var nextVideo = arr[video_count];
           
        $("#videoPlayer").attr({
          "src": nextVideo,
          "poster": "",
          "autoplay": "autoplay"
        })         
      } 
      
      function PreviousFunction (){
        video_count--;
        var cont_video = <?=$cont_video?>;
        if (video_count < cont_video-1){ btn_next.style.display ="block"; }
        if (video_count == 0){ btn_previous.style.display ="none"; }
        
        var previousVideo = arr[video_count];
           
        $("#videoPlayer").attr({
          "src": previousVideo,
          "poster": "",
          "autoplay": "autoplay"
        })         
      }
      function fimSerie (){
        if (executar == true) {
          if (elem.currentTime >= (elem.duration-10)) {
            $.ajax({
              url: 'updatetop10.php',
              type: 'POST',
              dataType: 'html',
              data: {
                videofim: valortop10,
                id: id
              },
              success: function(data) {
                $('#content_next').empty().html(data);
              }
            });
          }
          executar = false;
        }
      }
      
  </script>
  <?php }?>

</body>
</html>