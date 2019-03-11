<?php
	namespace Model;
	use Think\Model;

	class AuthModel extends Model{

	    //分页、搜索、排序
	    public function search(){
	    	$where = array();
	        //1.分页信息
	        // $count = $this->where($where)->count();// 查询满足要求的总记录数
	    	$count = $this->count();

	        $page_model = new \Think\Page($count,16);// 实例化分页类 传入总记录数和每页显示的记录数(25)
	        $page  = $page_model->show();// 分页显示输出

	        //2.获取分页数据
	        $data = $this->getTree();
	        // dump($data);die();
	        $info = array_slice($data, $page_model->firstRow,$page_model->listRows);
	        // dump($info);die();
	        //打印sql
	        // echo $this->getLastSql();
	        // die();
	        return array(
	        	'page'=>$page,
	        	'info'=>$info
	        );

	    }


	public function getTree(){
		$data = $this->select();
		// dump($data);die();
		return $this->_reSort($data);
	}

	/**
	*重新排序
	*@param array $data 要重新排序数组
	*@param int $parent_id 父id
	*@param int $level 级别
	*@param int $isClear 是否清空数组
	*@return array $ret 排序好的数组
	*/
	public function _reSort($data,$parent_id=0,$level=0,$isClear=TRUE){
		static $ret = array();
		if($isClear){
			$ret = array();
		}

		foreach ($data as $k => $v) {
			if($v['parent_id'] == $parent_id){
				$v['level'] = $level;
				$ret[] = $v;
				$this->_reSort($data,$v['auth_id'],$level+1,FALSE);
			}
		}

		return $ret;
	}

			/**
			*重新排序
			*@param array $arr 要重新排序数组
			*@param int $pid 父id
			*@return array $res 排序好的数组
			*/
			public function tree($arr,$pid=0,$level=0){
				static $res = array();
				foreach ($arr as $v) {
					if($v['parent_id'] == $pid){
						$v['level'] = $level;
						//说明找到，先保存，在继续递归查找
						$res[] = $v;
						$this->tree($arr,$v['cat_id'],$level+1);
					}
				}
				return $res;
			}
			/**
			*获取指定分类cat_id所有子cat_id，同时包含自身
			*@param int $cat_id 分类主键
			*@return array $res包含自身cat_id的数组
			*/
			public function getSubIds($cat_id){


				$sql = "select * from {$this->table}";
				$cats = $this->db->getAll($sql);
				$cats_sort = $this->tree($cats,$cat_id);

				$res = array();
				foreach ($cats_sort as $k => $v) {
					$res[] = $v['cat_id'];
				}
				//将自身保存到数组中
				$res[] = $cat_id;

				return $res;
			}

	}



?>