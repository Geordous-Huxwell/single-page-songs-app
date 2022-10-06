<?php
require_once './includes/config.inc.php';
require_once './includes/dbClasses.php';

$conn = DatabaseHelper::createConnection(array(DBCONNSTRING, DBUSER, DBPASS));
$songDB = new SongDB($conn);
// echo json_encode($songDB->getAll());
$randomSongID = rand(1001, 1318);
$songID = $randomSongID;
$songData = $songDB->getSongData($songID)[0];
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
$metrics = $songDB->getSongMetrics($songID)[0];

// echo json_encode($metrics);
function generateMetrics($metrics) {
  foreach($metrics as $metric=>$value){
?>
  <div class="circle">
    <div class="datatype"><?=$metric?></div> 
    <div class="value"><?=$value?></div>
    <!-- <progress class="value" value='<?=$value?>' max="100"><?=$value?></progress> -->
  </div>
  
<?php
  }
}
?>