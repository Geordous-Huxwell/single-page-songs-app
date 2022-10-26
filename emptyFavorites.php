<?php
session_start();
// clear favorites and reload favorites page
$_SESSION["Favorites"] = [];
header("Location: favorites.php");

?>