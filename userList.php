<?php
  $data = [];

  $conn = mysqli_connect('127.0.0.1', 'root', '123456', 'web');
  mysqli_options($conn,MYSQLI_OPT_INT_AND_FLOAT_NATIVE,true);
  
  $sql = "select * from user";

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