<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>

	<a href="/index.php/Back/Qz/add1">添加规则</a><br>
	<a href="/index.php/Back/Qz/showlist">查看分类</a><br>
	<a href="/index.php/Back/Qz/showlist1">查看规则</a><br><br>

	<form action="/index.php/Back/Qz/add" method="post">
		<div id="pics">
			分类名：<input type="text" name="fenlei" size="5"><br>
					
		</div>
		<!-- <input type="button" style="background-color: white;border:0;" value="[+]添加记录" onclick="addinput()" id="add" /><br><br> -->
		<input type="submit" name="添加" id="from1">
	</form>
	
</body>
<!-- 
    <script src="<?php echo (C("BACK_JS_URL")); ?>jq.js"></script>
    <script>
    function addinput() {
    	var pics=document.getElementById('pics'); 
    	var Add=$("<input type='text' name='fenlei[]' size='5'> <br>");
    	Add.appendTo(pics);
    }

    </script>
 -->
</html>