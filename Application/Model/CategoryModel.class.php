<?php
	namespace Model;
	use Think\Model;

	class CategoryModel extends Model{

		/***前台页面逻辑代码***/
		//获取左侧导航数据
		public function getNavCatData(){
			//先从缓存中读数据
			$cats_cache = S('cats');
			//缓存是否有数据
			if($cats_cache){
				//有数据
				return $cats_cache;
			}else{
				//无数据

				//方式一：多次读数据库
				//先取出所有的顶级分类
				// $cats = $this->where(array('parent_id'=>array('eq',0)))->select();
				
				// //循环每个顶级分类再取出相应的二级分类
				// foreach ($cats as $k => $v) {
				// 	$cats[$k]['children']=$this->where('parent_id='.$v['cat_id'])->select();

				// 	//循环每个二级分类取出相应的三级分类
				// 	foreach ($cats[$k]['children'] as $k1 => $v1) {
				// 		$cats[$k]['children'][$k1]['children']=$this->where('parent_id='.$v1['cat_id'])->select();
				// 	}
				// }

				//方式二：读一次数据库
				$cats = array();
				//获取所有的分类
				$data = $this->select();

				//循环按照级别排序输出
				foreach ($data as $k => $v) {
					if($v['parent_id'] == 0){
						//循环取出二级分类
						foreach ($data as $k1 => $v1) {
							if($v1['parent_id'] == $v['cat_id']){
								//循环找出三级分类
								foreach ($data as $k2 => $v2) {
									if($v2['parent_id'] == $v1['cat_id']){
										$v1['children'][] = $v2;
									}
								}

								$v['children'][] = $v1;
							}
						}
						$cats[] = $v;
					}
				}

				//保存缓存
				S('cats',$cats);
				return $cats;
			}

		}

	}


?>