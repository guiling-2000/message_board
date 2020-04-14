<?php
session_start();

if ( !isset($_SESSION['uid']) || empty($_SESSION['uid']) ){
  echo '<script>alert("无权访问"); location.href="' . 'login.php"</script>';
}
