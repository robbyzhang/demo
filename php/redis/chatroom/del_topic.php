<?php
  require_once 'data.php';
  $redis = new Redis();
  $redis->pconnect('127.0.0.1');
  $name=$_GET["topic_name"];

  $redis->lRem(TOPIC_LIST, $name);
  echo "operation done<br>";
  echo '<a href="chat.php">back</a>';
?>