<?php
$name = $_POST["name"];
$pwd = $_POST["password"];

$redis = new Redis();
$redis -> pconnect('127.0.0.1');
$id = $redis -> get("name:$name:uid");

$pwd1 = $redis -> get("uid:$id:pwd");

if ($pwd == $pwd1) {
	$au = $redis -> get("uid:$id:auth");
	setcookie("auth", $au, time() + 3600 * 24 * 365);
	header("Location:index.php");
} else {
	echo "登录失败";
}

end:
?>

