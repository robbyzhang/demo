<?php
$name = $_POST["name"];
$pwd = $_POST["pwd"];
$pwd1 = $_POST["pwd1"];

if ($pwd != $pwd1) {
	echo "密码不一致！注册失败！";
	return;
}

if ($name == "") {
	echo "用户名不能为空！";
	return;
}

if ($pwd == "" || $pwd1 == "") {
	echo "密码不能为空！";
	return;
}

$redis = new Redis();
$redis -> pconnect('127.0.0.1');

if (($redis -> get("name:$name:uid")) != "") {
	echo "用户已存在，注册失败！";
	return;
}

$ret = $redis->multi()
    ->get('nextId')
    ->incr('nextId')
    ->exec();
$id = $ret[0];

$redis -> set("uid:$id:name", $name);
$redis -> set("uid:$id:pwd", $pwd);
$redis -> set("name:$name:uid", $id);

function getrand() {
	$fd = fopen("/dev/urandom", "r");
	$data = fread($fd, 16);
	fclose($fd);
	return md5($data);
}

$au = getrand();
$redis -> set("uid:$id:auth", $au);
$redis -> set("au:$au", $id);



echo "注册成功";
?>