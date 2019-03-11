<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>

	<a href="/index.php/Back/Qz/add">添加分类</a><br>
	<a href="/index.php/Back/Qz/add1">添加规则</a><br>
	<a href="/index.php/Back/Qz/showlist">查看分类</a><br><br>
	<button id="scxz1">删除选中</button>
	<table border="1" cellspacing="0">
		<tr>
			<td><input type="checkbox" id="qx"></td>
			<td>ID</td>
			<td>权限规则</td>
			<td>权限名称</td>
			<td>所属分类</td>
			<td>操作</td>
		</tr>
		<?php foreach($data as $v){ ?>
			<tr>
				<td><input type="checkbox" class="qx1" id="<?php echo $v['id']?>"></td>
				<td><?php echo ($v["id"]); ?></td>
				<td><?php echo ($v["guize"]); ?></td>
				<td><?php echo ($v["username"]); ?></td>
				<td><?php echo ($v["fenlei"]); ?></td>
				<td><a href="/index.php/Back/Qz/delete1/id/<?php echo ($v["id"]); ?>">删除</a>|<a href="/index.php/Back/Qz/update1/id/<?php echo ($v["id"]); ?>">修改</a></td>
			</tr>
		<?php } ?>
	</table>
</body>
<script src="<?php echo (C("BACK_JS_URL")); ?>jq.js"></script>
<script >
     $("#qx").click(function(){
       	var qx1=this.checked;
       	$(".qx1").prop("checked",qx1);
      })
      //选中删除
        // $("#scxz1").click(function(){
        //  	$(".qx1:checked").closest("tr").remove();
        //  })
      $("#scxz1").click(function(){
      	var xz='';
      	$("input:checkbox").each(function(){
      		if(this.checked==true){
                   xz+=this.id+',';
      		}
             // header("location:/index.php?m=Home&c=Qz&a=delete&id="+xz);
      	})
      	//alert(xz);
          
           window.location.href="/index.php?m=Back&c=Qz&a=delete3&id="+xz;
      })

</script>
</html>