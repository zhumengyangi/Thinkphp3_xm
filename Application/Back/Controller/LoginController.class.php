<?php  
	namespace Back\Controller;
	use Think\Controller;

	class LoginController extends Controller{
		
		 public function login(){
	        //判断是否提交登录表单
	        if(IS_POST){
	            $admin_model = new \Model\AdminModel();
	            //验证数据是否合法
	            //validate()用于指定使用的验证规则
	            if($admin_model->validate($admin_model->_login_validate)->create()){
	                //验证登录是否成功
	                if($admin_model->login()){
	                    // redirect(U('Back/Index/index'));//直接调用全局函数
	                    //类中此方法也是通过全局函数实现的
	                    $this->redirect('Index/index');
	                }
	            }
	            $this->error($admin_model->getError());
	        }else{
	            $this -> display();  
	        }
	        
	    }  

		//	生成验证码
		public function verifyImg(){
			$cfg = array(
				'imageH'	=>	40,		//	验证码图片高度
				'imageW'	=>	100,	//	验证码图片宽度
				'length'	=>	4,		//	验证码位数
				'fontttf'	=>	'4.ttf',//	验证码字体，不设置随机获取
				'fontSize'	=>	15,		//	验证码字体大小（px）
			);
			$very = new \Think\Verify($cfg);
			$very ->entry();
		}

		//	生成验证码
		public function captcha(){
			$config = array(
				'fontSize'	=>	15, 	//	验证码字体大小
				'length'	=>	4,		//	验证码位数
				'useNoise'	=>	false,	//	关闭验证码杂点
				'imageH'	=>	40,		//	验证码图片高度
				'imageW'	=>	100,	//	验证码图片宽度
			);
			$Verify	=	new \Think\Verify($config);
			$Verify->entry();
		}

		//	ajax过来校检验证码
		function checkCode(){
			$code = I('get.code');	//	获得用户输入的验证码
			$vry  = new \Think\Verify();
			if($vry->check($code)){
				echo json_encode(array('status'=>1));
			}else{
				echo json_encode(array('status'=>2));
			}
		}

		//	退出登录
		public function logout(){
			//	销毁session
			session(null);
			$this->redirect('Login/login');
		}

	}

?>