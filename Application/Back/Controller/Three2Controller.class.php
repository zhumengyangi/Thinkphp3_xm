<?php  
	
	namespace Back\Controller;
	use Think\Controller;

	class Three2Controller extends Controller{

		public function add1(){

			if(IS_POST){
				echo "<pre>";

				$area=D("Area");
				$sheng=$area->where(array('area_id'=>$_POST['category']))->find();
				$shi=$area->where(array('area_id'=>$_POST['statuss']))->find();
				$xian=$area->where(array('area_id'=>$_POST['status']))->find();

				$city = $sheng['area_name'].$shi['area_name'].$xian['area_name'];

				$res = array();
				for($i=0;$i<count($_POST['goods_num']);$i++){
					foreach ($_POST as $k => $v) {
						$res[$i][$k]=$v[$i];
					}
					$res[$i]['city']=$city;

					unset($res[$i]['category']);
					unset($res[$i]['status']);
					unset($res[$i]['statuss']);
				}

				$goods = D("Three");
				$data=$goods->add1All($res);
				if($res){
					$this->redirect('showlist');
				}else{
					$this->redirect('add1');
				}
			}else{
				$this->area();
				$this->display();
			}
		}

		public function showlist(){

			$goods=D("Three");
			$info=$goods->select();

			$this->assign(array(
					'info'=>$info
				));
			$this->display();
		}

		public function area(){
			$list = M('area')->where(array('area_parent_id'=>0))->select();
			$this->assign('list',$list);
		}

		public function ajaxArea(){

			$parent_id = $_POST['data']?$_POST['data']:0;
			$list=M('area')->where(array('area_parent_id'=>$parent_id))->select();
			$html='';

			if($_POST['num'] == 1){
				$html.="<option value=\"\">-请选择市级分类-</option>";
			}else{
				$html.="<option value=\"\">-请选择县级分类-</option>";
			}

			foreach ($list as $k => $v) {
				$html.="<option value=".$v['area_id'].">".$v['area_name']."</option>";
			}
			print_r($html);
		}

	}

?>