<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

		<title>Redis Cache Demo</title>
		<link href="../../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="../../../js/jquery-1.7.2.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {

			});
		</script>
	</head>

	<body>
		<div class="container">
			<div class="page-header">
				<h1>Redis Cache Demo</h1>
			</div>

			<h3>发贴</h3>

			<form method="post" action="submit.php" class="well form-horizontal">
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="input01">标题</label>
						<div class="controls">
							<input type="text" class="input-xlarge" name="title">
						</div>
						<br/>
						<label class="control-label" for="input01">内容</label>
						<div class="controls">
							<input type="text" class="input-xlarge" name="content">
						</div>
						
						<br/>
						<label class="control-label" for="input01">发布者</label>
						<div class="controls">
							<input type="text" class="input-xlarge" name="author">
						</div>
						<br/>
						<div class="controls">
							<input id="btn1" type="submit" name="submit" value="Submit" class="btn">
						</div>
						
					</div>
				</fieldset>
			</form>
			<br>

			<h3>Forum List</h3>

			<div class="well" id="ret_list">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>标题</th>
							<th>发布者</th>
							<th>发布时间</th>
						</tr>
					</thead>
					<tbody>
						<?php
						function mysql_query_cache($sql, $linkIdentifier = false, $timeout = 20) {
							$k = md5("mysql_query" . $sql);
							$redis = new Redis();
							$redis -> connect('127.0.0.1');
							$cache = unserialize($redis -> get($k));
							print $$linkIdentifier;
							if ($cache == "") {
								print("Fetch from DB");
								$cache = false;
								$r = ($linkIdentifier != false) ? mysql_query($sql, $linkIdentifier) : mysql_query($sql);
								if (is_resource($r) && (($rows = mysql_num_rows($r)) !== 0)) {
									for ($i = 0; $i < $rows; $i++) {
										$fields = mysql_num_fields($r);
										$row = mysql_fetch_array($r);
										for ($j = 0; $j < $fields; $j++) {
											if ($i == 0) {
												$columns[$j] = mysql_field_name($r, $j);
											}
											$cache[$i][$columns[$j]] = $row[$j];
										}
									}
									$redis -> setex($k, $timeout, serialize($cache));
								}
							} else {
								print("Fetch from cache");
							}
							return $cache;
						}

						$con = mysql_connect("localhost", "root", "robby");
						mysql_select_db("demo", $con);

						$r = mysql_query_cache("select * from tab_forum order by time desc", $con);
						$rows = count($r);
						for ($i = 0; $i < $rows; $i++) {
							echo "<tr><td>" . $r[$i]['title'] . "<td>" . $r[$i]['author'] . "</td>" . "<td>" . $r[$i]['time'] . "</td>" . "</td></tr>";
						}
						mysql_close($con);
						?>
					</tbody>
				</table>
			</div>
		</div>

	</body>
</html>
