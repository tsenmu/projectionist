<div class="navbar navbar-inverse navbar-fixed-top" role="navigation" >
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="home.php"><span class="glyphicon glyphicon-facetime-video"></span>  电影放映管理系统</a>
        </div>
        <?php if (isset($_SESSION['current_user'])): ?>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <!--	    <li id="home"><a href="home.php">主页</a></li> -->
                <li id="records"><a href="records.php">管理记录</a></li>
                <?php if ($_SESSION['current_user_type'] == 0): ?>
                <!-- <li id="management" class="dropdown"> 
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">管理<b class="caret"></b></a>
                <ul class="dropdown-menu"> -->
                    <li id="user-management"><a href="user-management.php">管理用户</a></li>
                    <li id="movie-management"><a href="movie-management.php">管理电影</a></li>
                    <!--  </ul>
                </li>-->
                <?php endif; ?>
                <li class="dropdown" id="user">
                    <a  href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user">&nbsp;<?php 
require_once('logic/database.php'); echo get_user_type_str($_SESSION['current_user_type'])."用户："; 
echo $_SESSION['current_user'];?>&nbsp;</span ><b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li id="change-password"><a href="user.php?option=cp">更改密码</a></li>
                    <li class="divider"></li> 
                    <li id="logout"><a href="logout.php">登出</a></li>

                </ul>
            <?php endif; ?>
        </div><!--/.nav-collapse -->
    </div>
</div>

