<div class="modal fade" id="update-record" tabindex="-1" role="dialog" aria-labelledby="insert-record-label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="update-chain-label">编辑放映</h4>
      </div>
      <div class="modal-body">
        <div id="alert"></div>
        <form role="form">
            <div class="form-group">
                <label for="chain-name">院线</label>
                <select class="form-control" id="chain-name" required>
                </select>
            </div>
            <div class="form-group">
                <label for="film-name">电影</label>
                <select class="form-control" id="film-name" required>
                </select>
            </div>
            <div class="form-group">
                <label for="user-name">放影员</label>
                <select class="form-control" id="user-name"> 
                </select>
            </div>
           <div class="form-group">
                <label for="date-time">时间</label>
<div class="input-append date form_datetime">
<input class="form-control" id="date-time" type="text" value="" readonly required>
<span class="add-on"><i class="icon-th"></i></span>
</div>
            </div>
            <div class="form-group">
                <label for="location">地点</label>
                <input type="text" class="form-control" id="location" required>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button id="update-record-cancel" type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <button id="update-record-submit" type="button" class="btn btn-success">更新</button>
      </div>
    </div>
  </div>
</div>
<label style="display: none;" id="update-user-id"><?php echo $_SESSION['current_user']; ?></label>
