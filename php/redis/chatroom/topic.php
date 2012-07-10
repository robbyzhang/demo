<?php
require_once 'data.php';
$redis = new Redis();
$redis -> pconnect('127.0.0.1');

$user_name = $_GET["user_name"];
$topic_name = $_GET["topic_name"];
$key = PREFIX_TOPIC . $topic_name;
$found=false;

$n = $redis -> lSize($key);

for ($i = 0; $i < $n; $i++) {
	$val = $redis -> lGet($key, $i);
	if($val == $user_name)
	    $found = true;
}

if(!$found){
  $redis -> lPush($key, $user_name);
  
  $redis -> setex(PREFIX_USER_ALIVE.$user_name, 100, "1");
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

		<title>Chat Room</title>
		<link href="../../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="../../../js/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src="../../../js/jquery.form.js"></script>
		<script type="text/javascript">
		$(document).ready(function() {
				$("#btn_send_msg").click(function(){
					url = "user_sendchat.php?user_name="+<?php echo '"' . $user_name . '"'; ?>
						+"&topic_name="+<?php echo '"' . $topic_name . '"'; ?>
													+"&message="+$("#message").attr('value');
					//alert(url);
					$("#message").attr('value','');
					$.ajax(url);
					//window.location=url;
					
					load_topic_content();
					
				
					
				});
				function load_topic_users(){
					url = "list_topic_user.php?topic_name="+<?php echo '"' . $topic_name . '"'; ?>
					     +"&user_name="+<?php echo '"' . $user_name . '"'; ?>;
					//alert(url);
					$("#topic_users").load(url);
					
				}
				load_topic_users();
				setInterval(load_topic_users, 5000)
				
				function load_topic_content(){
					url = "user_getchat.php?user_name="+<?php echo '"' . $user_name . '"'; ?>
												+"&topic_name="+<?php echo '"' . $topic_name . '"'; ?>;
					$.get(url, "", function(resp){
						var m=$("#chat_content").html();
						m = m + resp;
						$("#chat_content").html(m);
					});
				}
				load_topic_content();
				setInterval(load_topic_content, 2000)
				
		});

		</script>
	</head>

	<body>
		<div class="container">
			<div class="page-header">
				<h1>Chat Room Demo<br><a href="chat.php">back</a></h1>
			</div>

			<h3>当前主题：<?php echo $_GET["topic_name"]; ?></h3>
			
			<div class="well form-inline">
				<label><?php echo $_GET["user_name"]; ?></label>
				<input type="text" id="message" class="input" value="">
				<input id="btn_send_msg" type="submit" name="submit" value="发送" class="btn">
			</div>
			
			<h3>聊天内容</h3>
			<div class="well" id="chat_content" style="height:300px;">
				
			</div>
			
			<h3>参与者</h3>
			<div class="well" id="topic_users"></div>
		</div>

	</body>
</html>
