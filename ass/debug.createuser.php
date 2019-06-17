<?php
require_once "conf/debug.conf.php";
if(DEBUG_ALLOW_REGISTER || $_SESSION['is_admin'])
{
$user = $_GET['username'];
$pw = $_GET['passwd'];
$passwd = password_hash($pw.'salt:$username$'.$user,PASSWORD_DEFAULT);
echo $user.'<br>'.$passwd."@phpversion:7.2";
$checksum = password_verify('lqbly303-1'.'salt:$username$'.$user,$passwd);
echo '<br>'.(string)$checksum;
}
//php version 7.2
//本方式生成的用户注册信息相信输入是安全的，可以在./conf/debug.conf.php中关闭调试常量，但admin也有此权限，只是生成的注册信息必须是有数据库维护能力的人员手动添加
?>