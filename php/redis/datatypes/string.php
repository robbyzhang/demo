<?php
$redis = new Redis();
$redis -> pconnect('127.0.0.1', 6380);

for($i=0; $i<1000000; $i++){
	$redis->set($i, $i."a");
}
?>