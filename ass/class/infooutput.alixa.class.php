<?php
	echo("您的session名为：".$_COOKIE['PHPSESSID'].",<br>"."您的临时变量为:".$_SESSION[assid].",<br>"."您的审核员ID为：".$_SESSION[assid].",<br>"."您的UID为：".$_SESSION[UID].",<br>"."您的登陆时间：".date("Y-m-d H-i-s",$_SESSION[time_breaker]));
?>
