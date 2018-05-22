<?php
	header("Access-Control-Allow-Origin: *");
	header('Content-type: application/json');

	$data = [];
	$username = isset($_POST["username"]) ? $_POST["username"] : '';
	$password = isset($_POST["password"]) ? $_POST["password"] : '';
	$repeatPassword = isset($_POST["repeatPassword"]) ? $_POST["repeatPassword"] : '';

	$link = mysqli_connect("127.0.0.1", "root", "123456", "web");

	if($link) {
		$select = mysqli_select_db($link, "web");
		if($select) {
			if($username=="" || $password==""){
  			// 判断是否填写
  			$data['code'] = 1;
  			$data['message'] = "用户名和密码为空";
  			echo json_encode($data);
			}
			if($password == $repeatPassword){
				// 判断输入密码和重复密码是否一样
				$dbusername = null;
				$result = mysqli_query($link, "select * from user where username='{$username}'");
				while ($row=mysqli_fetch_array($result)){
					$dbusername = $row["username"];
				}
				if(!is_null($dbusername)){
					// 用户已存在
					$data['code'] = 2;
					$data['message'] = "该用户名已存在";
					echo json_encode($data);
				} else {
					// 注册成功
					$data['code'] = 0;
					$data['message'] = "注册成功";
					echo json_encode($data);
					mysqli_query($link, "insert into user (username,password) values ('${username}', '${password}')") or die("存入数据库失败".mysqli_error());
					mysqli_close($link);
				}
			} else {
				$data['code'] = 3;
				$data['message'] = "输入密码和重复密码不一致";
				echo json_encode($data);
			}
		}
	}
?>