<?php
session_start();
define('BASE', substr(CWD, strlen($_SERVER['DOCUMENT_ROOT'])));
define('PAGE', substr($_SERVER['SCRIPT_NAME'],1 + strlen(BASE)));
if (!isset($_SESSION['current_user']))
{
    header("Location: ../login.php");
    exit;
}
else if (PAGE == 'index.php')
{
    header("Location: ../home.php");
    exit;
}
require_once("database.php");
//print_r(get_user_Info($_SESSION['current_user']));
?>
