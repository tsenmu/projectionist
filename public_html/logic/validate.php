<?php
require_once(dirname(__FILE__) . '/../../resources/config.php');
require_once('database.php');
//print_r($config);
$username = $_REQUEST["username"];
$password = $_REQUEST["password"];
echo $username . $password;
$ret = is_password_match($username, $password);
echo $ret;
?>
