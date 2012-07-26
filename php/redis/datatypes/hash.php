<?php
$redis = new Redis();
$redis -> pconnect('127.0.0.1', 6380);

/*
for($i=0; $i<1000000; $i++){
    
    if( ($i%1000) == 0 )
		echo $i."\r\n";
	
	
    $redis -> hSet("hh", $i, "this is a test");
	//$redis -> set($i, "this is a test");
}
*/

for($i=0; $i<2000; $i++){
  for($j=0; $j<500; $j++){
    $redis -> hSet($i, $j, "this is a test");
  }
}


/*
 * 84
 * 84
 * 25
 * */

?>