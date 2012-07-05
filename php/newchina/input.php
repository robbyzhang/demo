<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="../../js/jquery-1.7.2.min.js"></script>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Insert title here</title>
		<script   language="javascript">
			var count = 0;
			var maxfile = 5;
			function addUpload() {
				if (count >= maxfile)
					return;
				count++;
				//var newDiv = "<div id=divUpload" + count + ">" + " <input id=file" + count + " type=file size=50 name=upload>" + " <a href=javascript:delUpload('divUpload" + count + "');>删除</a>" + " </div>";
				var newDiv = '<div id=divUpload' +count+' ><input id="input' + count +'" type="text" name="input'+ count + '" placeholder="Input"> <input id="output' + count + '" type="text" name="output' + count + '" placeholder="Expected Output"> ' + " <a href=javascript:delUpload('divUpload" + count + "');>删除</a>" + '<br/><br/>';
				document.getElementById("uploadContent").insertAdjacentHTML("beforeEnd", newDiv);
			}

			//删除指定元素
			function delUpload(diva) {
				count--;
				document.getElementById(diva).parentNode.removeChild(document.getElementById(diva));
			}
		</script>
	</head>
	<body>
		<div class="container">
			<div class="page-header">
				<h1>Auto C Function Test Demo</h1>
			</div>

			<form method="post" action="submit.php" class="well form-horizontal">
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="input01">Function Declaration</label>
						<div class="controls">
							<input type="text" class="input-xlarge" name="fname">
						</div>
						<br/>
						<label class="control-label" for="input01">Function Implemetation</label>
						<div class="controls">
							<textarea type="text" class="input-xlarge" name="fimpl"></textarea>
						</div>

						<br/>

						<a href="javascript:addUpload()">Add Test Case</a>
						<div id="uploadContent" class="controls">

						</div>
						

						<br/>
						<div class="controls">
							<input id="btn1" type="submit" name="submit" value="Submit" class="btn">
						</div>

					</div>
				</fieldset>
			</form>
		</div>

	</body>
</html>