<?php
	namespace Back\Controller;
	// use Think\Controller;
	class IndexController extends BaseController{
	    public function index(){
	        $this->display();
	    }
	     public function head(){
	        $this->display();
	    }
	     public function left(){
	       /*取出当前管理员所拥有的权限的前两级按钮*/
	       // 取出当前管理员的所有的权限信息
	        $admin_id=session('admin_id');
	        if ($admin_id ==1 ){
	            //超级管理员取出所有
	            $sql="select * from shop0926_auth ";
	        }else{
	            //普通管理员取出所有
	            $sql='select b.* 
	            from shop0926_role_auth a 
	            left join shop0926_auth b on a.auth_id=b.auth_id 
	            left join shop0926_admin_role c on a.role_id=c.role_id 
	            where c.admin_id = '.$admin_id;
	        }
	        $model=M();
	        $auths=$model->query($sql);
	        
	        /*从1取出当前管理员所拥有的权限的前两级按钮*/

	        //用于存放前两级按钮
	        $btns=array();
	        //取出第一级权限
	        foreach($auths as $k1=>$v1) {
	            //找出parent_id为0的 作为第一级
	            if ($v1['parent_id']==0){
	                //dump($v1);
	                //根据parent_id为0所对应的auth_id 查找子级（取出第二级权限）
	                foreach ($auths as $k2=>$v2){
	                    //取出第一级的auth_id为父id的子权限信息
	                    if ($v2['parent_id']==$v1['auth_id']){
	                        //可能有多个子权限,所以用[]
	                        $v1['children'][]=$v2;
	                    }
	                }
	                $btns[]=$v1;
	            }
	        }
	        
	        $this->assign('btns',$btns);
	        $this->display();
	    }
	    
	     public function main(){
	        $this->display();
	    }

	}
	
?>