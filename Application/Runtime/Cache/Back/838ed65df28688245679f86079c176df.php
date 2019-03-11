<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

        <title>管理员列表</title>

        <link href="<?php echo (C("BACK_CSS_URL")); ?>mine.css" type="text/css" rel="stylesheet" />
        <script type="text/javascript" src='<?php echo (C("BACK_JS_URL")); ?>jquery-2.1.3.min.js'></script>
    </head>
    <body>
        <style>
            .tr_color{background-color: #9F88FF}
        </style>
        <div class="div_head">
            <span>
                <span style="float: left;">当前位置是：权限管理-》管理员列表</span>
                <span style="float: right; margin-right: 8px; font-weight: bold;">
                    <a style="text-decoration: none;" href="<?php echo U('add');?>">【添加管理员】</a>
                </span>
            </span>
        </div>
        <div></div>

        <div style="font-size: 13px; margin: 10px 5px;">
            <table class="table_a" border="1" width="100%">
                <tbody><tr style="font-weight: bold;">
                        <td>序号</td>
                        <td>管理员名称</td>
                        <td>管理员密码</td>
                        <td>是否启用</td>
                        <td>创建时间</td>
                        <td align="center">操作</td>
                    </tr>
                    <?php if(is_array($info)): foreach($info as $key=>$v): ?><tr id="product1">
                        <td><?php echo ($v["admin_id"]); ?></td>
                        <td><a href="#"><?php echo ($v["admin_name"]); ?></a></td>
                        <td><?php echo ($v["admin_pwd"]); ?></td>

                        <td class="is_use" admin_id="<?php echo ($v["admin_id"]); ?>" class="is_use">
                            <?php echo ($v['is_use']==1?'启用':'未启用'); ?>
                        </td>
                        
                        <td><?php echo (date("Y-m-d H:i:s",$v["add_time"])); ?></td>
                        <td>
                            <?php if($v['admin_id']>1):?>
                                <a href="<?php echo U('delete?admin_id='.$v['admin_id']);?>" onclick="delete_product(1)">删除</a>|
                            <?php endif;?>
                            <a href="<?php echo U('edit?admin_id='.$v['admin_id']);?>" >修改</a>
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
    <script src="<?php echo (C("BACK_JS_URL")); ?>jq.js"></script>
    <script type="text/javascript">
    //给启用按钮的td加点击事件
    $('.is_use').click(function(){
        //先获取点击的记录的id
        var admin_id=$(this).attr('admin_id');
        var _this = $(this);
        // alert(admin_id);
        if(admin_id == 1){
            alert('超级管理员不能被禁用');
            return false;
        }
        $.ajax({
            type:"get",
            // /index.php/Back/Admin/ajaxUpdateIsUse.html?admin_id=
            url:"<?php echo U('ajaxUpdateIsUse');?>?admin_id="+admin_id,
            // dataType:"json",
            success:function(data){
                console.log(data);
                if(data == 0){
                    _this.html('禁用');
                }else if(data == 1){
                    _this.html('启用');
                }
            },
            error:function(e){
                console.log(e);
            }
        })
    });
    </script>
</html>