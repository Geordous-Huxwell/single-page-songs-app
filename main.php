<?php
require_once './includes/config.inc.php';
require_once './includes/dbClasses.php';

$conn = DatabaseHelper::createConnection(array(DBCONNSTRING, DBUSER, DBPASS));
$songDB = new SongDB($conn);
$artistDB = new ArtistDB($conn);
$genreDB = new GenreDb($conn);
$typeDB = new TypeDb($conn);

if (isset($_GET['title']) && !empty($_GET['title'])){
  $songID = $songDB->getSongID($_GET['title']);
}
else {
  $songID = rand(1001, 1318);
  }


$songData = $songDB->getSongData($songID)[0];

$title = $songData["title"];
$artistID = $songData["artist_id"];
$artist = $artistDB->getArtistName($artistID);
$artistType = $songData["artist_id"];
$artistType = $typeDB -> getType($artistType);
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
    border: green 1px solid;
  }
  
  /* Style the links inside the navigation bar */
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
  
  /* Change the color of links on hover */
  .topnav a.home:hover, a.sPage:hover, a.search:hover, a.result:hover, a.fav:hover
  {
    background-color: #ddd;
    color: black;
  }
  
  /* Add a color to the active/current link */
  .topnav a.home, a.sPage, a.search, a.result, a.fav
  {
   /* background-color: rgb(115, 63, 11); */
    background-color: rgb(203, 70, 70);
    color: white;
  }

  </style>

      <div class="topnav">
        <a class="home" href="./index.php">Random</a>
        <a class="sPage" href="./results.php">Songs</a>
        <a class="search" href="./search.php">Search</a>
        <a class="result" href="./rankings.php">Rankings</a>
        <a class="fav" href="./favorites.php">Favourites</a>
        <br>
        <br>
      </div>
          
<?php
    }
    function generateFooter()
    {
      ?>
      <!-- TODO: Harshad - make the header element into a function for use on each
       page, maybe add some styling as well -->
       <br>
    <header> COMP 3512 Assign1
          <h4> <a href="https://github.com/Geordous-Huxwell" target="blank" class="Jc"> Joel Conley </a>,
           <a href="https://github.com/Hkrishnaraj?tab=repositories"
          target="blank" class="HK">
            Harshad Krishnaraj </a></h4>
          <a href="https://github.com/Geordous-Huxwell/single-page-songs-app.git" target="blank">
            github repo link
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

  
  
   