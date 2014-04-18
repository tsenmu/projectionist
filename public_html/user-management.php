<!DOCTYPE html>
<?php ini_set("display_errors", 1);
error_reporting(E_ALL ^ E_NOTICE);
require_once('logic/entry.php');
?>
<?php require_once(dirname(__FILE__) . '/../resources/config.php'); ?>
<html>
    <head>
        <!-- common styles -->
        <?php require_once($config["includes"]["header"]);?>
        <!-- custom styles -->
        <!-- generate title from config file -->
        <title><?php echo $config["vars"]["title"] ?></title>
    </head>
    <body>
        <?php require_once(dirname(__FILE__) . '/navbar.php'); ?>

        <div class="container" role="user-main">
            <div id="panel-user" class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">用户管理</h3>
                </div>
                <div class="panel-body">
                    <div id="alert"></div>

                    <button type="button" class="btn btn-default"
                        data-toggle="modal" data-target="#insert-user"> <span
                            class="glyphicon glyphicon-plus"></span> 添加新用户</button>
                    <div class="table-responsive">
                        <table class="table table-striped" id="user-list">
                        </table>
                    </div>
                </div>
            </div>
        </div>
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
                            <div class="form-group" id="div-insert-username">
                                <label for="insert-username">用户名</label>
                                <input type="text" class="form-control" id="insert-username" required>
                            </div>
                            <div class="form-group" id="div-insert-password">
                                <label for="insert-password">密码</label>
                                <input type="password" class="form-control" id="insert-password" required>
                            </div>

                            <div class="form-group" id="div-insert-parent">
                                <label for="insert-parent">上级行政单位</label>
                                <select id="insert-parent" class="form-control">
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

        <div class="modal fade" id="delete-user" tabindex="-1" role="dialog"
            aria-labelledby="delete-user-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="delete-user-label">删除用户</h4>
                    </div>
                    <div id="alert"></div>
                    <div class="modal-body">
                        <h3><span class="label label-warning">确认删除用户：<span id=delete-user-name> </span>?</span></h3>
                    </div>
                    <div class="modal-footer">
                        <button id="delete-user-cancel" type="button" class="btn btn-default"
                            data-dismiss="modal">取消</button>
                        <button id="delete-user-submit" type="button" class="btn btn-danger">
                            删除</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="update-user" tabindex="-1" role="dialog"
            aria-labelledby="update-user-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="update-user-label">编辑用户</h4>
                    </div>
                    <div class="modal-body">
                        <form role="form">
                            <div id="alert"></div>
                            <div class="form-group" id="div-update-username">
                                <label for="update-username">用户名</label>
                                <input type="text" class="form-control" id="update-username" required>
                            </div>
                            <div class="form-group" id="div-update-password">
                                <label for="update-password">密码</label>
                                <input type="password" class="form-control" id="update-password" required>
                            </div>

                            <div class="form-group" id="div-update-parent">
                                <label for="update-parent">上级行政单位</label>
                                <select id="update-parent" class="form-control">
                                </select>
                            </div>
                        </div>
                    </form>

                    <div class="modal-footer">
                        <button id="update-user-cancel" type="button" class="btn btn-default"
                            data-dismiss="modal">关闭</button>
                        <button id="update-user-submit" type="button" class="btn btn-primary">
                            更新</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- javascripts -->
        <?php require_once($config["includes"]["footer"]);?>
        <script src="js/user-management.js"></script>
    </body>
</html>
