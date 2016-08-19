<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
   <Admintemplate file="Common/Nav"/>
   <form class="J_ajaxForm" action="{:U('alumni_add')}" method="post" id="myform">
   <div class="h_a">基本属性</div>
   <div class="table_full">
   <table width="100%" class="table_form contentWrap">
        <tbody>
            <th width="80">分类名称<span class="red">*</span></th>
            <td><input type="test" name="alumni_name" class="input" id="alumni_name" placehoder="请输入分类名称"></td>
            </tr>
            <tr>
            <th>显示分类</th>
            <td><select id="is_show" name="is_show">
                  <option value="1">显示</option>
                  <option value="0">不显示</option>
                </select></td>
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
</body>
</html>