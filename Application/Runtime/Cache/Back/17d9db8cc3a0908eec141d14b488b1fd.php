<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<table>
		<th>
			<select name="category" id="sheng">
				<option value="">-请选择省级分类-</option>
				<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["area_id"]); ?>"><?php echo ($v["area_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
			</select>
			<select name="statuss" id="shi">
				<option value="">-请选择市级分类-</option>
			</select>
			<select name="status" id="xian">
				<option value="">-请选择县级分类-</option>
			</select>
		</th>
	</table>
</body>
</html>
<script src="<?php echo (C("BACK_JS_URL")); ?>jq.js"></script>
<script type="text/javascript">
	$(document).ready(function(e){

		$('#sheng').change(function(){
			sheng();
		})

		$('#shi').change(function(){
			shi();
		})

		function sheng(){
			var sheng=$('#sheng').val();
			$.ajax({
				url:'<?php echo U("Three/ajaxArea");?>',
				data:{data:sheng,num:1},
				type:'post',
				dataType:'html',
				success:function(data){
					$('#shi').html(data);
				}
			})
		}

		function shi(){
			var shi=$('#shi').val();
			$.ajax({
				url:'<?php echo U("Three/ajaxArea");?>',
				data:{data:shi,num:1},
				type:'post',
				dataType:'html',
				success:function(data){
					$('#xian').html(data);
				}
			})
		}

	})
</script>