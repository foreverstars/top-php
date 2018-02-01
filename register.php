<?php
	
	class Res {
		public $code;
		public $message;
	}

	$username = $_POST["username"];
	$passsword = $_POST["password"];

	$link = mysql_connect("127.0.0.1", "root", "123456");
	if($link) {
		$select = mysql_select_db("user", $link);
		if($select) {
			$username = $_POST["username"];
			$passsword = $_POST["password"];
			$repeatPassword = $_POST["repeatPassword"];
			if($name=="" || $password==""){
  			// 判断是否填写
  			$res = new Res
  			$res->$code = 1
  			$res->$message = "用户名和密码为空"
  			echo $res
			}
			if($password == $repeatPassword){
				// 判断输入密码和重复密码是否一样
				$dbusername = null;
				$result = mysql_query("select * from user where username='{$username}'")
				while ($row=mysql_fetch_array($result)){
					$dbusername = $row["username"]
				}
				if(!is_null($dbusername)){
					// 用户已存在
					$res = new Res
					$res->$code = 2
					$res->$message = "该用户名已存在"
					echo $res
				}
				// 注册成功
				$res = new Res
				$res->$code = 0
				$res->message = "注册成功"
				echo $res
				mysql_query("insert into user (username,password) values ('${username}', '${password}')") or die("存入数据库失败".mysql_error())
				mysql_close($link)
			}
			$res = new Res
			$res->$code = 3
			$res->$message = "输入密码和重复密码不一致"
			echo $res
		}
	}
?>