<!DOCTYPE html>
<?php ini_set("display_errors", 1);
error_reporting(E_ALL ^ E_NOTICE);
require_once('logic/entry.php');
?>
<?php require_once(dirname(__FILE__) . '/../resources/config.php'); ?>
<html>
  <head>
    <!-- common styles -->
    <?php require_once($config["includes"]["header"]);?>
    <!-- custom styles -->
    <link href="css/login.css" rel="stylesheet">
    <!-- generate title from config file -->
    <title><?php echo $config["vars"]["title"] ?></title>
  </head>
  <body>
    <?php require_once(dirname(__FILE__) . '/navbar.php'); ?>
<div class="container">
    <h1> </h1>
    <button class="btn btn-lg" data-toggle="modal" data-target="#insert-user">添加用户</button>
    <button class="btn btn-lg" data-toggle="modal" data-target="#delete-user">删除用户</button>
</div>
    <?php require_once(dirname(__FILE__) . '/user-management-query.php'); ?>
    <?php require_once(dirname(__FILE__) . '/user-management-insert.php'); ?>
    <?php require_once(dirname(__FILE__) . '/user-management-delete.php'); ?>
    <?php require_once(dirname(__FILE__) . '/user-management-update.php');?>
</div>    
<!-- javascripts -->
    <?php require_once($config["includes"]["footer"]);?>
    <script src="js/user-management.js"></script>
    <script>
        $(document).ready(function() {
        set_active_navbar_button('#user-management');  
        set_active_navbar_button('#management');
        });
    </script>
  </body>
</html>
