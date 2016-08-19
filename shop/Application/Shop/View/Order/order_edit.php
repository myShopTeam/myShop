<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
   <Admintemplate file="Common/Nav"/>
   <form class="J_ajaxForm" action="{:U('category_edit',array('catid'=>$_GET['catid']))}" method="post" id="myform">
   <div class="h_a">基本属性</div>
   <div class="table_full">
   <table width="100%" class="table_form contentWrap">
        <tbody>
          <tr>
            <th width="80">父级分类</th>
            <td>{$catList}</td>
          </tr>
          <tr>
            <th width="80">分类名称<span class="red">*</span></th>
            <td><input type="test" name="cat_name" class="input" id="goods_name" value="{$cat_name}">
              <span class="gray">请输入分类名称</span></td>
            </tr>
            <tr>
              <th>分类图片</th>
              <td colspan="3"><a href="javascript:void(0);" onclick="flashupload('thumb_images', '附件上传','thumb',thumb_images,'1,jpg|jpeg|gif|png|bmp,1,,,0','Content','14','4f53e09b9971776c9afed91028a69955');return false;">
              <img src="{$cat_img|default='/statics/images/icon/upload-pic.png'}" id="thumb_preview" width="135" height="113" style="cursor:hand"></a></td>
              <input type="hidden"  id='thumb' name="cat_img" value="{$cat_img}">
              <!-- <th>商品缩略图</th>
              <td><a href="javascript:void(0);" onclick="flashupload('thumb_images', '附件上传','thumb',thumb_images,'1,jpg|jpeg|gif|png|bmp,1,,,0','Content','14','4f53e09b9971776c9afed91028a69955');return false;">
      <img src="/statics/images/icon/upload-pic.png" id="thumb_preview" width="135" height="113" style="cursor:hand"></a></td> -->
            </tr>
            <tr>
            <th>显示分类</th>
            <td><select id="is_show" name="is_show">
                  <option value="1" <if condition="$is_show eq 1">selected</if>>显示</option>
                  <option value="0" <if condition="$is_show eq 0">selected</if>>不显示</option>
                </select></td>
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