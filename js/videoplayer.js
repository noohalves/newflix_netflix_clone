$(document).ready(function(){init();});
	
	var _readied = false;

    var volumeMuted = document.getElementById('somMutedButton');
    var volume = document.getElementById('somButton');
    volumeMuted.style.display = 'none';


	init = function()
  	{
		$("body").fadeTo(200, 1);
				
		$("#videoPlayer").video({"swf":"swf/video.swf", video:"videos/video.mp4"});
		$("#videoPlayer").bind("stateChange", stateChangeHandler);
		$("#videoPlayer").bind("videoProgress", progressHandler);

		var s = $("#videoPlayer").video("getState");
				
		if(s == "waiting"){
		  	$("#buttons").fadeTo(0, 0.3);
		}else if(s == "playing"){
		  	$("#playButton").css("visibility","hidden");
		  	$("#pauseButton").css("visibility","visible");
		  	ready();
		}else{
		  	ready();
		}
		  		
		var t;
		var f = false;
		var op = false;
		$("body").mousemove( function(event) { 
		if(!f){
			f = true;
			$("#homeButton").stop();
			$("#homeButton").fadeTo(500,1);
			$("#controls").stop();
			$("#controls").fadeTo(500,1);
			clearTimeout(t);

			if(!op){
				t = setTimeout (function(){
					$("#homeButton").fadeTo(500,0);
					$("#controls").fadeTo(500,0);
					f = false;
				}, 5000);
			}
		}
	} );
				
	$("body").mouseout( function(event) { 
        $("#homeButton").stop();
        $("#homeButton").fadeTo(500,0);
        $("#controls").stop();
        $("#controls").fadeTo(500,0);
        clearTimeout(t);
        f = false;
	} );

	$("#panel").mouseover( function(event) {
		clearTimeout(t);
		op = true;
	} );

	$("#panel").mouseout( function(event) {
		op = false;
	} );
				
	};

	ready = function(){
		if(!_readied){
			$("#playButton").click(playButtonHandler);
			$("#pauseButton").click(pauseButtonHandler);
			$("#stopButton").click(stopButtonHandler);
			$("#forwardButton").mousedown(forwardButtonDownHandler);
			$("#backwardButton").mousedown(backwardButtonDownHandler);

			$("#buttons").addClass("active");

			_readied = true;
		}
	};

	var elem = document.getElementById("videoPlayer");

    stateChangeHandler = function(event){
		log("stateChangeHandler " + event.state);
		  		
		if(event.state == "ready"){
		  	$("#buttons").fadeTo(200, 1);
		  	ready();
		}else if(event.state == "playing"){
		  	$("#playButton").css("visibility","hidden");
		  	$("#pauseButton").css("visibility","visible");
		}else if(event.state == "paused" || event.state == "ended"){
		  	$("#playButton").css("visibility","visible");
		  	$("#pauseButton").css("visibility","hidden");
		}
	};

	progressHandler = function(event){
		var l = Math.round((event.loaded / event.duration) * 100);
		var p = Math.round((event.currentTime / event.duration) * 100);

		$("#loading").css("width",l + "%");
		$("#playing").css("width",p + "%");
	};
	progress.addEventListener('click', (e)=>{
		const progressTime = (e.offsetX / progress.offsetWidth) * elem.duration
		elem.currentTime = progressTime
	})
		  	
	playButtonHandler = function(event){
		event.preventDefault();
		$("#videoPlayer").video("play");
	};
		  	
	pauseButtonHandler = function(event){
		event.preventDefault();
		$("#videoPlayer").video("pause");
	};
		  	
	stopButtonHandler = function(event){
	    event.preventDefault();
		$("#videoPlayer").video("stop");
	};

	forwardButtonDownHandler = function(event){
		event.preventDefault();
		$("body").bind("mouseup",scrubButtonUpHandler);
		$("#videoPlayer").video("scrubStart",500);
	};

	var btnFullScreen = document.getElementById('fullscreenButton');


	btnFullScreen.addEventListener('click', function(){
		// if already full screen; exit
		// else go fullscreen
		if (
		  document.fullscreenElement ||
		  document.webkitFullscreenElement ||
		  document.mozFullScreenElement ||
		  document.msFullscreenElement
		) {
		  if (document.exitFullscreen) {
			document.exitFullscreen();
		  } else if (document.mozCancelFullScreen) {
			document.mozCancelFullScreen();
		  } else if (document.webkitExitFullscreen) {
			document.webkitExitFullscreen();
		  } else if (document.msExitFullscreen) {
			document.msExitFullscreen();
		  }
		} else {
		  element = $('#content').get(0);
		  if (element.requestFullscreen) {
			element.requestFullscreen();
		  } else if (element.mozRequestFullScreen) {
			element.mozRequestFullScreen();
		  } else if (element.webkitRequestFullscreen) {
			element.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
		  } else if (element.msRequestFullscreen) {
			element.msRequestFullscreen();
		  }
		}
	});

	function homeButton() {
		window.history.back();
	}

    function somAumentarButton(){
        if( elem.volume < 1) { 
			elem.volume += 0.1;
		}
		if ( elem.volume > 0.1 ) {
			volume.style.display = 'block';
            volumeMuted.style.display = 'none';
		}
    }

    function somDiminuirButton(){
        if( elem.volume > 0)  {
			elem.volume -= 0.1;
		}
		if ( elem.volume <= 0.1 ) {
			volume.style.display = 'none';
            volumeMuted.style.display = 'block';
		}
    }

    function mute(){
        if( elem.muted ){
            elem.muted = false;
			elem.volume = 0.1;
            volume.style.display = 'block';
            volumeMuted.style.display = 'none';
        }else{
            elem.muted = true;
			elem.volume = 1;
            volume.style.display = 'none';
            volumeMuted.style.display = 'block';
        }
    }

	backwardButtonDownHandler = function(event){
		event.preventDefault();
		$("body").bind("mouseup",scrubButtonUpHandler);
		$("#videoPlayer").video("scrubStart",-500);
	};

	scrubButtonUpHandler = function(event){
	    event.preventDefault();
		$("body").unbind("mouseup",scrubButtonUpHandler);
		$("#videoPlayer").video("scrubStop");
	};