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
// now add passed favorite id to our favorites array
// Remove item

   if  ($key = array_search($_GET["song_id"], $favorites)) 
   {
    unset($favorites[$key]); 
   }

// then resave modified array to session state
$_SESSION["Favorites"] = $favorites;

// finally redirect to favorites page
header("Location: favorites.php");


?>