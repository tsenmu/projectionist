<!DOCTYPE html>
<?php ini_set("display_errors", 1);
error_reporting(E_ALL ^ E_NOTICE);
?>
<?php require_once('logic/entry.php');?>
<?php require_once(dirname(__FILE__) . '/../resources/config.php'); ?>
<html>
  <head>
    <!-- common styles -->
    <?php require_once($config["includes"]["header"]);?>
    <!-- custom styles -->
    <!-- generate title from config file -->
    <title><?php echo $config["vars"]["title"] ?></title>
  </head>
  <body>
	<?php require_once(dirname(__FILE__) . '/navbar.php'); ?>
    <div class="container">
    <h1>
    <?php 
echo $_SESSION['current_user']; ?> </br>
<?php echo $_SESSION['current_user_type'];?> 
</h1>
</div>
    <!-- javascripts -->
    <?php require_once($config["includes"]["footer"]);?>
    <script>
        $(document).ready(function() {
        set_active_navbar_button('#home');  
        });
    </script>
  </body>
</html>
