<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
   <Admintemplate file="Common/Nav"/>
   <form class="J_ajaxForm" action="{:U('order_delivery')}" method="post" id="myform">
   <div class="h_a">基本属性</div>
   <div class="table_full">
   <table width="100%" class="table_form contentWrap">
        <tbody>
          <tr>
            <th width="80">发货时间：<span class="red">*</span></th>
            <td width="250"><input type="test" name="time" class="input length_2 J_datetime" id="username" placeholder="请选择发货时间"></td>
            <th width="90">快递单号：</th>
            <td><input type="test" name="shipping_num" class="input" id="verify" maxlength="6"  placeholder="请输入物流单号"></td>
          </tr>
            <input type='hidden' value="{$oid}" name='oid'>
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