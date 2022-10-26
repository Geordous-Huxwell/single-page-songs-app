<?php  
require_once './main.php';

// ensure sessions works on this page
session_start();
// if no favorites in session, initialize it to empty array
if ( !isset($_SESSION["Favorites"]) ) {
   $_SESSION["Favorites"] = [];
  }

// retrieve favorites array for this user session
$favorites = $_SESSION["Favorites"];

function generateSongRows($songsArray, $artistDB, $genreDB){
    
    foreach ($songsArray as $song){
        $artist = $artistDB->getArtistName($song["artist_id"]);
        $genre = $genreDB->getGenreName($song["genre_id"]);
        ?>
        <tr>
            <td class="song-title"><?=$song["title"]?></td>
            <td class="center-data"><?=$artist?></td>
            <td class="center-data"><?=$song["year"]?></td>
            <td class="center-data"><?=$genre?></td>
            <td class="center-data"><?=$song["popularity"]?></td>
            <?=$song["song_id"]?></td> 
            <td class="center-data"><a href="./removeFromFavorites.php?song_id=<?=$song["song_id"]?>">Remove</a></td>
            <td class="center-data"><a href="./songDetails.php?song_id=<?=$song["song_id"]?>">View</a></td>
        </tr>
        <?php
    }
}
?>
<style>
h1{
    width: fit-content;
    margin-left: auto;
    margin-right: auto;
}

.filter {
    width: fit-content;
    margin-left: auto;
    margin-right: auto;
    font-family: helvetica;
}

table {
    border-collapse: collapse;
    margin: auto;
    border: 5px rgb(115, 63, 11) solid;
    font-family: monospace;
    font-size: 14px;
}

td {
    padding: 4px 4px;
}

th {
    padding: 0px 4px;
    background-color: rgb(233, 217, 197);
}

td,
th {
    border: 2px black solid;
}

.center-data {
    text-align: center;
}

.song-title {
    max-width: 300px;
}

/* striped table css from https://www.w3schools.com/howto/howto_css_table_zebra.asp */
tr:nth-child(odd) {
  background-color: #f2f2f2;
}


/* scrollable table css from
https://www.w3docs.com/snippets/html/how-to-create-a-table-with-a-fixed-header-and-scrollable-body.html */
.scroll-table {
    overflow-y: auto;
    height: 400px;
}

thead th {
    position: sticky;
    top: 0;
}

button {
    color: white;
    background-color: cadetblue;
    padding: 5px 10px;
    border: 1px cadetblue solid;
    border-radius: 2px;
    box-shadow: 2px 2px black;
}

button:active {
    transform: translate(1px, 1px);
    box-shadow: none;
}

form {
    display: inline;
}

.fav-header{
    display: flex;
    width: fit-content;
    margin: auto;
}
</style>


<body>
    <?=generateHeader();?>
    <article>
        <div class="fav-header">
            <h1>Favorites</h1>
        </div>
        <div class="fav-header">
            <h4 class="filter"><form><button formaction="./emptyFavorites.php">Clear Favorites</button></form></h4>
        </div>
        <div class="scroll-table">
        <table>
            <thead>
                
                    <th>Title</th>
                    <th>Artist</th>
                    <th>Year</th>
                    <th>Genre</th>
                    <th>Popularity</th>
                    <th style="max-width: 75px">Remove from favourites</th>
                    <th>Details</th>
                
            </thead>
            <tbody>
            <?php
            
            if (isset($_SESSION['Favorites']) && !empty($_SESSION['Favorites']))
            {
              foreach ($_SESSION['Favorites'] as $songID)
              {
                 generateSongRows($songDB->getSongData($songID), $artistDB, $genreDB);
              }
            }
            ?>
