<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

        <title>权限列表</title>

        <link href="<?php echo (C("BACK_CSS_URL")); ?>mine.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <style>
            .tr_color{background-color: #9F88FF}
        </style>
        <div class="div_head">
            <span>
                <span style="float: left;">当前位置是：权限管理-》权限列表</span>
                <span style="float: right; margin-right: 8px; font-weight: bold;">
                    <a style="text-decoration: none;" href="<?php echo U('add');?>">【添加权限】</a>
                </span>
            </span>
        </div>
        <div></div>

        <div style="font-size: 13px; margin: 10px 5px;">
            <table class="table_a" border="1" width="100%">
                <tbody><tr style="font-weight: bold;">
                        <td>序号</td>
                        <td>权限名称</td>
                        <td>模块名称</td>
                        <td>控制器名称</td>
                        <td>方法名称</td>
                        <td>上级id</td>
                        <td>创建时间</td>
                        <td align="center">操作</td>
                    </tr>
                    <?php if(is_array($info)): foreach($info as $key=>$v): ?><tr id="product1">
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
                       <td><a href="<?php echo U('del',array('auth_id'=>$v['auth_id']));?>">删除</a></a>&nbsp;&nbsp;
                           <a href="javascript:;" onclick="edit_product(1)">修改</a>
                       </td>
                    </tr><?php endforeach; endif; ?>
                    <tr>
                        <td colspan="20" style="text-align: center;">
                            <?php echo ($page); ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
</html>