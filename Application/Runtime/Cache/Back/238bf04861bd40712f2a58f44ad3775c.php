<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head></head>
<body>

    <form action="/index.php/Back/Duo/add" method="post">
        会员姓名：<br /><input type="text" value="" id="mem_name" /><br /><br />

        联系电话：<br /><input type="text" value=""  id="mem_phone" /><br /><br />
        <div id="pics">
            <p>
                [商品分类][商品名称][商品数量][上货价][奖金币][上货总金额][奖金币总金额]
            <p/>
            <p>
                <input type="hidden" name="member_name[]" class="v1"  />
                <input type="hidden" name="member_phone[]" class="v2" />
                <input type="text" name="classify[]" size="5" />
                <input type="text" name="goods_name[]" size="5" />
                <input type="text" name="goods_num[]" size="5" />
                <input type="text" name="top_price[]" size="5" />
                <input type="text" name="money_num[]" size="5" />
                <input type="text" name="top_he[]" size="5" />
                <input type="text" name="money_he[]" size="5" />
                <input type="hidden" name="text[]" class="v3" />
            </p>
        </div>
        <input type="button" style="background-color: white;border:0;" value="[+]添加记录" onclick="addinput()" id="add" /><br /><br />

        收货地址：<br />
        详细地址：<br />
        <textarea  id="text" cols="30" rows="10"></textarea><br /><br />

        发货日期：<input type="date" name="add_time" /><br /><br />
        <input type="submit" value="添加" id="from1" />
    </form>
</body>
<block name="javascript">
    <script src="<?php echo (C("BACK_JS_URL")); ?>jq.js"></script>
    <script>
    //依托事件来给其中的隐藏域赋值  用来变成二维数组  没有时间是获取不到值的 必须获取
    $("#from1").click(function(){
       
        var	v_name=$("#mem_name").val();
        var	v_phone=$("#mem_phone").val();
        var	v_text=$("#text").val();
		// alert(v_name);
        $(".v1").attr("value",v_name);
        $(".v2").attr("value",v_phone);
        $(".v3").attr("value",v_text);    	
    })

    function addinput() {
    	var pics=document.getElementById('pics'); 
    	var Add=$("<span><input type='hidden' name='member_name[]' class='v1' /> <input type='hidden' name='member_phone[]' class='v2' /> <input type='text' name='classify[]' size='5' /> <input type='text' name='goods_name[]' size='5' /> <input type='text' name='goods_num[]' size='5' /> <input type='text' name='top_price[]' size='5' /> <input type='text' name='money_num[]' size='5' /> <input type='text' name='top_he[]' size='5' /> <input type='text' name='money_he[]' size='5' /> <input type='hidden' name='text[]' class='v3' /><input type='date' name='add_time[]' /> <p/></span>");
    	Add.appendTo(pics);
    }

    </script>

</html>