<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

		<title>Weibo Demo</title>
		<link href="../../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="../../../js/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src="../../../js/jquery.form.js"></script>
		<script type="text/javascript" src="../../../js/jquery.cookie.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {

				if ($.cookie("auth") != null) {
					$("#form_login").hide();
					$("#div-user").show();
				} else {
					$("#form_login").show();
					$("#div-user").hide();
				}
			});
		</script>
	</head>

	<body>
		<div class="container">
			<div class="page-header">
				<form id="form_login" method="post" action="login.php" class="well form-inline">
					<input id="form_oper" type="hidden" name="oper">
					用户名:
					<input id="string_key" type="text" name="name" class="input-small">
					密码:
					<input id="string_key" type="password" name="password" class="input-small">
					<input id="btn_login" type="submit" name="submit" value="登录" class="btn">
					<a href="register.html">注册</a>
					<lable id="lab_ret"></lable>
				</form>
				<div id="div-user">
					<lable id="lab-user">
						<?php $redis = new Redis();
						$redis -> pconnect('127.0.0.1');
						$co = $_COOKIE['auth'];
						$id = $redis -> get("au:$co");
						echo $redis -> get("uid:$id:name");
						?>
					</lable>
					<a href="logout.php">注销</a>
				</div>
			</div>

			<h3>当前未关注用户</h3>
			<div class="well" id="ret_string">
				<table class="table table-bordered">
					<tbody>
						<?php $l = $redis -> get("nextId");

						for ($i = 1; $i < $l; $i++) {
							if ($i != $id && !$redis -> sIsMember("uid:$id:follow", $i)) {
								$name = $redis -> get("uid:$i:name");
								echo "<tr><td>" . $name . "</td><td><a href=\"follow.php?name=$name\">关注</a></td></tr>";
							}
						}
						?>
					</tbody>
				</table>
			</div>

			<h3>已关注用户</h3>
			<div class="well" id="ret_string">
				<table class="table table-bordered">
					<tbody>
						<?php $ar = $redis -> sMembers("uid:$id:follow");
						foreach ($ar as $value) {
							$name = $redis -> get("uid:$value:name");
							echo "<tr><td>" . $name . "</td><td><a href=\"unfollow.php?name=$name\">取消关注</a></td></tr>";
						}
						?>
					</tbody>
				</table>
			</div>

			<h3>发布微薄</h3>

			<form method="post" action="post.php" class="well form-inline">
				<input type="text" name="content" class="span6">
				<input type="submit" name="submit" value="发布" class="btn">
			</form>

			<h3>微薄</h3>
			<div class="well" id="ret_string">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>发布人</th>
							<th>时间</th>
							<th>内容</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						function strElapsed($t) {
								$d = time() - $t;
								if ($d < 60)
									return "$d seconds";
								if ($d < 3600) {
									$m = (int)($d / 60);
									return "$m minute" . ($m > 1 ? "s" : "");
								}
								if ($d < 3600 * 24) {
									$h = (int)($d / 3600);
									return "$h hour" . ($h > 1 ? "s" : "");
								}
								$d = (int)($d / (3600 * 24));
								return "$d day" . ($d > 1 ? "s" : "");
							}
						$ar = $redis -> lRange("uid:$id:post", 0,  -1);
						foreach ($ar as $value) {
							$data = $redis -> get("post:$value");
							$aux = explode("|", $data);
							$id = $aux[0];
							
							$content = $aux[2];
							$name = $redis -> get("uid:$id:name");

							
							
							$t=strElapsed($aux[1]);

							echo "<tr><td>$name</td><td>$t</td><td>$content</td></tr>";
						}
						?>
					</tbody>
				</table>
			</div>

		</div>

	</body>
</html>
