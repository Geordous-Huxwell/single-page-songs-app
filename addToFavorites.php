<!-- $_SESSION steps via Randy Connolly -->
<?php
require_once "./main.php";

session_start();

if ( !isset($_SESSION["Favorites"]) ) {
    $_SESSION["Favorites"] = [];
   }

$favorites = $_SESSION["Favorites"];

if (array_search($_GET["song_id"], $favorites) == false)
{
    $favorites[] = $_GET["song_id"];
}

$_SESSION["Favorites"] = $favorites;

header("Location: favorites.php");


?>