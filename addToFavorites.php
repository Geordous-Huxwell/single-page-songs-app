<?php
require_once "./main.php";
// ensure sessions works on this page
session_start();

// does session already exist?
if ( !isset($_SESSION["Favorites"]) ) {
    // initialize an empty array that will contain the favorites
    $_SESSION["Favorites"] = [];
   }

// retrieve favorites array for this user session
$favorites = $_SESSION["Favorites"];
// echo json_encode($_GET);
// now add passed favorite id to our favorites array
$favorites[] = $_GET["song_id"];

// then resave modified array to session state
$_SESSION["Favorites"] = $favorites;

// finally redirect to favorites page
header("Location: favorites.php");


?>