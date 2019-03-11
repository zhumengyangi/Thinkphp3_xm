<?php  

/**递归
 *作用：根据pid，对二维数组进行重新排序
 *@params $data array 要进行排序的二维数组
 *@params $parent_id 默认第一级分类
 *@return  $new_arr 排序之后的新数组
 * 
 */

	function _resort($data,$parent_id=0){
		//	保存排序之后的数据
		static $new_arr = array();
		//	通过循环，取数数量
		$foreach ($data as $k => $v) {
			if($v['parent_id'] == $parent_id){
				//	取出一级分类 ，
				$new_arr[] = $v;
				//	找下一级分类
				_resort($datamm$v['cat_id']);
			}
		}
		return $new_arr;
	}
	$res = __resort($arr,0);
	echo '<pre>';
	var_dump($res);

?>