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
                <span style="float: left;">当前位置是：角色管理-》角色列表</span>
                <span style="float: right; margin-right: 8px; font-weight: bold;">
                    <a style="text-decoration: none;" href="<?php echo U('add');?>">【添加角色】</a>
                </span>
            </span>
        </div>
       
            
        </div>
        <div style="font-size: 13px; margin: 10px 5px;">
            <table class="table_a" border="1" width="100%">
                <thead>
                    <tr style="font-weight: bold;">
                        <td width="60px"><input type="checkbox" id="all"></td>
                        <td>序号</td>
                        <td>权限名称</td>
                        <td>模块名称</td>
                        <td>控制器名称</td>
                        <td>方法名称</td>
                        <td>上级id</td>
                        <td>创建时间</td>
                        <td align="center">操作</td>
                    </tr>
                </thead>
                <tbody id="list">
                    <?php if(is_array($info)): foreach($info as $key=>$v): ?><tr id="product1" align="center">
                        <!-- <td><input type="checkbox" id="<?php echo ($v["goods_id"]); ?>"></td> -->
                        <td><?php echo ($v["auth_id"]); ?></td>
                        <td>
                            <?php echo str_repeat('&nbsp;',$v['level']*8); ?>
                            <?php echo ($v["auth_name"]); ?>
                        </td>
                        <td><?php echo ($v["module_name"]); ?></td>
                        <td><?php echo ($v["controller_name"]); ?></td>
                        <td><?php echo ($v["action_name"]); ?></td>
                        <td><?php echo ($v["parent_id"]); ?></td>
                        <td><?php echo (date("y-m-d",$v["add_time"])); ?></td>
                       <td><a href="javascript:;" onclick="delete_product(1)">删除</a>&nbsp;&nbsp;
                           <a href="javascript:;" onclick="edit_product(1)">修改</a>
                       </td>
                    </tr><?php endforeach; endif; ?>
                   </tbody>
            </table>
             <form action="<?php echo U('Home/Goods/showList');?>" method="get">
                轮播间隔时间: <input type="text" name="jiange" />毫秒
                <input type="submit" id="zhanshi" value="前台图片展示" />
            </form>
            <!-- http://www.shop0926.com/index.php/home/goods/showList.html?jiange=3000 -->
        </div>
    </body>
</html>