<?php
	header("Access-Control-Allow-Origin: *");
	class Res {
		public $code;
		public $message;
	}

	$username = $_POST["username"];
	$password = $_POST["password"];
	$repeatPassword = $_POST["repeatPassword"];

	$link = mysqli_connect("127.0.0.1", "root", "123456");
	if($link) {
		$select = mysqli_select_db($link, "user");
		echo $select;
		if($select) {
			if($username=="" || $password==""){
  			// 判断是否填写
  			$res = new Res();
  			$res->$code = 1;
  			$res->$message = "用户名和密码为空";
  			echo $res;
			}
			if($password == $repeatPassword){
				// 判断输入密码和重复密码是否一样
				$dbusername = null;
				$result = mysqli_query("select * from user where username='{$username}'");
				while ($row=mysqli_fetch_array($result)){
					$dbusername = $row["username"];
				}
				if(!is_null($dbusername)){
					// 用户已存在
					$res = new Res();
					$res->$code = 2;
					$res->$message = "该用户名已存在";
					echo $res;
				}
				// 注册成功
				$res = new Res;
				$res->$code = 0;
				$res->message = "注册成功";
				echo $res;
				mysqli_query("insert into user (username,password) values ('${username}', '${password}')") or die("存入数据库失败".mysqli_error());
				mysqli_close($link);
			}
			$res = new Res();
			$res->$code = 3;
			$res->$message = "输入密码和重复密码不一致";
			echo $res;
		}
	}
?>