<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>轮播图</title>
	<style type="text/css">
		*{
			margin: 0;
			padding: 0;
		}
		#wrap{
			width: 1130px;
			height: 500px;
			border: 5px solid green;
			margin: 0 auto;
			position: relative;
			overflow: hidden;
		}
		#juan{
			width: 9999px;
			height: 500px;
			background-color: pink;
			position: absolute;
			left: 0;
			top:0;
			transition: all 1s ease-out;
			
		}
		#juan img{
			float: left;
			width: 1130px;
			height: 500px;
		}
		#left{
			position: absolute;
			left:0;
			top:50%;
			margin-top: -30px;
			display: none;
			cursor: pointer;
		}
		#right{
			position: absolute;
			right:0;
			top:50%;
			margin-top: -30px;
			display: none;
			cursor: pointer;
		}
		#btns li{
			width: 40px;
			height: 40px;
			background-color: #ccc;
			border-radius: 50%;
			float: left;
			text-align: center;
			line-height: 40px;
			cursor: pointer;
		}
		#btns{
			list-style: none;
			position: absolute;
			bottom: 0;
			left: 50%;
			margin-left: -80px;
		}
	</style>
</head>
<body>
    <a href="<?php echo U('Back/Goods/showlist');?>">返回后台管理</a>
	<div id="wrap">
		<div id="juan">
		<!-- 展示出图片 -->
		   <?php if(is_array($info)): foreach($info as $key=>$v): ?><img src='<?php echo (C("IMG_URL")); echo ($v["goods_big_logo"]); ?>'><?php endforeach; endif; ?>
		</div>
		<img src="<?php echo (C("HOME_IMG_URL")); ?>left.png" id="left">
		<img src="<?php echo (C("HOME_IMG_URL")); ?>right.png" id="right">
		<!-- 展示出图片数量标签 -->
		<ul id="btns">
		   <!-- $count就是获取到的图片总数 -->
		   <?php for($i=1;$i<=$count;$i++){echo "<li>$i</li>";}?>
		</ul>
	</div>
	<!-- 隐藏域来获取图片数量和轮播间隔时间 -->
	<input type="hidden" id="count" value="<?php echo ($count); ?>">
	<input type="hidden" id="jiange" value="<?php echo I('get.jiange')?I('get.jiange'):'2000';?>">

</body>
<script type="text/javascript">
	var wrap = document.getElementById('wrap');
	var left = document.getElementById('left');
	var right = document.getElementById('right');
	var lis = document.querySelectorAll('#btns li');
	var juan = document.getElementById('juan');

	var count = document.getElementById('count');//通过标签获取图片数量信息
	var jiange = document.getElementById('jiange');//通过标签获取轮播时间间隔

    var num=count.value -1;  //图片数量减一来获取最大下标
    var time=jiange.value -0;  //自动轮播时间间隔
    

  
	lis[0].style.backgroundColor = 'red';

	// 鼠标滑过wrap，显示与隐藏按钮
	wrap.onmouseover = function(){
		left.style.display = 'block';
		right.style.display = 'block';
		clearInterval(timer);
	}
	wrap.onmouseout = function(){
		left.style.display = 'none';
		right.style.display = 'none';
		timer = setInterval(autoPlay,time);//time时间需要修改  是轮播时间间隔
	}
	
	// // 单击向右切换图片
	var index = 0;
	right.onclick = function(){
		autoPlay();
	}
	// 单击向左切换图片
	left.onclick = function(){
		index--;
		if(index < 0){
			index = num;  //num就是我们所获取的图片下标
		}
		juan.style.left = - 1130 * index + 'px';
		for(var i = 0; i < lis.length; i++){
			lis[i].style.backgroundColor = '#ccc';
		}
		lis[index].style.backgroundColor = 'red';
	}

	// 自动轮播
	function autoPlay(){

		index++;
		if(index > num){    //num就是我们所获取的图片下标
			index = 0;
		}
		juan.style.left = - 1130 * index + 'px';

		// 点变红
		for(var i = 0; i < lis.length; i++){
			lis[i].style.backgroundColor = '#ccc';
		}
		lis[index].style.backgroundColor = 'red';
		// index = 1
	}

	var timer = setInterval(autoPlay, time); //time时间需要修改  是轮播时间间隔


	// 给每一个li添加鼠标滑过事件
	lis[i]
	for(var i = 0; i < lis.length; i++){
		lis[i].no = i;
		lis[i].onmouseover = function(){
			// console.log(i);   
			juan.style.left = -1130 * this.no + 'px';

			for(var j = 0; j < lis.length; j++){
				lis[j].style.backgroundColor = '#ccc';
			}
			this.style.backgroundColor = 'red';
			//3
			index = this.no;
		}
		//  3
	}


</script>
</html>