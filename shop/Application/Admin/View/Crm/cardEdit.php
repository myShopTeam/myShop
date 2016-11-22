<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
   <Admintemplate file="Common/Nav"/>
   <form class="J_ajaxForm" action="{:U('cardEdit')}" method="post" id="myform">
   <div class="h_a">基本属性</div>
   <div class="table_full">
       <input type="hidden" name="id" value="{$card_id}">
   <table width="100%" class="table_form contentWrap">
        <tbody>
          <tr>
            <th width="80">卡号<span class="red">*</span></th>
            <td width="250"><input readonly type="test" value='{$card_num}' name="card_num" class="input" id="username" placeholder="请输入卡号"></td>
            <th width="90">校验码</th>
            <td><input type="test" name="verif" class="input" id="verify" maxlength="6" value="{$verif}" placeholder="请输入卡号"></td>
          </tr>
           <tr>
            <th>卡单类型<span class="red">*</span></th>
                <td>
                    <select name="card_type" class="select" id="card_type">
                        <option ></option>
                        <volist name="type" id="vo">
                            <option <eq name="vo.card_name" value="$card_type">selected</eq> value="{$vo.card_name}">{$vo.card_name}</option>
                        </volist>
                    </select>
                </td>
                <th>产品名称<span class="red">*</span></th>
                <td>
                    <select name="card_name" class="select" id="card_name">
                        <option ></option>
                        <volist name="product" id="vo">
                            <option <eq name="vo.card_name" value="$card_name">selected</eq> value="{$vo.card_name}">{$vo.card_name}</option>
                        </volist>
                    </select>
               </td>
          </tr>
          <tr>
            <th width="80">真实姓名</th>
            <td width="350"><input type="test" value='{$realname}' name="realname" class="input" id="realname"  placeholder="请输入真实姓名"></td>
            <th width="80">身份证</th>
            <td><input type="text" name="mobile" value="{$mobile}" class="input" id="email"  placeholder="请输入手机号"></td>
        
          </tr>
          <tr>
            <th>出生年月</th>
            <td><input type="text" name="birthday" value="<if condition='$birthday'>{$birthday|date='Y-m-d',###}</if>" class="input length_2 J_date" id="birthday" value="{$_GET.start_uploadtime}" placeholder="请输入生日" style="width: 147px !important;"></td>
              <th>联系地址</th>
            <td><input type="text" name="live" value="{$live}" class="input" id="qq" placeholder="请输入联系地址"></td>
          </tr>
          <tr>
                <th width="80">手机</th>
            <td><input type="text" name="mobile" value="{$mobile}" class="input" id="email"  placeholder="请输入手机号"></td>
          </tr>
          <tr>
            <th>省份</th>
            <td><input type="text" name="addr_province"  value="{$addr_province}" class="input" id="phone" placeholder="请输入省份"></td>
            <th>城市</th>
            <td><input type="text" name="addr_city" value="{$addr_city}" class="input" id="mobile" placeholder="请输入城市"></td>
          </tr>
          <tr>
            <th>紧急联系人</th>
            <td><input type="text" name="contract_name" value="{$contract_name}" class="input" id="phone" placeholder="请输入紧急联系人姓名"></td>
            <th>紧急联系人电话</th>
            <td><input type="text" name="contract_way" value="{$contract_way}" class="input" id="mobile" placeholder="请输入紧急联系人电话"></td>
          </tr>
          <tr>
          <tr>
            <th>性别</th>
            <td><input type="radio" name="sex" class="input" id="sex" value="保密" <if condition="$sex eq '保密'"> checked</if>>保密
            <input type="radio" name="sex" class="input" id="sex" value="男" <if condition="$sex eq '男'"> checked</if>>男
            <input type="radio" name="sex" class="input" id="sex1" value="女" <if condition="$sex eq '女'"> checked</if>>女</td>
            <th>状态</th>
            <td style="color:green"><if condition="$is_active == 2">已激活<else/><font color="red">未激活</font></if></td>
          <tr>
<!--            <tr>
              <th>头像</th>
              <td colspan="3"><a href="javascript:void(0);" onclick="flashupload('thumb_images', '附件上传','thumb',thumb_images,'1,jpg|jpeg|gif|png|bmp,1,,,0','Content','14','4f53e09b9971776c9afed91028a69955');return false;">
              <img src="/statics/images/icon/upload-pic.png" id="thumb_preview" width="135" height="113" style="cursor:hand"></a></td>
              <input type="hidden" name="headpic" value="" id="thumb">
               <th>商品缩略图</th>
              <td><a href="javascript:void(0);" onclick="flashupload('thumb_images', '附件上传','thumb',thumb_images,'1,jpg|jpeg|gif|png|bmp,1,,,0','Content','14','4f53e09b9971776c9afed91028a69955');return false;">
      <img src="/statics/images/icon/upload-pic.png" id="thumb_preview" width="135" height="113" style="cursor:hand"></a></td> 
            </tr>-->
<!--             <tr>
              <th width="80">
                商品参数 
               </th>
               <td colspan="3">
               <div id="content_tip"></div>
               <div id="content" class="edui-default" style="">
               <span>
</div></span></td>
            </tr> -->
        </tbody>
      </table>
   </div>
   <div class="btn_wrap" style="z-index:9999 !important;">
      <div class="btn_wrap_pd">             
        <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit">修改</button>
      </div>
    </div>
    </form>
</div>
<script src="{$config_siteurl}statics/js/common.js"></script>
<script src="{$config_siteurl}statics/js/content_addtop.js"></script>
<style type="text/css">.content_attr{ border:1px solid #CCC; padding:5px 8px; background:#FFC; margin-top:6px}</style>
</body>
</html>
<script>
    $('#card_type').change(function(){
        var url   = "{:U('ajaxGetProduct')}";
        var data  = 'card_type='+$(this).val()
        $.post(url,data,function(re){
            if(re.res == 'success'){
                $('#card_name').html(re.data)
            }else{
                alert(re.msg);
            }
        },'json')
    })
</script>
