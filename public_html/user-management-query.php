<div class="container">

<div class="panel panel-default">
    <div class="panel-heading">查询用户</div>
        <div class="panel-body">
<ul class="pager">
    <li class="previous"><a href="#">&larr; 上一页</a></li>
    <li class="next"><a href="#">下一页 &rarr;</a></li>
</ul>
            <table class="table table-striped" id="query-user">
                <thead>
                    <th>用户名</th>
                    <th>密码</th>
                    <th>级别</th>
                </thead>
                <tbody>
                    <?php echo generate_user(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
require_once('logic/database.php');
function generate_user()
{
    $ret = '';
    $users = get_all_user_info();
    foreach ($users as $user)
    {
        $user_name = $user['user_name'];
        $user_password = $user['user_password'];
        $user_type = $user['user_type'];
        switch($user_type)
        {
            case 0:
                $user_type = "区级";
                break;
            case 1:
                $user_type = "县级";
                break;
            case 2:
                $user_type = "乡级";
                break;
            case 3:
                $user_type = "放映员";
                break;
        }
        $ret = $ret . '<tr> <td>' . "$user_name" . '</td> <td>' . "********" . '</td> <td>' . "$user_type" . '</td></tr>';
    }
    return $ret;
}
?>
