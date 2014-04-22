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
<?php if(!isset($_REQUEST['search']) && !isset($_REQUEST['page'])) {
  header("Location: records.php?page=1");
} elseif($_REQUEST['page'] < 1) {
    header("Location: records.php?page=1");
}
?>
        <?php require_once(dirname(__FILE__) . '/navbar.php'); ?>
        <div class="container-fluid">
            <div class="row">
            <?php require_once(dirname(__FILE__) . '/sidebar.php'); ?>
               <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2
                    main">
                    
                    <div id="panel-record" class="panel panel-default">
                        <div class="panel-heading"><h3 class="panel-title">放映记录</h3></div>
                        <div class="panel-body">
                            <div id="alert"></div>
                            <?php if ($_SESSION['current_user_type'] == 0 || $_SESSION['current_user_type'] == 3) : ?>
                            <button class="btn btn-success open-insert-record-dialog" data-toggle="modal" data-target="#insert-record"> <span class="glyphicon glyphicon-plus"></span>添加放映记录</button>    
                            <?php endif; ?>
                            <button class="btn btn-default btn-warning download-records"> <span class="glyphicon glyphicon-download"></span>导出放映记录</button>
                            <ul class="pager">
                                <span>共&nbsp;<span
                                        id="record-count"><?php echo
                                        $_REQUEST['total'];?></span>&nbsp;条放映记录，</span>
                                <span>当前显示第<span id="record-page">&nbsp;
                                        <input id="current-page" class=""
                                            style="text-align: center;" value="<?php echo $_REQUEST['page'] ?>"
                                        size="3px" type="text"  >&nbsp; / <span id="page-count"></span> 页记录</span>
                                        <li class="previous <?php if($_REQUEST['page'] == 1): ?> disabled<?php endif;?> "><a href="#">上一页</a></li>
                                <li class="next <?php if($_REQUEST['page'] == $_SESSION['page_count']): ?> disabled<?php endif;?> "><a href="#">下一页</a></li>
                            </ul>
                            <div class="table-responsive">
                                <table class="table table-striped" id="record-list">
                                </table>
                            </div>
                      <!--      <ul class="pager">
                                <span>共&nbsp;<span
                                        id="record-count"><?php echo
                                        $_REQUEST['total'];?></span>&nbsp;条放映记录，</span>
                                <span>当前显示第<span id="record-page">&nbsp;
                                        <input class=""
                                            style="text-align: center;" value="<?php echo $_REQUEST['page'] ?>"
                                        size="3px" type="text"  >&nbsp; / <span id="page-count"></span> 页记录</span>
                                        <li class="previous <?php if($_REQUEST['page'] == 1): ?> disabled<?php endif;?> "><a href="#">上一页</a></li>
                                <li class="next <?php if($_REQUEST['page'] == $_SESSION['page_count']): ?> disabled<?php endif;?> "><a href="#">下一页</a></li>
                            </ul> -->
                        </div>  
                    </div>    
                </div>
            </div>
        </div>
        <?php require_once(dirname(__FILE__) . '/records-insert.php'); ?>
        <?php require_once(dirname(__FILE__) . '/records-update.php'); ?>
        <?php require_once(dirname(__FILE__) . '/records-delete.php'); ?>
        <?php require_once(dirname(__FILE__) . '/records-search.php'); ?>
        <!-- javascripts -->
        <?php require_once($config["includes"]["footer"]);?>
        <script src="js/bootstrap-datetimepicker.min.js"></script>
        <script src="js/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
        <script src="js/records.js"></script>
    </body>
</html>
