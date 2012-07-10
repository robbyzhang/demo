
<?php
require_once 'data.php';
$topic_name=$_GET["topic_name"];
$user_name=$_GET["user_name"];

$redis = new Redis();
$redis -> pconnect('127.0.0.1');

$n = $redis -> lSize(PREFIX_TOPIC.$topic_name);

for ($i = 0; $i < $n; $i++) {
	$val = $redis -> lGet(PREFIX_TOPIC.$topic_name, $i);
	echo $val."\t";
}

?>
