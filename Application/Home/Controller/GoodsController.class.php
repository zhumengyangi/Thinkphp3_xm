<?php 

	namespace Home\Controller;
	use Think\Controller;


	/**
	* 
	*/
	class GoodsController extends Controller
	{
		public function showlist()
		{
			$goods=D("Goods");

			$info=$goods->select();//按照优先级来排序优先展示图片
	        $count=$goods->count();//获取轮播图片总数

			$this->assign("info",$info);
			$this->assign("count",$count);

			$this->assign("time",$_POST['jiange']);//获取后台传来的轮播间隔
			
	        

			$this->display();
		}
	}


?>