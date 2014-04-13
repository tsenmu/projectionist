<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
	  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	    <span class="sr-only">Toggle navigation</span>
	    <span class="icon-bar"></span>
	    <span class="icon-bar"></span>
	    <span class="icon-bar"></span>
	  </button>
	  <a class="navbar-brand" href="#">电影放映管理系统</a>
	</div>
	<div class="collapse navbar-collapse">
	  <ul class="nav navbar-nav">
	    <li id="home"><a href="home.php">主页</a></li>
	    <li id="query"><a href="query.php">查询</a></li>
            <?php if ($_SESSION['current_user_type'] == 0): ?>
	    <li id="management" class="dropdown">
	      <a href="#" class="dropdown-toggle" data-toggle="dropdown">管理<b class="caret"></b></a>
	      <ul class="dropdown-menu">
		<li id="user-management"><a href="user-management.php">管理用户</a></li>
		<li id="movie-management"><a href="movie-management.php">管理电影</a></li>
	      </ul>
        </li>
        <?php endif; ?>
        <?php if($_SESSION['current_user_type'] == 3): ?>
            <li id="insert"><a href="insert.php">录入</a></li>
        <?php endif;?>
        <li id="logout"><a href="logout.php">登出</a></li>
	  </ul>
		</div><!--/.nav-collapse -->
	</div>
</div>
<script src="js/navbar.js"></script>

