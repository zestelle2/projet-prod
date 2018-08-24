// mes variables
var mytrack = document.getElementsByTagName("source"); //ma chanson actuelle
var muteButton = document.getElementsByClassName("volume"); //bouton muet
var duration = document.getElementById("time-total");
var currentTime = document.getElementById("time-current"); //temps total
var progressBar = document.querySelector("#progress-bar"); //barre de progression
var bar = document.getElementById("default-bar"); //barre grise en arrière plan
var percent = 0;

setInterval(function () {
	var minutes = parseInt(audio.currentTime / 60);
	var seconds = parseInt(audio.currentTime % 60); 

	if(minutes.toString().length == 1) {
		minutes = "0" + minutes;
	}
	if(seconds.toString().length == 1) {
		seconds = "0" + seconds;
	}
	 currentTime.innerHTML = minutes + ':' + seconds;
	// console.log(audio.duration, duration, minutes, seconds)
	
},1000);


//clic sur la progression pour aller à un endroit de la chanson
bar.addEventListener('click', clickedProgressBar);
function clickedProgressBar (e) {
	if (!audio.ended) {
		var mouseX = e.pageX - $(bar).offset().left;
		var newtime = mouseX * audio.duration / $(bar).width();

		console.log(mouseX, audio.duration);
		console.log(mouseX);
		console.log(newtime);

		progressBar.style.width = mouseX + 'px';
		audio.currentTime = newtime;
	}
}

//affichage de la progression en fonction de la chanson
audio.addEventListener('timeupdate', function () {
	percent = Math.floor((100 / this.duration) * this.currentTime);
	progressBar.style.width = percent + '%';
});

$('.pause').hide(); //hide pause button until clicked

//play button
$('.play').click(function () {
	audio.play();
	$('.play').hide();
	$('.pause').show();
});

//mute button
$('.muted').click(function() {	
	if (audio.muted == false) {
		audio.muted=true;
		var muted = document.querySelector(".volume");
		muted.style.color="rgb(220,20,60)";	
	} else {
		audio.muted=false;
		var muted = document.querySelector(".volume");
		muted.style.color="#8BA989";
	}
});

//pause button
$('.pause').click(function () {
	audio.pause();
	$('.play').show();
	$('.pause').hide();
});

//bouton repeat song
$('.repeat').click(function() {	
	if (audio.loop == false) {
		audio.loop=true;
		var loop = document.querySelector(".repeat");
		loop.style.color="rgb(0,191,255)";	
	} else {
		audio.loop=false;
		var loop = document.querySelector(".repeat");
		loop.style.color="#8BA989";	
	}
});

//like & shuffle button
$('.heart').click(function () {
	$(this).toggleClass('heartClicked');
});
$('.shuffle').click(function () {
	$(this).toggleClass('clickedShuffle');
});

//show info box on hover
$('#player').hover(function () {
	$('.info').toggleClass('up');
});

//Fade Out effect 
$(function() {
	$(audio).prop("volume", 0.0);
	$(audio).on("timeupdate", function() {
		if (this.currentTime < 2) {
			$(this).stop().animate({volume: 1.0}, 2000);
		} 
		else if (this.currentTime > (this.duration - 2)) {
			$(this).stop().animate({volume: 0.0}, 2000);
		}
		// console.log(this.currentTime, this.volume);
	});
});