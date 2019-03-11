<?php

    //商品goodsmodel模型

    namespace Model;
    use Think\Model;

    class GoodsModel extends Model{
        //自动完成设置add_time/upd_time
        protected $_auto = array(
            array('add_time','time',1,'function'),
            array('upd_time','time',3,'function'),
        );

        protected $insertFields = array('goods_name','goods_price','goods_weight','goods_introduce');
        protected $updateFields = array('goods_id','goods_name','goods_price','goods_weight','goods_introduce');

        //分页、搜索、排序
        public function search(){

        	$where = array();
        	//按照商品名称搜索
        	$goods_name = I('get.goods_name');
        	// dump($goods_name);die();
        	if($goods_name){
        		// $where['goods_name'] = $goods_name;
        		$where['goods_name']  = array('like',"%$goods_name%");
        	}

        	//按照价格搜索
        	$start_price = I('get.start_price')+0;//将字符串转化int类型
        	$end_price = I('get.end_price')+0;
        	if($start_price && $end_price){
        		$where['goods_price']  = array('between',array($start_price,$end_price));
        	}elseif($start_price){
        		$where['goods_price']  = array('egt',$start_price);

        	}elseif($end_price){
        		$where['goods_price']  = array('elt',$end_price);   		
        	}

            //按照上架搜索
            $is_on_sale = I('get.is_on_sale',-1) + 0;
            if($is_on_sale != -1){
                $where['is_on_sale'] = array('eq',$is_on_sale);
            }
            //按照删除搜索
            $is_delete = I('get.is_delete',-1) + 0;
            if($is_delete != -1){
                $where['is_delete'] = array('eq',$is_delete);
            }

            //排序
            //设置默认
            $order_column = 'goods_id';
            $order_way = 'asc';

            $order = I('get.order','goods_id_asc');
            if($order && in_array($order, array('goods_id_asc','goods_id_desc','goods_price_asc','goods_price_desc'))){
                if($order == 'goods_id_desc'){
                    $order_way = 'desc';
                }elseif ($order == 'goods_price_asc') {
                   $order_column = 'goods_price';
                }elseif ($order == 'goods_price_desc') {
                    $order_column = 'goods_price';
                    $order_way = 'desc'; 
                }
            }

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

        /*****************前台逻辑*********************/
        //获取当前正处于促销期间的商品
        public function getPromoteGoods($limit = 5){
            $now = time();
            return $this->field('goods_id,goods_name,promote_price,goods_sm_logo')
                    ->where(array(
                                'is_on_sale'=>array('eq',1),//上加
                                'is_delete'=>array('eq',0),//未删除
                                'is_promote'=>array('eq',1),//促销的商品
                                'promote_start_time'=>array('elt',$now),
                                'promote_end_time'=>array('egt',$now)
                            ))
                    ->order('sort_num asc')
                    ->limit($limit)
                    ->select();
        }

        public function getHotGoods($limit = 5){
            return $this->field('goods_id,goods_name,promote_price,goods_sm_logo')
                    ->where(array(
                                'is_on_sale'=>array('eq',1),//上加
                                'is_delete'=>array('eq',0),//未删除
                                'is_hot'=>array('eq',1),//是否热销
                            ))
                    ->order('sort_num asc')
                    ->limit($limit)
                    ->select();
        }

    }
