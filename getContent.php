<?php
  $data = [];
  $raw = file_get_contents('php://input');
  $json = json_decode($raw,true);

  $id = $json['id'];

  $conn = mysqli_connect('127.0.0.1', 'root', '123456', 'web');
  mysqli_options($conn,MYSQLI_OPT_INT_AND_FLOAT_NATIVE,true);
  
  $sql = "select id, title, author, time, content from blog_list where id= '$id'";

  $ret = mysqli_query($conn, $sql);

  $row = mysqli_fetch_assoc($ret);

  if (!empty($row)) {
    $data['code'] = 0;
    $data['data'] = $row;
    echo json_encode($data);
  } else {
  }
?>