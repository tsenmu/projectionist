<div class="container" role="chain-main">
    <div id="panel-chain" class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">院线管理</h3>
        </div>
        <div class="panel-body">
<div id="alert"></div>

                <button type="button" class="btn btn-default btn-lg"
                    data-toggle="modal" data-target="#insert-chain"> <span
                        class="glyphicon glyphicon-plus"></span> 添加新院线</button>
        </div>
        <div class="table-responsive">
            <table class="table table-striped" id="chain-list">
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="insert-chain" tabindex="-1" role="dialog"
    aria-labelledby="insert-chain-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"
                    aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="insert-chain-label">添加院线</h4>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div id="alert"></div>
                    <div class="form-group" id="div-chain-name">
                        <label for="chain-name">名称</label>
                        <input type="text" class="form-control"
                        id="chain-name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="insert-chain-cancel" type="button" class="btn btn-default"
                        data-dismiss="modal">关闭</button>
                    <button id="insert-chain-submit" type="button" class="btn btn-primary">
                        添加</button>
                </div>
            </div>
        </div>
    </div>

 <div class="modal fade" id="delete-chain" tabindex="-1" role="dialog"
            aria-labelledby="delete-chain-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="delete-chain-label">删除院线</h4>
                    </div>
                    <div id="alert"></div>
                    <div class="modal-body">
                        <h3><span class="label label-warning">确认删除院线：<span id=delete-chain-name> </span>?</span></h3>
                    </div>
                        <div class="modal-footer">
                            <button id="delete-chain-cancel" type="button" class="btn btn-default"
                                data-dismiss="modal">取消</button>
                            <button id="delete-chain-submit" type="button" class="btn btn-danger">
                                删除</button>
                        </div>
                    </div>
                </div>
            </div>
<div class="modal fade" id="update-chain" tabindex="-1" role="dialog"
    aria-labelledby="update-chain-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"
                    aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="update-chain-label">编辑院线</h4>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div id="alert"></div>
                    <div class="form-group" id="div-chain-name">
                        <label for="chain-name">名称</label>
                        <input type="text" class="form-control"
                        id="chain-name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="update-chain-cancel" type="button" class="btn btn-default"
                        data-dismiss="modal">关闭</button>
                    <button id="update-chain-submit" type="button" class="btn btn-primary">
                        更新</button>
                </div>
            </div>
        </div>
    </div>


