<?php
	if(!isset($_POST['1q84']))
	{
		exit("出现错误。");
	}
	else
	{
		session_start();
		echo($_POST['pwd']);
		$time=time();
		$uid_file=fopen("/var/uid.now","r+");
		$uid_last=(int)fread($uid_file,filesize("/var/uid.now"));
		fclose($uid_file);
		if(isset($_SESSION[UID])!=1) 
		{
			$uid=$uid_last+1;
			$_SESSION[UID]=$uid;
			setcookie(UID,$uid,3600);
			$uid_file_w=fopen("/var/uid.now","w");
			fwrite($uid_file_w, $uid);
			fclose($uid_file_w);
		}
		if(isset($_SESSION[assid])!=1)
		{
			$_SESSION[time_breaker]=$time;
			$timex=$time+rand(1,500);
			$ass_string=$uid_file+$timex;
			$_SESSION[assid]=md5($ass_string);
		}
		require_once 'class/infooutput.alixa.class.php';
		echo("<br>申请审核员成功，请前往<a href=assessor.php>审核页面</a>");
	}
?>