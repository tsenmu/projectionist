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
    <h1></h1>
    <div class="panel panel-default">
        <div class="panel-heading"><h3>放映记录查询</h3></div>
        <div class="panel-body">
            
        </div>  
    </div>    
    </div>
    <!-- javascripts -->
    <?php require_once($config["includes"]["footer"]);?>
    <script>
        $(document).ready(function() {
        set_active_navbar_button('#records');  
        });
    </script>
  </body>
</html>
<?php

?>
