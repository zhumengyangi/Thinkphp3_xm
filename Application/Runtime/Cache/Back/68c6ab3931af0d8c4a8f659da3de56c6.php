<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>添加商品</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <link href="<?php echo (C("BACK_CSS_URL")); ?>mine.css" type="text/css" rel="stylesheet">
    </head>

    <body>

        <div class="div_head">
            <span>
                <span style="float:left">当前位置是：商品管理-》添加商品信息</span>
                <span style="float:right;margin-right: 8px;font-weight: bold">
                    <a style="text-decoration: none" href="./admin.php?c=goods&a=showlist">【返回】</a>
                </span>
            </span>
        </div>
        <div></div>

        <div style="font-size: 13px;margin: 10px 5px">
            <form action="/index.php/Back/Goods/update/goods_id/46.html" method="post" enctype="multipart/form-data">
            <input type="hidden" name="goods_id" value="<?php echo ($info['goods_id']); ?>" />
            <table border="1" width="100%" class="table_a">
                <tr>
                    <td>商品名称</td>
                    <td><input type="text" name="goods_name" value="<?php echo ($info['goods_name']); ?>" /></td>
                </tr>
                <tr>
                    <td>商品图片</td>
                    <td><input type="file" name="goods_big_logo" value="<?php echo ($info['goods_big_logo']); ?>" /></td>
                </tr>
                <tr>
                    <td>商品价格</td>
                    <td><input type="text" name="goods_price" value="<?php echo ($info['goods_price']); ?>" /></td>
                </tr>
               <tr>
                    <td>商品数量</td>
                    <td><input type="text" name="goods_num" value="<?php echo ($info['goods_num']); ?>" /></td>
                </tr>
                <tr>
                    <td>商品详情</td>
                    <td><input type="text" name="goods_desc" value="<?php echo ($info['goods_desc']); ?>" /></td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" value="添加">
                    </td>
                </tr>  
            </table>
            </form>
        </div>
    </body>
</html>