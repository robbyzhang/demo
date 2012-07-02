<?php

  $redis = new Redis();
  $redis->connect('127.0.0.1');



$tmp_object = new stdClass;
$tmp_object->str_attr = 'test';
$tmp_object->int_attr = 123;

$redis->set('key', serialize($tmp_object)) or die ("Failed to save data at the server");
echo "Store data in the cache (data will expire in 10 seconds)<br/>\n";

$get_result = unserialize($redis->get('key'));
echo "Data from the cache:<br/>\n";

echo($get_result->str_attr);
echo($get_result->int_attr);

?>
