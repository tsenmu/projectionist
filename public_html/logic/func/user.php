<?php
function user_change_password() {
    $password = $_REQUEST['password'];
    $new_password = $_REQUEST['new-password'];
    session_start();
    $user_name = $_SESSION['current_user'];
    echo update_user_password($user_name, $password, $new_password);
}
?>
