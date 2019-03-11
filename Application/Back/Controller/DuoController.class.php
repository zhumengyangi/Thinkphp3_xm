<?php 
    namespace Back\Controller;
    use Think\Controller;

    class DuoController extends Controller{
    
        public function add(){
        // $arr[]=["member_name"=>"12312"];
        
            if(IS_POST){
                echo "<pre>";
                // var_dump($_POST);die;
                //实例化对象取出省市县 拼接收货地址
                 
                $area=D("Duo");
                //通过id查询省市区
                $sheng=$area->where(array('area_id'=>$_POST['category']))->find();
                $shi=$area->where(array('area_id'=>$_POST['statuss']))->find();
                $xian=$area->where(array('area_id'=>$_POST['status']))->find();
                // var_dump($sheng);die;
     
                //获取省区市的值进行拼接  (有用)
                $city=$sheng['area_name'].$shi['area_name'].$xian['area_name'];
                // var_dump($city);die;

                //处理数据信息 使其成为二维数组 方便多条添加
                $res=array();
                 // var_dump(count($_POST['goods_num']));die;
                for($i=0;$i<count($_POST['goods_num']);$i++){
                    //$k 是数据库里里边的字段   $v第二维数组
                    foreach ($_POST as $k => $v) {
                        //变成多条添加需要
                        $res[$i][$k]=$v[$i];
                    }
                    $res[$i]['city']=$city;
                    
                }
                      // var_dump($res);die;

                //实例化goods  进行数据添加
                $goods=D("Duo");
                //执行多条添加
                $data=$goods->addAll($res);
                 
                if($res){
                    $this->redirect('showlist');
                }else{
                    $this->redirect('add');
                 }
            }else{
                $this->area();
                $this->display();
            }
         }

         public function showlist(){
            //实例化对象  获取表中的数据
            $goods=D("Duo");
            $info=$goods->select();
            
            //将数据引入常量 在前台展示
            $this->assign(array(
                  'info'=>$info
                ));
            $this->display();
         }

        //三级联动-省
        public function area(){
            $list=M('duo')->where(array('area_parent_id'=>0))->select();
            //print_r($list);die;
            $this->assign('list',$list);
        }
    
    }


 ?>