<?php
	
	// 声明变量
	$username = $_POST["username"]
	$password = $_POST["password"]
	$remember = $_POST["remember"]

	// 判断用户名和密码是否为空
	if (!empty($username) && !empty($password)) {
		// 建立连接
		$conn = mysqli_connet('localhost', 'root', '123456')

		// 执行sql语句
		$sql_select = "SELECT username, password FROM User WHERE username = '$username' AND password = $password"

		// 执行sql语句
		$ret = mysqli_query($conn, $sql_select)

		$row = mysqli_fetch_array($ret)

		// 判断用户名或密码是否正确
    if($username==$row['username']&&$password==$row['password']) {
    //选中“记住我”
	    if($remember=="on") {
	      //创建cookie
	      setcookie("wang", $username, time()+7*24*3600);
	    }
	    // //开启session
	    // session_start();
	    // //创建session
	    // $_SESSION['user']=$username;

	    //关闭数据库
	    mysqli_close($conn);
		} else {
		    //用户名或密码错误

		}
	}

?>