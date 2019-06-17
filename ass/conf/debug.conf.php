<?php
define('DEBUG_TOOLKIT_USABLE',1);//全局调试常量开关，如果不是高安全模式应该一直为1
if(DEBUG_TOOLKIE_USABLE)
{
    define('DEBUG_ALLOW_ANONYMOUS_LOGIN',0);//启用免认证登陆，系统将生成一个随机合法的登陆态，具有完整的审核员权限
    define('DEBUG_ALLOW_REGISTER',1);//允许从debug.createuser.php 生成一个用户信息
    //define('DEBUG_ALLOW_EMPTY_USER',0);
    define('DEBUG_DISABLE_MYSQL_MODE',0);//启用简单账户模式
    define('DEBUG_ANONYMOUS_ADMIN',0);//赋予anonymous'is_admin'权限
}
?>