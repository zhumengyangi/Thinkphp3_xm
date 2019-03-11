<?php  

	namespace Back\Controller;
	use Think\Controller;
	header("content-type:text/html;charset=utf-8");
	class QzController extends Controller{

		public function add(){

			$index_Model = M('qz1');
			if(IS_POST){

				$res=array();
				/*var_dump($_POST);die;*/
				$data = I('post.');
				$info = $index_Model -> add($data);
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

			/*$goods_model = new \Model\QzModel();
			// $goods_model = D('goods');
			//	分页查看
			
			$data = $goods_model->search();
			$this->assign(
				array(
					'info'=>$data['info'],
					'page'=>$data['page']
				));
			// var_dump($data);die;
			
			$this->display();*/

			$index_Model = M('qz1');
			$info = $index_Model->select();
			$this->assign('info',$info);
			$this->display();
			return $data;
		}

		public function delete(){
			$id = I('get.id');
			$index_Model = M('qz1');
			$info = $index_Model->delete($id);
			if($info){
				$this->success('删除成功',U('showlist'));
			}else{
				$this->error('删除失败');
			}
		}

		public function delete2(){
    
		     $d=M('qz1');
		    // print_r($id);die;
		    $sql=$d->delete($id=rtrim(I('get.id'),','));
		    
		    if($sql){
		      $this->success('删除成功',U('showlist'));
		    }else{
		      $this->error('删除失败');
		    }
		    //print_r($sql);die;
		 }

		 public function delete3(){
    
		 	$d=M('qz2');
		    // print_r($id);die;
		    $sql=$d->delete($id=rtrim(I('get.id'),','));
		    
		    if($sql){
		      $this->success('删除成功',U('showlist'));
		    }else{
		      $this->error('删除失败');
		    }

		 }

		public function add1(){
			
			$index1_Model = M('qz1');
			$index_Model = M('qz2');
			$info = $index1_Model->select();
			$this->assign('info',$info);

			if(IS_POST){
				$data = I('post.');
				$info = $index_Model -> add($data);
				if($info){
					$this->success('添加成功',U('showlist'));
				}else{
					$this->error('添加失败');
				}
			}else{
				$this->display();
			}
			
		}

		public function showlist1(){
			$index_Model = M('qz2');
			$info = $index_Model -> select();
			$this->assign('data',$info);
			$this->display();
		}

		public function delete1(){
			$id = I('get.id');
			$index_Model = M('qz2');
			$info = $index_Model -> delete($id);
			if($info){
				$this->success('删除成功',U('showlist1'));
			}else{
				$this->error('删除失败');
			}
		}

		public function update(){
		 	if(!$_POST){
		 		$id = I('get.id');
		 		$info = M('qz1')->where("id=$id")->find();
		 		
		 		$this->assign('info',$info);
		 		$this->display();
		 	}else{
		 		$id=I('post.id');
				  	 //print_r($id);die;
				  	 $sql=M('qz1')->where(array('id'=>$id))->save(I('post.'));
				  	 if($sql){
				  	 	$this->success('修改成功',U('showlist1'));
				  	 }else{
				  	 	$this->error();
				  	 }
		 	}

		 }

		 public function update1(){
		 	if(!$_POST){
		 		$id = I('get.id');
		 		$info = M('qz2')->where("id=$id")->find();
		 		$this->assign('info',$info);
		 		$this->display();
		 	}else{
		 		 $id=I('post.id');
				  	 //print_r($id);die;
				  	 $sql=M('qz2')->where(array('id'=>$id))->save(I('post.'));
				  	 if($sql){
				  	 	$this->success('修改成功',U('showlist1'));
				  	 }else{
				  	 	$this->error();
				  	 }
		 	}
		 
		 }

	}

?>