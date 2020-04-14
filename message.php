<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Leave A Message</title>
  <link rel="stylesheet" href="static/style/top-nav.css" />
  <link rel="stylesheet" href="static/style/message.css" />
</head>
<body>
  <?php
    require 'is_user.php';
    require 'member_top-nav.html';
    require 'db.php';

    $db = new DB();

    @ $name = htmlspecialchars(trim($_POST['name']));
		@ $content = htmlspecialchars(trim($_POST['content']));
		$message_time = date("Y-m-d H:i:s");

		if ( !empty($name) && !empty($content) ) {
			$query = " insert into message_board ( name, message_time, content ) values ( '$name', '$message_time', '$content' )";
			$result = $db->execute_dml($query);

      if ( $result ) echo '<script>alert("留言成功")</script>';
      else           echo '<script>alert("留言失败")</script>';
		}

    $db = null;
  ?>

  <div class="container">
    <h1>Message</h1>
    <div class="nav-bar">
      <div class="item">
        <a href="viewMessage.php">View Message</a>
      </div>
      <div class="item">
        <a href="manage_message.php">Manage Message</a>
      </div>
    </div>
    <div class="info">
      <form action="#" method="post">
        <label><input type="text" id="name" name="name" placeholder="your name" /></label>
        <!-- <label><input type="text" name="title" placeholder="title" /></label> -->
        <textarea name="content" rows="6" cols="40" placeholder="content"></textarea>
        <div class="btn">
          <input type="submit" value="Submit" onclick="return check();" />
        </div>
      </form>
    </div>
  </div>
  <script>
    function check() {
      var name = document.getElementById('name').value;
      var content = document.getElementsByTagName('textarea')[0].value;
      var reg = /^\s*$/;

      if ( reg.test(name) || reg.test(content) ) {
        alert('字段不能为空!');
        return false;
      }
      return true;
    }
  </script>
</body>
</html>
