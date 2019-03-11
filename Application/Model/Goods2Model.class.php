<?php  
	namespace Model;
	use Think\Model;
	class Goods2Model extends Model{
		protected $insertFields = array('goods_name','goods_num','goods_price','goods_big_logo','goods_desc','goods_add_time','is_sale');
		protected $updateFields = array('goods_name','goods_num','goods_price','goods_big_logo','goods_desc','goods_add_time','is_sale','goods_id');
		protected $_validate = array(
			array('goods_name','require','商品名称不能为空'),
			array('goods_name','1,45','商品名称为1-45个字符',1,'length'),
			array('goods_price','require','价格不能为空'),
			array('goods_price','currency','价格必须是货币格式',1),
			array('goods_num','require','商品数量不能为空'),
		)；
		protected function _before_insert(&$data,$option){
			$data['goods_add_time']=time();
			if($_FILES['goods_big_logo']['error']==0){
				$upload=new \Think\Upload();
				$upload->maxSize=(int)C('UPLOAD_SIZE')*1024*1024;
				$upload->exts=C('UPLOAD_EXTS');
				$upload->savePath='/Goods/';
				$info=$upload->uploadOne($_FILES['goods_big_logo']);
				if(!$info){
					$this->error=$upload->getError();
					return false;
				}else{
					$big_logo=C('UPLOAD_POOT_PATH').$info['savepath'].$info['savename'];
					$sm_logo= C('UPLOAD_POOT_PATH').$info['savepath']."thumb_".$info['savename'];
					$image=new \Think\Image();
					$image->open($big_logo);
					$image->thumb(150,150)->save($sm_logo);
					$data['goods_big_logo']=substr($big_logo,1);
					$data['goods_small_logo']=substr($sm_logo,1);
				}
			}
		}

		public function search(){
			$count=$this->count();
			$Page=new \Think\Page($count,5);
			$show=$Page->show();
			$list=$this->order('goods_add_time desc')
					   ->limit($Page->firstRow.','.$Page->listRows)
					   ->select();
			return array(
					'info'=>$list,
					'page'=>$show
				)
		}

	}
?>