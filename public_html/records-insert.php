<div class="modal fade" id="insert-record" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">添加放映</h4>
      </div>
      <div class="modal-body">
        <form role="form">
            <div class="form-group">
                <label for="insert-movie">电影</label>
                <select class="form-control" id="insert-movie" required>
                    <?php echo generate_films(); ?>
                </select>
            </div>
            <div class="form-group">
                <label for="insert-chain">院线</label>
                <select class="form-control" id="insert-chain" required>
                    <?php echo generate_chains(); ?>
                </select>
            </div>
            <div class="form-group">
                <label for="insert-date-time">时间</label>
<div class="input-append date form_datetime">
<input class="form-control" id="insert-date-time" type="text" value="" readonly required>
<span class="add-on"><i class="icon-th"></i></span>
</div>
            </div>
            <div class="form-group">
                <label for="insert-location">地点</label>
                <input type="text" class="form-control" id="insert-location" required>
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
<label style="display: none;" id="insert-user-id"><?php echo $_SESSION['current_user']; ?></label>

<?php 
require_once('logic/database.php');
generate_chains();
function generate_films()
{
    $ret = '';
    $film_info = get_all_film_info();
    if ( !isset($film_info) )
    {
        return $ret;
    }
    foreach($film_info as $film)
    {
        $append_str = '<option>' . $film['film_name'].'</option>';
        $ret = $ret .$append_str;
    }
    return $ret;
}

function generate_chains()
{
    $ret = '';
    $chain_info = get_all_chain_info();
    if ( !isset($chain_info) )
    {
        return $ret;
    }
    foreach($chain_info as $chain)
    {
        $append_str = '<option>'. $chain['chain_name'].'</option>';
        $ret = $ret.$append_str; 
    }
    return $ret;
}
function generate_parents()
{
    $ret = '';
    $users = get_parent_user_info();
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
