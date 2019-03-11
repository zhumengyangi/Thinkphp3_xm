<?php  
	namespace Back\Controller;
	use Think\Controller;
	class AuthController extends BaseController{

		public function add(){
	    	if(IS_POST){
	    		// dump(I('post.'));
				$auth_model = new \Model\AuthModel();
	    		$data = $auth_model->create();

	    		if($data){
	    			// dump($data);
	    			if($res = $auth_model->add($data)){
	    				$this->success('添加成功','showList',3);
					}else{
						$this->error('添加失败','add',5);
					}
	    		}else{
	    			$errorInfo = $auth_model->getError();
	    			$this->error($errorInfo,'add',5);
	    		}

	    	}else{
	    		$auth_model = new \Model\AuthModel();
	    		$auths = $auth_model->getTree();
	    		$this->assign('auths',$auths);
	       		$this -> display();
	    	}
    	}

		public function del(){
			$auth_id = I('get.auth_id')+0;
		 	$p 	=	I('get.p',1)+0;

		 	$goods_model = new \Model\AuthModel();
		 	
		 	if($goods_model->delete($auth_id)){
		 		$this->success('删除成功',U('showList?p='.$p),3);
		 	}else{
		 		$this->error('删除失败',U('showList?p='.$p),3);
		 	}
		}

		public function showList(){
			$auth_model = new \Model\AuthModel();

	    	$data = $auth_model->search();
	    	// var_dump($data);die;
	    	// dump($data);die();
	    	$this->assign(array(
	    		'page'=>$data['page'],
	    		'info'=>$data['info'],
	    	));
	    	// var_dump($data);die;
	        $this -> display();
		}

		public function edit(){
			$this -> display();
		}
	}

?>