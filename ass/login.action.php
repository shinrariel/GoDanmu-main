<?php
	$conf_mysqli_need = 1;
	require_once "conf/component.conf.php";
	#调试常量结束
	session_start();
	require_once "api/sql.api.php";
	/*
	 * function simple_logincheck($password){
	 * //已废弃：基于文件的验证密码，采用php内置安全验证
	 * $correct_pass = 'sytv20190623qwq';
	 * $hash = password_hash($correct_pass, PASSWORD_DEFAULT);
	 * }
	 * $refuse = !simple_logincheck($_POST["password"]);
	*/
	if($_SESSION['uid']){
		//已存在登陆态跳转
		header("Location:assessor.php");
		exit();
	}

	$mysql = sqlinit();

	if( !$mysql->check_login($safe_user,$safe_pd,0) && !DEBUG_ALLOW_ANONYMOUS_LOGIN){  
		if(!isset($_POST['submit'])){
			//无登陆态且空密码的处理
			$_SESSION['wp'] = 2;
			header("Location:index.php");
			exit("qwq!");
		} else{
			//无登陆态密码错误的处理
			$_SESSION['wp'] = 1;
			header("Location:index.php");
			exit();
		}
	} else 
	{
		//登录成功
		include_once 'class/func.class.php';
		$_SESSION['uid'] = makeuid($_SESSION['uid']);
		$_SESSION['time_b'] = time();
		$ass_string = $uid_file . md5( date( 'Y-m-d H:i:s' , $_SESSION['time_b'] ) );
		$_SESSION['assid'] = md5($ass_string);
		allinfooutput();
	}
?>