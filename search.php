<?php
require_once './main.php';
?>
<style>
    h2 {
        width: fit-content;
        margin-left: auto;
        margin-right: auto;
    }

    .search-box {
        display: grid;
        grid-template-columns: 1fr;
        grid-template-rows: 1fr 1fr 1fr 2fr 2fr 1fr;
        grid-row-gap: 20px;
        justify-items: center;
        width: fit-content;
    }
    .row{
        font-family: helvetica;
    }
    span {
        display: flex;
        margin-top: 10px;
        justify-content: center;
    }

    #search-article {
        width: 600px;
        margin: auto;
        display: grid;
        grid-template-columns: 1fr;
        grid-template-rows: 0.2fr 1fr;
        justify-items: center;
    }

    input, select {
        border-radius: 3px;
    }

    .pop-row {
        margin: 4px 0px;
        text-align: center;
    }

    button {
        color: white;
        background-color: black;
        padding: 5px 10px;
        border: 1px cadetblue solid;
        border-radius: 2px;
        box-shadow: 2px 2px black;
    }

    button:active {
        transform: translate(1px, 1px);
        box-shadow: none;
    }

</style>
<body>
    <?=generateHeader()?>
        <article id="search-article">
            <h2>Song Search</h2>
            <form action="./results.php" method="get">
            <div class=search-box>
                <div class="row">
                    <label for="title">Title</label>
                    <input list="songs" name="title" id="title">
                    <datalist id="songs">
                    <?php generateTitles($songDB->getAll()); ?>
                    </datalist>
                </div>
                <div class="row">
                    <label for="artist">Artist</label>
                    <select name="artist" id="artists">
                        <option value="none" selected disabled hidden></option>
                        <?php generateArtists($artistDB->getAll()); ?>
                    </select>
                </div>
                <div class="row">
                    <label for="genre">Genre</label>
                    <select name="genre" id="genres">
                        <option value="none" selected disabled hidden></option>
                        <?php generateGenres($genreDB->getAll()); ?>
                    </select>
                </div>
                <div class="row">
                    <label for="year">Year</label>
                    <select name="year" id="year">
                        <option value="none" selected disabled hidden></option>
                        <option value="2016">2016</option>
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                    </select>
                    <input type="radio" id="before" name="yearOperator" value="before">
                    <label for="before">Before</label>
                    <input type="radio" id="after" name="yearOperator" value="after">
                    <label for="after">After</label> <span>(inclusive of year selected)</span>
                </div>
                <div class="row pop-column">
                    <div class="pop-row">
                        <label for="popularity">Popularity</label>
                        <input type="range" id="popularity" name="popularity" min="0" max="100" value="0">
                    </div>
                    <div class="pop-row">
                        <input type="radio" id="lower" name="popOperator" value="lower">
                        <label for="before">Lower</label>
                        <input type="radio" id="greater" name="popOperator" value="greater">
                        <label for="after">Greater</label>
                    </div>
                </div>
                <div class="row">
                    <button type="submit">Search</button>
                </div>
            </div>
            </form>
        </article>
        <?=generateFooter()?>
</body>