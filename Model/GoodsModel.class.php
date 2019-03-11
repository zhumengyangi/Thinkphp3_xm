<?php  
	namespace Model;
	use Think\Model;

	class GoodsModel extends Model{
		/*
			goods_name			商品名称
			goods_big_logo		商品图片
			goods_small_logo	商品缩略图片
			goods_price			商品价格
			goods_num			商品数量
			goods_desc			商品描述
			is_sale 			是否上架： 1上架0下架
			is_delete 			是否删除： 1删除0未删除
			goods_add_time		添加时间

		 */

		//	在添加时调用create方法时，允许接收的字段
		protected $insertFields = array('goods_name' , 'goods_num' , 'goods_price' , 'goods_big_logo' , 'goods_desc' , 'goods_add_time' , 'is_sale');
		//	在修改时调用create方法时，允许接收的字段
		protected $updateFields = array('goods_name' , 'goods_num' , 'goods_price' , 'goods_big_logo' , 'goods_desc' , 'goods_add_time' , 'is_sale' , 'goods_id');
	
		//	定义表单验证的规则，控制器器中调用的create方法时被使用
		protected $_validate = array(
			array('goods_name' , 'require' , '商品名称不能为空'),
			array('goods_name' , '1,45' , '商品名称为1-45个字符' , 1 , 'length'),
			array('goods_price' , 'require' , '价格不能为空'),
			array('goods_price' , 'currency' , '价格必须是货币格式' , 1),
			array('goods_num' , 'require' , '商品数量不能为空')
			//array('sale' , '0,1' , '上架只能取1,0' , 1, 'in')
		);

		//	添加前置钩子，在执行控制器中的add()之前会自动调用该方法
		protected function _before_insert(&$data,$option){
			//	添加时间
			$data['goods_add_time'] = time();
			
			//	上传logo  
			//	有图片才进行上传
			if($_FILES['goods_big_logo']['error'] == 0){

			$upload = new \Think\Upload();
			 $upload->maxSize   =    (int)C('UPLOAD_SIZE')* 1024*1024 ;// 设置附件上传大小    
			 $upload->exts      =    C('UPLOAD_EXTS');// 设置附件上传类型    
			// $upload->rootPath  =    C('IMG_rootPath'); // 设置附件上传根目录    上传单个文件     
			 $upload->savePath  =	  '/Goods/';//	设置附件上传二级目录	 上传单个文件   
			 $info = $upload->uploadOne($_FILES['goods_big_logo']);
			
			if(!$info) {// 上传错误提示错误信息   
				$this->error = $upload->getError();
				return false;
			}else{
				//	上传成功 并生成缩略图
				//	./Uploads/Goods/2018-09-27/dfdasdas.png
				$big_logo	=	C('UPLOAD_ROOT_PATH').$info['savepath'].$info['savename'];
			 	$sm_logo =	C('UPLOAD_ROOT_PATH').$info['savepaht']."thumb_".$info['savepath'];
			 	$image = new \Think\Image();
			 	$image->open($big_logo);
			 	$img->thumb(150,150)->save($sm_logo);
			 	$data['goods_big_logo']	=	substr($big_logo,1);
			 	$data['goods_small_logo']	=	substr($sm_logo,1);
			}
			}

		}








	}
	
?>