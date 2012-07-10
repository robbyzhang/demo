<?php
require_once 'data.php';

$user_name=$_GET["user_name"];
$topic_name=$_GET["topic_name"];

$redis = new Redis();
$redis -> pconnect('127.0.0.1');

$key=PREFIX_USER_INBOX.$user_name;

while(($val=$redis->lPop($key)) != ""){
	echo $val."<br>";
}
?>