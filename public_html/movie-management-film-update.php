    <div class="modal fade" id="update-film" tabindex="-1" role="dialog"
        aria-labelledby="update-film-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="update-film-label">编辑电影</h4>
                </div>
                <div id="alert"></div>
                <div class="modal-body">
                    <form role="form">
                        <div class="form-group" id="div-film-name">
                            <label for="film-name">名称</label>
                            <input type="text" class="form-control" id="film-name">
                        </div>
                        <div class="form-group" id="div-film-userdefine-id">
                            <label for="film-userdefine-id">编号</label>
                            <input type="number" class="form-control"
                            id="film-userdefine-id">
                        </div>
                        <div class="form-group" id="div-chain-name">
                            <label for="chain-name">院线</label>
                            <select type="text" class="form-control"
                                id="chain-name">
                            </select>
                        </div>
                        <div class="form-group" id="div-film-path">
                            <label for="film-path">文件路径</label>
                            <input type="text" class="form-control" id="film-path">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="update-film-cancel" type="button" class="btn btn-default"
                            data-dismiss="modal">关闭</button>
                        <button id="update-film-submit" type="button" class="btn btn-primary">
                            更新</button>
                    </div>
                </div>
            </div>
        </div>


