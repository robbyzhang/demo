<?php
echo "<p><a href=\"index.php\">back</a></p>";


$co=$_COOKIE['auth'];
if($co==""){
	echo "<p>please login first!</p>";
	return;
}

$content = $_POST["content"];
if("$content" == ""){
	echo "<p>Content can't be empty!</p>";
	return;
}

$redis = new Redis();
$redis -> pconnect('127.0.0.1');

$id = $redis -> get("au:$co");

$ret = $redis->multi()
    ->get('nextPostId')
    ->incr('nextPostId')
    ->exec();

$postid = $ret[0];

$post = $id ."|".time()."|".$content;
$redis -> set("post:$postid", $post);

$redis -> lPush("uid:$id:post", $postid);

$ar = $redis -> sMembers("uid:$id:followers");
foreach ($ar as $value) {
	$redis -> lPush("uid:$value:post", $postid);
}



echo "Post successful!"

?>

