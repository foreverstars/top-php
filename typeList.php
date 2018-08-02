<?php
  $data = [];
  $raw = file_get_contents('php://input');
  $json = json_decode($raw,true);

  $type = $json['type'];

  $conn = mysqli_connect('127.0.0.1', 'root', '123456', 'web');
  mysqli_options($conn,MYSQLI_OPT_INT_AND_FLOAT_NATIVE,true);
  
  $sql = "select id, type, time, title, brief from blog_list where type= '$type'";

  $ret = mysqli_query($conn, $sql);

  if (mysqli_num_rows($ret) > 0) {
    $list = array();
    while ($row = mysqli_fetch_assoc($ret)) {
      array_push($list, $row);
    }
    $data['code'] = 0;
    $data['data'] = $list;
    echo json_encode($data);
  } else {
    $list = [];
    $data['code'] = 0;
    $data['data'] = $list;
    echo json_encode($data);
  }
?>