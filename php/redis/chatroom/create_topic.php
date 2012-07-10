<?php
  require_once 'data.php';
  $redis = new Redis();
  $redis->pconnect('127.0.0.1');
  
  $name=$_POST["topic_name"];
  
  $n=$redis->lSize(TOPIC_LIST);
  $found = false;
  for($i=0; $i<$n; $i++)
  {
    if($redis->lGet(TOPIC_LIST, $i) == $name)
       $found = true;
  }
  
  
  if($name != "" && $found == false)
      $redis->lPush(TOPIC_LIST, $name);
  
?>