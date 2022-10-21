<?php
require_once './main.php';

?>

<html>
  
  <?php generateHeader(); ?>

    <article>
        <details>
          <summary>
            <span class="title"><?=$title?></span>
            <span class="artist"><?=$artist?></span>
          </summary>
          <h3>
            <ul>
              <li>Year: <?=$year?></li>
              <li>Length: <?=$duration?></li>
              <li>Genre: <?=$genre?></li>
              <li>Type: <?=$artistType?></li>
            </ul>
          </h3>
        </details>
        <div class="grid">
          
          <?php generateMetrics($metrics); ?>
          
        </div>
    </article>
  </body>
  <?php
    generateFooter();
    ?>
</html>