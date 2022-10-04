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
  "dance"=>$danceability, 
  "liveness"=>$liveness, 
  "valence"=>$valence, 
  "acoustic"=>$acousticness, 
  "speech"=>$speechiness, 
  "popularity"=>$popularity
];
// echo json_encode($metrics);
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
    <!-- TODO: Harshad - make the header element into a function for use on each 
    page, maybe add some styling as well -->
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
            <!-- TODO: Harshad - make this list into a function and style the list items-->
            <li>Year: <?=$year?></li>
            <li>Length: <?=$duration?></li>
            <li>Genre: <?=$genre?></li>
            <li>Type: <?=$artistType?></li>
          </ul>
          
        </details>
        <div class="grid">
          
          <?php generateMetrics($metrics); ?>        
          
        </div>
    </article>
    <!-- TODO: Harshad - refer to the assignment instructions for what content 
    should be in the footer and build a function to generate it so it can be 
    injected into all pages -->
    <footer>write footer-generating function</footer>
  </body>
</html>