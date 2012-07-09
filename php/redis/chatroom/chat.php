<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

		<title>Chat Room</title>
		<link href="../../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="../../../js/jquery-1.7.2.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				var socket = new WebSocket('ws://127.0.1.1:8081');
				socket.onopen = function(event){
					socket.send('subscribe chat');
					socket.onmessage = function(event){
						alert(event);
					}
				}
			});
		</script>
	</head>

	<body>
		<div class="container">
			<div class="page-header">
				<h1>Chat Room Demo</h1>
			</div>

			<h3>Search String</h3>
			<div class="well" id="ret_string"></div>
			
			<br>

			<h3>Search List</h3>
			<form method="post" action="" class="well form-inline">
				Key:
				<input id="list_key" type="text" name="key" class="input-small">
				<input id="btn1" type="submit" name="submit" value="Search" class="btn">
			</form>
			<div class="well" id="ret_list"></div>
		</div>

	</body>
</html>
