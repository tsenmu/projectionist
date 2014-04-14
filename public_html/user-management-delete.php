<div class="modal fade" id="delete-user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">删除用户</h4>
      </div>
      <div class="modal-body">
        <form role="form">
            <div class="form-group">
                <label for="delete-username">用户名</label>
                <select id="delete-username" class="parent">
                    <?php echo generate_children(); ?>
                </select>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button id="delete-cancel" type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button id="delete-submit" type="button" class="btn btn-primary">删除</button>
      </div>
    </div>
  </div>
</div>
<?php 
require_once('logic/database.php');
function generate_children()
{
    $ret = '';
    $users = get_child_user_info();
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
