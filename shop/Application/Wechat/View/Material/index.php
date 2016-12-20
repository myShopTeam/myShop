<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
  <Admintemplate file="Common/Nav"/>


  <style type="text/css">
    .cLine {
      height:25px;
      color: #000000;
      overflow: hidden;
      padding: 5px 0;
    }
    .pageNavigator {
      padding: 5px 0;
    }
    .right {
      float: right;
    }
  </style>
  <link rel="stylesheet" type="text/css" href="{$config_siteurl}statics/weixin/css/imageTextList.css"/>
  <link rel="stylesheet" type="text/css" href="{$config_siteurl}statics/weixin/css/common.css" />

  <form method="post" class="search_form" action="{:U('sync')}">
    <div class="search_type cc mb10">
      <div class="mb10">
        <button class="btn btn_submit mr10 J_ajax_submit_btn">同步素材</button> 注：获取公众平台添加的素材，以下删除素材只是删除此平台下的素材，不会影响公众平台里的素材
      </div>
    </div>
  </form>
  <div class="panel-default">
    <div class="panel-body" style="padding: 0px 65px 40px;">

      <div class="msgWrap msgContainer" id="msgContainer">

<!--        <div class="item" id="newmessage" style="top: 0px; left: 0px; visibility: visible;">-->
         <!--[if IE 8]>
        <!--<div class="rgshadow"></div>
        <![endif]-->
<!--          <div style="display: block;" class="add">+</div>-->
<!--          <div class="select" style="display: none;">-->
<!--            <a href='{:U("MessagePush/imageAdd")}' seed="select-link" smartracker="on" class="single">单图文广播</a>-->
<!--             <a href='{:U("MessagePush/MultiImageAdd")}' class="multi" seed="select-multi" smartracker="on">多图文广播</a>-->
<!--          </div>-->
          <!--[if IE 8]>
        <!--<div class="btmshadow"></div>
        <![endif]-->
<!--        </div>-->
        <script>
          $("#newmessage").hover(function(){
            $(this).find(".add").hide();
            $(this).find(".select").show();
          },function(){
            $(this).find(".add").show();
            $(this).find(".select").hide();
          });
        </script>

        <?php if(!empty($info)){foreach($info as $k=>$v){ ?>
          <!--瀑布流单个元素开始-->
          <div class="item" style="top: 0px; left: 304px; visibility: visible;">
            <!--[if IE 8]><div class="rgshadow"></div><![endif]-->
            <div class="contain">
              <p class="time"><?php echo date('Y-m-d H:i',$v['createtime'])?></p>
              <div class="img"> <img src="<?php echo $v['pic'] ?>" height="121" class="image" alt="<?php echo $v['title'] ?>" seed="img-image" smartracker="on">
                <h3 class="title-multi"><?php echo $v['title'];?></h3>
                <a class="link-cover" target="_blank" href="<?php echo $v['url'] ?>" seed="img-linkCover" smartracker="on"></a> </div>
              <?php if(!empty($v['child'])){foreach($v['child'] as $m=>$n){?>
                <div class="multi-item">
                  <div class="msg fn-left"><?php echo $n['title']?></div>
                  <img src="<?php echo $n['pic']?>" alt="<?php echo $n['title'] ?>" class="photo-mini"> <a class="link-cover" target="_blank" href="<?php echo $n['url']?>" seed="multiItem-linkCover" smartracker="on"></a> </div>
              <?php }} ?>
            </div>
            <div class="control">  <a href="<?php if(!empty($v['child'])){echo U('MessagePush/MessagePush_MultiEdit',array('id'=>$v['id']));}else{echo U('MessagePush/imageEdit',array('id'=>$v['id']));} ?>" seed="control-linkT1" smartracker="on">编辑</a> <a class="lst del" data-id="{$v['id']}" data-used="used" href="javascript:;" onclick="del('{$v['id']}')" seed="control-lst" smartracker="on">删除</a> </div>
            <!--[if IE 8]><div class="btmshadow"></div><![endif]-->
          </div>
          <!--瀑布流单个元素结束-->
        <?php }}?>
      </div>
      <div class="cLine">
        <div class="pageNavigator right">
          <div class="pages">{$Page}</div>
        </div>
        <div class="clr"></div>
      </div>
    </div>
    <div class="clr"></div>
  </div>

  <script type="text/javascript">

    function del(id){
      var url = "{:U('MessagePush/imageDel')}";
      $.ajax({
        type: "post",
        url: url,
        data: {id:id},
        dataType: "json",
        success: function(data){
          if(data.status == 1){
            alert('删除成功');
          }else{
            alert('删除失败');
          }
        }
      })
    }


    //瀑布流
    function waterfall(){
      var margin = 30;//设置间距
      var li=$(".msgContainer .item");
      var li_W = li[0].offsetWidth+margin;
      var h=[];
      var n = 920/li_W|0;
      for(var i = 0;i < li.length;i++) {
        li_H = li[i].offsetHeight;
        if(i < n) {
          h[i]=li_H;
          li.eq(i).css({"top":0,"left":i * li_W,"visibility":"visible"});
        }else{
          min_H =Math.min.apply(null,h) ;
          minKey = getarraykey(h, min_H);
          h[minKey] += li_H+margin ;
          li.eq(i).css({"top":min_H+margin,"left":minKey * li_W,"visibility":"visible"});
        }
      }
      max =Math.max.apply(null,h);
      $("#msgContainer").css("height",max);
    }
    function getarraykey(s, v) {for(k in s) {if(s[k] == v) {return k;}}}
    waterfall();
    function checkAll(form, name) {
      for(var i = 0; i < form.elements.length; i++) {
        var e = form.elements[i];
        if(e.name.match(name)) {
          e.checked = form.elements['chkall'].checked;
        }
      }
    }
  </script>
  <!--底部-->

  <!-- <form method="post" action="{:U('insert')}" >
    <div class="h_a">首次关注时回复内容</div>
    <input name="id" value="{$areply.id}" type="hidden"/>
      <div class="table_full">
        <table cellpadding="0" cellspacing="0" class="table_form" width="100%">
          <tbody>
            <tr>
              <th width="110">文字：</th>
              <td><textarea name="content" maxlength="200" style="width:800px;">{$areply.content}</textarea><span style="color:red">字数不能超过200字</span></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="btn_wrap">
        <div class="btn_wrap_pd">
          <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit" data-action="{:U('insert')}">保存</button>
        </div>
      </div>
      </form>-->
</div>
<script src="{$config_siteurl}statics/js/common.js?v"></script>
</body>
</html>