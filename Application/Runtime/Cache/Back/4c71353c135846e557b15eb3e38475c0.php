<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form action="/index.php/back/yk/add" method="post">
		栏目ID：<input type="text" name="id"><br>
		上级栏目：<select name="fenlei">
					<option >分类A级</option>
					<option >　　分类A1级</option>
					<option >分类B级</option>
					<option >　　分类B1级</option>
				 </select><br>
		分类名称：<input type="text" name="fenlei1"><br>
		别名：<input type="text" name="bieming"><br>
		目录：<input type="text" name="mulu"><br>
		内容类型：<select>
					<option>文章</option>
					<option>语句</option>
				 </select><br>
		是否生成静态html：<input type="checkbox"><br>
		<input type="submit" value="提交">
	</form>
</body>
</html>


































<!-- <?php foreach($info as $v){ ?>
	<option value="<?php echo ($v["fenlei"]); ?>"><?php echo ($v["fenlei"]); ?></option>
<?php }?> -->