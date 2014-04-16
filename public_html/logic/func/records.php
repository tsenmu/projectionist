<?php
require_once(dirname(__FILE__).'/../control_record.php');
require_once(dirname(__FILE__).'/../database.php');
function records_get_record_list()
{
    session_start();
    $current_user = $_SESSION['current_user'];
    $current_user_id = get_user_id($current_user);
    $records= get_record($current_user_id);
    if (count ($records) == 0)
    {
        echo '<thead><tr><th>当前管辖范围内暂无任何记录</th></tr></thead>';
        return;
    }
    $ret = '<thead><tr><th>电影</th><th>院线</th><th>放映员</th><th>时间</th><th>地点</th><th>操作</th></tr></thead>';
    foreach ( $records as $record_id => $record)
    {
        $record_text = show_record($records_id);    
        $film_name = $record_text['film_name'];
        $user_name = $record_text['user_name'];
        $chain_name = $record_text['chain_name'];
        $user_name = $record_text['user_name'];
        $user_id = $record['user_id'];
        $film_id = $record['film_id'];
        $chain_id = $record['chain_id'];
        $date_time = $record['date_time'];
        $location = $record['location'];
        $push_str = <<<EOT
<tr><td>$film_name</td><td>$chain_name</td><td>$user_name</td><td>$date_time</td><td>$location</td></tr>
EOT;
        $ret = $ret.$push_str;
    }
    echo $ret;
}
function records_get_film_options()
{
    $ret = '';
    $film_info = get_all_film_info();
    if (!isset($film_info))
    {
        echo $ret;
        return;
    }
    foreach($film_info as $film)
    {
        $film_name = $film['film_name'];
        $append_str = <<<EOD
    <option>$film_name</option>
EOD;
        $ret = $ret . $append_str;
    }
    echo $ret;
}
function records_get_chain_options()
{
    $ret = '';
    $chain_info = get_all_chain_info();
    if (!isset($chain_info))
    {
        echo $ret;
        return;
    }
    foreach ($chain_info as $chain)
    {
        $chain_name = $chain['chain_name'];
        $append_str = <<<EOD
<option>$chain_name</option>
EOD;
        $ret = $ret . $append_str;
    }
    echo $ret;
}
function records_insert_record()
{
    $film = $_REQUEST['film'];
    $chain = $_REQUEST['chain'];
    $date_time = $_REQUEST['date_time'];
    $location = $_REQUEST['location'];
    $username = $_REQUEST['username'];
    $film_info = get_film_info_by_film_name_and_chain_name($film, $chain);
    if (count($film_info) == 0)
    {
        echo "ERROR_FILM_CHAIN_NOT_MATCH";
        return;
    }
    $film_id = $film_info['film_id'];
    $chain_id = $film_info['chain_id']; 
    $user_id = get_user_id($user_name);
    echo insert_record($user_id, $film_id, $chain_id, $date_time, $location);
}
?>
