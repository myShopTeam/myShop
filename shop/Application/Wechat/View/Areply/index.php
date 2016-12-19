<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
  <Admintemplate file="Common/Nav"/>

  <style>
td {
	text-align: left;
}
table input[type='text'] {
	width: 320px;
	height: 35px;
	padding-left: 5px;
	border-radius: 5px;
	border: 1px solid #babcbe;
	background: none repeat scroll 0 0 #eef0f3;
}
table select {
	width: 328px;
	height: 35px;
	padding-left: 5px;
	padding-top: 7px;
	border-radius: 5px;
	border: 1px solid #babcbe;
	background: none repeat scroll 0 0 #eef0f3;
}
table select option {
	line-height: 35px;
	height: 35px;
	padding-left: 5px;
	padding-top: 7px;
}
table input[type='submit'] {
	width: 330px;
	background-color: #CCC;
	cursor: pointer
}
.select_btn {
	background: none repeat scroll 0 0 #eef0f3;
	border: 1px solid #babcbe;
	border-radius: 5px;
	color: #666;
	display: block;
	height: 35px;
	line-height: 35px;
	text-align: center;
	width: 100px;
}
.top-tools .edit-single-message {
	line-height: 50px;
	color: #999999;
	padding-left: 50px;
	background: url("{$config_siteurl}statics/weixin/images/2GARvyy2Jx.png") no-repeat 21px -44px;
	;
}
.top-tools .edit-multi-message {
	line-height: 50px;
	color: #999999;
	padding-left: 50px;
	background: url("{$config_siteurl}statics/weixin/images/2GARvyy2Jx.png") no-repeat 16px -90px;
}
.alipay-xbox-close {
	color: #999;
	cursor: pointer;
	display: block;
	font-family: tahoma;
	font-size: 24px;
	font-weight: 700;
	height: 18px;
	line-height: 14px;
	position: absolute;
	right: 16px;
	text-decoration: none;
	top: 16px;
	z-index: 10;
}
.top-tools .edit-multi-message {
	background: url("{$config_siteurl}statics/weixin/images/2GARvyy2Jx.png") no-repeat scroll 16px -90px rgba(0, 0, 0, 0);
	color: #999999;
	line-height: 50px;
	padding-left: 50px;
}
.top-tools .edit-single-message {
	background: url("{$config_siteurl}statics/weixin/images/2GARvyy2Jx.png") no-repeat scroll 21px -44px rgba(0, 0, 0, 0);
	color: #999999;
	line-height: 50px;
	padding-left: 50px;
}
.message-filter {
	display: none;
	width: 100%;
	height: 100%;
	position: absolute;
	top: 0;
	left: 0;
	background: #000;
	opacity: 0.3;
	filter: alpha(opacity=30);
	cursor: pointer;
	border-radius: 5px;
	z-index: 100;
}
.chosen {
	display: none;
	width: 70px;
	height: 70px;
	position: absolute;
	top: 100px;
	left: 130px;
	background: url("{$config_siteurl}statics/weixin/images/2IvBKloQgX.png") no-repeat;
	cursor: pointer;
	z-index: 100;
}
.message-box .active .chosen {
	display: block;
	width: 70px;
	height: 70px;
	position: absolute;
	top: 100px;
	left: 130px;
	background: url("{$config_siteurl}statics/weixin/images/2IvBKZLbET.png") no-repeat;
	cursor: pointer;
}
.top-tools {
	background: #f8f8f8;
	border-bottom: 1px solid #cccccc;
}
.images-box {
	display: none;
	border: 1px solid #CCC;
	width: 895px;
}
.content * {
	box-sizing: content-box;
}
.message-edit-type {
	width: 895px;
}
</style>
<link rel="stylesheet" href="{$config_siteurl}statics/weixin/css/chart.css" />
<link href="{$config_siteurl}statics/weixin/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{$config_siteurl}statics/weixin/js/common.js"></script>
<script src="{$config_siteurl}statics/weixin/js/preview_layer.js" type="text/javascript"></script>
<script src="{$config_siteurl}statics/weixin/js/layer.min.js"></script>
<link rel="stylesheet" type="text/css" href="{$config_siteurl}statics/weixin/css/editMenu.css" />
<link rel="stylesheet" type="text/css" href="{$config_siteurl}statics/weixin/css/chosen.css" />
<link rel="stylesheet" type="text/css" href="{$config_siteurl}statics/weixin/css/message_push.css" />
<script type="text/javascript" src="{$config_siteurl}statics/weixin/js/message_push.js"></script>
<script type="text/javascript" src="{$config_siteurl}statics/weixin/js/chosen.jquery.js"></script>
<div class="content" style="padding-left: 30px;">


  <div class="message-edit-cont" data-userid="" data-replyid="">
    <div class="message-edit-type fn-clear"> <a href="javascript:;" class="message-edit message-edit-text active fn-left" seed="messageEditType-messageEdit" smartracker="on">文字</a>
      <div class="message-edit-message fn-left"> <a href="javascript:;" class="message-edit message-edit-hybrid fn-left">图文广播</a>
        <ul class="message-hibrid-menu" style="display: none;">
          <li><a href="javascript:;" class="message-page-store" seed="messageHibridMenu-messagePageStore" smartracker="on">从素材库中选取</a></li>
        </ul>
      </div>
    </div>
    <div class="message-edit-area fn-clear">
      <textarea name="content" id="active-text-content" maxlength="200" class="message-text-area fn-left" seed="messageEditArea-activeTextContent" smartracker="on" style="width:875px;">{$areply.first_content}</textarea>
      <div class="message-edit-stat fn-left" >
        <span class="message-rest-num fn-right">还可以输入<span class="restNum">200</span>字</span> </div>
    </div>
    <div class="message-contain"></div>
    <!--ceshi-->
    <input type="hidden" id="type" value="{$areply.first_type}" />
    <input type="hidden" name="selectpagehidden" id="selectpagehidden" value="{$areply.first_imageid}" />
    <div class="images-box">
      <div class="message-item ">
        <!--single-->
        <if condition="count($img['child']) eq 0">
        <div class="message-body"><a  class="item-url" href="javascript:void(0)">
          <input type="hidden" value="{$areply.first_imageid}" class="message-id">
          <div class="message-title first-message-title">
            <div class="title-wrapper">
              <h4></h4>
              <div class="title-bg"></div>
            </div>
          </div>
          <div class="message-info">{$img.createtime|date='Y-m-d',###}</div>
          <div class="message-cover-pic"><img alt="标题" title="标题" class="cover" src="{$img.pic}"></div>
          <div class="message-text word-bread">{$img.text}</div>
          </a> </div>
        <!--single end-->
            <else/>
        <!--more-->
        <div class="message-body multiple-message"><a href="#" class="item-url" >
          <input class="message-id" value="{$img.id}" type="hidden">
          <div class="message-title first-message-title">
            <div class="title-wrapper">
              <h4>{$img.title}</h4>
              <div class="title-bg"></div>
            </div>
          </div>
          <div class="message-info">{$img.createtime|date='Y-m-d',###}</div>
          <div class="message-cover-pic"><img src="{$img.pic}" class="cover" title="{$img.pic}" alt="{$img.title}"></div>
          <div class="message-text word-bread"></div>
          </a>
          <volist name="img.child" id="n" key="m">
              <a href="#" class="item-url" >
              <div class="sub-message-body fn-clear">
                <div class="message-title fn-left">
                  <h4>{$n.title}</h4>
                </div>
                <div class="message-cover-pic fn-right"><img src="{$n.pic}" title="{$n.title}" alt="{$n.title}"> </div>
              </div>
              </a>
          </volist>
        </div>
        <!--more-->
        </if>
        <div class="message-filter" style="display: none;"></div>
        <div class="chosen" style="display: none;"></div>
      </div>
    </div>
    <!--cesi-->
  </div>
  <a href="#" class="btn btn-orange btn-send" seed="sendMessageForm-btn" smartracker="on"> 保<i class="btn-spacing"></i>存 </a>
  <script type="text/javascript">
  $(function(){
    if($("#type").val()==1){
        $('.alipay-xbox').hide();
      $(".images-box").show();
      $(".message-edit-area").hide();
      }
    $(".btn-send").click(function(){
      //alert('')
      var keyword=$("input[name='keyword']").val();
      var title=$("input[name='title']").val();
      var content=$("textarea[name='content']").val();
      var imageid=$("#selectpagehidden").val();
      var type=$("#type").val();
      $.post("{:U('Areply/insert')}",{'title':title,'keyword':keyword,'content':content,'imageid':imageid,'type':type},function(data){
if(data==1){
  alert('保存成功');
  window.location.reload();
  }else if(data==2){
    alert('内容不能为空')
    }else{
      alert('保存失败');
      }
});
      return false;
      });
$(".message-page-store").click(function(){
 $('.alipay-xbox').show();
 var page=1;
 ajax_pageImg(page);
});
$('.submit .btn').click(function(e) {
            $('.alipay-xbox').hide();
      $(".images-box").show();
      $(".message-edit-area").hide();
      $("#type").val(1);
        });
$('.cancel .btn').click(function(e) {
  $('.alipay-xbox').hide();

});
$('.alipay-xbox-close').click(function(e) {
  $('.alipay-xbox').hide();
});
$(".message-edit-text").click(function(){
  $(".images-box").hide();
  $(".message-edit-area").show();
  $("#type").val(0);
})
})
function ajax_pageImg(page){
       $.ajax({
           type: "POST",
           url: "{:U('img_list')}",
           data: "p="+page,
           dataType:"json",
           async:false,
           success: function(data){
             var html='';
             var imgshowcontent=$('#imgshowcontent');
             var info=data.list;
             var count=0;
             var children='';
             for(var i=0;i<info.length;i++){
               count =info[i].child.length;
               html+='<div class="message-list fn-left"><div class="message-item ">';
               if(count==0){
               html+='<div class="message-body"><a target="_blank" class="item-url" href=""><input type="hidden" value="'+info[i].id+'" class="message-id"><div class="message-title first-message-title"><div class="title-wrapper"><h4></h4><div class="title-bg"></div> </div> </div> <div class="message-info">'+info[i].createtime+'</div><div class="message-cover-pic"><img alt="'+info[i].title+'" title="'+info[i].title+'" class="cover" src="'+info[i].pic+'"></div><div class="message-text word-bread">'+info[i].text+'</div> </a> </div> <div class="message-filter"></div>  <div class="chosen"></div>';
               }else{
                html+='<div class="message-body multiple-message"><a href="#" class="item-url" target="_blank"><input class="message-id" value="'+info[i].id+'" type="hidden"><div class="message-title first-message-title"><div class="title-wrapper"><h4>'+info[i].title+'</h4><div class="title-bg"></div></div></div><div class="message-info">'+info[i].createtime+'</div><div class="message-cover-pic"><img src="'+info[i].pic+'" class="cover" title="'+info[i].title+'" alt="'+info[i].title+'"></div> <div class="message-text word-bread"></div></a>';
                 children=info[i].child;
                 for(var j=0;j<count;j++){
                       html+=' <a href="#" class="item-url" target="_blank"> <div class="sub-message-body fn-clear"><div class="message-title fn-left"><h4>'+children[j].title+'</h4></div><div class="message-cover-pic fn-right"><img src="'+children[j].pic+'" title="'+children[j].title+'" alt="'+children[j].title+'"> </div></div> </a>';
                 }
                   html+=' </div> <div class="message-filter"></div>  <div class="chosen"></div>';
               }
               html+='</div></div>';
             }
             var pagehtml='<span class="mi-paging-info">第<span class="paging-text mi-paging-bold"><span class="firstRow">'+data.firstRow+'</span>/<span class="totalRows">'+data.count+'</span></span>页</span><a data-page="0" class="mi-paging-item mi-paging-prev mi-paging-prev-disabled" href="#"><span class="paging-text"> 上一页</span></a><a class="mi-paging-item mi-paging-next mi-paging-next-disabled" href="#"><span class="paging-text">下一页</span></a>';
             imgshowcontent.html(html);
             $('#pagelist').html(pagehtml);
             var noepage=parseInt($('.firstRow').text());

             $('.mi-paging-prev-disabled').on('click',function(event){
               event.preventDefault();
               ajax_pageImg(noepage-1)

             })
             $('.mi-paging-next-disabled').on('click',function(event){
             event.preventDefault();
             ajax_pageImg(noepage+1)

             })
             $(".message-list .message-item").each(function(index, element) {
              $(this).children('.message-body').on('click',function(event){
               event.preventDefault();
               var Img_var= $(this).find('.message-id').val();
               var html=$(this).parent().parent().html();
               $(".images-box").html(html);
               $("#selectpagehidden").val(Img_var);
               $(this).parent().children('.message-filter').css({'display':'block'})
               $(this).parent().children('.chosen').css({'display':'block'});
               $(this).parents('.message-list').siblings().find('.message-filter').css({'display':'none'});
               $(this).parents('.message-list').siblings().find('.chosen').css({'display':'none'});
              })
                      });
                   }
 });
    }

  </script>
  <!--弹框开始-->
  <div class="alipay-xbox" tabindex="-1" data-widget-cid="widget-1" style="width:750px;z-index:999;position: fixed; left: 293.5px; top:10px;display:none;border:6px solid rgba(93, 92, 92, 1)">
    <div data-role="close" title="关闭本框" class="alipay-xbox-close" style="display: block;">×</div>
    <div class="alipay-xbox-loading" style="display: none;"></div>
    <div data-role="content" class="alipay-xbox-content" style="background: none repeat scroll 0% 0% rgb(255, 255, 255); height: 100%;">
      <div class="message-box">
        <div class="title">
          <h3>选择图文广播</h3>
        </div>
        <div class="top-tools fn-clear">
          <div class="mi-paging fn-right" id="pagelist"></div>
        </div>
        <div class="message-placeholder fn-clear" id="imgshowcontent"></div>
        <div class="actions"> <a class="mi-bizcrm-button mi-bizcrm-button-sred submit" href="javascript:;"><span class="btn btn-gray">确&nbsp;&nbsp;定</span></a> <a class="mi-bizcrm-button mi-bizcrm-button-swhite cancel" href="javascript:;"><span class="btn btn-gray">取&nbsp;&nbsp;消</span></a> </div>
      </div>
    </div>
  </div>
</div>
<!--弹框结束-->

























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