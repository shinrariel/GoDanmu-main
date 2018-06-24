<?php
	session_start();
	if(isset($_SEESSION[UID]))
	{
		header("Location:login.action.php?already_login=1");
		exit();
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>互动审核系统 身份验证</title></head>
<h2>互动审核系统 身份验证</h2>
<form name="LoginForm" method="post" action="login.action.php">    
<p>  
<label for="password" class="label">密 码:</label>  
<input id="password" name="password" type="password" class="input">  
<p/>
<p>  
<input type="submit" name="submit" value="  确 定  " class="left">  
</p>  
</form>  
<?php
	if($_GET[action]=="WP")
		echo("<br><br><p>验证失败，密码位数不少于18位</p>");
?>
</html>