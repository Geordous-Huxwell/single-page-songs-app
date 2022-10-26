<?php
require_once "./main.php";

session_start();

if (!isset($_SESSION["Favorites"])) {
    $_SESSION["Favorites"] = [];
   }

$favorites = $_SESSION["Favorites"];

// Remove song if ID exists in favorites array
   if (array_search($_GET["song_id"], $favorites) !== false) //fun bug when this returns 0 as an index and "!== false" isn't used
   {
      $indexOfSong = array_search($_GET["song_id"], $favorites);
      unset($favorites[$indexOfSong]);
   }

$_SESSION["Favorites"] = $favorites;

header("Location: favorites.php");


?>