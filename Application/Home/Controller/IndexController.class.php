<?php
  namespace Home\Controller;
  use Think\Controller;

  class IndexController extends Controller {

    public function add(){
    $sql=M('area')->where(array('pid'=>0))->select();
    $this->assign('info',$sql);
    $this->display();

  }

  public function geto(){

    $sql=M('area')->where(array('pid'=>I('post.sid')))->select();
    $html='';
    foreach ($sql as $k => $v) {
    $html.="<option value='$v[sid]'>$v[username]</optio>";
    }
    echo $html;
  }

  public function add1(){
    
    if(IS_POST){
      $date=I('post.');
      $ff=D('yk1');
      $sql=$ff->add($date);

      if($sql){
        $this->success('添加成功',U('show'));
      }else{
        $this->error();
      }

    }else{
      $this->display();
    }

  }

   public  function   show(){
     $User = M('yk1'); // 实例化User对象
     $sql="select a.*,b.fs from  shop0926_yk1 a left join shop0926_yk2 b on  a.id=b.sid";
        $info1 = $User -> query($sql);

      //$inf=$midel()->query($sql);
      //print_r($info);die;
      $User = M('yk1'); // 实例化User对象
      $count      = $Us
      er->count();// 查询满足要求的总记录数
      $Page       = new \Think\Page($count,2);// 实例化分页类 传入总记录数和每页显示的记录数(25)
      $fenye      = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
      $list = array_splice($info1,$Page->firstRow,$Page->listRows);
    
       $this->assign('list',$list);//数据
       $this->assign('show',$fenye);//分页
    $this->display();
  }

  public function delete(){
    
    $d=M('yk1');
    // print_r($id);die;
    $sql=$d->delete($id=rtrim(I('get.id'),','));
    
    if($sql){
      $this->success('删除成功',U('show'));
    }else{
      $this->error('删除失败');
    }
    //print_r($sql);die;
  }

  public function  edit(){
    
    $b=M('yk1');
    $id=I('get.id');
    $sql=$b->where("$id=id")->find();
    $this->assign('info',$sql);
    $this->display();
    //print_r($sql);dieb
  }

  public  function  edit1(){
    $id=I('post.id');
    //print_r($id);die;

    $sql=M('yk1')->where(array('id'=>$id))->save(I('post.'));
    
    if($sql){
      $this->success('修改成功',U('show'));
    }else{
      $this->error();
    }

  }

  }