<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>

	<a href="/index.php/Back/Qz/add">添加分类</a><br>
	<a href="/index.php/Back/Qz/add1">添加规则</a><br>
	<a href="/index.php/Back/Qz/showlist1">查看规则</a><br><br>

	<div class="div_search">
            <form action="<?php echo U('showList');?>" method="get">

                <input type="hidden" name="p" value="1" />
               <div>
                    商品名称：<input type="text" name="fenlei" value="<?php echo I('get.fenlei');?>" />
               </div>
                <input value="查询" type="submit" /><br><br>
            </form>
    </div>

	<button id="scxz">删除选中</button>
	<table border="1" cellspacing="0">
		<tr>
			<td><input type="checkbox" id="qx"></td>
			<td>ID</td>
			<td>分类名</td>
			<td>操作</td>
		</tr>
		<?php if(is_array($info)): foreach($info as $key=>$v): ?><tr>
				<td><input type="checkbox" class="qx1" id="<?php echo $v['id']?>"></td>
				<td><?php echo ($v["id"]); ?></td>
				<td><?php echo ($v["fenlei"]); ?></td>
				<td><a href="/index.php/Back/Qz/delete/id/<?php echo ($v["id"]); ?>">删除</a>|<a href="/index.php/Back/Qz/update/id/<?php echo ($v["id"]); ?>">修改</a></td>
			</tr><?php endforeach; endif; ?>
	</table>

</body>
<script src="<?php echo (C("BACK_JS_URL")); ?>jq.js"></script>
<script>

     $("#qx").click(function(){
       	var qx1=this.checked;
       	$(".qx1").prop("checked",qx1);
      })

      $("#scxz").click(function(){
      	var xz='';
      	$("input:checkbox").each(function(){
      		if(this.checked==true){
                   xz+=this.id+',';
      		}
             // header("location:/index.php?m=Home&c=Qz&a=delete&id="+xz);
      	})
      	//alert(xz);
          
           window.location.href="/index.php?m=Back&c=Qz&a=delete2&id="+xz;
      })

</script>
</html>