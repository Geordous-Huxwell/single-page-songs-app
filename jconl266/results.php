<?php
require_once './main.php';

// grab filters
$filter = "none";
$filterVal= "all";
foreach ($_GET as $key=>$value){
    if ($value){
        $filter = $key;
        $filterVal = $value;
    }
}

function generateSongRows($songsArray, $artistDB, $genreDB){
    
    foreach ($songsArray as $song){
        // echo json_encode($song);
        $artist = $artistDB->getArtistName($song["artist_id"]);
        $genre = $genreDB->getGenreName($song["genre_id"]);
        ?>
        <tr>
            <td class="song-title"><?=$song["title"]?></td>
            <td class="center-data"><?=$artist?></td>
            <td class="center-data"><?=$song["year"]?></td>
            <td class="center-data"><?=$genre?></td>
            <td class="center-data"><?=$song["popularity"]?></td>
            <td class="center-data"><?=$song["song_id"]?></td>
            <td class="center-data"><a href="./addToFavorites.php?song_id=<?=$song["song_id"]?>">Add</a></td>
            <td class="center-data"><a href="./index.php?title=<?=$song["title"]?>">View</a></td>
        </tr>
        <?php
    }
}
?>
<style>
h1{
    width: 60px;
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
    /* overflow-y: auto; */
}

td {
    padding: 4px 4px;
}

th {
    /* width: 100px; */
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

tbody {
    /* display: block; */
    /* overflow:auto; */
    /* height:300px; */
    /* width:100%; */
}

/* scrollable table css from
https://www.w3docs.com/snippets/html/how-to-create-a-table-with-a-fixed-header-and-scrollable-body.html */
.scroll-table {
    overflow-y: auto;
    height: 300px;
}

thead th {
    position: sticky;
    top: 0;
}

button {
    margin-left: 15px;
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
</style>
<body>
    <?=generateHeader();?>
    <article>
        <h1>Songs</h1>
        <h4 class="filter">Results filtered by <?=$filter?>: <?=$filterVal?> <form><button fromaction="./results.php">Clear</button></form></h4>
        <div class="scroll-table">
        <table>
            <thead>
                
                    <th>Title</th>
                    <th>Artist</th>
                    <th>Year</th>
                    <th>Genre</th>
                    <th>Popularity</th>
                    <th>Song ID</th>
                    <th style="max-width: 75px">Add to Favourites</th>
                    <th>Details</th>
                
            </thead>
            <tbody>
            <?php
            // search by title
            if (isset($_GET['title']) && !empty($_GET['title'])){
                generateSongRows($songDB->filterSongs($_GET['title']), $artistDB, $genreDB);
            }
            // search by artist
            elseif (isset($_GET['artist']) && !empty($_GET['artist'])){
                $artistID = $artistDB->getArtistID($_GET['artist']);
                generateSongRows($songDB->getAllByArtist($artistID), $artistDB, $genreDB);
            }
            // TODO: Harshad - implement search by genre based on how search by artist works

            // search by year
            elseif (isset($_GET['year']) && !empty($_GET['year'])){
            
                if (isset($_GET['yearOperator']) && ($_GET['yearOperator'] == 'before')){
                    generateSongRows($songDB->getAllBeforeYear($_GET['year']), $artistDB, $genreDB);
                }
                elseif (isset($_GET['yearOperator']) && ($_GET['yearOperator'] == 'after')){
                    generateSongRows($songDB->getAllAfterYear($_GET['year']), $artistDB, $genreDB);
                }
                else {
                    generateSongRows($songDB->getAllByYear($_GET['year']), $artistDB, $genreDB);
                }
            }
            // search by popularity
            elseif (isset($_GET['popularity']) && ($_GET['popularity'] != 0)){
            
                if (isset($_GET['popOperator']) && ($_GET['popOperator'] == 'lower')){
                    generateSongRows($songDB->getAllLowerPop($_GET['popularity']), $artistDB, $genreDB);
                }
                elseif (isset($_GET['yearOperator']) && ($_GET['popOperator'] == 'greater')){
                    generateSongRows($songDB->getAllGreaterPop($_GET['popularity']), $artistDB, $genreDB);
                }
                else {
                    generateSongRows($songDB->getAllByPop($_GET['popularity']), $artistDB, $genreDB);
                }
            }
            else {
                generateSongRows($songDB->getAll(), $artistDB, $genreDB);
            }
            ?>
            </tbody>
        </table>
        </div>
        </article>
    <?=generateFooter();?>
</body>