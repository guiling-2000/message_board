<?php
session_start();
// 销毁注册变量
unset($_SESSION['uid']);
// 销毁 整个 session
session_destroy();
?>
<script>
  location.href = 'login.php';
</script>
