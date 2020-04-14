<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Signup</title>
  <link rel="stylesheet" href="static/style/login.css" />
  <link rel="stylesheet" href="static/style/top-nav.css" />
  <link rel="stylesheet" href="static/style/signup.css" />
</head>
<body>
  <?php
    require 'top-nav.html';
   ?>
  <div class="container">
    <form action="handle_signup.php" method="post">
      <div class="title">
        <h1>Signup</h1>
      </div>
      <div class="info">
        <div class="item">
          <input type="text" id="username" name="username" placeholder="username" />
        </div>
        <div class="item">
          <input type="password" id="password" name="password" placeholder="password" />
        </div>
        <div class="item">
          <input type="password" id="password_ack" name="password_ack" placeholder="password_ack" />
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
    <script>
      var reg = /^\s*$/;
      function check() {
        if ( reg.test(username.value) || reg.test(password.value) || reg.test(password_ack.value) ) {
          alert('字段不能为空!');
          return false;
        }
        return true;
      }
    </script>
  </div>
</body>
</html>
