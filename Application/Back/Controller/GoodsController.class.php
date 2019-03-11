<?php  
	//	后台控制器
	namespace Back\Controller;  
	//	use Think\Controller;
	//	ide 编辑器
	//	{$Think.const.HOME_CSS_URL}/
	
	header("content-type:text/html;charset=utf-8");
	//	BaseController
	class GoodsController extends BaseController{
		public function showList(){
		//show
			//	生成超级管理员密码
			/*$pwd = md5('root'.C('MD5_KEY'));
			var_dump($pwd);*/

			//	获取数据
			$goods_model = new \Model\GoodsModel();
			// $goods_model = D('goods');
			//	分页查看
			$data = $goods_model->search();
			$this->assign(
				array(
					'info'=>$data['info'],
					'page'=>$data['page']
				));
			// var_dump($data);die;
			$this->display();
		
		}
		
		public function add(){
			//	根据传递方式，判断是载入模板还是插入数据
			if(IS_POST){
				$goods_model = new \Model\GoodsModel();
											//	TP自带 获取前台数据
				$data = $goods_model->create(I('post.'),1);
			
				if($data){
					
					$res = $goods_model->add($data);
					if($res){
						//	$this->success('新增成功','showList');
						$this->success("添加成功",U('showList'));
						//	$this->redirect('showList',array(),3,'新增成功，跳转中...');
						}
					}else{
						$this->error($goods_model->getError(),U('add'),3);
					}
			}else{
				$this->display();
			}

		}

	 public function update(){
	 	if(!$_POST){
	 		$id = I('get.goods_id')+0;
	 		$info = M('goods')->where("goods_id=$id")->find();
	 		
	 		$this->assign('info',$info);
	 		$this->display();
	 	}else{
	 		$goods_model = new \Model\GoodsModel();
			$data = $goods_model->create(I('post.'),1);
			if($data){
				$info = M('goods')->where(array("goods_id"=>I('post.goods_id')))->save(I('post.'));
		 		
		 		if($info){
		 			$this->success('修改成功',U('showList'));
		 		}else{
		 			$this->error('修改失败');
		 		}
			}else{
				$this->error($goods_model->getError(),U('showList'),3);
			}	
	 	}

	 }

	 public function del(){
	 	$goods_id = I('get.goods_id')+0;
	 	$p 	=	I('get.p',1)+0;

	 	$goods_model = new \Model\GoodsModel();
	 	
	 	if($goods_model->delete($goods_id)){
	 		$this->success('删除成功',U('showList?p='.$p),3);
	 	}else{
	 		$this->error('删除失败',U('showList?p='.$p),3);
	 	}

	 }
	 public function delete($id){
	 	$id=rtrim($id,',');
        // dump($ids);
        $goods_model=D('goods');
        
        // dump($goods_id);die;
        $res=$goods_model->delete("$id");
        // dump($res);die;
        if($res){
            $this->redirect('showList',array(),3,'删除成功');
        }else{
            $this->redirect('showList',array(),3,'删除失败');
        }
        $this->display();

		}
	}
?>