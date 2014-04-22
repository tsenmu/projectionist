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
                            <?php if ($_SESSION['current_user_type'] == 0 || $_SESSION['current_user_type'] == 2) : ?>
                            <button class="btn btn-success open-insert-record-dialog" data-toggle="modal" data-target="#insert-record"> <span class="glyphicon glyphicon-plus"></span>&nbsp;添加放映记录</button>    
                            <?php endif; ?>
                            <?php if ($_SESSION['current_user_type'] != 2) : ?>
                            <?php if (isset($_REQUEST['search'])) :?>
<button class="btn btn-default download-search-records"> <span class="glyphicon glyphicon-download"></span>&nbsp;导出全部搜索结果</button>

                            <?php else:?>
                            <button class="btn btn-default download-records"> <span class="glyphicon glyphicon-download"></span>&nbsp;导出当管辖范围内所有放映记录</button>
                            <?php endif;?>
                            <?php endif;?>
<?php
    if (isset($_REQUEST['search'])) {
        $ret = <<<EOR
<div class="alert alert-info">
当前您正在搜索：</br>
EOR;
    $s_film = $_REQUEST['film'];
    $s_chain = $_REQUEST['chain'];
    $s_from = $_REQUEST['from'];
    $s_to = $_REQUEST['location'];
    $s_user = $_REQUEST['user'];
if ($s_film != '') {
    $ret .= "电影：$s_film</br>";
} else  {
    $ret .= "电影：无限制</br>";
}
if ($s_chain != '') {
    $ret .= "院线：$s_chain</br>";
} else {
    $ret .= "院线：无限制</br>";
}
if ($s_from != '') {
    $ret .= "时间从：$s_from&nbsp;";
} else {
    $ret .= "时间从：无限制&nbsp;";
}
if ($s_to != '') {
    $ret .= "到：$s_to</br>";
} else {
    $ret .= "到：无限制</br>";
}
if ($s_user != '') {
    $ret .= "放映员： $s_user</br>";
} else {
    $ret .= "放映员：无限制</br>"; 
}
$ret.= <<<EOR
</div>
EOR;
echo $ret;
    }
?>
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
