<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
   <Admintemplate file="Common/Nav"/>
   <form class="J_ajaxForm" action="{:U('brand_edit',array('brand_id'=>$_GET['brand_id']))}" method="post" id="myform">
   <div class="h_a">基本属性</div>
   <div class="table_full">
   <table width="100%" class="table_form contentWrap">
        <tbody>
            <th width="80">选择校友分类<span class="red">*</span></th>
            <td><select name="school_id">
            <option value="">请选择</option>
            <volist name="list" id="vo">
              <option value="{$vo.id}" <if condition="$vo['id'] eq $school_id">selected</if>>{$vo.school_name}</option>
            </volist>
            </select></td>
            </tr>
            <tr>
            <th>校友名称<span class="red">*</span></th>
            <td><input type="text" class="input" name="brand_name" value="{$brand_name}" placeholder="例：雷军校友"></td>
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