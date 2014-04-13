<?php

require_once('database.php');
//print_r($config);

$ret = is_password_match(177,"123qwe123");
echo $ret;


$ret = update_user_password(77,"77");
echo $ret;



?>

