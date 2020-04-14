<?php
session_start();
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="static/style/top-nav.css" />
  <link rel="stylesheet" href="static/style/login.css" />
</head>
<body>
  <?php
    require 'top-nav.html';
   ?>
  <div class="container">
    <form action="#" method="post">
      <div class="title">
        <h1>Login</h1>
      </div>
      <div class="info">
        <div class="item">
          <input type="text" id="username" name="username" placeholder="username" />
        </div>
        <div class="item">
          <input type="password" id="password" name="password" placeholder="password" />
        </div>
        <div class="item">
          <input type="text" id="captcha" name="captcha" placeholder="captcha" />
          <img src="captcha.php" onclick="this.src='captcha.php?id='+new Date().getTime()" id="captcha_img" alt="captcha_code" />
        </div>
      </div>
      <div class="else">
        <input type="submit" value="submit" onclick="return check()" />
      </div>
    </form>
  </div>
  <script>
    var reg = /^\s*$/;
    function check() {
      if ( reg.test(username.value) || reg.test(password.value) || reg.test(captcha.value) ) {
        alert('字段不能为空!');
        return false;
      }
      return true;
    }
  </script>

  <?php
  if ( isset($_POST['username']) && isset($_POST['password']) && isset($_POST['captcha']) ) {
    require 'db.php';

    $db = new DB();

    $username = htmlspecialchars(trim($_POST['username']));
    $password = htmlspecialchars(trim($_POST['password']));
    $captcha = strtolower(htmlspecialchars(trim($_POST['captcha'])));

    $query = " select * from user where username='$username'";
    $resultObj = $db->execute_dql($query);
    
    $row = $resultObj->fetch_assoc();

    if ( $resultObj->num_rows === 1 && md5($password) === $row['password'] ) {
      if ( $captcha ===  strtolower($_SESSION['authcode']) ) {
        $_SESSION['uid'] = $row['id'];
        echo '<script>location.href="' . 'message.php"</script>';
      } else {
          echo '<script>alert("验证码错误")</script>';
      }
    } else {  // username or password is incorrect
        echo '<script>alert("用户名或密码错误")</script>';
    }

    $db->close();
  }
   ?>
</body>
</html>
