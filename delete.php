<?php
if ( !empty($_REQUEST['id']) ) {
  require 'db.php';
  $db = new DB();

  $id = $_REQUEST['id'];
  $query = " delete from message_board where id='$id' ";
  $result = $db->execute_dml($query);

  if ( $result ) echo 'delete successfully!!!';
  else           echo '';

  $db->close();
}
