<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Message Board</title>
		<link href="static/style/index.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<?php
		require 'top-nav.html';
		require 'db.php';
		
		$db = new DB();
		$sql1 = " select * from message_board ";
		$result1 = $db->execute_dql($sql1);

		if ( $result1->num_rows > 0 ) { /* 数据库里有数据 */
			while ( $row = $result1->fetch_object() ) {

				echo "<div class='message_item clearfix item'>
						<div class='name'> {$row->name} </div>
						<div class='message_time'> {$row->message_time} </div>
						<div class='content'> {$row->content} </div>
						</div>";
			}
			$result1->free();
		} else {
		?>
			<script type="text/javascript">
				alert( "当前还没有留言" );
			</script>
		<?php
		}

		@ $name = $_GET['name'];
		@ $content = $_GET['content'];
		$message_time = date("Y-m-d H:i:s");

		if ( !empty($name) && !empty($content) ) {
			$sql2 = " insert into message_board ( name, message_time, content ) values ( '$name', '$message_time', '$content' )";
			$result2 = $db->execute_dml($sql2);
			if ( $result2 ) {
				echo "<script>location.href='" . "index.php'" . "</script>";
			}
		}
		?>

			<form action="#" method="get" onsubmit="return check()">
				<input type="text" id="name" name="name" placeholder="Your Name" />
				<textarea name="content" cols="30" rows="3" placeholder="Content"></textarea>
				<input type="submit" value="submit" />
			</form>
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
