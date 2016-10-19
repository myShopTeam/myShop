<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
   <Admintemplate file="Common/Nav"/>
   <form class="J_ajaxForm" action="{:U('productAdd')}" method="post" id="myform">
   <div class="h_a">基本属性</div>
   <div class="table_full">
   <table width="100%" class="table_form contentWrap">
        <tbody>
          <tr>
            <th width="80">卡单类型名称<span class="red">*</span></th>
            <td width="250">
                <select name="parent_id">
                    <volist name="type" id="vo">
                    <option value="{$vo.id}">{$vo.card_name}</option>
                    </volist>
                </select>
            </td>
         </tr>
          <tr>
            <th width="80">产品名称<span class="red">*</span></th>
            <td width="250"><input type="test" name="card_name" class="input" id="username" placeholder="请输入名称"></td>
         </tr>
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