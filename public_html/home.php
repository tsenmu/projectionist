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
        <link href="css/home.css" rel="stylesheet">
        <!-- custom styles -->
        <!-- generate title from config file -->
        <title><?php echo $config["vars"]["title"] ?></title>
    </head>
    <body>
        <?php require_once(dirname(__FILE__) . '/navbar.php'); ?>
        <div class="container-fluid" role="user-main">
            <div class="row">
                <?php require_once(dirname(__FILE__) . '/sidebar.php'); ?>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2
                    main">
                    <div class="cover text-center pagination-center">
                        <h1>
                                电影放映管理系统</span> </h1>
                        <p>asdads</p>
                    </div>
            </div>
        </div>
        <!-- javascripts -->
        <?php require_once($config["includes"]["footer"]);?>
        <?php require_once(dirname(__FILE__) . '/records-search.php'); ?>
        <?php require_once(dirname(__FILE__) . '/records-insert.php'); ?>
        <?php require_once(dirname(__FILE__) . '/user-management-insert.php'); ?>
        <?php require_once(dirname(__FILE__) . '/movie-management-film-insert.php'); ?>
        <?php require_once(dirname(__FILE__) . '/movie-management-chain-insert.php'); ?>
        <script src="js/bootstrap-datetimepicker.min.js"></script>
        <script src="js/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
 
        <script src="js/home.js"></script>
    </body>
</html>
