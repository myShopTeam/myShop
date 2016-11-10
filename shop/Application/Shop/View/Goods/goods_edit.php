<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
   <Admintemplate file="Common/Nav"/>
   <form class="J_ajaxForm" action="{:U('goods_edit',array('goods_id'=>$_GET['goods_id']))}" method="post" id="myform">
   <div class="h_a">基本属性</div>
   <div class="table_full">
   <table width="100%" class="table_form contentWrap">
        <tbody>
          <tr>
            <th width="80">商品名称<span class="red">*</span></th>
            <td width="350"><input type="test" name="goods_name" class="input" id="goods_name" value="{$goods_name}">
              <span class="gray">请输入商品名称</span></td>
              <th width="80">商品货号</th>
            <td><input type="text" name="goods_serial" class="input" id="goods_serial" value="{$goods_serial}"><span class="gray">如果您不输入商品货号，系统将自动生成一个唯一的货号。</span></td>
          </tr>
          <tr>
            <th>商品分类<span class="red">*</span></th>
            <td>{$catList}
              <a href="{:U('Category/category_add')}" class="btn">添加分类</a></td>
              <th>运费</th>
              <td>
                  <input type="radio" name="transtype" value="免运费" checked>免运费
                  <input type="radio" name="transtype" value="固定运费">固定运费&nbsp;&nbsp;&nbsp;
                  <input type="text" class="input freight" name="freight" value="" hidden placeholder="请填写固定运费">
              </td>
          </tr>
          <tr>
          <tr>
            <th>上架</th>
            <td><input type="checkbox" name="is_show" value="1"  id="is_show" <if condition="$is_show eq 1">checked</if>>打勾表示允许销售，否则不允许销售。</td>
            <th>加入推荐</th>
            <td><input type="checkbox" name="is_best" value="1" id="is_best" <if condition="$is_best eq 1">checked</if>>精品
                <input type="checkbox" name="is_hot" value="1" id="is_hot" <if condition="$is_hot eq 1">checked</if>>热销
                <input type="checkbox" name="is_new" value="1" id="is_new" <if condition="$is_new eq 1">checked</if>>新品</td>
          </tr>
          <tr>
            <th>市场售价</th>
            <td><input type="text" name="market_price" value="{$market_price}" class="input" id="market_price" size="30">&nbsp;&nbsp;元</td>
              <th>本店售价<span class="red">*</span></th>
            <td><input type="text" name="goods_price" value="{$goods_price}" class="input" id="goods_price">&nbsp;&nbsp;元</td>
          </tr>
          <tr>
            <th>商品库存<span class="red">*</span></th>
            <td><input type="text" name="goods_total" value="{$goods_total}" class="input" id="goods_total" size="30">&nbsp;&nbsp;件</td>
              <th>销售数量</th>
            <td><input type="text" name="sale_num" value="{$sale_num}" class="input" id="sale_num">&nbsp;&nbsp;件</td>
          </tr>
          <tr>
              <th>商品属性</th>
              <td colspan="3">
                  <select name="attr_name" style="width: 156px;">
                    {$attrHtml}
                  </select>
                  <select name="attr_value" style="width: 156px;">
                    <option value="0">请选择商品属性值</option>
                  </select>
                  <input type="text" hidden value="" class="attrMoney input" placeholder="价格(相同可不填)" />
                  <input type="button" class="btn addAttr" value="添加" />
                  {$skuStr}
              </td>
          </tr>
          <tr>
              <th>商品缩略图</th>
              <td colspan="3"><a href="javascript:void(0);" onclick="flashupload('thumb_images', '附件上传','thumb',thumb_images,'{$args_thumb}','Content','14','{$authkey_thumb}');return false;">
                      <img src="{$goods_thumb|default='/statics/images/icon/upload-pic.png'}" id="thumb_preview" width="135" height="113" style="cursor:hand"></a></td>
              <input type="hidden"  id='thumb' name="goods_thumb" value="{$goods_thumb}">
          </tr>
          <tr>
              <th>商品展示图片</th>
              <td colspan="3">
              <div id="multpic" class="picList">
                <ul>{$imgsStr}</ul>
              </div>
              <a herf="javascript:void(0);" onclick="javascript:flashupload('multpic_images', '图片上传','multpic',change_images,'{$args}','Content','11','{$authkey}')" class="btn"><span class="add"></span>选择图片 </a>
            </tr>
              <th width="80">
                  商品图文详情
               </th>
               <td colspan="3">
               <div id="content_tip"></div><script type="text/plain" id="content" name="content">{$content}</script>
               <div id="content" class="edui-default" style="">
               <span>
</div></span></td>
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
<script type="text/javascript">
                //编辑器路径定义
                var editorURL = GV.DIMAUB;
                </script>
                <script type="text/javascript" src="/statics/js/ueditor/editor_config.js"></script>
                <script type="text/javascript" src="/statics/js/ueditor/editor_all_min.js"></script>
<script type="text/javascript">
 var editorcontent = UE.getEditor('content',{  
                            textarea:'content',
                            toolbars:[[
            'fullscreen', 'source', '|', 'undo', 'redo', '|',
            'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
            'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
            'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
            'directionalityltr', 'directionalityrtl', 'indent', '|',
            'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'touppercase', 'tolowercase', '|',
            'link', 'unlink', 'anchor', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
            'simpleupload', 'insertimage', 'emotion', 'scrawl', 'insertvideo', 'music', 'attachment', 'map', 'gmap', 'insertframe', 'insertcode', 'webapp', 'pagebreak', 'template', 'background', '|',
            'horizontal', 'date', 'time', 'spechars', 'snapscreen', 'wordimage', '|',
            'inserttable', 'deletetable', 'insertparagraphbeforetable', 'insertrow', 'deleterow', 'insertcol', 'deletecol', 'mergecells', 'mergeright', 'mergedown', 'splittocells', 'splittorows', 'splittocols', 'charts', '|',
            'print', 'preview', 'searchreplace', 'help', 'drafts'
        ]],
                            autoHeightEnabled:false
                      });
                      editorcontent.ready(function(){
                            editorcontent.execCommand('serverparam', {
                                  'catid': '9',
                                  '_https':'/',
                                  'isadmin':'1',
                                  'module':'Content',
                                  'uid':'1',
                                  'groupid':'0',
                                  'sessid':'1439600837',
                                  'authkey':'8ad0611414174499baa67128296ba1fb',
                                  'allowupload':'1',
                                  'allowbrowser':'1',
                                  'alowuploadexts':''
                             });
                             editorcontent.setHeight(300);
                      });
                      
</script>
<style type="text/css">.content_attr{ border:1px solid #CCC; padding:5px 8px; background:#FFC; margin-top:6px}</style>
<script>
  $(function(){
    //获取属性名
    $('select[name=cat_id]').change(function(){
        $value = $(this).val();
        $.post("{:U('getAttr')}",{catid:$value,type:0},function(res){
            $('select[name=attr_name]').html(res.html);
          },'json')
    })
    //获取属性值
    $('select[name=attr_name]').change(function(){
        $value = $(this).val();
        $catid = $('select[name=cat_id]').val();
        $.post("{:U('getAttr')}",{attrName:$value,catid:$catid,type:1},function(res){
            $('select[name=attr_value]').html(res.html);
          },'json')
    })
    //显示上传属性缩略图和价格
    $('select[name=attr_value]').change(function(){
      $('.attrMoney').show();
    })
    $('.addAttr').click(function(){
      var _this = $(this);
        var attr_name1 = $('select[name=attr_name1]').val();
        var attr_value1 = $('select[name=attr_value1] option:selected').attr('data-val');
        var attr_id1 = $('select[name=attr_value1] option:selected').val();
        var attr_name2 = $('select[name=attr_name2]').val();
        var attr_value2 = $('select[name=attr_value2] option:selected').attr('data-val');
        var attr_id2 = $('select[name=attr_value2] option:selected').val();
      var attrMoney = $('.attrMoney').val();
      //单属性检测
      var attr_names = $('.attr_names').val();
      if(attr_names!=attr_name){
        if(attr_names!=undefined){
          alert('商品只能选择单属性');
          return false;
        }
      }
        if(attrMoney==''){
            attrMoney = '不变';
        }
        if(attr_name1==0){
            alert("请选择商品属性名");
            return false;
        }
        if(attr_value1 ==0 || attr_value1 == undefined){
            alert("请选择商品属性值");
            return false;
        }
      $str = '';
        if(attr_name2 && attr_value2 && attr_id2){
            $str += '<div class="line"><input type="text" class="input attr_names" name="attr_names[]" readOnly="true" value='+attr_name1+' />&nbsp;';
            $str += '<input type="text" class="input attr_values" name="attr_values[]" readOnly="true" value='+attr_value1+' />&nbsp;';
            $str += '<input type="hidden" name="attr_id[]" value="'+attr_id1+'" >';
            $str += '<input type="text" class="input attr_names" name="attr_names[]" readOnly="true" value='+attr_name2+' />&nbsp;';
            $str += '<input type="text" class="input attr_values" name="attr_values[]" readOnly="true" value='+attr_value2+' />&nbsp;';
            $str += '<input type="text" class="input attrMoneys" name="attrMoneys[]" value="'+attrMoney+'" />&nbsp;';
            $str += '<input type="hidden" name="attr_id[]" value="'+attr_id2+'" >';
        } else {
            $str += '<div class="line"><input type="text" class="input attr_names" name="attr_names[]" readOnly="true" value='+attr_name1+' />&nbsp;';
            $str += '<input type="text" class="input attr_values" name="attr_values[]" readOnly="true" value='+attr_value1+' />&nbsp;';
            $str += '<input type="text" class="input attrMoneys" name="attrMoneys[]" value="'+attrMoney+'" />&nbsp;';
            $str += '<input type="hidden" name="attr_id[]" value="'+attr_id1+'" >';
        }
      // $str += '<input type="button" class="button" onclick="javascript:flashupload(\'image_images\', \'附件上传\',\'image\',submit_images,\'1,jpg|jpeg|gif|bmp|png,1,,,0\',\'content\',\'\',\'8c87cb0d024e5607ccb8d97e49a17e80\')" value="上传图片">';
      $str += '<input type="button" class="btn close" value="删除" /></div>';
      _this.parents('td').append($str);
      $('.close').unbind('click');
      $('.close').bind('click',function(){});
    })
    $(document).on('click','.close',function(){
      $(this).parent('.line').remove();
    })

    //运费
    $('input[name=transtype]').change(function(){
      $val = $(this).val();
      if($val == '固定运费'){
        $('.freight').show();
      }else{
        $('.freight').hide();
      }
    })
  })
</script>
</body>
</html>