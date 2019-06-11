<?php
	
	define('DEBUG_ALLOW_ANONYMOUS_LOGIN', false);//调试常量:允许不进行安全检查
	#调试常量结束
	session_start();
	$_SESSION['wp'] = $_SESSION['uid'] ? 0 : $_SESSION['wp'];
	
	function logincheck($password){
	//验证密码采用php内置安全验证
	$correct_pass = 'sytv20190623qwq';
	$hash = password_hash($correct_pass, PASSWORD_DEFAULT);
	}
	$refuse = !logincheck($_POST["password"]);
	if($_SESSION['uid']){
		//已存在登陆态跳转
		header("Location:assessor.php");
		exit();
	}

	if($refuse && !DEBUG_ALLOW_ANONYMOUS_LOGIN  ){  
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
		require_once 'class/func.class.php';
		$_SESSION['uid'] = makeuid($_SESSION['uid']);
		$_SESSION['time_b'] = time();
		$ass_string = $uid_file . md5( date( 'Y-m-d H:i:s' , $_SESSION['time_b'] ) );
		$_SESSION['assid'] = md5($ass_string);
		allinfooutput();
	}
?>