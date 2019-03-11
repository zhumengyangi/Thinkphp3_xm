<?php  

	namespace Model;
    use Think\Model;

    class QzModel extends Model{
    	
    	//分页、搜索、排序
        public function search(){

        	$where = array();
        	//按照商品名称搜索
        	$fenlei = I('get.fenlei');
        	// dump($fenlei);die();
        	if($fenlei){
        		// $where['fenlei'] = $fenlei;
        		$where['fenlei']  = array('like',"%$fenlei%");
        	}

        	//排序
            //设置默认
            $order_column = 'id';
            $order_way = 'asc';

            //1.分页信息
            $count = $this->where($where)->count();// 查询满足要求的总记录数

            $Page = new \Think\Page($count,2);// 实例化分页类 传入总记录数和每页显示的记录数(25)
            $page_info  = $Page->show();// 分页显示输出

            //2.获取分页数据
            $info = $this->where($where)->limit("$Page->firstRow,$Page->listRows")->order("$order_column $order_way")-> select();
            //打印sql
            // echo $this->getLastSql();
            // die();
            return array(
            	'page_info'=>$page_info,
            	'info'=>$info
            );

        }

     }

?>