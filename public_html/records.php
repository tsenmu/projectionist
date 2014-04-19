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
        <link href="css/bootstrap-datetimepicker.css" rel="stylesheet">
        <!-- generate title from config file -->
        <title><?php echo $config["vars"]["title"] ?></title>
    </head>
    <body>
        <?php require_once(dirname(__FILE__) . '/navbar.php'); ?>
        <div class="container">
            <div id="panel-record" class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">放映记录</h3></div>
                <div class="panel-body">
                    <div id="alert"></div>
                    <button class="btn btn-default btn-success open-insert-record-dialog" data-toggle="modal" data-target="#insert-record"> <span class="glyphicon glyphicon-plus"></span>添加放映记录</button>    
                    <div class="table-responsive">
                        <table class="table table-striped" id="record-list">
                        </table>
                    </div>
                </div>  
            </div>    
        </div>
        <?php require_once(dirname(__FILE__) . '/records-insert.php'); ?>
        <?php require_once(dirname(__FILE__) . '/records-update.php'); ?>
        <?php require_oncE(dirname(__FILE__) . '/records-delete.php'); ?>
        <!-- javascripts -->
        <?php require_once($config["includes"]["footer"]);?>
        <script src="js/bootstrap-datetimepicker.min.js"></script>
        <script src="js/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
        <script>
            $(document).ready(function() {
                set_active_navbar_button('#records');  
            });
        </script>
        <script type="text/javascript">
            $(".form_datetime").datetimepicker({
format: "yyyy/mm/dd hh:ii"
});
</script> 
<script src="js/records.js"></script>
  </body>
</html>
