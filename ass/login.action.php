<?php
	#调试常量
	define('DEBUG_FLAG', false);
	#调试常量结束
	session_start();
	if(isset($_GET['already_login']))
	{
		if(!isset($_SESSION['uid']))
		{
			exit("qwqqq1!");
		}
	}
	/*
	else
	{
		if(!isset($_POST['submit']))
		{
			exit("qwqqq2!");
		}
	}*/
	$password = $_POST["password"];

	$correct_pass = 'sytv20190623qwq';
	$hash = password_hash($correct_pass, PASSWORD_DEFAULT);

	if(password_verify($password, $hash) || DEBUG_FLAG){  
		//登录成功
		$_SESSION['wp'] = 0;
		if($_SESSION['uid']){
			//已存在登陆态
			header("Location:assessor.php");
			exit();
		} else{
			require_once 'class/func.class.php';
			$_SESSION['uid'] = makeuid($_SESSION['uid']);
			$_SESSION['time_b'] = time();
			$ass_string = $uid_file . md5( date( 'Y-m-d H:i:s' , $_SESSION['time_b'] ) );
			$_SESSION['assid'] = md5($ass_string);
			allinfooutput();
		}
	} else 
	{
		$_SESSION['wp'] = 1;
		header("Location:index.php");
		exit();
	}
?>