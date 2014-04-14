<div class="modal fade" id="insert-user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">添加用户</h4>
      </div>
      <div class="modal-body">
        <form role="form">
            <div class="form-group">
                <label for="insert-username">用户名</label>
                <input type="text" class="form-control" id="insert-username" required>
            </div>
            <div class="form-group">
                <label for="insert-password">密码</label>
                <input type="password" class="form-control" id="insert-password" required>
            </div>
            
            <div class="form-group">
                <label for="insert-parent">上级行政单位</label>
                <select id="insert-parent" class="parent">
                    <?php echo generate_parents(); ?>
                </select>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button id="insert-cancel" type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button id="insert-submit" type="button" class="btn btn-primary">添加</button>
      </div>
    </div>
  </div>
</div>
<?php 
require_once('logic/database.php');
function generate_parents()
{
    $ret = '';
    $users = get_all_user_info();
    foreach($users as $user)
    {
        $user_id = $user["user_id"];
        $user_password = $user["user_password"];
        $user_available = $user["user_available"];
        $user_name = $user["user_name"];
        $user_type = $user["user_type"];
        if ($user_available == 1)
        {
            $ret = $ret . '<option id=user_name_'."$user_name".' user-id='.'"'."$user_id".'">'."$user_name".'</option>';
        }
    }
    return $ret;
}
?>
