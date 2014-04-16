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
<button class="btn btn-default btn-lg" data-toggle="modal" data-target="#insert-record"> <span class="glyphicon glyphicon-plus"></span>添加放映记录</button>    
                    <table class="table table-striped" id="record-list">
                    </table>
                </div>  
            </div>    
        </div>
        <?php require_once(dirname(__FILE__) . '/records-insert.php'); ?>

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
<?php
function generate_records()
{
    require_once('logic/control_record.php');
    $ret = '';
    $current_user = $_SESSION['current_user'];
    $records = get_record($current_user);
    if ( count($records) == 0)
    return;
    foreach($records as $record_id => $record)
    {
        $record_text = show_record($record_id);
        $film_name = $record_text['film_name'];
        $user_name = $record_text['user_name'];
        $chain_name = $record_text['chain_name'];
        $user_name = $record_text['user_name'];
        $user_id = $record['user_id'];
        $film_id  = $record['film_id'];
        $chain_id = $record['chain_id'];
        $date_time = $record['date_time'];
        $location = $record['location'];
        $push_str = '<tr><td>'."$film_name".'</td><td>'."$chain_name".'</td><td>'."$user_name".'</td><td>'."$date_time".'</td><td>'."$location"  .'</td></tr>';
        $ret = $ret.$push_str;
    }
    return $ret;
}
?>
