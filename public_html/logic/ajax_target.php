<?php
// Include target functions
require_once('database.php');
require_once('func/movie_management.php');
require_once('func/user_management.php');
require_once('func/records.php');
require_once('func/utils.php');
require_once('func/user.php');
$func = $_REQUEST['func']; // Acquire the function desired.
$func(); // Call the function.
?>
