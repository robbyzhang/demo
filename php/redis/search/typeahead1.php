<?php
$key = $_GET["term"];
$redis = new Redis();
$redis -> pconnect('127.0.0.1');
$val = $redis -> zRevRange($key, 0, 4);
//print_r($val);
echo json_encode($val);

?>