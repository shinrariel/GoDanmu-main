<?php
	session_start();
	if(isset($_GET[already_login]))
	{
		if(!isset($_SESSION[UID]))
		{
			exit("qwqqq1!");
		}
	}
	else
	{
		if(!isset($_POST['submit']))
		{
			exit("qwqqq2!");
		}
	}
	$password = $_POST["password"];
	if($password=="1" || $_GET[already_login]=1){  
		//登录成功
		if(!isset($_SESSION[UID]))
		{
			$time=time();
			$uid_file=fopen("/var/uid.now","r+");
			$uid_last=intval(fread($uid_file,filesize("/var/uid.now")));
			$uid=$uid_last+1;
			$uid_str=(string)$uid;
			fwrite($uid_file,$uid_str);
			fclose($uid_file);
			$_SESSION[UID]=$uid;
			setcookie(UID,$uid,3600);
		}
		if(isset($_SESSION[assid])!=1)
		{
			$_SESSION[time_breaker]=$time;
			$timex=$time+rand(1,500);
			$ass_string=$uid_file.$timex;
			$_SESSION[assid]=md5($ass_string);
		}
		require_once 'class/infooutput.alixa.class.php';
		echo("<br>申请审核员成功，请前往<a href=assessor.php>审核页面</a>");
	} else 
	{
		$_SESSION=array();
		session_destroy();
		header("Location:index.php?action=WP");
	}
?>