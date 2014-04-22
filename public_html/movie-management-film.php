   <div id="panel-film" class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">电影管理</h3>
        </div>
        <div class="panel-body">
            <div id="alert"></div>

            <button type="button" class="btn btn-default btn-success"
                data-toggle="modal" data-target="#insert-film"> <span
                    class="glyphicon glyphicon-plus"></span> 添加新电影</button>
<ul class="pager">
                                <span>共&nbsp;<span
                                        id="film-count"> 
                                        </span>&nbsp;电影，</span>
                                <span>当前显示第<span id="film-page">&nbsp;
                                        <input id="current-page-film" class=""
                                            style="text-align: center;" value="<?php echo $_REQUEST['film-page'] ?>"
                                        size="3px" type="text"  >&nbsp; / <span id="page-count-film"></span> 页电影</span>
                                        <li id="previous-film" class="previous <?php if($_REQUEST['film-page'] == 1): ?> disabled<?php endif;?> "><a href="#">上一页</a></li>
                                <li id="next-film" class="next"><a href="#">下一页</a></li>
                            </ul>
 

            <div class="table-responsive">
                <table class="table table-striped" id="film-list">
                </table>
            </div>
        </div>
    </div>
<?php
require_once(dirname(__FILE__) . '/movie-management-film-insert.php');
require_once(dirname(__FILE__) . '/movie-management-film-update.php');
require_once(dirname(__FILE__) . '/movie-management-film-delete.php');
?>
