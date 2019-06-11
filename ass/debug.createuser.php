<?php
require_once "conf/debug.conf.php";
if(DEBUG_ALLOW_REGISTER)
{
$user = $_GET['username'];
$pw = $_GET['passwd'];
$passwd = password_hash($pw.'salt:$username$'.$user,PASSWORD_DEFAULT);
echo $user.'<br>'.$passwd."@phpversion:7.2";
$checksum = password_verify('lqbly303-1'.'salt:$username$'.$user,$passwd);
echo '<br>'.(string)$checksum;
}
//php version 7.2
?>