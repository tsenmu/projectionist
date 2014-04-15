<div class="container" role="main-film">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">电影管理</h3>
        </div>
        <div class="panel-body">
                <button type="button" class="btn btn-default btn-lg"
                    data-toggle="modal" data-target="#insert-film"> <span
                        class="glyphicon glyphicon-plus"></span> 添加新电影</button>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>电影名称</th>
                        <th>电影编号</th>
                        <th>电影院线</th>
                        <th>电影路径</th>
                        <th>操作</th>
                    </tr>
                </thead> 
                <tbody id="film-list">
                </tbody>
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
                    data-dismiss="modal">取消</button>
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
                    data-dismiss="modal">取消</button>
                <button id="update-film-submit" type="button" class="btn btn-primary">
                    更新</button>
            </div>
        </div>
    </div>
</div>
