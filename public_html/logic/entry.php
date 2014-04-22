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
    set_session_info();
    header("Location: ../home.php");
    exit;
}

set_session_info();
function set_session_info()
{

    if(!isset($_SESSION['current_user_type']))
    {
        $user_name=$_SESSION['current_user'];
        $_SESSION['current_user_type'] = get_user_type($user_name);
    }
}
?>
