<?php
$con = mysql_connect("localhost", "root", "robby");
mysql_select_db("demo", $con);
$t = date("y-m-d H:i:s");
$sql = "INSERT INTO tab_forum (title, content, author, time) VALUES ('$_POST[title]','$_POST[content]','$_POST[author]', '$t')";

print $sql;
if (!mysql_query($sql, $con)) {
	die('Error: ' . mysql_error());
}

$k = md5("mysql_query" . "select * from tab_forum order by time desc");
$redis = new Redis();
$redis -> connect('127.0.0.1');
$redis -> del($k);

header("Location:./cache.php")
?>