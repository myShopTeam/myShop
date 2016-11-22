<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
   <Admintemplate file="Common/Nav"/>
   <form class="J_ajaxForm" action="{:U('add')}" method="post" id="myform">
   <div class="h_a">基本属性</div>
   <div class="table_full">
   <table width="100%" class="table_form contentWrap">
        <tbody>
          <tr>
            <th width="100">募捐标题<span class="red">*</span></th>
            <td width="250"><input type="test" name="title" class="input" id="username" placeholder="请输入募捐标题"></td>
            <th width="100"></th>
            <td></td>
          </tr>
          <tr>
            <th width="80">募捐总金额：</th>
            <td width="350"><input type="test" name="total_money" class="input" id="realname"  placeholder="请输入金额">（元）</td>
            <th width="80">计划募捐人数：</th>
            <td><input type="text" name="member_num" value="" class="input" id="email"  placeholder="请输入募捐人数">（最多可设置<font color="red" >{$max_mem}</font>）人</td>
          </tr>
          <tr>
            <th width="80">捐款截止时间：</th>
            <td width="350"><input type="test" name="period" class="input length_2 J_datetime" id="realname"  placeholder="选择捐款截止时间"></td>
            <th width="80">人均捐款金额：</th>
            <td><input type="text" name="aver_money" value="" class="input" id="email"  placeholder="可手动输入捐款金额">（元）
                <button class="btn btn_submit mr10 auto_sum" type="button">自动计算</button>
            </td>
          </tr>
          <tr>
          <tr>
<!--            <tr>
              <th>头像</th>
              <td colspan="3"><a href="javascript:void(0);" onclick="flashupload('thumb_images', '附件上传','thumb',thumb_images,'1,jpg|jpeg|gif|png|bmp,1,,,0','Content','14','4f53e09b9971776c9afed91028a69955');return false;">
              <img src="/statics/images/icon/upload-pic.png" id="thumb_preview" width="135" height="113" style="cursor:hand"></a></td>
              <input type="hidden" name="headpic" value="" id="thumb">
-->      
            <tr>
                <th>募捐缩略图</th>
                <td colspan="3"><a href="javascript:void(0);" onclick="flashupload('thumb_images', '附件上传','thumb',thumb_images,'{$args_thumb}','Content','9','{$authkey_thumb}');return false;">
                <img src="{$cat_img|default='/statics/images/icon/upload-pic.png'}" id="thumb_preview" width="135" height="113" style="cursor:hand"></a></td>
                <input type="hidden"  id='thumb' name="col_thumb" value="">
            </tr>
             <tr>
              <th width="80">
                募捐详情
               </th>
               <td colspan="3">
               <div id="content_tip"></div>
               <div id="content" class="edui-default" style="">
               <span>
</div></span></td>
            </tr> 
        </tbody>
      </table>
   </div>
   <div class="btn_wrap" style="z-index:9999 !important;">
      <div class="btn_wrap_pd">             
        <button class="btn btn_submit mr10 J_ajax_submit_btn issue" type="button" >发起募捐</button>
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
    $('.auto_sum').click(function(){
        var money = $('input[name="total_money"]').val();
        var num   = $('input[name="member_num"]').val();
        var aver_money = money/num;
        var re = /^[1-9]+[0-9]*]*$/;   //判断正整数 /^[1-9]+[0-9]*]*$/   
        if (!re.test(money/num))
        {
           alert("人均捐款金额非整数，请重新输入募捐金额和人数");
           return false;
        }else{
           $('input[name="aver_money"]').val(aver_money)
        }
    })
    
    function check_period(){
        var period    = $('input[name="period"]').val()
        var timestamp = new Date().getTime();
        var end_time  = Date.parse(new Date(period));
        var total_day = (end_time - timestamp)/(24*60*60*1000);
        return total_day
    }
    
    $('.J_ajax_submit_btn').click(function(e){
        if(!confirm('请确认发布信息无误！')){
            e.topPropagation();
        }
    })
    
</script>
<script type="text/javascript">
    //编辑器路径定义
    var editorURL = GV.DIMAUB;
</script>
<script type="text/javascript" src="/statics/js/ueditor/editor_config.js"></script>
<script type="text/javascript" src="/statics/js/ueditor/editor_all_min.js"></script>
<script type="text/javascript">
    var editorcontent = UE.getEditor('content', {
        textarea: 'content',
        toolbars: [[
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
        autoHeightEnabled: false
    });
    editorcontent.ready(function () {
        editorcontent.execCommand('serverparam', {
            'catid': '9',
            '_https': '/',
            'isadmin': '1',
            'module': 'Content',
            'uid': '1',
            'groupid': '0',
            'sessid': '1439600837',
            'authkey': '8ad0611414174499baa67128296ba1fb',
            'allowupload': '1',
            'allowbrowser': '1',
            'alowuploadexts': ''
        });
        editorcontent.setHeight(300);
    });

</script>