	session_start();
	$time=time();
	$uid_file=fopen("uid.now","r+");
	$uid_last=(int)fread($uid_file,filesize("uid.now"));
	fclose($uid_file);
	if(isset($_SESSION[UID])!=1) 
	{
		$uid=$uid_last+1;
		$_SESSION[UID]=$uid;
		$uid_file_w=fopen("uid.now","w");
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
	echo("您的session名为：".$_COOKIE['PHPSESSID'].",<br>"."您的临时变量为:".$_SESSION[assid].",<br>"."您的审核员ID为：".$_SESSION[assid].",<br>"."您的UID为：".$_SESSION[UID].",<br>"."您的登陆时间：".date("Y-m-d H-i-s",$_SESSION[time_breaker]));