<script type="text/javascript">
	$(document).ready(function() {
		$("a.delete_link").click(function() {
			var name=$(this).attr("topic_name");
			var url="del_topic.php?topic_name=" + name;
			$.ajax(url);
			$("#topic_list").load("list_topics.php");
		});
		
		$("a.join_topic").click(function() {
			var tname=$(this).attr("topic_name");
			var name=$("#user_name").attr("value");
			if(name == ""){
		       alert("昵称不能为空！");
		       return;
			}
			var url="topic.php?topic_name=" + tname + "&user_name=" + name;
			window.location = url;
		});
	});
</script>

<?php
require_once 'data.php';
$redis = new Redis();
$redis -> pconnect('127.0.0.1');

$n = $redis -> lSize(TOPIC_LIST);

echo '<table class="table table-bordered table-striped">';
for ($i = 0; $i < $n; $i++) {
	$val = $redis -> lGet(TOPIC_LIST, $i);
	echo "<tr><td>" . $val . '</td><td><a href="#" class="join_topic" topic_name="'. $val .'">进入主题</a></td><td><a href="#" class="delete_link" topic_name="'. $val .'">删除主题</a></td></tr>';
}
echo "</table>";
?>
