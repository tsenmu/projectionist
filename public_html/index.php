<!DOCTYPE html>
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
    <div class="container">
        
    </div> <!-- /container -->
    <!-- javascripts -->
    <?php require_once($config["includes"]["footer"]);?>
  </body>
</html>
