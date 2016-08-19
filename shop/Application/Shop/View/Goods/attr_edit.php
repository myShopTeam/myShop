<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
   <Admintemplate file="Common/Nav"/>
   <form class="J_ajaxForm" action="{:U('attr_edit',array('attr_id'=>$_GET['attr_id']))}" method="post" id="myform">
   <div class="h_a">基本属性</div>
   <div class="table_full">
   <table width="100%" class="table_form contentWrap">
        <tbody>
          <tr>
            <th width="80">商品分类<span class="red">*</span></th>
            <td>{$catList}</td>
          </tr>
          <tr>
            <th width="80">属性名<span class="red">*</span></th>
            <td><input type="test" name="attr_name" class="input" id="attr_name" value="{$attr_name}" placeholder="例如：颜色，尺寸等" style="width:300px;"></td>
          </tr>
          <tr>
            <th>属性值<span class="red">*</span></th>
            <td><input type="test" name="attr_val" class="input" id="attr_val" value="{$attr_value}" placeholder="例如：黄色,绿色,蓝色" style="width:300px;">
              <span class="gray">多个属性请用中文状态下的“，”隔开</span></td>
            </tr>
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