        <div class="modal fade" id="insert-user" tabindex="-1" role="dialog"
            aria-labelledby="insert-user-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="insert-chain-label">添加用户</h4>
                    </div>
                    <div class="modal-body">
                        <form role="form">
                            <div id="alert"></div>
                            <div class="form-group" id="div-user-name">
                                <label for="user-name">用户名</label>
                                <input type="text" class="form-control" id="user-name" required>
                            </div>
                            <div class="form-group" id="div-password">
                                <label for="password">密码</label>
                                <input type="password" class="form-control" id="password" required>
                            </div>

                            <div class="form-group" id="div-parent-user-name">
                                <label for="parent-user-name">上级行政单位</label>
                                <select id="parent-user-name" class="form-control">
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button id="insert-user-cancel" type="button" class="btn btn-default"
                            data-dismiss="modal">关闭</button>
                        <button id="insert-user-submit" type="button" class="btn btn-primary">
                            添加</button>
                    </div>
                </div>
            </div>
        </div>


