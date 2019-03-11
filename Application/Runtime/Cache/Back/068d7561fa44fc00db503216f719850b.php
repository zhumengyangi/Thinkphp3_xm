<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>添加权限</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
            <link href="<?php echo (C("BACK_CSS_URL")); ?>mine.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <div class="div_head">
            <span>
                <span style="float:left">当前位置是：权限管理-》添加权限信息</span>
                <span style="float:right;margin-right: 8px;font-weight: bold">
                    <a style="text-decoration: none" href="<?php echo U('showlist');?>">【返回】</a>
                </span>
            </span>
        </div>
        <div></div>
        <div style="font-size: 13px;margin: 10px 5px">
            <form action="/index.php/Back/Auth/add.html" method="post" >
                <table border="1" width="100%" class="table_a">
                    <tr>
                        <td>权限名称</td>
                        <td><input type="text" name="auth_name" /></td>
                    </tr>
                    <tr>
                        <td>模块名称</td>
                        <td><input type="text" name="module_name" /></td>
                    </tr>
                    <tr>
                        <td>控制器名称</td>
                        <td><input type="text" name="controller_name" /></td>
                    </tr>
                    <tr>
                        <td>方法名称</td>
                        <td><input type="text" name="action_name" /></td>
                    </tr>
                    <tr>
                        <td>上级权限</td>
                        <td>
                            <select name="parent_id">
                                <option value="0">顶级权限</option>
                                <?php foreach ($auths as $k => $v) :?>
                                    <option value="<?php echo $v['auth_id']; ?>">
                                        <?php echo str_repeat("&nbsp;", $v['level']*8);?>
                                        <?php echo $v['auth_name']; ?>
                                    </option>  
                                <?php endforeach;?>
                                       
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <input type="submit" value="添加" />
                        </td>
                    </tr>  
                </table>
            </form>
        </div>
    </body>
</html>