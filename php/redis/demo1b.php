<?php
  $key=$_POST["key"];
  echo "key=".$key;
  $redis = new Redis() or die("Can'f load redis module.");
  $redis->connect('127.0.0.1');
  $n=$redis->lSize($key);
  for($i=0; $i<$n; $i++)
  {
    $val=$redis->lGet($key, $i);
    echo "<br>";
    echo "value_".$i."=".$val;
  }
?>

<br>
<a href="demo1.html">back</a>
