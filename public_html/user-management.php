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
    <body>
        <?php require_once(dirname(__FILE__) . '/navbar.php'); ?>

        <div class="container" role="user-main">
            <div id="panel-user" class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">用户管理</h3>
                </div>
                <div class="panel-body">
                    <div id="alert"></div>
                    <button type="button" class="btn btn-default btn-success"
                        data-toggle="modal" data-target="#insert-user"> <span
                            class="glyphicon glyphicon-plus"></span> 添加新用户</button>
                    <div class="table-responsive">
                        <table class="table table-striped" id="user-list">
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once(dirname(__FILE__) . '/user-management-insert.php');?>
        <?php require_once(dirname(__FILE__) . '/user-management-update.php');?>
        <?php require_once(dirname(__FILE__) . '/user-management-delete.php');?>
        <!-- javascripts -->
        <?php require_once($config["includes"]["footer"]);?>
        <script src="js/user-management.js"></script>
    </body>
</html>
