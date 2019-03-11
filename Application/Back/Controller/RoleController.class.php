<?php
	namespace Back\Controller;
	// use Think\Controller;

	class RoleController extends BaseController {

	    public function showList(){
	    	
	        $role_model = new \Model\RoleModel();// 实例化User对象
	        //分页、搜索、排序
	        $data = $role_model->search();

	        $this -> assign(array(
	            'page'=>$data['page'],
	            'info'=>$data['info']
	        ));


	        $this -> display();
	    }
	    
	    public function add(){
	    	if(IS_POST){
	    		// dump(I('post.'));die();
	    		$data = array();
	    		$rModel = D('Role');//这里对应shop/back/Model/RoleModel.class.php钩子函数
	            // $rModel = new \Model\RoleModel();//这里对应shop/Model/RoleModel.class.php钩子函数
	    		$data['role_name'] = I('post.role_name');
	    		$data['add_time'] = time();

	    		if($res = $rModel->add($data)){
	    			$this->success('角色添加成功','showList',3);
	    		}else{
	    			$this->error('角色添加失败','add',5);
	    		}

	    	}else{
	    		// 获取权限列表
	    		$model = new \Model\AuthModel();
	    		$auths = $model->getTree();
	    		// dump($auths);exit();
	    		$this->assign('auths',$auths);
	        	$this -> display();
	    	}
		}

	    public function edit(){
	    	if(IS_POST){


	    	}else{
	    		$role_id = ('get.role_id')+0;

	    		$role_model = new \Model\RoleModel();
	    		$reole_data = $role_model->where(array('role_id'=>$role_id))->find();
	    		$this->assign('info',$role_data);
	    		$ra_model = D("RoleAuth");
	    		$cur_auth_str = $$ra_model->field("group_concat(auth_id) auth_id")
	    								  ->where(array('role_id'=>$role_id))
	    								  	->group("role_id")
	    								  	->find();

	    		$this->assign('cur_auth_str',$cur_auth_str['auth_id']);
	    		$auth_model = new \Model\AuthModel();
	    		$auth_data = $auth_model->getAuthTree();
	    		$this->assign('auth_info',$auth_data);

	    		$this->display();
	    	}
	       
	    }
	}
	
?>