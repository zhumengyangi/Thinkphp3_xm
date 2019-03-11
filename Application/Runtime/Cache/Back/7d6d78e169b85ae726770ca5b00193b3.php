<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>添加管理员</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <link href="<?php echo (C("BACK_CSS_URL")); ?>mine.css" type="text/css" rel="stylesheet" />
           
    </head>
    <body>
        <div class="div_head">
            <span>
                <span style="float:left">当前位置是：管理员管理-》添加管理员信息</span>
                <span style="float:right;margin-right: 8px;font-weight: bold">
                    <a style="text-decoration: none" href="<?php echo U('showlist');?>">【返回】</a>
                </span>
            </span>
        </div>
        <div></div>
        <div style="font-size: 13px;margin: 10px 5px">
            <form action="/index.php/Back/Admin/add.html" method="post" >
                <table border="1" width="100%" class="table_a">
                    <tr>
                        <td>管理员名称</td>
                        <td><input type="text" name="admin_name" /></td>
                    </tr>
          			<tr>
                        <td>管理员密码</td>
                        <td><input type="text" name="admin_pwd" /></td>
                    </tr>
         			<tr>
                        <td>确认管理员密码</td>
                        <td><input type="text" name="admin_pwd2" /></td>
                    </tr>
                    <tr>
                        <td>是否启用</td>
                        <td>
                            <input type="radio" name="is_use" value='1' checked/>启用
                            <input type="radio" name="is_use" value='0'/>禁用
                        </td>
                    </tr>
                    <tr>
                        <td>所在角色</td>
                        <td>
							<?php foreach ($roles as $k => $v):?>
								<input type="checkbox" name='role_id[]' value="<?php echo ($v["role_id"]); ?>"/><?php echo ($v["role_name"]); ?><br/>
							<?php endforeach;?>  
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