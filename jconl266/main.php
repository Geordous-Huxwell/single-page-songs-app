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
//  echo json_encode($artistDB->getArtistName(75));
//  echo json_encode($artistDB->getAll());

$genreDB = new GenreDb($conn); 
//  echo json_encode($genreDB->getGenreName(25));
//  echo json_encode($genreDB->getAll());

$typeDB = new TypeDb($conn);
// echo json_encode($typeDB->getType(75));
// echo json_encode($typeDB->getAll());



$title = $songData["title"];

$artistID = $songData["artist_id"];
$artist = $artistDB->getArtistName($artistID);


// $artistType = "artistType";
$artistType = $songData["artist_id"];
$artistType = $typeDB -> getType($artistType); 



// $genre = "Genre";
$genre = $songData["genre_id"];
 $genre = $genreDB -> getGenreName($genre); 


 
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

function generateHeader()
    {
      ?>
      <!-- HTML boilerplate from https://www.freecodecamp.org/news/basic-html5-template-boilerplate-code-example/ -->
      <!DOCTYPE html>
      <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>COMP 3512 Assign1</title>
        <link rel="stylesheet" href="css/style.css">
      </head>

      <header> COMP 3512 Assign1
          <h4>Joel Conley, Harshad Krishnaraj</h4>
      </header>
      
    
<?php
    }
    function generateFooter()
    {
      ?>
      <!-- TODO: Harshad - make the header element into a function for use on each 
       page, maybe add some styling as well -->
    <header> COMP 3512 Assign1
          <h4>Joel Conley, Harshad Krishnaraj</h4>
      </header>

      <?php   
    }

?>
  
  
   