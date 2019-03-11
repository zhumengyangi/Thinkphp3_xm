<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <title>会员列表</title>
        <link href="<?php echo (C("BACK_CSS_URL")); ?>mine.css" type="text/css" rel="stylesheet" />

    </head>
    <body>
        <style>
            .tr_color{background-color: #9F88FF}
        </style>
        <div class="div_head">
            <span>
                <span style="float: left;">当前位置是：商品管理-》商品列表</span>
                <span style="float: right; margin-right: 8px; font-weight: bold;">
                    <a style="text-decoration: none;" href="<?php echo U('add');?>">【添加商品】</a>
                </span>
            </span>
        </div>
        <div></div>
        <div class="div_search" style="height:200px;">
            <form action="<?php echo U('showList');?>" method="get">

                <input type="hidden" name="p" value="1" />
               <div>
                    商品名称：<input type="text" name="goods_name" value="<?php echo I('get.goods_name');?>" />
               </div>
                <div>
                    商品价格：<input type="text" name="start_price" value="<?php echo I('get.start_price');?>" />&nbsp;-
                             <input type="text" name="end_0 price" value="<?php echo I('get.end_price');?>" />
               </div>
                <div>
                    是否上架：
                    <select name="is_sale">
                         <option <?php echo I('get.is_sale',-1)==-1?'selected="selected"':'';?>  value="-1" onclick="parentNode.parentNode.submit">全部</option>
                         <option <?php echo I('get.is_sale',-1)==1?'selected="selected"':'';?>  value="1" >上架</option>
                         <option <?php echo I('get.is_sale',-1)==0?'selected="selected"':'';?>  value="0" >下架</option>
                    </select>
               </div>
                <div>
                   是否删除：
                    <select name="is_delete">
                         <option <?php echo I('get.id_delete',-1)==-1?'selected="selected"':'';?>  value="-1" onclick="parentNode.parentNode.submit">全部</option>
                         <option <?php echo I('get.id_delete',-1)==1?'selected="selected"':'';?>  value="1" >删除</option>
                         <option <?php echo I('get.id_delete',-1)==0?'selected="selected"':'';?>  value="0" >未删除</option>
                    </select>
               </div>
               <div>
                    排序方式：
                       <!--  <input type="radio" name="order" value="id_asc" <?php echo I('get.order',"id_asc")=="id_asc"?"checked":"";?> />按照时间升序
                       <input type="radio" name="order" value="id_desc" <?php echo I('get.order',"id_asc")=="id_desc"?"checked":"";?> />按照时间降序
                       <input type="radio" name="order" value="price_asc" <?php echo I('get.order',"id_asc")=="price_asc"?"checked":"";?> />按照价格升序
                       <input type="radio" name="order" value="price_desc" <?php echo I('get.order',"id_asc")=="price_desc"?"checked":"";?> />按照价格降序 -->
                        
                   <select name="order">
                       <option <?php echo I('get.order','id_asc')=='id_asc'?'selected="selected"':'';?>  value="id_asc" onclick="parentNode.parentNode.submit">按照时间升序</option>
                       <option <?php echo I('get.order','id_asc')=='id_desc'?'selected="selected"':'';?>  value="id_desc">按照时间降序</option>
                       <option <?php echo I('get.order','id_asc')=='price_asc'?'selected="selected"':'';?>  value="price_asc">按照价格升序</option>
                       <option <?php echo I('get.order','id_asc')=='price_desc'?'selected="selected"':'';?>  value="price_desc">按照价格降序</option>
                   </select>
               </div>
                <input value="查询" type="submit" />
            </form>
            
        </div>
        <div style="font-size: 13px; margin: 10px 5px;">
            <table class="table_a" border="1" width="100%">
                <thead>
                    <tr style="font-weight: bold;">
                        <td width="60px"><input type="checkbox" id="all"></td>
                        <td>序号</td>
                        <td>商品名称</td>
                        <td>图片</td>
                        <td>缩略图</td>
                        <td>价格</td>
                        <td>库存</td>
                        <td>详细</td>
                        <td>是否上架</td>
                        <td>是否删除</td>
                        <td>创建时间</td>
                        <td align="center">操作</td>
                    </tr>
                </thead>
                <tbody id="list">
                    <?php if(is_array($info)): foreach($info as $key=>$v): ?><tr id="product1" align="center">
                        <td><input type="checkbox" id="<?php echo ($v["goods_id"]); ?>"></td>
                        <td><?php echo ($v["goods_id"]); ?></td>
                        <td><a href="#"><?php echo ($v["goods_name"]); ?></a></td>
                        <td><img src="<?php echo ($v["goods_big_logo"]); ?>" height="60" width="60"></td>
                        <td><img src="<?php echo ($v["goods_small_logo"]); ?>" height="40" width="40"></td>
                        <td><?php echo ($v["goods_price"]); ?></td>
                        <td><?php echo ($v["goods_num"]); ?></td>
                        <td><?php echo ($v["goods_desc"]); ?></td>
                        <td><?php echo $v['is_sale']==1?'上架':下架 ?></td>  
                        <td> <?php echo $v['is_delete']==1?'删除':未删除 ?></td>
                        <td><?php echo (date("y-m-d",$v["goods_add_time"])); ?></td>
                       <td><a href="<?php echo U('update',array('goods_id'=>$v['goods_id']));?>">修改</a>&nbsp;&nbsp;
                           <a href="<?php echo U('del',array('goods_id'=>$v['goods_id']));?>">删除</a>
                       </td>
                    </tr><?php endforeach; endif; ?>
                 
                    <tr>
                        <td colspan="1">
                            <input type="button" value="反选" id="fan" />       
                            <input type="submit" value="删除" id="delete" />      
                        </td>
                        <td colspan="19" style="text-align: center;">
                             <?php echo ($page); ?>
                        </td>
                    </tr>
                    </tfoot>
            </table>
             <form action="<?php echo U('Home/Goods/showList');?>" method="get">
                轮播间隔时间: <input type="text" name="jiange" />毫秒
                <input type="submit" id="zhanshi" value="前台图片展示" />
            </form>
            <!-- http://www.shop0926.com/index.php/home/goods/showList.html?jiange=3000 -->
        </div>
        <script type="text/javascript" src="<?php echo (C("BACK_JS_URL")); ?>jq.js"></script>
        <script type="text/javascript">
    $(function(){
        //下面所有复选框的状态，和第一个复选框按钮的状态一样
        $("#all").click(function(){
            $("#list input:checkbox").prop("checked",$(this).prop("checked"));
        })

        //下面的checkbox都被选中了，那么第一个checkbox也被选中
        $("#list input:checkbox").click(function(){
            //
            if($("#list input:checkbox").length === $("#list input:checked").length){
                $("#all").prop("checked",true);
            }else{
                $("#all").prop("checked",false);
            }

        })

        //反选
        $("#fan").click(function(){
            $("#list input").each(function(){
                this.checked = !this.checked;
            })
        })
        
        //删除按钮绑定单击事件
        $("#delete").click(function(){
             var str ="";//声明空字符串保存id[]
             
             //用each()遍历每一个多选框 
             $("#list input").each(function(){
                 //过滤出被选中的多选框
                 if(this.checked==true){
                    str+=this.id+',';//拼接id字符串
                 }
             })
             // alert(str);
             //携带id字符串跳转请求delete
            window.location.href="http://www.shop0926.com/index.php?m=Back&c=Goods&a=delete&id="+str;
        })
     })
        </script>
    </body>
</html>