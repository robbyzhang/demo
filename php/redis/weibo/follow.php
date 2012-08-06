<?php
echo "<p><a href=\"index.php\">back</a></p>";
$name = $_GET["name"];

$co=$_COOKIE['auth'];
if($co==""){
	echo "<p>please login first!</p>";
	return;
}

$redis = new Redis();
$redis -> pconnect('127.0.0.1');

$id = $redis -> get("au:$co");

$fid = $redis -> get("name:$name:uid");

if($id == $fid){
	echo "you can't follow yourself!";
	return;
}

$redis->sAdd("uid:$id:follow", $fid);
$redis->sAdd("uid:$fid:followers", $id);
echo "follow $name successful!"

?>

