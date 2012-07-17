<?php
$key = $_GET["term"];
$redis = new Redis();
$redis -> pconnect('127.0.0.1');

for($i=0; $i<strlen($key); $i++)
{
	$k = substr($key, 0, $i+1);
	$redis -> zIncrBy($k, 1, $key);
}

echo $key." submitted"
?>