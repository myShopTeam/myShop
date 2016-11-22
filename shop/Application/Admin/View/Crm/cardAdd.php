<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
   <Admintemplate file="Common/Nav"/>
   <form class="J_ajaxForm" action="{:U('cardAdd')}" method="post" id="myform">
   <div class="h_a">基本属性</div>
   <div class="table_full">
   <table width="100%" class="table_form contentWrap">
        <tbody>
          <tr>
            <th width="80">卡号<span class="red">*</span></th>
            <td width="250"><input type="test" name="card_num" class="input" id="username" placeholder="请输入卡号"></td>
            <th width="90">校验码</th>
            <td><input type="test" name="verif" class="input" id="verify" maxlength="6"  placeholder="请输入卡号"></td>
          </tr>
           <tr>
            <th>卡单类型<span class="red">*</span></th>
            <td>
                <select name="card_type" class="select" id="card_type">
                    <option ></option>
                    <volist name="type" id="vo">
                    <option value="{$vo.card_name}">{$vo.card_name}</option>
                    </volist>
                </select>
            </td>
            <th>产品名称<span class="red">*</span></th>
            <td>
                <select name="card_name" class="select" id="card_name">
                </select>
           </td>
          </tr>
          <tr>
            <th width="80">真实姓名</th>
            <td width="350"><input type="test" name="realname" class="input" id="realname"  placeholder="请输入真实姓名"></td>
              <th width="80">身份证号</th>
            <td><input type="text" name="cred_num" value="" class="input" id="email"  placeholder="请输入身份证号"></td>
          </tr>
          <tr>
            <th>出生年月</th>
            <td><input type="text" name="birthday" class="input length_2 J_date" id="birthday" value="{$_GET.start_uploadtime}" placeholder="请输入生日" style="width: 147px !important;"></td>
              <th>联系地址</th>
            <td><input type="text" name="live" value="" class="input" id="qq" placeholder="请输入联系地址"></td>
          </tr>
          <tr>          
            <th width="80">手机</th>
            <td><input type="text" name="mobile" value="" class="input" id="email"  placeholder="请输入手机号"></td>
          </tr>   
          <tr>
            <th>省份</th>
            <td><input type="text" name="addr_province" value="" class="input" id="phone" placeholder="请输入省份"></td>
            <th>城市</th>
            <td><input type="text" name="addr_city" value="" class="input" id="mobile" placeholder="请输入城市"></td>
          </tr>
          <tr>
            <th>紧急联系人</th>
            <td><input type="text" name="contract_name" value="" class="input" id="phone" placeholder="请输入紧急联系人姓名"></td>
            <th>紧急联系人电话</th>
            <td><input type="text" name="contract_way" value="" class="input" id="mobile" placeholder="请输入紧急联系人电话"></td>
          </tr> 
          <tr>
            <th>性别</th>
            <td><input type="radio" name="sex" class="input" id="sex" value="保密" checked>保密
            <input type="radio" name="sex" class="input" id="sex" value="男">男
            <input type="radio" name="sex" class="input" id="sex1" value="女">女</td>
            <th>是否激活</th>
            <td>
            <input type="radio" name="is_active" class="input" id="sex" value="2">是
            <input type="radio" name="is_active" class="input" id="sex1" value="1" checked>否</td>
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
        <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit">添加</button>
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