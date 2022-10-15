<?php
require_once './includes/config.inc.php';
require_once './includes/dbClasses.php';

$conn = DatabaseHelper::createConnection(array(DBCONNSTRING, DBUSER, DBPASS));
$songDB = new SongDB($conn);
// echo json_encode($songDB->getAll());

// if (isset($_GET['title']) && !empty($_GET['title'])){
  // echo json_encode($_GET);
  // $songID = $songDB->getSongID($_GET['title']);
// }else {
  $songID = rand(1001, 1318);
// }

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
        <link rel="stylesheet" href="css/style.css">
      </head>

      <header> COMP 3512 Assign1
          <h4>Joel Conley, Harshad Krishnaraj</h4>
      </header>

      <style> 
      
      .topnav {

        display:inline;
        margin: 50px; 
        padding-left: 25%;
    padding-right: 25%;
    
    
    
        
    /* overflow: hidden; */
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
        <a class="home" href="https://www.w3schools.com/howto/howto_js_topnav.asp">Home</a>
        <a class="sPage" href="news">Songs</a>
      <a class="search"   href="contact">Search</a>
      <a class="result" href="about">Results </a>
      <a class="fav" href="about"> Favorites</a>
      <br>
      <br>
      
    
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
    echo "<option value='".$artist['artist_name']."'>";
  }
}
 
function generateGenres($genreData){
  
  foreach ($genreData as $genre){
    echo "<option value='".$genre['genre_name']."'>";
  }
}

function generateTitles($songData){
  foreach ($songData as $song){
    echo "<option value='".$song['title']."'>";
  }
}
?>

  
  
   