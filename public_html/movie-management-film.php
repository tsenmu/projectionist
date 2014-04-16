<div class="container" role="main-film">
    <div id="panel-film" class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">电影管理</h3>
        </div>
        <div class="panel-body">
<div id="alert"></div>

            <button type="button" class="btn btn-default btn-lg"
                data-toggle="modal" data-target="#insert-film"> <span
                    class="glyphicon glyphicon-plus"></span> 添加新电影</button>
        </div>
        <div class="table-responsive">
            <table class="table table-striped" id="film-list">
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="insert-film" tabindex="-1" role="dialog"
    aria-labelledby="insert-film-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"
                    aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="insert-film-label">添加电影</h4>
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
                    <button id="insert-film-cancel" type="button" class="btn btn-default"
                        data-dismiss="modal">关闭</button>
                    <button id="insert-film-submit" type="button" class="btn btn-primary">
                        添加</button>
                </div>
            </div>
        </div>
    </div>

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

        <div class="modal fade" id="delete-film" tabindex="-1" role="dialog"
            aria-labelledby="delete-film-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="delete-film-label">删除电影</h4>
                    </div>
                    <div id="alert"></div>
                    <div class="modal-body">
                        <h3><span class="label label-warning">确认删除电影：<span id=delete-film-name> </span>?</span></h3>
                    </div>
                        <div class="modal-footer">
                            <button id="delete-film-cancel" type="button" class="btn btn-default"
                                data-dismiss="modal">取消</button>
                            <button id="delete-film-submit" type="button" class="btn btn-danger">
                                删除</button>
                        </div>
                    </div>
                </div>
            </div>
