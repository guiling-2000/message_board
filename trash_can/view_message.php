<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>View Message</title>
  <link rel="stylesheet" href="style/top-nav.css" />
  <link rel="stylesheet" href="style/view_message.css" />
</head>
<body>
  <?php
  require 'is_user.php';
  require 'member_top-nav.html';
  require 'db.php';

  $sqlconnct  = new DB();

  $query = " select * from message_board ";
  $result = $sqlconnct->execute_dql($query);
  $rows = $result->num_rows;
  // 每一页的留言数量 
  const PAGE = 4;

  if ( $rows === 0 ) {
    echo '<script>alert("当前还没有留言")</script>';
  } else {
    // the number of page
    $page_nums = ceil( $rows / PAGE );
    $query = $result = NULL;
    // 第几页
    $page = isset($_GET['id']) ? $_GET['id'] : 1;
    $first = ( $page - 1 ) * PAGE;
    $last =  $page * PAGE;

    $query = " select * from message_board limit $first, $last; ";
    $result = $sqlconnct->execute_dql($query);
    echo "<div class='container'><div class='message'>";
    while ( $row = $result->fetch_object() ) {
      echo "<div class='message_item'>
              <button onclick='Delete(this)'>Delete</button>
              <div class='name'> $row->name </div>
              <div class='time'> $row->message_time </div>
              <div class='content'> $row->content </div>
            </div>
           ";
    }
    $result->free();
    $sqlconnct->close();

    echo "<div class='pagination'>";
    for ( $i = 1; $i <= $page_nums; $i++ ) {
      echo "<a href='?id={$i}'>{$i}</a>";
    }
    echo "</div>
          </div>
          </div>";

    echo "
      <script>
        // current page
        var page = $page;
        var element = document.querySelectorAll('.pagination a');

        for ( var i = 0; i < element.length; i++ ) {
          if ( element[i].innerText == page ) element[i].style.background = 'rgba(219, 131, 26, 0.76)';
        }
      </script>
         ";
  }
?>
</body>
</html>
