<?php
require_once(dirname(__FILE__).'/../control_record.php');
require_once(dirname(__FILE__).'/../database.php');
function records_load_record_info()
{
    $record_id = $_REQUEST['record-id'];
    $record = show_record($record_id); 
    echo json_encode($record);
}
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
    $ret =<<< EOD
<thead><tr><th>电影</th><th>院线</th><th>放映员</th><th>时间</th><th>地点</th><th>操作</th></tr></thead>
EOD;
    foreach ( $records as $record)
    {
        $record_id = $record['record_id'];
        $record_text = show_record($record_id);    
        print_r($record_text);
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
<tr><td>$film_name</td><td>$chain_name</td><td>$user_name</td><td>$date_time</td><td>$location</td><td>
<button role="update-record" class="btn btn-primary open-update-record-dialog" type="button" data-toggle="modal"data-target="#update-record" data-id="$record_id">
<span class="glyphicon glyphicon-pencil"></span>
编辑
</button>
<button role="delete-record" class="btn btn-danger open-delete-record-dialog" type="button" data-toggle="modal" data-target="#delete-record" data-id="$record_id">
<span class="glyphicon glyphicon-trash"></span>
删除
</button>
</td></tr>
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
    $selected_chain_name = $_REQUEST['chain-name'];
    $selected_chain_id = get_chain_id_by_name($selected_chain_name);
    foreach($film_info as $film)
    {
        $film_name = $film['film_name'];
        $chain_id = $film['chain_id'];
        if ($selected_chain_id == $chain_id)
        {
        $append_str = <<<EOD
    <option>$film_name</option>
EOD;
        $ret = $ret . $append_str;
        }
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
function records_get_user_name_options()
{
    session_start();
    $current_user = $_SESSION['current_user'];
    $current_user_info = get_user_info($current_user);
    $current_user_type = $current_user_info['user_type'];
    if ($current_user_type == 0) {
        $users = get_all_user_info() ;
        $ret = '';
        foreach ($users as $user)
        {
            if ($user['user_type'] == 3)
            {
                $user_name = $user['user_name'];
                $append_str = <<<EOS
<option>$user_name</option>
EOS;
                $ret = $ret . $append_str;
            }
            echo $ret;
        }
    } elseif ($current_user_type == 3) {
        $ret = <<<EOS
<option>$current_user</option>
EOS;
        echo $ret;
    }
}
function records_insert_record()
{
    $film_name = $_REQUEST['film-name'];
    $chain_name = $_REQUEST['chain-name'];
    $date_time = $_REQUEST['date-time'];
    $location = $_REQUEST['location'];
    $user_name = $_REQUEST['user-name'];
    $film_info = get_film_info_by_film_name_and_chain_name($film_name, $chain_name);
    if (count($film_info) == 0)
    {
        echo "ERROR_FILM_CHAIN_NOT_MATCH";
        return;
    }
    $film_id = $film_info['film_id'];
    $chain_id = $film_info['chain_id']; 
    $user_id = get_user_id($user_name);
    echo insert_record($user_id, $film_id, $chain_id, $date_time, $location);
function records_update_record()
{
    $record_id = $_REQUEST['record-id'];
    $film_name = $_REQUEST['film-name'];
    $chain_name = $_REQUEST['chain-name'];
    $date_time = $_REQUEST['date-time'];
    $location = $_REQUEST['location'];
    $user_name = $_REQUEST['user-name'];
    $film_info = get_film_info_by_film_name_and_chain_name($film_name, $chain_name);
    if (count($film_info) == 0)
    {
        echo "ERROR_FILM_CHAIN_NOT_MATCH";
        return;
    }
    $film_id = $film_info['film_id'];
    $chain_id = $film_info['chain_id']; 
    $user_id = get_user_id($user_name);
    echo update_record($record_id, $film_id, $chain_id, $date_time, $location);
}
}
?>
