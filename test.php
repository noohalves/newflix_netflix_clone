<!DOCTYPE html>
<html>
<body>
<style>
#status span.status {
  display: none;
  font-weight: bold;
}
span.status.complete {
  color: green;
}
span.status.incomplete {
  color: red;
}
#status.complete span.status.complete {
  display: inline;
}
#status.incomplete span.status.incomplete {
  display: inline;
}
</style>

<video width="480" height="400" controls="true" poster="" id="video">
    <source type="video/mp4" src="http://www.w3schools.com/html/mov_bbb.mp4"></source>
</video>

<div id="status" class="incomplete">
<span>Play status: </span>
<span class="status complete">COMPLETE</span>

<span class="status incomplete">INCOMPLETE</span>
<br />
</div>
<div>
<span id="played">0</span> seconds out of 
<span id="duration"></span> seconds. (only updates when the video pauses)
</div>
<?php
    $variavel = 0;
    $variavel = "<script> document.write(variavelsoma) </script>";
    $variavel = intval($variavel) + intval($variavel);

    for ($i=0; $i <= $variavel ; $i++) { 
        echo "VARIAVEL : ".$variavel;
    }
?>


<script>
var video = document.getElementById("video");

var timeStarted = -1;
var timePlayed = 0;
var duration = 0;
// If video metadata is laoded get duration
if(video.readyState > 0)
  getDuration.call(video);
//If metadata not loaded, use event to get it
else
{
  video.addEventListener('loadedmetadata', getDuration);
}
// remember time user started the video
function videoStartedPlaying() {
  timeStarted = new Date().getTime()/1000;
}
function videoStoppedPlaying(event) {
  // Start time less then zero means stop event was fired vidout start event
  if(timeStarted>0) {
    var playedFor = new Date().getTime()/1000 - timeStarted;
    timeStarted = -1;
    // add the new ammount of seconds played
    timePlayed+=playedFor;
  }
  document.getElementById("played").innerHTML = Math.round(timePlayed)+"";
  // Count as complete only if end of video was reached
  if(timePlayed>=duration && event.type=="ended") {
    document.getElementById("status").className="complete";
    const variavelsoma = 1;
    var teste = $("#exemplo").html();
  }
}

function getDuration() {
  duration = video.duration;
  document.getElementById("duration").appendChild(new Text(Math.round(duration)+""));
  console.log("Duration: ", duration);
}

video.addEventListener("play", videoStartedPlaying);
video.addEventListener("playing", videoStartedPlaying);

video.addEventListener("ended", videoStoppedPlaying);
video.addEventListener("pause", videoStoppedPlaying);
</script>

<?php 
for ($i=0; $i <= $variavel ; $i++) { 
    echo "VARIAVEL : ".$variavel;
}
?>

</body>
</html> 