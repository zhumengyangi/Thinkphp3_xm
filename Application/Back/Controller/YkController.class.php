<?php 
    namespace Back\Controller;
    use Think\Controller;

     class YkController extends Controller{

     	public function add(){

     		$index_Model = M('yka');
     		if(IS_POST){
     			$data = I('post.');
     			$info = $index_Model->add($data);
     			
     			if($info){
     				$this->success('添加成功',U('showlist'));
     			}else{
     				$this->error('添加失败');
     			}

     		}else{
     			$this->display();
     		}
     	}

     	public function showlist(){

     		$index_Model = M('yka');
     		$info=$index_Model->select();
     		$this->assign('info',$info);
     		$this->display();
     		return $data;

     	}

     	public function edit(){

     		if(!$_POST){
     			$id = I('get.id');
     			$info = M('yka')->where("id=$id")->find();
     			$this->assign('info',$info);
     			$this->display();
     		}else{
     			$id = I('post.id');
     			 $sql=M('yka')->where(array('id'=>$id))->save(I('post.'));

     			if($sql){
     				$this->success('修改成功',U('showlist'));
     			}else{
     				$this->error('修改失败');
     			}
     		}
     	}



     }

?>