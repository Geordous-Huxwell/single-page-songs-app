<?php
require_once "./main.php";

function generateTopSongs($songDB){
    $topSongs = $songDB->getTopSongs();
    foreach($topSongs as $song){
        ?>
        <tr>
            <td><a href="./songDetails.php?song_id=<?=$song["song_id"]?>"><?=$song["title"]?></a></td>
            <td><?=$song["artist_name"]?></td>
            <td class="num-col"><?=$song["popularity"]?></td>
        </tr>
        <?php
    }
}

function generateLongestAcoustics($songDB)
{
    $topAcoustic = $songDB->getAcousticSongs();
    foreach($topAcoustic as $song){
        ?>
        <tr>
            <td><a href="./songDetails.php?song_id=<?=$song["song_id"]?>"><?=$song["title"]?></a></td>
            <td><?=$song["artist_name"]?></td>
            <td class="num-col"><?=number_format($song["acousticness"], 0)?></td>
            <td class="num-col"><?=convertTime($song["duration"])?></td>
        </tr>
        <?php
    }

}

function generateTopClub($songDB)
{
    $topClub = $songDB->getTheClub();
    foreach($topClub as $song){
        ?>
        <tr>
            <td><a href="./songDetails.php?song_id=<?=$song["song_id"]?>"><?=$song["title"]?></a></td>
            <td><?=$song["artist_name"]?></td>
            <td class="num-col"><?=number_format($song["CLUBINESS"], 0)?></td>
        </tr>
        <?php
    }
}

function generateRunningSong($songDB)
{
    $topRun = $songDB->getRunningSong();
    foreach($topRun as $song){
        ?>
        <tr>
            <td><a href="./songDetails.php?song_id=<?=$song["song_id"]?>"><?=$song["title"]?></a></td>
            <td><?=$song["artist_name"]?></td>
            <td class="num-col"><?=number_format($song["RUNNINESS"],0)?></td>
        </tr>
        <?php
    }
}

function generateStudying($songDB)
{
    $topStudy = $songDB->getStudying();
    foreach($topStudy as $song){
        ?>
        <tr>
            <td><a href="./songDetails.php?song_id=<?=$song["song_id"]?>"><?=$song["title"]?></a></td>
            <td><?=$song["artist_name"]?></td>
            <td class="num-col"><?=number_format($song["STUDINESS"], 0)?></td>
        </tr>
        <?php
    }
}

function generateTopArtists($artistDB){
    $topArtists = $artistDB->getTopArtists();
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
            <td><a href="./songDetails.php?song_id=<?=$song["song_id"]?>"><?=$song["title"]?></a></td>
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

h1, .table-title {
    font-family: helvetica;
}

#description {
    text-align: center;
    border: 3px black solid;
    border-radius: 5px;
    width: fit-content;
    margin: 20px auto;
    padding: 10px;
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



.row-2 {
    margin-top: -30px;
}

.row-3 {
    margin-top: -110px;
}

.row-4 {
    margin-top: -25px;
}

table {
    border-collapse: collapse;
    margin: 15px auto;
    border: 5px rgb(115, 63, 11) solid;
    font-family: monospace;
    font-size: 14px;
}

.table-title {
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
    padding: 4px;
    background-color: rgb(233, 217, 197);
    font-weight: 600;
    font-size: 16px;
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
                    <th class="num-col">Duration</th>
                </thead>
                <?php generateLongestAcoustics($songDB); ?>
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