<?php
    namespace Model;
    use Think\Model;

    class RoleModel extends Model{

        //分页、搜索、排序
        public function search(){
        	$where = array();
            //1.分页信息
            // $count = $this->where($where)->count();// 查询满足要求的总记录数
        	$count = $this->count();

            $page_model = new \Think\Page($count,1);// 实例化分页类 传入总记录数和每页显示的记录数(25)
            $page  = $page_model->show();// 分页显示输出

            $page_model->setConfig('prev','上一页');
            $page_model->setConfig('next','下一页');
            // select a.*,GROUP_CONCAT(c.auth_name) auth_name 
            // from shop0926_role a 
            // left join shop0926_role_auth b on a.role_id = b.role_id 
            // left join shop0926_auth c on b.auth_id = c.auth_id 
            // group by a.role_id;
            //2.获取分页数据
            $info = $this->field('a.*,GROUP_CONCAT(c.auth_name) auth_name')->alias('a')
            ->join('left join shop0926_role_auth b on a.role_id = b.role_id 
            left join shop0926_auth c on b.auth_id = c.auth_id')->where($where)->
            group('a.role_id')->limit("$page_model->firstRow,$page_model->listRows")->select();
            //打印sql
            // echo $this->getLastSql();
            // die();
            return array(
            	'page'=>$page,
            	'info'=>$info
            );

        }



        //添加角色之后执行后置钩子
        protected function _after_insert($data,$option){
            $auth_id = I('post.role_auth_id');
            if($auth_id){
                $raModel = D('RoleAuth');
                foreach ($auth_id as $k => $v) {
                    $raModel->add(array(
                        'auth_id'=>$v,
                        'role_id'=>$data['role_id'],
                        'add_time'=>time()
                    ));
                }
            }

        }

    }



?>