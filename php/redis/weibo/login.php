<?php
$name = $_POST["name"];
$pwd = $_POST["password"];
$oper = $_POST["oper"];

if ($oper == "register") {
	$redis = new Redis();
	$redis -> pconnect('127.0.0.1');
	$id = $redis -> get("nextId");

	$redis -> set("uid:" . $id . ":name", $name);
	$redis -> set("uid:" . $id . ":pwd", $pwd);

	$redis -> hSet("nameToUid", $name, $id);

	$redis -> incr("nextId");
	$val = $redis -> get($key);
	echo "注册成功";
}

if ($oper == "login") {
	$redis = new Redis();
	$redis -> pconnect('127.0.0.1');
	$id = $redis -> hGet("nameToUid", $name);

    $pwd1 = $redis -> get("uid:".$id.":pwd");
    
	if($pwd == $pwd1)
		echo "登录成功";
	else {
		echo "登录失败";
	}
}
?>

