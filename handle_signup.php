<?php
session_start();
header('Content-type: text/html; charset=utf-8');

require 'db.php';

$db = new DB();

$username = htmlspecialchars(trim($_POST['username']));
$password = htmlspecialchars($_POST['password']);
$password_ack = htmlspecialchars($_POST['password_ack']);
$captcha = strtolower(htmlspecialchars(trim($_POST['captcha'])));

if ( $password === $password_ack ) {
  if ( $captcha === strtolower($_SESSION['authcode']) ) {
    // md5加密
    $password = md5($password);
    $query = " insert into user (username, password) value ( '$username', '$password' ); ";
    $result = $db->execute_dml($query);

    if ( !$result ) {
      echo '<script>alert("注册失败，请重新注册!"); location.href="' . 'signup.php"</script>';
    } else {
?>
    <div style="position: absolute; top: 50%; left: 40%; color: #333; font-size: 20px;">
      注册成功, 去
      <a href="login.php" style="color: rgb(62, 146, 223); text-decoration: none;">登录</a>
      <span id="count" style="color: red;">5</span> 秒后返回到登录页面
    </div>
    <script>
      function Count() {
        count.innerText--;
        if ( count.innerText == 0 ) {
          location.href = 'login.php';
        } else {
          setTimeout(Count, 1000);
        }
      }
      setTimeout(Count, 1000);
    </script>
<?php
    }
  } else {
    echo '<script>alert("验证码不正确")</script>';
  }
} else {
  echo '<script>alert("两次密码不匹配")</script>';
}
?>
