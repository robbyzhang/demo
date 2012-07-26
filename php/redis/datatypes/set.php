<?php
$redis = new Redis();
$redis -> pconnect('127.0.0.1', 6380);

for($i=0; $i<2000; $i++){
	echo $i."\r\n";
	for($j=0; $j<500; $j++)
		$redis->sAdd($i, $j."a");
}

?>