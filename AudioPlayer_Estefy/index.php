<?php
  // connexion à la base de données
include 'include/connexion.php';

  // tableau Json avec les données dans music
$req = $bdd->query('SELECT * FROM music');
$musics = $req->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Estefy | Music Player</title>
  
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <script>
  var musics = <?= json_encode($musics) ?>;
  var indexRunningTrack = 0;

  var audio = new Audio(musics[indexRunningTrack]["file_path"]);

  // volume par défaut fonctionne
  audio.volume = 1;
</script>
</head>

<body>
  <div class="container">
  <div id="player" >
    <div class="album">
      <form method="get">
        <a class="heart" target="_blank" href="include/likespost.php?likes=<?php echo $musics[0]["id"]?>">
          <i class="fas fa-heart fa-2x"> 
            <span id="likesNumber"> <?=$musics[0]['likes']?> </span>
          </i>
        </a>
      </form>
      <img id="cover" src="<?= $musics[0]['cover'] ?>" width="100%" height="100%">
    </div>
    <div class="info">
      <div id="default-bar">
        <div id="time-current">0:00</div>
        <div id="time-total"><?= $musics[0]['time'] ?></div>
        <div id="progress-bar"></div>
      </div>
      <div class="currently-playing">
        <h2 id="song-name"> <?= $musics[0]['title'] ?> </h2>
        <h3 id="artist-name"> <?= $musics[0]['author'] ?> </h3>
      </div>

      <div class="controls">
        <div class="option"><i class="fas fa-bars"></i></div>
        <div class="volume muted"><i class="fas fa-volume-up"></i></div>
        <div class="previous" onclick="PlayPreviousSongOnClick()"><i class="fas fa-backward"></i></div>
        <div class="play"><i class="fas fa-play"></i></div>
        <div class="pause"><i class="fas fa-pause"></i></div>
        <div class="next" onclick="PlayNextSongOnClick()"><i class="fas fa-forward"></i></div>
        <div class="shuffle" onclick="ShuffleSongOnClick()"><i class="fas fa-random"></i></div>
        <div class="repeat"><i class="fas fa-redo-alt"></i></div>
      </div>
    </div>
  </div>
</div>

<div class="disqus_container">
<div id="disqus_thread"></div>
</div>

<script>

//bouton next
function PlayNextSongOnClick() {
  var ElsName =document.getElementById("artist-name");
  var ElsTitle = document.getElementById("song-name");
  var ElsDuration = document.getElementById("time-total");
  var Elscovers = document.getElementById("cover");

  indexRunningTrack = indexRunningTrack+1;
  ElsName.innerHTML = musics[indexRunningTrack]['author'];
  ElsTitle.innerHTML = musics[indexRunningTrack]['title'];
  ElsDuration.innerHTML = musics[indexRunningTrack]['time'];
  Elscovers.src = musics[indexRunningTrack]['cover'];

  audio.src = musics[indexRunningTrack]["file_path"];
  audio.load();
  audio.play();
}

//changement automatique de chanson à la fin de la précédente
audio.onended = function() {
  PlayNextSongOnClick();
  audio.play();
};

//bouton previous
function PlayPreviousSongOnClick() {
  var ElsName =document.getElementById("artist-name");
  var ElsTitle = document.getElementById("song-name");
  var ElsDuration = document.getElementById("time-total");
  var Elscovers = document.getElementById("cover");

  indexRunningTrack = indexRunningTrack-1;
  ElsName.innerHTML= musics[indexRunningTrack]['author'];
  ElsTitle.innerHTML= musics[indexRunningTrack]['title'];
  ElsDuration.innerHTML = musics[indexRunningTrack]['time'];
  Elscovers.src = musics[indexRunningTrack]['cover'];

  audio.src = musics[indexRunningTrack]["file_path"];
  audio.load();
  audio.play();
}

//bouton shuffle
function ShuffleSongOnClick() {
  var numberMusic= Math.floor(Math.random() * (musics.length - 0 + 1)) + 0;
  var ElsName =document.getElementById("artist-name");
  var ElsTitle = document.getElementById("song-name");
  var ElsDuration = document.getElementById("time-total");
  var Elscovers = document.getElementById("cover");
		
  ElsName.innerHTML= musics[numberMusic]['author'];
  ElsTitle.innerHTML= musics[numberMusic]['title'];
  ElsDuration.innerHTML = musics[numberMusic]['time'];
  Elscovers.src = musics[numberMusic]['cover'];

  audio.src = musics[numberMusic]["file_path"];
  audio.load();
  if (!audio.pause){
    audio.play();
  }
}

</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.js"></script>

<script  src="js/index.js"></script>

<script>

/**
*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
/*
var disqus_config = function () {
this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};
*/
(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');
s.src = 'https://https-192-168-1-5-tests-audioplayer-estefy.disqus.com/embed.js';
s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>

                            
</body>

</html>
