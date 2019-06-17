<?php
/**  component.conf.php
	* 整套系统所有的配置文件
	* 调用配置文件信息时，请创建变量$conf_componant_need = 1;
    * @config
	* @version 0.0.1
	* @author Beichi_qwq <g841734459@126.com>
    * 
*/  
    //mysql数据库配置项
    if(!isset($conf_mysqli_exist) && $conf_mysqli_need)
    {
        $conf_mysqli_exist = 1;
        $conf_mysqli_host   = 'localhost:3308';
        $conf_mysqli_user   = 'root';
        $conf_mysqli_passwd = 'ght759153';
        $conf_mysqli_db     = 'godanmu';
    }

    //redis配置项
    if(!isset($conf_redis_exist) && $conf_redis_need)  
    {
        $conf_redis_exist = 1;
        $conf_redis_host   = 'localhost';
        $conf_redis_port   = 6379;
        //$conf_redis_user   = 'root';
        //$conf_redis_passwd = 'ght759153';
        $conf_redis_db     = 'godanmu';
    }

    //goim1配置项
    if(!isset($conf_goim1_exist) && $conf_goim1_need)  
    {
        $conf_goim1_exist       = 1;
        $conf_goim1_host        = 'server1';
        $conf_goim1_port_send   = 7172;
        $conf_goim1_port_get    = 8090;
        //$conf_goim1_passwd    = 'passwd';
    }

    //goim2配置项
    if(!isset($conf_goim2_exist) && $conf_goim2_need)  
    {
        $conf_goim2_exist       = 1;
        $conf_goim2_host        = 'server2';
        $conf_goim2_port_send   = 8172;
        $conf_goim2_port_get    = 9090;
        //$conf_goim2_passwd    = 'passwd';
    }
    include "/ass/conf/debug.conf.php";
?>