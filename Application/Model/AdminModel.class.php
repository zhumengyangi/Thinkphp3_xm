<?php
	namespace Model;
	use Think\Model;

	class AdminModel extends Model{

	    //自动完成设置add_time/upd_time
	    protected $_auto = array(
	        array('add_time','time',1,'function'),
	        // array('upd_time','time',3,'function'),
	    );
		//添加表单提交，允许的字段
		protected $insertFields = array('admin_name','admin_pwd','is_use','add_time','admin_captcha','admin_pwd2','role_id');
		//修改表单提交，允许的字段
		// protected $updateFields = array('admin_id','admin_name','admin_pwd','is_use','admin_pwd2','role_id');

		//登录时表单验证的规则
		public $_login_validate = array(
			array('admin_name','require','用户名不能为空',1),
			array('admin_pwd','require','密码不能为空',1),
			array('admin_captcha','require','验证码不能为空',1),
			array('admin_captcha','check_captcha','验证码不正确',1,'callback'),
		);
		//验证码验证
		public function check_captcha($code){
			 $verify = new \Think\Verify();    
			 return $verify->check($code);
		}


		//$_validate默认对添加和修改管理员时验证规则：
		protected $_validate = array(
			array('admin_name','require','用户名不能为空',1,'regex',3),
			array('admin_name','1,30','用户名长度不能超过30个字符',1,'length',3),
			// 下面规则只有添加时生效，修改时不生效，1添加，2修改，3所有情况
			array('admin_pwd','require','密码不能为空',1,'regex',1),
			array('admin_pwd2','admin_pwd','两次密码不一致',1,'confirm',3),
			array('is_use','number','是否启用 1启用 0禁用 必须是一个整数',2,'regex',3),
			array('admin_name','','账号已经存在',1,'unique',1),
			// array('role_id','require','请选择角色',0)
		);

		//分页
		public function search(){
			//分页信息
			$count = $this->count();
			$Page  = new \Think\Page($count,1);// 实例化分页类 传入总记录数和每页显示的记录数(25)
			$show  = $Page->show();// 分页显示输出

			//分页数据
			$info = $this->order('admin_id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
			return array(
				'page'=>$show,
				'info'=>$info
			);
		}

		//添加前置钩子函数
		protected function _before_insert(&$data,$option){
			// dump($data);
			$data['admin_pwd'] = md5($data['admin_pwd'].C('MD5_KEY'));
		}
		
		//添加后置钩子函数
		protected function _after_insert($data,$option){
			$role_ids = I('post.role_id');//数组

			//保存到sw_admin_role
			$arModel = D('AdminRole');
			foreach ($role_ids as $k => $v) {
				$arModel->add(array(
					'admin_id'=>$data['admin_id'],
					'role_id'=>$v
				));
			}
		}

		//修改前置钩子函数
		protected function _befor_update(&$data,$option){
			//超级管理员不允许禁用
			if($option['where']['admin_id'] == 1)
				$data['is_use'] = 1;

			$role_ids = I('post.role_id');//数组
			// var_dump($role_ids);die();
			// 处理管理员所在角色
	        // 先删除中间表中原来的数据
	        $raModel = D('RoleAdmin');
	        $raModel->where(array(
	            'admin_id' => $option['where']['admin_id'],
	        ))->delete();


	        // 重新把新选择的添加一遍
	        $roleId = I('post.role_id');
	        if($role_ids)
	        {
	            foreach ($role_ids as $k => $v)
	            {
	                $raModel->add(array(
	                    'admin_id' => $option['where']['admin_id'], // 添加之后的管理员的ID
	                    'role_id' => $v
	                ));
	            }
	        }

		}	

		//删除前置钩子
		protected function _before_delete($option){

			if($option['where']['admin_id']==1){
				$this->error = '超级管理员不允许删除';
				return false;
			}

			//在删除admin表中管理员之前，
			//先删除sw_admin_role表中这个管理员对应的数据

			$arModel = D('AdminRole');
			$arModel->where(array('admin_id'=>array('eq',$option['where']['admin_id'])))
			->delete();
		}


		//登录
		public function login(){
			//获取表单中的用户名和密码
			$admin_name = $this->admin_name;
			$admin_pwd = $this->admin_pwd;

			//先查询数据库是否存在这个账号
			$admin = $this->where(array('admin_name'=>array('eq',$admin_name)))->find();
			//判断是否存在这个账号
			if($admin){
				//判断是否启用,注意超级管理员不能被禁用
				if($admin['is_use']==1 || $admin['admin_id']==1){
					//判断密码
					if($admin['admin_pwd'] == md5($admin_pwd.C('MD5_KEY'))){
						//登录成功，将admin_id和admin_name存入session中
						session('admin_id',$admin['admin_id']);
						session('admin_name',$admin['admin_name']);
						return true;
					}else{
							$this->error='密码错误';
							return false;	
					}
				}else{
					$this->error='此账号被禁用';
					return false;
				}
			}else{
				$this->error='此账号不存在';
				return false;
			}
		}


	}

?>