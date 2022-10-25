<?php
require_once './main.php';

?>
<style>
  
summary::after {
    content: "";
    position: absolute;
    top: -110%;
    left: -210%;
    width: 200%;
    height: 200%;
    opacity: 0;
    transform: rotate(30deg);
    background: rgba(255, 255, 255, 0.13);
    background: linear-gradient( to right, rgba(255, 255, 255, 0.13) 0%, rgba(255, 255, 255, 0.13) 77%, rgba(255, 255, 255, 0.5) 92%, rgba(255, 255, 255, 0.0) 100%)
}

summary::after:hover {
    opacity: 1;
    top: -30%;
    left: -30%;
    transition-property: left, top, opacity;
    transition-duration: 0.7s, 0.7s, 0.15s;
    transition-timing-function: ease;
}

</style>
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
              <li>Type: <?=$type?></li>
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