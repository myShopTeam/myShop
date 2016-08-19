<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
   <Admintemplate file="Common/Nav"/>
   <form class="J_ajaxForm" action="{:U('vip_edit',array('vip_id'=>$_GET['vip_id']))}" method="post" id="myform">
   <div class="h_a">基本属性</div>
   <div class="table_full">
   <table width="100%" class="table_form contentWrap">
        <tbody>
          <tr>
            <th width="80">登录帐号<span class="red">*</span></th>
            <td width="350"><input type="test" name="username" class="input" id="username" placeholder="请输入登录帐号" value="{$username}"></td>
              <th width="80">会员昵称</th>
            <td><input type="text" name="nickname" value="{$nickname}" class="input" id="nickname" placeholder="请输入会员昵称"></td>
          </tr>
           <tr>
            <th>登录密码<span class="red">*</span></th>
            <td><input type="password" name="password" value="" class="input" id="password"  placeholder="不填密码默认不修改"></td>
            <th>确认密码<span class="red">*</span></th>
            <td><input type="password" name="checkPassword" value="" class="input" id="checkPassword"  placeholder="不填密码默认不修改"></td>
          </tr>
          <tr>
            <th width="80">真实姓名</th>
            <td width="350"><input type="test" name="realname" class="input" id="realname"  placeholder="请输入真实姓名" value="{$realname}"></td>
              <th width="80">email</th>
            <td><input type="text" name="email" value="{$email}" class="input" id="email"  placeholder="请输入邮箱地址" value="{$email}"></td>
          </tr>
          <tr>
            <th>生日</th>
            <td><input type="text" name="birthday" class="input length_2 J_date" id="birthday" value="{$_GET.start_uploadtime|default=$birthday}" placeholder="请输入生日" style="width: 147px !important;"></td>
              <th>qq</th>
            <td><input type="text" name="qq" value="{$qq}" class="input" id="qq" placeholder="请输入QQ号"></td>
          </tr>
          <tr>
            <th>家庭电话</th>
            <td><input type="text" name="phone" value="{$phone}" class="input" id="phone" placeholder="请输入家庭电话"></td>
            <th>手机</th>
            <td><input type="text" name="mobile" value="{$mobile}" class="input" id="mobile" placeholder="请输入手机号"></td>
          </tr>
          <tr>
          <tr>
            <th>性别</th>
            <td><input type="radio" name="sex" class="input" id="sex" value="保密" <if condition="$sex eq '保密'">checked</if>>保密
            <input type="radio" name="sex" class="input" id="sex" value="男" <if condition="$sex eq '男'">checked</if>>男
            <input type="radio" name="sex" class="input" id="sex1" value="女" <if condition="$sex eq '女'">checked</if>>女</td>
            <th>是否启动</th>
                <td><select name="status">
                      <option value="1" <if condition="$status eq 1">selected</if>>启动</option>
                      <option value="0" <if condition="$status eq 0">selected</if>>冻结</option>
                  </select><span class="gray">账户冻结后，此账户所有商品将下架</span></td></tr>
          <tr>
            <tr>
              <th>头像</th>
              <td colspan="3"><a href="javascript:void(0);" onclick="flashupload('thumb_images', '附件上传','thumb',thumb_images,'1,jpg|jpeg|gif|png|bmp,1,,,0','Content','14','4f53e09b9971776c9afed91028a69955');return false;">
              <img src="{$headpic|default='/statics/images/icon/upload-pic.png'}" id="thumb_preview" width="135" height="113" style="cursor:hand"></a></td>
              <input type="hidden" name="headpic" value="{$headpic}" id="thumb">
              <!-- <th>商品缩略图</th>
              <td><a href="javascript:void(0);" onclick="flashupload('thumb_images', '附件上传','thumb',thumb_images,'1,jpg|jpeg|gif|png|bmp,1,,,0','Content','14','4f53e09b9971776c9afed91028a69955');return false;">
      <img src="/statics/images/icon/upload-pic.png" id="thumb_preview" width="135" height="113" style="cursor:hand"></a></td> -->
            </tr>
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
</body>
</html>