<?php
  $key=$_GET["key"];
  echo "key=".$key;
  $redis = new Redis();
  $redis->connect('127.0.0.1');
  $n=$redis->lSize($key);
  for($i=0; $i<$n; $i++)
  {
    $val=$redis->lGet($key, $i);
    echo "<br>";
    echo "value_".$i."=".$val;
  }
?>

