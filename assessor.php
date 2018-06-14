<?php
session_start();
$_SESSION['expiretime'] = time() + 3600;
///if(isset($_SESSION['expiretime'])) {  
    //if($_SESSION['expiretime'] < time()) {  
        //unset($_SESSION['expiretime']);  
       // header('Location: logout.php'); // 登出  
        //exit(0);  
    //} else {  
   //     $_SESSION['expiretime'] = time() + 3600; // 刷新时间戳
    //}  
//}  
require_once 'class/infooutput.alixa.class.php';
//找session
if(empty($_SESSION["UID"]))
{
    header("Location:index.php");//定义不能跳转页面
    }
//找coolie
//$_COOKIE["uid"]    
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>审核页面</title>
</head>

<body>
<h1>审核页面 </h1>
<table width="100%" border="1" cellpadding="0" cellspacing="0">
<tr>
    <td>序号</td>
    <td>内容</td>
    <td>状态</td>
    <td>操作</td>
</tr>
<?php
  include("mydbda.php");
  $db=new mydbda();
  $sql="select * from users";
  $str=$db->Select($sql,"CX","mydb");
  $hang=explode("|",$str);
  for($i=0;$i<count($hang);$i++)
     {
         $lie=explode("^",$hang[$i]);
         $sex=$lie[3]?"男":"女";
         $zhuangtai=$lie[6]?"<input type='text' value='审核已通过' checked='checked'/>":"<a href='shenhechuli.php?uid={$lie[0]}'>审核</a>";
         echo "<tr>
               <td>{$lie[0]}</td>
               <td>{$lie[1]}</td>
               <td>{$lie[2]}</td>
               <td>{$sex}</td>
               <td>{$lie[4]}</td>
               <td>{$lie[5]}</td>
               <td>{$zhuangtai}</td>
              </tr>";
         }

?>
</table>
</body>
</html>