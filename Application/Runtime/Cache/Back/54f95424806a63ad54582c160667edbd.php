<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form action="/index.php/Back/Yk/edit/id/12345" method="post">
		<input type="hidden" name="id" value="<?php echo ($info['id']); ?>">	
		上级栏目：<select name="fenlei" value="<?php echo ($info['fenlei']); ?>">
					<option>分类A级</option>
					<option>　　分类A1级</option>
					<option>分类B级</option>
					<option>　　分类B1级</option>
				 </select><br>
		分类名称：<input type="text" ><br>
		别名：<input type="text"><br>
		目录：<input type="text"><br>
		内容类型：<select>
					<option>文章</option>
					<option>语句</option>
				 </select><br>
		是否生成静态html：<input type="checkbox"><br>
		<input type="submit" value="修改">
	</form>
</body>
</html>