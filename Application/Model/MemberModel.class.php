<?php
	namespace Model;
	use Think\Model;

	class adminModel extends Model{

		//注册时表单允许提交的字段
		protected $insertFields = array('admin_email','admin_pwd','admin_pwd2','admin_captcha','agree');

		//登录时表单的验证规则
		public $_login_validate = array(
			array('admin_email','require','email不能为空',1),
			array('admin_email','email','email格式不正确',1),
			array('admin_pwd','require','密码不能为空',1),
			array('admin_pwd','6,20','密码必须是6,20位',1,'length'),
			array('admin_captcha','require','验证码不能为空',1),
			array('admin_captcha','check_captcha','验证码不正确',1,'callback')
		);

		//注册时表单的验证规则
		protected $_validate = array(
			array('admin_email','require','email不能为空',1),
			array('admin_email','email','email格式不正确',1),
			array('admin_pwd','require','密码不能为空',1),
			array('admin_pwd','6,20','密码必须是6,20位',1,'length'),
			array('admin_pwd2','admin_pwd','两次密码不一致',1,'confirm'),
			array('admin_captcha','require','验证码不能为空',1),
			array('admin_captcha','check_captcha','验证码不正确',1,'callback'),
			array('admin_email','','email已经被注册',1,'unique'),
			array('agree','require','您必须同意用户注册协议',1),
		);

		public function check_captcha($code){
			$verify = new \Think\Verify();
			return $verify->check($code);
		}

		//在会员记录插入到数据库之前
		protected function _before_insert(&$data,$option){
			$data['add_time']=time();
			//生成用于验证邮箱地址是否有效
			$data['email_code'] = md5(uniqid());
			//会员密码加密
			$data['admin_pwd'] = md5($data['admin_pwd'].C('MD5_KEY'));
		}

		//在会员注册成功之后
		protected function _after_insert($data,$option){
			//heredoc的语法：注意第二个HTML必须顶格写，不能有空格
			$content =<<<HTML
			<p>欢迎您成为本站会员，请点击以下链接地址完成email验证。</p>
			<p><a href="http://www.0821.com/index.php/Home/admin/check_email/code/{$data['email_code']}">点击完成验证</a></p>
	HTML;

			//把生成的验证码发送到会员邮箱中
			sendMail($data['admin_email'],'www.shop0926.com网email验证',$content);
		}


		//会员登录
		public function login(){
			$admin_email = $this->admin_email;
			$admin_pwd = $this->admin_pwd;

			//思路：1判断账号是否存在 2判断是否验证邮箱 3判断密码是否正确
			$admin = $this->where(array('admin_email'=>array('eq',$admin_email)))->find();

			if($admin){
				// 2判断是否验证邮箱
				if(empty($admin['email_code'])){
					//3判断密码是否正确
					if($admin['admin_pwd'] == md5($admin_pwd.C('MD5_KEY'))){
						session('admin_id',$admin['admin_id']);
						session('admin_email',$admin['admin_email']);
						return true;
					}else{
						$this->error = '密码不正确';
						return false;
					}
				}else{
					$this->error = '邮箱未通过验证，请您登录邮箱，验证后在登录';
					return false;
				}
			}else{
				$this->error = '账号不存在';
				return false;
			}
		}


	}


?>