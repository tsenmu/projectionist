<?php
require_once('database.php');
$type = $_REQUEST['type'];
if ($type == 'insert')
{
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    $parent = $_REQUEST['parent'];
    echo insert_user($username, $password, $parent);
}
else if ($type == 'delete')
{
    $username = $_REQUEST['username'];
    echo delete_user($username);
}
?>
