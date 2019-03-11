<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<a href="<?php echo U('add');?>">添加</a>
	<div>
		<form action="" method="get">
			ID搜索<input type="text" name="id" value="<?php echo I('get.id');?>">
			<input type="submit" value="搜索">
		</form>
	</div>
	<div>
		<table border="1" cellspacing="0">
			<tr>
				<th>ID</th>
				<th>栏目名称</th>
				<th>操作</th>
			</tr>
			<?php if(is_array($info)): foreach($info as $key=>$v): ?><tr>
				<td><?php echo $v['id']?></td>
				<td><?php echo $v['fenlei']?></td>
				<td><a href="/index.php/Back/Yk/edit/id/<?php echo ($v["id"]); ?>">修改</a></td>
			</tr><?php endforeach; endif; ?>
		</table>
	</div>
</body>
</html>