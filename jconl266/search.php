<?php
require_once './main.php';
// echo json_encode($artistDB);
?>
<body>
    <header>inject header here</header>
        <article>
            <h2 class="search-box">Song Search</h2>
            <form action="./index.php" method="get"></form>
            <div class=row>
                <div class="column">
                    <label for="title">Song Title</label>
                    <input type="text" name="title">
                </div>
                <div class="column">
                    <label for="artist">Artist</label>
                    <input list="artists" name="artist" id="artist">
                    <datalist id="artists">
                    <?php generateArtists($artistDB->getAll()); ?>
                    
                        
                    </datalist>
                    <!-- <?php generateArtists($artistDB); ?> -->
                </div>
            </div>
        </article>
    <footer>inject footer here</footer>
</body>