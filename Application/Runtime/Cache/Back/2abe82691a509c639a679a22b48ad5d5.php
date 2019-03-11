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

	<form action="/index.php/Back/Qz/update/id/8" method="post">
		<input type="hidden" name="id" value="<?php echo ($info['id']); ?>" />
		分类名：	<input type="text" name="fenlei" value="<?php echo ($info['fenlei']); ?>"><br>
				<input type="submit" name="添加">
	</form>

</body>
</html>