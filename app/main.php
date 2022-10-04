<?php
require_once 'config.inc.php';
require_once 'dbClasses.php';

$conn = DatabaseHelper::createConnection(array(DBCONNSTRING, DBUSER, DBPASS));
$songDB = new SongDB($conn);
// echo json_encode($songDB->getAll());
$randomSongID = rand(1001, 1318);
$songData = $songDB->getSongData($randomSongID)[0];
// echo json_encode($songData);

$artistDB = new ArtistDB($conn);
// echo json_encode($artistDB->getArtistName(75));
// echo json_encode($artistDB->getAll());


$title = $songData["title"];
$artistID = $songData["artist_id"];
$artist = $artistDB->getArtistName($artistID);
$artistType = "Artist Type";
$genre = "Genre";
$year = $songData["year"];
$seconds = $songData["duration"];
$minutes = floor($seconds/60);
$seconds = $seconds % 60;
$duration = $minutes . ":" . $seconds;
$bpm = $songData["bpm"];
$energy = $songData["energy"];
$danceability = $songData["danceability"];
$liveness = $songData["liveness"];
$valence = $songData["valence"];
$acousticness = $songData["acousticness"];
$speechiness = $songData["speechiness"];
$popularity = $songData["popularity"];
$metrics = [
  "bpm"=>$bpm, 
  "energy"=>$energy, 
  "danceability"=>$danceability, 
  "liveness"=>$liveness, 
  "valence"=>$valence, 
  "acousticness"=>$acousticness, 
  "speechiness"=>$speechiness, 
  "popularity"=>$popularity
];
// $metrics = array_slice($songData, 5, 12, true);
echo json_encode($metrics);
function generateMetrics($metrics) {
  foreach($metrics as $metric=>$value){
?>
  <div class="circle">
    <div class="datatype"><?=$metric?></div> 
    <div class="value"><?=$value?></div>
  </div>
  
<?php
}
}
?>
<!-- HTML boilerplate from https://www.freecodecamp.org/news/basic-html5-template-boilerplate-code-example/ -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>COMP 3512 Assign1</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
	<header>COMP 3512 Assign1
        <h4>Joel Conley, Harshad Krishnaraj</h4>
    </header>
    <article>
        <!-- <h2>Song Info</h2> -->
        <details>
          <summary>
            <span class="title"><?=$title?></span>
            <span class="artist"><?=$artist?></span>
          </summary>
          <ul>
            <li>Year: <?=$year?></li>
            <li>Length: <?=$duration?></li>
            <li>Genre: <?=$genre?></li>
            <li>Type: <?=$artistType?></li>
          </ul>
          
        </details>
        <div class="grid">
          
          <?php generateMetrics($metrics); ?>        
          <!-- <div>2</div>
          <div>3</div>
          <div>4</div>
          <div>5</div>
          <div>6</div>
          <div>7</div>
          <div>8</div> -->
        </div>
    </article>
    <footer>write footer-generating function</footer>
  </body>
</html>