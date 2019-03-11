<?php  
	namespace	Back\Controller;
	use Think\Controller;
	class Goods2Controller extends Controller{

		public function showList(){
			$goods_model->search();
			$this->assign(array(
				'info'=>$data['info'],
				'page'=>$data['page']
			));
			$this->display();
		}
		public function add(){
			if(IS_POST){
				$goods_model=new \Model\Goods2Model();
				$data=$goods_model->create(I('post.'),1);
				if($data){
					$res=$goods_model->add($data);
					if($res){
						$this->success('添加成功',U('showList'));
					}
				}else{
					$this->error($goods_model->getError(),U('add'),3);
				}
			}else{
				$this->display();
			}
		}
		public function del(){
			$id=I('get.goods_id');
			$info=M('goods')->where(array("goods_id"=>$id))->delete();
			if($info){
				$this->success('删除成功',U('showList'));
			}else{
				$this->error('删除失败');
			}
		}



	}
?>