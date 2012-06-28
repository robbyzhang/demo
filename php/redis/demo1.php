<?php
  $key=$_POST["key"];
  echo "key=".$key;
  $redis = new Redis() or die("Can'f load redis module.");
  $redis->connect('127.0.0.1');
  $val=$redis->get($key);
  echo "<br>";
  echo "value=".$val;
?>

<br>
<a href="demo1.html">back</a>
