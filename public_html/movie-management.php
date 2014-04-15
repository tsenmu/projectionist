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
        <!-- generate title from config file -->
        <title><?php echo $config["vars"]["title"] ?></title>
    </head>
    <body role="document">
        <?php require_once(dirname(__FILE__) . '/navbar.php'); ?>
        <?php require_once('movie-management-film.php'); ?>    
        <?php require_once('movie-management-chain.php'); ?>
        <!-- javascripts -->
        <?php require_once($config["includes"]["footer"]);?>
        <script src="js/movie-management.js"></script>
    </body>
</html>
