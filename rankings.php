<!-- MOST POPULAR SONGS
 SELECT song_id, title, artist_name, popularity
FROM songs INNER JOIN artists on songs.artist_id=artists.artist_id
ORDER BY popularity DESC
LIMIT 10; -->

<!-- TOP ARTISTS
 SELECT title, artist_name, COUNT(artist_name) AS artist_count
FROM songs INNER JOIN artists on songs.artist_id=artists.artist_id
GROUP BY artist_name
ORDER BY artist_count DESC
LIMIT 10; -->

<!-- TOP GENRES
 SELECT title, genre_name, COUNT(genre_name) AS genre_count
FROM songs INNER JOIN genres on songs.genre_id=genres.genre_id
GROUP BY genre_name
ORDER BY genre_count DESC
LIMIT 10; -->

<!-- ONE HIT WONDERS
SELECT artist_name, popularity, COUNT(artist_name) AS artist_count
FROM songs INNER JOIN artists on songs.artist_id=artists.artist_id
GROUP BY artist_name
HAVING artist_count=1
ORDER BY popularity DESC
LIMIT 10; -->


<!-- AT DA CLUB
SELECT song_id, title, artist_name, danceability, SUM( (danceability*1.6) + 
               (energy * 1.4)) AS CLUBINESS
               FROM songs INNER JOIN artists on songs.artist_id=artists.artist_id
               WHERE danceability > 80
               ORDER BY CLUBINESS DESC
               LIMIT 10; -->

<!-- RUNNINESS
SELECT song_id, title, artist_name, bpm, ((valence*1.6) + (energy*1.3)) AS RUNNINESS             
      FROM songs INNER JOIN artists on songs.artist_id=artists.artist_id WHERE bpm >= 120 AND bpm <= 125      
      ORDER BY Runniness DESC LIMIT 10; -->

 <!-- STUDINESS
SELECT song_id, title, artist_name, bpm, speechiness, ((acousticness*0.8) + (100 - speechiness) + (100 - valence)) AS STUDINESS             
      FROM songs INNER JOIN artists on songs.artist_id=artists.artist_id  
       WHERE bpm >= 100 AND bpm <= 115 AND speechiness <=20      
       ORDER BY Studiness DESC LIMIT 10; -->
<?php
require_once "./main.php";

function generateTopSongs($songDB){
    $topSongs = $songDB->getTopSongs();
    // echo json_encode($topSongs);
    foreach($topSongs as $song){
        ?>
        <tr>
            <td><?=$song["title"]?></td>
            <td><?=$song["artist_name"]?></td>
            <td><?=$song["popularity"]?></td>
        </tr>
        <?php
    }
}

function generateTopArtists($artistDB){
    $topArtists = $artistDB->getTopArtists();
    // echo json_encode($topSongs);
    foreach($topArtists as $artist){
        ?>
        <tr>
            <td><?=$artist["artist_name"]?></td>
            <td><?=$artist["artist_count"]?></td>
        </tr>
        <?php
    }
}
generateHeader();
?>
<style>
.rankings-grid {
    display: grid;
    grid-template-rows: repeat(4, 3fr);
    grid-template-columns: repeat(2, 2fr);
    width: 900px;
    margin: auto;
    gap: 50px;
    justify-items: center;
}
.ranking-table {
    border: 1px red solid;
}

td {
    font-weight: 300;
}

.table-title {
    border: 1px blue solid;
    width: fit-content;
    margin: auto;
}
</style>
<article>
    <h1>Song Rankings</h1>
    <h4>description lorem ipsum</h4>
    <div class="rankings-grid">
        <div class="ranking-table">
            <div class="table-title">Top Songs</div>
            <!-- TODO: make whole table head generation part of functions -->
            <table>
                <thead>
                    <th>Title</th>
                    <th>Artist</th>
                    <th>Pop.</th>
                </thead>
                <?php generateTopSongs($songDB); ?>
            </table>
        </div>
        <div class="ranking-table">
            <div class="table-title">Top Artists</div>
            <table>
                <thead>
                    <th>Artist</th>
                    <th>Song Count</th>
                </thead>
                <?php generateTopArtists($artistDB); ?>
            </table>
        </div>
        <div class="ranking-table">
            <div class="table-title">Top Genres</div>
            <table>
                <thead>
                    <th>Artist</th>
                    <th>Song Count</th>
                </thead>
            </table>
        </div>
        <div class="ranking-table">
            <div class="table-title">One Hit Wonders</div>
            <table>
                <thead>
                    <th>Title</th>
                    <th>Artist</th>
                    <th>Pop.</th>
                </thead>
            </table>
        </div>
        <div class="ranking-table">
            <div class="table-title">Longest Acoustics</div>
            <table>
                <thead>
                    <th>Title</th>
                    <th>Artist</th>
                    <th>acousticness</th>
                </thead>
            </table>
        </div>
        <div class="ranking-table">
            <div class="table-title">In Da Club</div>
            <table>
                <thead>
                    <th>Title</th>
                    <th>Artist</th>
                    <th>Clubiness</th>
                </thead>
            </table>
        </div>
        <div class="ranking-table">
            <div class="table-title">Running Music</div>
            <table>
                <thead>
                    <th>Title</th>
                    <th>Artist</th>
                    <th>Runniness</th>
                </thead>
            </table>
        </div>
        <div class="ranking-table">
            <div class="table-title">Study Time</div>
            <table>
                <thead>
                    <th>Title</th>
                    <th>Artist</th>
                    <th>Studiness</th>
                </thead>
            </table>
        </div>
    </div>
</article>
<?php
generateFooter();
?>