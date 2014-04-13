<!DOCTYPE html>
<?php ini_set("display_errors", 1);
error_reporting(E_ALL ^ E_NOTICE);
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
	<?php require_once(dirname(__FILE__) . '/navbar-admin.php'); ?>
    
    <!-- javascripts -->
    <?php require_once($config["includes"]["footer"]);?>
    <script>
        $(document).ready(function() {
        set_active_navbar_button('#user-management');  
        });
    </script>
  </body>
</html>
