<?php
require_once 'config.inc.php';
require_once 'dbClasses.php';

$conn = DatabaseHelper::createConnection(array(DBCONNSTRING, DBUSER, DBPASS));
$songDB = new SongDB($conn);
echo json_encode($songDB->getAll());

$title = "Title";
$artist = "Artist";
$artistType = "Artist Type";
$genre = "Genre";
$year = "Year";
$duration = "0:00";
?>
<!-- HTML boilerplate from https://www.freecodecamp.org/news/basic-html5-template-boilerplate-code-example/ -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>COMP 3512 Assign1</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
	<header>COMP 3512 Assign1
        <h4>Joel Conley, Harshad K.</h4>
    </header>
    <article>
        <h2>Song Info</h2>
    </article>
  </body>
</html>