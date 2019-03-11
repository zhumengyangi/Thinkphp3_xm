<?php
namespace Model;
use Think\Model;

class CartModel extends Model{

	public function addToCart($goods_id,$goods_attr_id,$goods_number=1){
		$member_id = session('member_id');

		if($member_id){
			//已登录,操作数据库
			//判断该会员是否第一次将该商品加入购物车，通过判断数据库是否有该商品
			$has = $this->where(array(
				'member_id'=>array('eq',$member_id),
				'goods_id'=>array('eq',$goods_id),
				'goods_attr_id'=>array('eq',$goods_attr_id)
			))->find();

			if($has){
				//如果有，在之前的商品基础上追加数量
				$this->where('id='.$has['cart_id'])->setInc('goods_number',$goods_number);
			}else{
				//如果没有，在数据库新增
				$this->add(array(
					'goods_id'=>$goods_id,
					'goods_attr_id'=>$goods_attr_id,
					'goods_number'=>$goods_number,
					'member_id'=>$member_id
				));
			}
		}else{
			//未登录,操作cookie
			//1.从cookie中取出购物车的数组，
			//如果第一次存到coolie中，$_COOKIE['cart']不存在，返回空数组
			//如果是$_COOKIE['cart']已经存在，则反序列化成数组
			$cart = isset($_COOKIE['cart'])?unserialize($_COOKIE['cart']):array();

			//2.把商品存到数组中
			$key = $goods_id."-".$goods_attr_id;
			//先判断数组中有没有这件商品
			if(isset($cart[$key])){
				$cart[$key] += $goods_number;
			}else{
				$cart[$key] = $goods_number;
			}

			//3.把这个数组存回到cookie
			//cookie过期时间
			$aMonth = 30*24*60*60;//一个月之后过期
			//
			setcookie('cart',serialize($cart),time()+$aMonth,'/','0821.com');

		}
	}
}

?>