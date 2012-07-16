<?php
$key = $_GET["term"];
$redis = new Redis();
$redis -> pconnect('127.0.0.1');
$val = $redis -> zRank("search", $key);

if (strlen($val)!=0) {
	$ret = $redis -> zRange("search", $val, $val + 100);

	$a = array();
	foreach ($ret as $v) {
		if (substr($v, -1) == "*")
			array_push($a, substr($v, 0, -1));
	}
	echo json_encode($a);
}
?>