<?php
require './main.php';

?>
<html>
  
  <?php generateHeader(); ?>

    <article>
        <details open>
          <summary>
            <span class="title"><?=$title?></span>
            <span class="artist"><?=$artist?></span>
          </summary>
          <h3>
            <ul>
              <li>Year: <?=$year?></li>
              <li>Length: <?=$duration?></li>
              <li>Genre: <?=$genre?></li>
              <li>Type: <?=$type?></li>
            </ul>
          </h3>
        </details>
        <div class="grid">
          
          <?php generateMetrics($metrics); ?>
          
        </div>
        <div class="add-fav-div">
          <form method="get" action="./addToFavorites.php?song_id=<?=$songID?>">
            <button type='submit' name="song_id" value=<?=$songID?>>Add to Faves</button>
          </form>
        </div>
    </article>
  </body>
  <?php
    generateFooter();
    ?>
</html>