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
				$("#topic_list").load("list_topics.php");
				$("#btn_new_topic").click(function() {
					$("#frm_new_topic").ajaxSubmit(function(resp) {
						$("#topic_list").load("list_topics.php");
					});
					return false;
				});

			});

		</script>
	</head>

	<body>
		<div class="container">
			<div class="page-header">
				<h1>Chat Room Demo</h1>
			</div>

			<h3>创建一个新主题</h3>
			<form id="frm_new_topic" method="post" action="create_topic.php" class="well form-inline">
				主题:
				<input type="text" name="topic_name" class="input-small">
				<input id="btn_new_topic" type="submit" name="submit" value="创建" class="btn">
			</form>

			<h3>昵称</h3>
			<div class="well">
				<input type="text" id="user_name" class="input-small" value="">
			</div>
			
			<h3>主题列表</h3>
			<div class="well" id="topic_list"></div>
		</div>

	</body>
</html>
