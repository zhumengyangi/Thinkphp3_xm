<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
  <a href="/index.php/Back/Duo/add">返回添加页面</a><br>

  <table border="1" cellspacing="0" align="center">
    <tr>
      <th>会员姓名</th>
      <th>联系电话</th>
      <th>商品分类</th>
      <th>商品名称</th>
      <th>商品数量</th>
      <th>上货价</th>
      <th>奖金币</th>
      <th>上货价总额</th>
      <th>奖金币总额</th>
      <th>收货地址</th>
      <th>发货日期</th>
    </tr>
    
    <?php foreach($info as $v):?>
    <tr>
      <td><?php echo ($v["member_name"]); ?></td>   
      <td><?php echo ($v["member_phone"]); ?></td>   
      <td><?php echo ($v["classify"]); ?></td>   
      <td><?php echo ($v["goods_name"]); ?></td>   
      <td><?php echo ($v["goods_num"]); ?></td>   
      <td><?php echo ($v["top_price"]); ?></td>   
      <td><?php echo ($v["money_num"]); ?></td>   
      <td><?php echo ($v["top_he"]); ?></td>   
      <td><?php echo ($v["money_he"]); ?></td>   
      <td><?php echo ($v["city"]); ?></td>   
      <td><?php echo (date("Y-m-d H:i:s",$v["add_time"])); ?></td>   
    </tr>
    <?php endforeach;?>
  </table>
</body>
</html>