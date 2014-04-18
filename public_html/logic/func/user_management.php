<?php
require_once(dirname(__FILE__).'/../database.php');
function user_management_get_parent_options()
{
    $users = get_parent_user_info();
    $ret = '';
    $exclude_user_id = $_REQUEST['exclude-user-id'];
    foreach($users as $user)
    {
        $user_name = $user["user_name"];
        $user_id = $user["user_id"];
        if (isset($exclude_user_id) && $user_id == $exclude_user_id)
        {
            continue;
        } 
        $append_str =<<<  EOS
<option user-id="$user_id">$user_name</option>
EOS;
        if($user["user_available"] == 1)
        {
            $ret = $ret . $append_str;
        }
    }
    echo $ret;
}
function user_management_get_user_list()
{
    $users = get_all_user_info();    // no admin
    $ret = '';
    if ( count($users) == 0)
    {
        $ret ='<thead><tr><td>暂无用户</td></tr></thead>';
        echo $ret;
        return; 
    }
    $ret = '<thead><tr><th>用户</th><th>密码</th><th>上级行政单位</th><th>操作</th><tr></thead><tbody>';
    foreach ($users as $user)
    {
        $user_id = $user['user_id'];
        $user_name = $user['user_name'];
        $user_type = $user['user_type'];
        $user_parent = get_user_name_by_id(get_parent_user_id($user['user_id']));
        if ( $user_type == 0)
        {
        $append_str = <<< EM
<tr><td>$user_name</td><td>********</td><td>无</td>
<td>
<span data-toggle="tooltip" data-placement="left" title="请在屏幕右上角更改区级用户信息">
<button role="update-user" class="btn btn-primary open-update-user-dialog" type="button" disabled>
<span class="glyphicon glyphicon-pencil"></span>
编辑
</button></span>
<span data-toggle="tooltip" data-placement="left" title="区级用户不能被删除">
<button role="delete-user" class="btn btn-danger" type="button" data-toggle="tooltip" data-placement="left" title="ssss" disabled>
<span class="glyphicon glyphicon-trash"></span>
删除
</button>
</span>

</td>
</tr>
EM;
        }
        else 
        {
            $append_str = <<< EM
<tr><td>$user_name</td><td>********</td><td>$user_parent</td>
<td>
<button role="update-user" class="btn btn-primary open-update-user-dialog" type="button" data-toggle="modal"data-target="#update-user" data-id="$user_id">
<span class="glyphicon glyphicon-pencil"></span>
编辑
</button>
<button role="delete-user" class="btn btn-danger open-delete-user-dialog" type="button" data-toggle="modal" data-target="#delete-user" data-id="$user_id">
<span class="glyphicon glyphicon-trash"></span>
删除
</button>

</td>
</tr>
EM;

        }
        $ret = $ret . $append_str;
    }
    $ret = $ret. '</tbody>';
    echo $ret;
}
function user_management_insert_user()
{
    $username = $_REQUEST['user-name'];
    $password = $_REQUEST['password'];
    $parent = $_REQUEST['parent-user-name'];
    echo insert_user($username, $password, $parent);
}
function user_management_delete_user()
{
    $username = $_REQUEST['username'];
    echo delete_user($username);
}
function user_management_load_user_info()
{
    $user_id = $_REQUEST['user-id'];
    $info = get_user_info(get_user_name_by_id($user_id));
    $parent_user_id = get_parent_user_id($user_id);
    $parent_user_name = get_user_name_by_id($parent_user_id);
    unset($info['user_password']);
    $info['parent_user_name'] = $parent_user_name;
    echo json_encode($info);
}
function user_management_update_user()
{
    $user_id = $_REQUEST['user-id'];
    $user_name = $_REQUEST['user-name'];
    $password = $_REQUEST['password'];
    $parent_user_name = $_REQUEST['parent_user_name'];
    echo update_user($user_id, $user_name, $password, $parent_user_name); 
}
?>
