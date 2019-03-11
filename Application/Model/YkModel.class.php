<?php

    //商品goodsmodel模型
    namespace Model;
    use Think\Model;

    class YkModel extends Model{
        //搜索
        public function search(){

        	$where = array();
        	$fenlei = I('get.fenlei');
        	if($fenlei){
        		$where['fenlei']  = array('like',"%$fenlei%");
        	}

        }

    }
