<?php session_start(); 
    //phpinfo();
    print(session_id());
	$user = $_SESSION['redislogin_user'];
	if($user==""){
		$user = $_POST["username"];
		$_SESSION['redislogin_user'] = $user;
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<link href="../../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="../../../js/jquery-1.7.2.min.js"></script>
	</head>
	<body>
		<div class="container">
			<div class="page-header">
				<h1>Redis Session Demo</h1>
			</div>
			
			<a href="logout.php">Logout</a>
			
			<form id="form_test" method="post" action="demo.php" class="well form-inline">
				User Name
				<input id="user_name" type="text" name="username" class="input-small">
				<input id="btn" type="submit" name="submit" value="Submit" class="btn">
			</form>
			
			<?php
			   if($user != "")
			       echo "<h3> Login User : ".$user."</h3>" 
			?>
			
		</div>

	</body>
</html>