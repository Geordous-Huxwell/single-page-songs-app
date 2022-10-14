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
            <!-- <td><form><button formaction="./addToFavorites.php?song_id=<?=$song["song_id"]?>">Add</button></form></td> -->
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
    <h4>Filter: </h4>
    <table>
        <th>Title</th>
        <th>Artist</th>
        <th>Year</th>
        <th>Genre</th>
        <th>Popularity</th>
        <th>Song ID</th>
        <th><button>Add to Favourites</button></th>
        <th><button>Details</button></th>
        <?php generateSongRows($songDB->getAll(), $artistDB, $genreDB); ?>
    </table>
</html>