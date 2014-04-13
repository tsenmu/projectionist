<?php
session_start();
define('BASE', substr(CWD, strlen($_SERVER['DOCUMENT_ROOT'])));
define('PAGE', substr($_SERVER['SCRIPT_NAME'],1 + strlen(BASE)));
require_once('database.php');
if (!isset($_SESSION['current_user']))
{
    header("Location: ../login.php");
    exit;
}
else if (PAGE == 'index.php')
{
    $_SESSION['current_user_type'] = 1;
    header("Location: ../home.php");
    exit;
}


?>
