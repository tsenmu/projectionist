<?php
if (isset($_REQUEST['option']) && $_REQUEST['option'] == 'cp') :
?>
<div class="container">
    <div class="panel panel-default" id="panel-user-cp">
        <div class="panel-heading">
            <h3 class="panel-title">更改密码</h3>
        </div>
        <div class="panel-body">
            <div id="alert"></div>
            <div class="form-group" id="div-password">
                <label for="password">旧密码</label>
                <input type="password" class="form-control" id="password">
            </div>
            <div class="form-group" id="div-new-password">
                <label for="new-password">新密码</label>
                <input type="password" class="form-control"
                id="new-password">
            </div>
            <div class="form-group" id="div-repeat-new-password">
                <label for="repeat-new-password">重复新密码</label>
                <input type="password" class="form-control"
                id="repeat-new-password">
            </div>
            <button id="submit-change-password" type="submit" class="btn btn-default">更改密码</button>
        </div>
    </div>
</div>

<?php endif;?>
