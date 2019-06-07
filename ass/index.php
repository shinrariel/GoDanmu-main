<?php
	session_start();
	if(array_key_exists('UID', $_SESSION))
	{
		header("Location:/ass/login.action.php?already_login=1");
		exit();
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>互动审核系统 身份验证</title></head>
<h2>互动审核系统 身份验证</h2>
<form name="LoginForm" method="post" action="/ass/login.action.php">    
<p>  
<label for="password" class="label">密 码:</label>  
<input id="password" name="password" type="password" class="input">  
</p>
<p>  
<input type="submit" name="submit" value="  确 定  " class="left">  
</p>  
</form>  
<?php
	if(array_key_exists('wp', $_SESSION) && $_SESSION['wp']==1)
		echo("<br><br><p>密码位数不少于18位</p>");
?>
</html>