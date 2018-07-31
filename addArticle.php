<?php
  $data = [];
	$raw = file_get_contents('php://input');
  $json = json_decode($raw,true);
 
  $link = mysqli_connect("127.0.0.1", "root", "123456", "web");
  mysqli_options($link,MYSQLI_OPT_INT_AND_FLOAT_NATIVE,true);

  $author = $json['author'];
  $authorId = $json['authorId'];
  $title = $json['title'];
  $content = $json['content'];
  $type = $json['type'];
  // $time = time();

  $sql = "insert into blog_list (author, authorId, title, content, type) values ('$author', $authorId , '$title', '$content', '$type')";
  // 执行sql语句
  if (mysqli_query($link, $sql)){
    $data['code'] = 0;
    $data['message'] = '新增成功';
    echo json_encode($data);
  } else {
    $data['code'] = 1;
    $data['message'] = '新增失败';
    echo json_encode($data);
    // die("存入数据库失败".mysqli_error());
  }
?>