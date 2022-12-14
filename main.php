<?php
require_once './includes/config.inc.php';
require_once './includes/dbClasses.php';

$conn = DatabaseHelper::createConnection(array(DBCONNSTRING, DBUSER, DBPASS));
$songDB = new SongDB($conn);
$artistDB = new ArtistDB($conn);
$genreDB = new GenreDb($conn);
$typeDB = new TypeDb($conn);

if (isset($_GET['song_id']) && !empty($_GET['song_id'])){
  $songID = $_GET['song_id'];
}
else {
  $songID = rand(1001, 1318);
  }



$songData = $songDB->getSongData($songID)[0];



// $typeData = $typeDB -> getTypeData($typeData)[0]; 

$title = $songData["title"];

$artistID = $songData["artist_id"];
$artist = $artistDB->getArtistName($artistID);

$genreID = $songData["genre_id"];
$genre = $genreDB -> getGenreName($genreID);

$typeID = $artistDB -> getTypeId($artistID); 
$type = $typeDB -> getTypeName($typeID);


$year = $songData["year"];
$seconds = $songData["duration"];
$duration = convertTime($seconds);
$bpm = $songData["bpm"];
$energy = $songData["energy"];
$danceability = $songData["danceability"];
$liveness = $songData["liveness"];
$valence = $songData["valence"];
$acousticness = $songData["acousticness"];
$speechiness = $songData["speechiness"];
$popularity = $songData["popularity"];
$metrics = $songDB->getSongMetrics($songID)[0];

function convertTime($seconds){
  
  $minutes = floor($seconds/60);
  $seconds = $seconds % 60;
  $seconds = sprintf("%'02s", $seconds); //add leading 0 if single digit result from above computation
  if (!$seconds){ //handle case of no remainder
    $seconds = "00";
  }
  return $minutes . ":" . $seconds;
}

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
        <link rel="stylesheet" href="./css/style.css">
      </head>

      <header> COMP 3512 Assign1
          <h4>Joel Conley, Harshad Krishnaraj</h4>
      </header>

      <style>
  /* Some navbar css from https://www.w3schools.com/howto/howto_js_topnav.asp */
  .topnav {
    display:block;
    width: fit-content;
    margin: auto;
    font-family: helvetica;
    font-weight: bold;
  }
  
  .topnav a.home, a.sPage, a.search, a.result, a.fav
  {
    display: inline-block;
    align-items: center;
    justify-content: center;
    border-radius: 200px;
    color: #f2f2f2;
    text-align: center;
    padding: 20px 24px;
    text-decoration: none;
    font-size: 17px;
    border: 2px black solid;
    /* text stroke from https://css-tricks.com/adding-stroke-to-web-text/ */
    -webkit-text-stroke-width: 1px;
    -webkit-text-stroke-color: black;
  }
  
  .topnav a.home:hover, a.sPage:hover, a.search:hover, a.result:hover, a.fav:hover
  {
    background-color: #ddd;
    color: black;
  }
  
  .topnav a.home, a.sPage, a.search, a.result, a.fav
  {
    background-color: rgb(203, 70, 70);
    color: white;
  }

.add-fav-div>form>button {
    border-radius: 5px;
    background-color: darkseagreen;
    padding: 5px;
    box-shadow: 2px 2px;
}

.add-fav-div {
    display: flex;
    width: fit-content;
    margin: auto;
}
.add-fav-div>form>button:hover {
  cursor: pointer;
  background-color: #1f70f2;
  color: azure;
  font-weight: 600;
}

.add-fav-div>form>button:active {
    box-shadow: none;
    transform: translate(2px, 2px);
}

  </style>

      <div class="topnav">
        <a class="result" href="./rankings.php">Rankings</a>
        <a class="sPage" href="./results.php">Songs</a>
        <a class="search" href="./search.php">Search</a>
        <a class="home" href="./songDetails.php">Random</a>
        <a class="fav" href="./favorites.php">Favourites</a>
        <br>
        <br>
      </div>
          
<?php
    }
    
    function generateFooter()
    {
      ?>
       <br>
    <header> COMP 3512 Assignment 1
          <h4>
            <a href="https://github.com/Geordous-Huxwell?tab=repositories"
              target="blank" class="Jc">
              Joel Conley </a>,
            <a href="https://github.com/Hkrishnaraj?tab=repositories"
              target="blank" class="HK">
            Harshad Krishnaraj </a></h4>
            <a href="https://github.com/Geordous-Huxwell/single-page-songs-app.git"
              target="blank">
            Github Repo
          </a>
      </header>

      <?php
    }

function generateArtists($artistData){
  
  foreach ($artistData as $artist){
    echo "<option value='".$artist['artist_name']."'>".$artist['artist_name']."</option>";
  }
}
 
function generateGenres($genreData){
  
  foreach ($genreData as $genre){
    echo "<option value='".$genre['genre_name']."'>".$genre['genre_name']."</option>";
  }
}

function generateTitles($songData){
  foreach ($songData as $song){
    echo "<option value='".$song['title']."'>";
  }
}
?>

  
  
   