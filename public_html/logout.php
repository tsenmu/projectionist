<?php
require_once('logic/entry.php');
session_destroy();
header("location: index.php");
exit();
?>
