<?php
	function makeuid($sessuid = 0){
	/**  
	* 重新实现了uid分配算法 
	* 
	* @access public 
	* @param int $sessuid 使用该函数时必须传入$_session[UID] 
	* @return int or die
	*/  
		if($sessuid != 0){
			return $sessuid;
		}
		$uid_file = fopen( "./class/uid" , "r+" ) or die( "Unable to open UID file!");
		$uid_last = (int)fread( $uid_file , filesize("./class/uid") );
		fclose($uid_file);
		$uid = $uid_last + rand(542,rand(543,rand(544,120487)));
		$uid_file = fopen( "./class/uid" , "w" ) or die("Unable to write UID file!");
		fwrite($uid_file , (string)$uid);
		fclose($uid_file);
		return $uid;
	}
	function allinfooutput(){
		//这个丢人东西，我是真的不想用，但是等下还要调试，好烦啊好烦qwq
		echo "您的审核员ID为：".$_SESSION['assid'].",<br>";
		echo "您的UID为：".$_SESSION['uid'].",<br>";
		echo "您的登陆时间：".date("Y-m-d H-i-s",$_SESSION['time_b']);
		echo("<br>申请审核员成功，请前往<a href=assessor.php>审核页面</a>");
	}
	function allowLogin(){
    $uid[]  = array('session' => $_SESSION['uid'],'cookie' =>$_COOKIE['uid']);

}
?>