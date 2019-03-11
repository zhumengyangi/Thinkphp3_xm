<?php
	namespace Back\Controller;
	use Think\Controller;

	class BaseController extends Controller {

		public function __construct(){
			//调用父类的构造函数
			parent::__construct();
			//登录验证
			if(!session('admin_id')){
				$this->error('请登录后，再访问',U('Back/login/login'));
			}

			$admin_id = session('admin_id');
			// var_dump($admin_id);
			//验证当前管理员是否有权限访问这个页面
			//1.先获取当前管理员将要访问的页面---TP自带常量
			//$url = MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME;

			//查询数据库判断当前管理员有没有访问这个页面的权限
			$where = ' module_name="'.MODULE_NAME.'" and controller_name = "'.CONTROLLER_NAME.'" and action_name = "'.ACTION_NAME.'" ';
			
			//默认后台首页都有权访问
			if(CONTROLLER_NAME == 'Index'){
				return true;
			}

			// 超级管理员拥有所有权限,其他管理员根据自己的权限
			if($admin_id == 1){
				$sql = "select count(*) has from shop0926_auth where ".$where;
			}else{
				$sql = "select count(a.auth_id) has
						from shop0926_role_auth a
						left join shop0926_auth b on a.auth_id=b.auth_id
						left join shop0926_admin_role c on a.role_id=c.role_id
						where c.admin_id = ".$admin_id." and ".$where;
			}

			$model = M();
			$auths = $model->query($sql);
			// dump($auths);
			// dump($auths[0]['has'] < 1);
			// die();
			

			/*if($auths[0]['has'] < 1){
				$this->error('无权访问');
			}*/	

		}
	}
?>