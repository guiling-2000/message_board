<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Manage Message</title>
  <link rel="stylesheet" href="static/style/top-nav.css" />
  <link rel="stylesheet" href="static/style/view_message.css" />
  <link rel="stylesheet" href="static/style/manage_message.css" />
</head>
<body>
  <?php
    require 'is_user.php';
    require 'member_top-nav.html';
  ?>
  <div class="container">
    <div class="message">

    </div>
  </div>
  <script src="static/script/ajax.js"></script>
  <script src="static/script/handle_message.js"></script>
</body>
</html>
