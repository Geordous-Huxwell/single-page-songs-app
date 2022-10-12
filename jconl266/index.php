<?php
require_once './main.php';



?>

<html> 
  
  <?php
generateHeader();  
?> 

    <article>
        <!-- <h2>Song Info</h2> -->
        <details>
          <summary>
            <span class="title"><?=$title?></span>
            <span class="artist"><?=$artist?></span>
          </summary>
          <ul>
            <!-- TODO: Harshad - make this list into a function and style the list items-->
            <li>Year: <?=$year?></li>
            <li>Length: <?=$duration?></li>
            <li>Genre: <?=$genre?></li>
            <li>Type: <?=$artistType?></li>
          </ul>
          
        </details>
        <div class="grid">
          
          <?php generateMetrics($metrics); ?>        
          
        </div>
    </article>
    
  </body>

   <!-- TODO: Harshad - refer to the assignment instructions for what content 
    should be in the footer and build a function to generate it so it can be 
    injected into all pages -->

  <?php
    generateFooter();
    ?>
</html>