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
<?php 
if (!isset($_REQUEST['chain-page'])) {
    $new_url = "Location: movie-management.php?";
    $_REQUEST["chain-page"] = 1;
    foreach($_REQUEST as $key => $val)
    {
        $new_url .= "$key=$val&";
    }
    $new_url = substr($new_url, 0, strlen($new_url) - 1);
    header($new_url);
}
if (!isset($_REQUEST['film-page'])) {
    $new_url = "Location: movie-management.php?";
    $_REQUEST['film-page'] = 1;
    foreach($_REQUEST as $key => $val)
    {
        $new_url .= "$key=$val&";
    }
    $new_url = substr($new_url, 0, strlen($new_url) - 1);
    header($new_url);
}
?>
 
    <body role="document">
        <?php require_once(dirname(__FILE__) . '/navbar.php'); ?>
        <div class="container-fluid" role="user-main">
            <div class="row">
                <?php require_once(dirname(__FILE__) . '/sidebar.php'); ?>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2
                    main">
                    <?php require_once('movie-management-film.php'); ?>    
                    <?php require_once('movie-management-chain.php'); ?>
                </div>
            </div>
        </div>
        <!-- javascripts -->
        <?php require_once($config["includes"]["footer"]);?>
        <script src="js/movie-management.js"></script>
    </body>
</html>
