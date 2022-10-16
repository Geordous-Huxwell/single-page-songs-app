<?php  
include_once './main.php';

// ensure sessions works on this page
session_start();
// if no favorites in session, initialize it to empty array
if ( !isset($_SESSION["Favorites"]) ) {
   $_SESSION["Favorites"] = [];
  }

// retrieve favorites array for this user session
$favorites = $_SESSION["Favorites"];

echo json_encode($favorites);
?>

<a href="./emptyFavorites.php">Empty Favorites</a>