<!DOCTYPE html>
<?php require_once(dirname(__FILE__) . '/../resources/config.php'); ?>
<html>
  <head>
    <!-- common styles -->
    <?php require_once($config["includes"]["header"]);?>
    <!-- custom styles -->
    <link href="css/login.css" rel="stylesheet" type="text/css">
    <!-- generate title from config file -->
    <title><?php echo $config["vars"]["title"] ?></title>
  </head>
  <body>
    <div class="container">
      <form class="form-signin" role="form">
        <h2 class="form-signin-heading">请登录</h2>
        <div class="control-group" id="username_field">
            <input type="text" class="form-control" placeholder="用户名" required autofocus>
            <span class="help-inline">该用户不存在</span>
        </div>
        <div class="control-group" id="password_field">
            <input type="password" class="form-control" placeholder="密码" required>
            <span class="help-inline">密码不正确</span>
        </div>
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> 在这台电脑上记住我 
        </label>
        <button class="btn btn-lg btn-primary btn-block" type="submit">登录</button>
      </form>
    </div> <!-- /container -->
    <!-- javascripts -->
    <?php require_once($config["includes"]["footer"]);?>
    <script type="text/javascript">
        $(function() {
            var login_result = '<?php echo $result; ?>';
            if (login_result) == 'username')
            {
                $('#username_field').addClass('error');
            }
            else
            {
                $('#password_field').addClass('error');
            }
        });
    </script>
  </body>
</html>
