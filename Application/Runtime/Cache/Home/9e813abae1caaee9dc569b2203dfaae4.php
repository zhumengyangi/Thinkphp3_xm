<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>   
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
  <form action="/index.php/Home/Index\add1" method="post">
    姓名：<input type="text" name="name"><br>
    电话：<input type="text" name="phone"><br>
    <input type="submit" value="提交">
  </form>
</body>
</html>