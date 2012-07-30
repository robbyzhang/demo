<?php
$name = $_POST["name"];
$pwd = $_POST["password"];
$oper = $_POST["oper"];

function getrand() {
    $fd = fopen("/dev/urandom","r");
    $data = fread($fd,16);
    fclose($fd);
    return md5($data);
}

if ($oper == "register") {
	if($pwd == ""){
		echo "注册失败";
		return;
	}
	
	$redis = new Redis();
	$redis -> pconnect('127.0.0.1');
	
	if( ($redis->get("name:$name:uid")) != "" ){
		echo "用户已存在，注册失败！";
		return;
	}
	
	$id = $redis -> get("nextId");

	$redis -> set("uid:$id:name", $name);
	$redis -> set("uid:$id:pwd", $pwd);
	$redis -> set("name:$name:uid", $id);

    $au = getrand();
	$redis -> set("uid:$id:auth", $au);
	$redis -> set("au:$au", $id);

	$redis -> incr("nextId");
	
	echo "注册成功";
}

if ($oper == "login") {
	$redis = new Redis();
	$redis -> pconnect('127.0.0.1');
	$id = $redis -> get("name:$name:uid");
	

    $pwd1 = $redis -> get("uid:$id:pwd");
    
	if($pwd == $pwd1){
		$au = $redis->get("uid:$id:auth");
		setcookie("auth",$au,time()+3600*24*365);
		echo $name."已登录";
	}
	else {
		echo "登录失败";
	}
}

end:
?>

