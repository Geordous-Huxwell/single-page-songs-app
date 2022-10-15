<?php
require_once './main.php';
// echo json_encode($artistDB);
?>
<body>
    <header>inject header here</header>
        <article>
            <h2 class="search-box">Song Search</h2>
            <form action="./results.php" method="get">
            <div class=row>
                <div class="column">
                    <label for="title">Song Title</label>
                    <input list="songs" name="title" id="title">
                    <datalist id="songs">
                    <?php generateTitles($songDB->getAll()); ?>
                    </datalist>
                </div>
                <div class="column">
                    <label for="artist">Artist</label>
                    <input list="artists" name="artist" id="artist">
                    <datalist id="artists">
                    <?php generateArtists($artistDB->getAll()); ?>
                    </datalist>
                </div>
                <div class="column">
                    <label for="genre">Genre</label>
                    <input list="genres" name="genre" id="genre">
                    <datalist id="genres">
                    <?php generateGenres($genreDB->getAll()); ?>
                    </datalist>
                </div>
                <div class="column">
                    <label for="year">Year</label>
                    <select name="year" id="year">
                        <option value="2016">2016</option>
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                    </select>
                    <input type="radio" id="before" name="yearOperator">
                    <label for="before">Before</label>
                    <input type="radio" id="after" name="yearOperator">
                    <label for="after">After</label>
                </div>
                <div class="column">
                    <label for="popularity">Popularity</label>
                    <input type="range" id="popularity" min="1" max="100" value="50">
                    <input type="radio" id="lower" name="popOperator">
                    <label for="before">Lower</label>
                    <input type="radio" id="greater" name="popOperator">
                    <label for="after">Greater</label>
                </div>
                <div class="column">
                    <button type="submit">Search</button>
                </div>
            </div>
            </form>
        </article>
    <footer>inject footer here</footer>
</body>