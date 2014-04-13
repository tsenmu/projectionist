<!DOCTYPE html>
    
<html>
  <head>
    <!-- common styles -->
    <meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name= "viewport" content="width=device-width, initial-scale=1.0">
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="css/common.css" rel="stylesheet">
        
    <!-- custom styles -->
    <link href="css/login.css" rel="stylesheet" type="text/css">
    <!-- generate title from config file -->
    <title>电影放映管理系统</title>
  </head>
  <body>
    <div class="container">
      <form class="form-signin" role="form">
        <h2 class="form-signin-heading">请登录</h2>
        <div class="control-group" id="username_field">
            <input id="username" type="text" class="form-control" placeholder="用户名" required autofocus>
            <span class="help-inline">该用户不存在</span>
        </div>
        <div class="control-group" id="password_field">
            <input id="password" type="password" class="form-control" placeholder="密码" required>
            <span class="help-inline">密码不正确</span>
        </div>
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> 在这台电脑上记住我 
        </label>
        <button id="submit" class="btn btn-lg btn-primary btn-block" type="submit">登录</button>
      </form>
        <p id="feedback"></p>
    </div> <!-- /container -->
    <!-- javascripts -->
    <script src="http://code.jquery.com/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
    <script src="js/login.js"> </script>
  </body>
</html>

