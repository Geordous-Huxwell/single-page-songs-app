<?php
session_start();
$_SESSION["Favorites"] = [];
header('./favorites.php');
?>