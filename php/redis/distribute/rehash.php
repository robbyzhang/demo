<?php
  $ra = new RedisArray(array("127.0.0.1","127.0.0.1:6380","127.0.0.1:6381"), array('previous' => array("127.0.0.1","127.0.0.1:6380")));
  $ra -> _rehash();
?>