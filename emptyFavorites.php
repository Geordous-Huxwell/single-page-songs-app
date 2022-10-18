<?php
session_start();
$_SESSION["Favorites"] = [];
header("Location: favorites.php");

// header("Location: favorites.php");


?>