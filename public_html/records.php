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
    <link href="css/login.css" rel="stylesheet">
    <link href="css/bootstrap-datetimepicker.css" rel="stylesheet">
    <!-- generate title from config file -->
    <title><?php echo $config["vars"]["title"] ?></title>
  </head>
  <body>
	<?php require_once(dirname(__FILE__) . '/navbar.php'); ?>
    <div class="container">
    <h1></h1>
    <button class="btn btn-lg" data-toggle="modal" data-target="#insert-record">添加放映记录</button>    
    <div class="panel panel-default">
        <div class="panel-heading"><h3>查询放映记录</h3></div>



        <div class="panel-body">
<ul class="pager">
    <li class="previous"><a href="#">&larr; 上一页</a></li>
    <li class="next"><a href="#">下一页 &rarr;</a></li>
</ul>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>电影</th>
                    <th>
                        院线
                    </th>
                    <th>
                        放映员
                    </th>
                    <th>
                        时间
                    </th>
                    <th>
                        地点
                    </th>
                    </tr>
                </thead>
                <tbody>
            <?php echo generate_records();            ?>
                </tbody>
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
    foreach($records as $record)
    {
        $user_name = $record['user_id'];
        $film_name = $record['film_id'];
        $chain_name = $record['chain_id'];
        $date_time = $record['date_time'];
        $location = $record['location'];
        $push_str = '<tr><td>'."$film_name".'</td><td>'."$chain_name".'</td><td>'."$user_name".'</td><td>'."$date_time".'</td><td>'."$location"  .'</td></tr>';
        $ret = $ret.$push_str;
    }
    return $ret;
}
?>
