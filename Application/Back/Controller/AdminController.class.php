<?php
	namespace Back\Controller;
	// use Think\Controller;

	class AdminController extends BaseController{


	    public function showList(){
	        // echo md5('root');//63a9f0ea7bb98050796b649e85481845
	        // echo md5('root'.C('MD5_KEY'));//aaf41bd48a69b51ab8f14097c4d83f73
	        $admin_model= new\Model\AdminModel();
	        $data = $admin_model->search();
	        $this->assign(
	            array(
	                'page'=>$data['page'],
	                'info'=>$data['info']
	            )
	        );
	        $this -> display();
	    }

	    public function add(){
	    	if(IS_POST){
	    		// dump(I('post.'));
	      //       die();
	    		$admin_model = new \Model\AdminModel();
	    		$data = $admin_model->create();
	            // dump($data);
	            // die();
	            $data['admin_pwd'] = md5($data['admin_pwd'].C('MD5_KEY'));
	    		if($data){
	    			// dump($data);
	    			if($res = $admin_model->add($data)){
	    				$this->success('添加成功','showList',3);
					}else{
						$this->error('添加失败','add',5);
					}
	    		}else{
	    			/*$errorInfo = $admin_model->getError();
	    			$this->error($errorInfo,'add',5);*/
	    			$this->error($admin_model->getError(),'add',3);
	    		}
	    	}else{
	            //获取所有角色
	            $role_model = new \Model\RoleModel();
	            $roles = $role_model->select();
	            $this->assign(array('roles'=>$roles));
	    		$this->display();
	    	}
	    }

	    public function edit(){
	        //要修改的管理员的id
	        $admin_id = I('get.admin_id');

	        //先判断是否有权修改
	        //1.取出当前管理员的id
	        $cur_admin_id = session('admin_id');
	        //2.如果是普通管理员要修改其他管理员的信息提示无权
	        if($cur_admin_id>1 && $admin_id != $cur_admin_id){
	            $this->error('无权限修改');
	        }

	    	if(IS_POST){
	            // dump(I('post.'));die();
	            $admin_model = new \Model\AdminModel();
	            $data = $admin_model->create();
	            // dump($data);die();
	            //判断密码是否为空，为空，unset($data['admin_pwd'])
	                                // 非空，MD5加密
	            if(empty($data['admin_pwd'])){
	                //不让密码入库
	                unset($data['admin_pwd']);
	            }else{
	                $data['admin_pwd'] = md5($data['admin_pwd'].C('MD5_KEY'));
	            }

	            if($data){
	                // dump($data);die();
	                if($res = $admin_model->save($data)){
	                     // $this->success('修改成功','showList',3);
	                    $this->success('修改成功',U('showList'),3);
	                }else{
	                    $this->error('修改失败',U('edit',"admin_id=$admin_id"),3);
	                }
	            }else{
	               $this->error($admin_model->getError(),U('edit',"admin_id=$admin_id"),3); 
	                // $this->redirect('edit', array('admin_id'=>$admin_id), 5,$admin_model->getError());
	               // $this->error($admin_model->getError(),"edit/admin_id/$admin_id",3);                
	                // redirect('edit/admin_id/3', 5, $admin_model->getError());
	            }
	    	}else{
	    		$admin_id = I('get.admin_id')+0;
	            $admin_model = D('Admin');
	            $info = $admin_model->where(array('admin_id'=>$admin_id))->find();
	            $this->assign('info',$info);

	            //获取所有角色
	            $role_model = new \Model\RoleModel();
	            $roles = $role_model->select();
	            $this->assign(array('roles'=>$roles));

	            //获取当前管理员所在的角色的id字符串
	            $arModel = M('AdminRole');
	            
	            $cur_rids = $arModel->field('GROUP_CONCAT(role_id) role_id')
	            ->where(array('admin_id'=>array('eq',$admin_id)))->find();
	            // dump($cur_rids);die();
	            $this->assign('cur_rids',$cur_rids['role_id']);

	    		$this->display();
	    	}
	    }

	    //删除
	    public function delete(){
	        $admin_id = I('get.admin_id');

	        $admin_model = new \Model\AdminModel;
	        if($admin_model->delete($admin_id)){
	            $this->success('删除成功',U('showList'),3);
	        }else{
	            $this->error('删除失败',U('showList'),5);
	        }

	    }

	    //修改启用状态
	    public function ajaxUpdateIsUse(){
	        // echo I('get.admin_id');
	        $admin_id = I('get.admin_id');

	        //超级管理员不能被禁用
	        if($admin_id == 1){
	            return false;
	        }

	        $model = D('Admin');
	        $info = $model->find($admin_id);

	        if($info['is_use'] == 1){
	            $model->where(array('admin_id'=>array('eq',$admin_id)))->setField('is_use',0);
	            echo 0;
	        }else{
	            $model->where(array('admin_id'=>array('eq',$admin_id)))->setField('is_use',1);
	            echo 1;
	        }
	    }

	}


?>