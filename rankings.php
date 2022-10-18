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
<?php
require_once "./main.php";

function generateTopSongs($songDB){
    $topSongs = $songDB->getTopSongs();
}

generateHeader();
?>
<style>
.rankings-grid {
    display: grid;
    grid-template-rows: repeat(2, 3fr);
    grid-template-columns: repeat(4, 2fr);
}
.ranking-table {
    border: 1px red solid;

}
</style>
<article>
    <h1>Song Rankings</h1>
    <h4>description lorem ipsum</h4>
    <div class="rankings-grid">
        <div class="ranking-table">
            <div class="table-title">Top Songs</div>
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
        </div>
        <div class="ranking-table">
            <div class="table-title">In Da Club</div>
        </div>
        <div class="ranking-table">
            <div class="table-title">Running Music</div>
        </div>
        <div class="ranking-table">
            <div class="table-title">Study Time</div>
        </div>
    </div>
</article>
<?php
generateFooter();
?>