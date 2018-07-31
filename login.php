<?php
	
	// 声明变量
	$raw = file_get_contents('php://input');
	$json = json_decode($raw,true);

	$username = $json["username"];
	$password = $json["password"];
  //$remember = $json["remember"]
	$data = [];

	// 判断用户名和密码是否为空
	if (!empty($username) && !empty($password)) {
		// 建立连接
		$conn = mysqli_connect('127.0.0.1', 'root', '123456', 'web');

		mysqli_options($conn,MYSQLI_OPT_INT_AND_FLOAT_NATIVE,true);

		// 执行sql语句
		$sql_select = "select * from user where username = '$username' and password = $password";

		// 执行sql语句
		$ret = mysqli_query($conn, $sql_select);

		$row = mysqli_fetch_array($ret);


		// 判断用户名或密码是否正确
    if($username==$row['username']&&$password==$row['password']) {
    //选中“记住我”
	    // if($remember=="on") {
	    //   //创建cookie
	    //   setcookie("wang", $username, time()+7*24*3600);
	    // }
	    // //开启session
	    // session_start();
	    // //创建session
			// $_SESSION['user']=$username;

			$info = [];
			$info['id'] = $row['id'];
			$info['username'] = $row['username'];

			$data['code'] = 0;
			$data['message'] = "登录成功";
			$data['data'] = $info;
	
			echo json_encode($data);

	    //关闭数据库
	    mysqli_close($conn);
		} else {
			mysqli_close($conn);
		    //用户名或密码错误
			$data['code'] = 1;
			$data['message'] = "账号或密码错误";
			echo json_encode($data);
		}
	}

?>