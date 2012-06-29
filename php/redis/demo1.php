<?php
  $key=$_GET["key"];
  echo "key=".$key;
  $redis = new Redis();
  $redis->connect('127.0.0.1');
  $val=$redis->get($key);
  echo "<br>";
  echo "value=".$val;
?>

