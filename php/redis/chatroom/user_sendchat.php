<?php
require_once 'data.php';

$user_name=$_GET["user_name"];
$topic_name=$_GET["topic_name"];



$redis = new Redis();
$redis -> pconnect('127.0.0.1');

$t = "[".date("y-m-d H:i:s")."]";
$msg=$t.$user_name.":".$_GET["message"];
$n = $redis -> lSize(PREFIX_TOPIC.$topic_name);
for ($i = 0; $i < $n; $i++) {
	$val = $redis -> lGet(PREFIX_TOPIC.$topic_name, $i);
	$redis -> rPush(PREFIX_USER_INBOX.$val, $msg);
}

?>
