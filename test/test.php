<?php

require "db.php";

$db = new DB();
$username = 'admin';
$query = " select * from user where username='$username'";
$result = $db->execute_dql($query);

print_r($result);