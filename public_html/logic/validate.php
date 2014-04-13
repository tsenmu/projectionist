<?php
session_start();
require_once(dirname(__FILE__) . '/../../resources/config.php');
require_once('database.php');
$username = $_REQUEST["username"];
$password = $_REQUEST["password"];
$remember = $_REQUEST["remember"];
$ret = is_password_match($username, $password);
if ($ret == "SUCCESS" )
{
    $_SESSION['current_user'] = $username;
    $_SESSION['remember_user'] = True;
}
echo $ret;
?>
