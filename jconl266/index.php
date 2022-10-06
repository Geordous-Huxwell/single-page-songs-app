<?php
require_once './main.php';
?>
<!-- HTML boilerplate from https://www.freecodecamp.org/news/basic-html5-template-boilerplate-code-example/ -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>COMP 3512 Assign1</title>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <!-- TODO: Harshad - make the header element into a function for use on each 
    page, maybe add some styling as well -->
	<header>COMP 3512 Assign1
        <h4>Joel Conley, Harshad Krishnaraj</h4>
    </header>
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
    <!-- TODO: Harshad - refer to the assignment instructions for what content 
    should be in the footer and build a function to generate it so it can be 
    injected into all pages -->
    <footer>write footer-generating function</footer>
  </body>
</html>