<div class="container" role="main-film">
    <div id="panel-film" class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">电影管理</h3>
        </div>
        <div class="panel-body">
            <div id="alert"></div>

            <button type="button" class="btn btn-default btn-success"
                data-toggle="modal" data-target="#insert-film"> <span
                    class="glyphicon glyphicon-plus"></span> 添加新电影</button>
            <div class="table-responsive">
                <table class="table table-striped" id="film-list">
                </table>
            </div>
        </div>
    </div>
</div>
<?php
require_once(dirname(__FILE__) . '/movie-management-film-insert.php');
require_once(dirname(__FILE__) . '/movie-management-film-update.php');
require_once(dirname(__FILE__) . '/movie-management-film-delete.php');
?>
