<?php
require_once './main.php';

function generateSongRows($songsArray, $artistDB, $genreDB){
    
    foreach ($songsArray as $song){
        // echo json_encode($song);
        $artist = $artistDB->getArtistName($song["artist_id"]);
        $genre = $genreDB->getGenreName($song["genre_id"]);
        ?>
        <tr>
            <td><?=$song["title"]?></td>
            <td><?=$artist?></td>
            <td><?=$song["year"]?></td>
            <td><?=$genre?></td>
            <td><?=$song["popularity"]?></td>
            <td><?=$song["song_id"]?></td>
            <td><a href="./addToFavorites.php?song_id=<?=$song["song_id"]?>">Add</a></td>
            <td><a href="./index.php?title=<?=$song["title"]?>">Details</a></td>
        </tr>
        <?php
    }
}
?>

<html>
    <?php
    generateHeader();
    ?>
    <h1>Songs</h1>
    <h4>Filter: <?=json_encode($_GET)?></h4>
    <table>
        <th>Title</th>
        <th>Artist</th>
        <th>Year</th>
        <th>Genre</th>
        <th>Popularity</th>
        <th>Song ID</th>
        <th><button>Add to Favourites</button></th>
        <th><button>Details</button></th>
        <?php
        if (isset($_GET['title']) && !empty($_GET['title'])){
            generateSongRows($songDB->filterSongs($_GET['title']), $artistDB, $genreDB);
        }
        elseif (isset($_GET['artist']) && !empty($_GET['artist'])){
            $artistID = $artistDB->getArtistID($_GET['artist']);
            generateSongRows($songDB->getAllByArtist($artistID), $artistDB, $genreDB);
        }
        elseif (isset($_GET['year']) && !empty($_GET['year'])){
        
            if ($_GET['yearOperator'] == 'before'){
                generateSongRows($songDB->getAllBeforeYear($_GET['year']), $artistDB, $genreDB);
            }
            elseif ($_GET['yearOperator'] == 'after'){
                generateSongRows($songDB->getAllAfterYear($_GET['year']), $artistDB, $genreDB);
            }
            else {
                generateSongRows($songDB->getAllByYear($_GET['year']), $artistDB, $genreDB);
            }
        }
        elseif (isset($_GET['popularity']) && ($_GET['popularity'] != 0)){
        
            if ($_GET['popOperator'] == 'lower'){
                generateSongRows($songDB->getAllLowerPop($_GET['popularity']), $artistDB, $genreDB);
            }
            elseif ($_GET['popOperator'] == 'greater'){
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
    </table>
</html>