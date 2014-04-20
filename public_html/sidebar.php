<div class="col-sm-3 col-md-2 sidebar nav-inverse">
    <ul class="nav nav-pills nav-justified">
        <li id="sidebar-records" class="">
        <a href="records.php"> <span class="glyphicon glyphicon-list-alt"></span></br>记录</a>
        </li>
        <li id="sidebar-user-management" class="">
        <a href="user-management.php"><span class="glyphicon glyphicon-user"></span></br>用户</a>
        </li>
        <li id="sidebar-movie-management" class="">
        <a href="movie-management.php"><span class="glyphicon glyphicon-play-circle"></span></br>电影</a>
        </li>
    </ul>
    <ul class="nav nav-sidebar nav-pills nav-stacked">
        <?php if (PAGE == 'records.php' || PAGE == 'home.php') : ?>
        <li class="divider"></li>
        <li  class="">
        <a  data-target="#insert-record" data-toggle="modal" href="#"><span class="glyphicon glyphicon-plus"> 添加放映记录</span></a>
        </li>
        <li>
        <a href="#"><span class="glyphicon
                glyphicon-list"> 查看放映记录</span></a>
        </li>
        <li>
        <a data-target="#search-record" data-toggle="modal" href="#"><span class="glyphicon glyphicon-search">
                搜索放映记录</span></a>
        </li>
        <?php endif;?>
        <?php if (PAGE == 'user-management.php' || PAGE == 'home.php') : ?>
        <li class="divider"></li>
        <li>
        <a data-target="#insert-user" data-toggle="modal" href="#"><span class="glyphicon glyphicon-plus"> 添加新用户 </span></a>
        </li>
        <li>
        <a href="#"><span class="glyphicon glyphicon-list"> 查看用户</span></a>
        </li>
        <?php endif;?>
        <?php if (PAGE == 'movie-management.php' || PAGE == 'home.php') : ?> 
        <li class="divider"></li>
        <li>
        <a href="#" data-target="#insert-film" data-toggle="modal"><span class="glyphicon glyphicon-plus"> 添加新电影</span></a>
        </li> 
        <li>
        <a href="#" data-target="#insert-chain" data-toggle="modal"><span class="glyphicon glyphicon-plus">
                添加新院线</span></a>
        </li>
        <li>
        <a href="#"><span class="glyphicon glyphicon-list">
                查看电影和院线</span></a>
        </li>
        <?php endif; ?>
    </ul>
</div>

