<!DOCTYPE html>
<?php ini_set("display_errors", 1);
error_reporting(E_ALL ^ E_NOTICE);
require_once('logic/entry.php');
?>
<?php require_once(dirname(__FILE__) . '/../resources/config.php'); ?>
<?php if(!isset($_REQUEST['page'])) {
    header("Location: user-management.php?page=1");
} elseif($_REQUEST['page'] < 1) {
    header("Location: user-management.php?page=1");
} 
?>
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

        <div class="container-fluid" role="user-main">
            <div class="row">
                <?php require_once(dirname(__FILE__) . '/sidebar.php'); ?>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2
                    main">
                    <div id="panel-user" class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">用户管理</h3>
                        </div>
                        <div class="panel-body">
                            <div id="alert"></div>
                            <button type="button" class="btn btn-default btn-success"
                                data-toggle="modal" data-target="#insert-user"> <span
                                    class="glyphicon glyphicon-plus"></span> 添加新用户</button>
                            <ul class="pager">
                                <span>共&nbsp;<span
                                        id="user-count"><?php echo
                                        $_REQUEST['total'];?></span>&nbsp;用户，</span>
                                <span>当前显示第<span id="user-page">&nbsp;
                                        <input id="current-page" class=""
                                            style="text-align: center;" value="<?php echo $_REQUEST['page'] ?>"
                                        size="3px" type="text"  >&nbsp; / <span id="page-count"></span> 页用户</span>
                                        <li class="previous <?php if($_REQUEST['page'] == 1): ?> disabled<?php endif;?> "><a href="#">上一页</a></li>
                                <li class="next"><a href="#">下一页</a></li>
                            </ul>
 
                            <div class="table-responsive">
                                <table class="table table-striped" id="user-list">
                                </table>
                            </div>
                        </div>
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
