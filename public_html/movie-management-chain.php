<div class="container" role="chain-main">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">院线管理</h3>
        </div>
        <div class="panel-body">
            <div class="btn-toolbar">
                <button type="button" class="btn btn-default"
                    data-toggle="modal" data-target="#insert-chain"> <span
                        class="glyphicon glyphicon-plus"></span> 添加</button>
                <button type="button" class="btn btn-default"> <span
                        class="glyphicon glyphicon-minus"></span> 删除</button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>院线名称</th>
                    </tr>
                </thead> 
                <tbody id="chain-list">
                </tbody>
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
