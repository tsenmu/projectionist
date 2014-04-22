<div id="panel-chain" class="panel panel-default">

    <div class="panel-heading">
        <h3 class="panel-title">院线管理</h3>
    </div>
    <div class="panel-body">
        <div id="alert"></div>

        <button type="button" class="btn btn-default btn-success"
            data-toggle="modal" data-target="#insert-chain"> <span
                class="glyphicon glyphicon-plus"></span> 添加新院线</button>
        <ul class="pager">
            <span>共&nbsp;<span
                    id="count-chain"></span>&nbsp;院线，</span>
            <span>当前显示第<span id="page-chain">&nbsp;
                    <input class=""
                    style="text-align: center;" value="<?php echo $_REQUEST['page'] ?>"
                    size="3px" type="text"  >&nbsp; / <span id="page-count-chain"></span> 页院线</span>
                <li class="previous <?php if($_REQUEST['page-chain'] == 1): ?> disabled<?php endif;?> "><a href="#">上一页</a></li>
                <li class="next"><a href="#">下一页</a></li>
            </ul>


            <div class="table-responsive">
                <table class="table table-striped" id="chain-list">
                </table>
            </div>
        </div>
    </div>

    <?php
    require_once(dirname(__FILE__) . '/movie-management-chain-insert.php');
    require_once(dirname(__FILE__) . '/movie-management-chain-update.php');
    require_once(dirname(__FILE__) . '/movie-management-chain-delete.php');
    ?>
