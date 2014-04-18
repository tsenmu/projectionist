<div class="container" role="chain-main">
    <div id="panel-chain" class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">院线管理</h3>
        </div>
        <div class="panel-body">
            <div id="alert"></div>

            <button type="button" class="btn btn-default"
                data-toggle="modal" data-target="#insert-chain"> <span
                    class="glyphicon glyphicon-plus"></span> 添加新院线</button>
            <div class="table-responsive">
                <table class="table table-striped" id="chain-list">
                </table>
            </div>
        </div>
    </div>
</div>

<?php
require_once(dirname(__FILE__) . '/movie-management-chain-insert.php');
require_once(dirname(__FILE__) . '/movie-management-chain-update.php');
require_once(dirname(__FILE__) . '/movie-management-chain-delete.php');
?>
