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
SELECT title, artist_name, popularity, COUNT(artist_name) AS artist_count
FROM songs INNER JOIN artists on songs.artist_id=artists.artist_id
GROUP BY artist_name
HAVING artist_count=1
ORDER BY popularity DESC
LIMIT 10; -->


<!-- AT DA CLUB
SELECT song_id, title, artist_name, danceability, ((danceability1.6) + (energy1.4)) AS CLUBINESS             
FROM songs INNER JOIN artists on songs.artist_id=artists.artist_id   WHERE Danceability > 80      
ORDER BY Clubiness DESC LIMIT 10; -->

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
            <td class="num-col"><?=$song["popularity"]?></td>
        </tr>
        <?php
    }
}

function generateTopAcoustics($songDB)
{
    $topAcoustic = $songDB->getAcousticSong();
    foreach($topAcoustic as $acoustic){
        ?>
        <tr>
            <td><?=$acoustic["title"]?></td>
            <td><?=$acoustic["artist_name"]?></td>
            <td class="num-col"><?=number_format($acoustic["acousticness"], 0)?></td>
        </tr>
        <?php
    }

}

function generateTopClub ($songDB)
{
    $topClub = $songDB->getTheClub();
    foreach($topClub as $club){
        ?>
        <tr>
            <td><?=$club["title"]?></td>
            <td><?=$club["artist_name"]?></td>
            <td class="num-col"><?=number_format($club["CLUBINESS"], 0)?></td>
        </tr>
        <?php
    }
}

function generateRunningSong($songDB)
{
    $topRun = $songDB->getRunningSong();
    foreach($topRun as $run){
        ?>
        <tr>
            <td><?=$run["title"]?></td>
            <td><?=$run["artist_name"]?></td>
            <td class="num-col"><?=number_format($run["RUNNINESS"],0)?></td>
        </tr>
        <?php
    }
}

function generateStudying($songDB)
{
    $topStudy = $songDB->getStudying();
    foreach($topStudy as $study){
        ?>
        <tr>
            <td><?=$study["title"]?></td>
            <td><?=$study["artist_name"]?></td>
            <td class="num-col"><?=number_format($study["STUDINESS"], 0)?></td>
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
            <td class="num-col"><?=$artist["artist_count"]?></td>
        </tr>
        <?php
    }
}

function generateTopGenres($genreDB) {
    $topGenres = $genreDB->getTopGenres();
    
    foreach($topGenres as $genre){
        ?>
        <tr>
            <td><?=$genre["genre_name"]?></td>
            <td class="num-col"><?=$genre["genre_count"]?></td>
        </tr>
        <?php
    }
}

function generateOneHitWonders($songDB) {
    $oneHits = $songDB->getOneHitWonders();
    
    foreach($oneHits as $song){
        ?>
        <tr>
            <td><?=$song["title"]?></td>
            <td><?=$song["artist_name"]?></td>
            <td class="num-col"><?=$song["popularity"]?></td>
        </tr>
        <?php
    }
}

?>

<style>
h1{
    width: fit-content;
    margin:30px auto;
    font-size: 42px;
}

#description {
    text-align: center;
}

.rankings-grid {
    display: grid;
    grid-template-rows: repeat(4, 1fr);
    grid-template-columns: repeat(2, 2fr);
    width: 900px;
    margin: auto;
    gap: 50px;
    justify-items: center;
}

.ranking-table {
    /* border: 1px red solid; */
}

.row-2 {
    margin-top: -30px;
}

.row-3 {
    margin-top: -110px;
}

.row-4 {
    margin-top: -50px;
}

table {
    /* margin-top: 15px; */
    border-collapse: collapse;
    margin: 15px auto;
    border: 5px rgb(115, 63, 11) solid;
    font-family: monospace;
    font-size: 14px;
}

.table-title {
    /* border: 1px blue solid; */
    width: fit-content;
    margin: auto;
    font-weight: 900;
    font-size: 24px;
    
}

.num-col, td {
    text-align: center;
}

td {
    padding: 4px 8px;
    font-weight: 300;
}

th {
    /* width: 100px; */
    padding: 4px;
    background-color: rgb(233, 217, 197);
}

td,
th {
    border: 2px black solid;
    max-width: 150px;
}

/* striped table css from https://www.w3schools.com/howto/howto_css_table_zebra.asp */
tr:nth-child(odd) {
  background-color: #f2f2f2;
}

.num-col {
    max-width: 75px;
}


</style>

<?= generateHeader(); ?>
  
<article>
    <h4 id="description"><?= generateFooter(); ?></h4>
    <h1>Rankings</h1>
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
            <div class="table-title">One Hit Wonders</div>
            <table>
                <thead>
                    <th>Title</th>
                    <th>Artist</th>
                    <th>Pop.</th>
                </thead>
                <?php generateOneHitWonders($songDB); ?>
            </table>
        </div>
        <div class="ranking-table row-2">
            <div class="table-title">Top Artists</div>
            <table>
                <thead>
                    <th>Artist</th>
                    <th>Song Count</th>
                </thead>
                <?php generateTopArtists($artistDB); ?>
            </table>
        </div>
        <div class="ranking-table row-2">
            <div class="table-title">Top Genres</div>
            <table>
                <thead>
                    <th>Genre</th>
                    <th>Song Count</th>
                </thead>
                <?php generateTopGenres($genreDB); ?>

            </table>
        </div>
        <div class="ranking-table row-3">
            <div class="table-title">Longest Acoustics</div>
            <table>
                <thead>
                    <th>Title</th>
                    <th>Artist</th>
                    <th class="num-col">Acoustic Score</th>
                </thead>
                <?php generateTopAcoustics($songDB); ?>
            </table>
        </div>
        <div class="ranking-table row-3">
            <div class="table-title">Club Music</div>
            <table>
                <thead>
                    <th>Title</th>
                    <th>Artist</th>
                    <th class="num-col">Club Score</th>
                </thead>
                <?php generateTopClub($songDB); ?>
            </table>
        </div>
        <div class="ranking-table row-4">
            <div class="table-title">Running Music</div>
            <table>
                <thead>
                    <th>Title</th>
                    <th>Artist</th>
                    <th class="num-col">Exercise Score</th>
                </thead>
                <?php generateRunningSong($songDB); ?>
            </table>
        </div>
        <div class="ranking-table row-4">
            <div class="table-title">Study Time</div>
            <table>
                <thead>
                    <th>Title</th>
                    <th>Artist</th>
                    <th class="num-col">Study Score</th>
                </thead>
                <?php generateStudying($songDB); ?>
            </table>
        </div>
    </div>
</article>
<?php
generateFooter();
?>