<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>

	<a href="/index.php/Back/Qz/add">添加分类</a><br>
	<a href="/index.php/Back/Qz/showlist">查看分类</a><br>
	<a href="/index.php/Back/Qz/add1">查看规则</a><br><br>

	<form action="/index.php/Back/Qz/add1" method="post">
		<select name="fenlei">
			<?php foreach($info as $v){ ?>
				<option value="<?php echo ($v["fenlei"]); ?>"><?php echo ($v["fenlei"]); ?></option>
			<?php }?>
		</select><br>
		规则：<input type="text" name="guize"><br>
		姓名：<input type="text" name="username"><br>
		<input type="submit" value="添加">
	</form>
	
</body>
</html>