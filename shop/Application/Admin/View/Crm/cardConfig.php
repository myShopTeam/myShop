<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
  <Admintemplate file="Common/Nav"/>

  <form action="{:U('index')}" method="post" class="J_ajaxForm">
    <div class="table_list">
      <table width="100%" cellspacing="0">
        <thead>
          <tr>
            <td align="center" width="5%">排序</td>
            <td align="center"width="25%" style="text-align: left">卡单类型</td>
            <td align="center"width="20%" style="text-align: left">卡单最大激活数</td>
            <td align="center"width="30%" style="text-align: left">参保年龄范围</td>
            <td align="center"width="10%" >操作</td>
          </tr>
        </thead>
        <thead>
            <tr><td style="background: #72a8cf">普通卡</td>
                <td style="background: #72a8cf"></td>
                <td style="background: #72a8cf"></td>
                <td style="background: #72a8cf"></td>
                <td style="background: #72a8cf"></td>
            <tr>
        </thead>
        <tbody>
          <volist name="nomal_card" id="vo">
            <tr>
              <td align="center"><input size="1" class="input" name="listorder[{$vo.id}]" value="{$vo.listorder}"/></td>
              <td align="center" style="<if condition="$vo.parent_id == 0">color:blue;</if>text-align: left"><if condition="$vo.parent_id != 0">|——</if>{$vo.card_name}</td>
              <td ><input size="1" class="input" name="num[{$vo.id}]" value="{$vo.max_active}"/></td>
              <td ><input size="1" class="input" name="min_age[{$vo.id}]" value="{$vo.min_age}"/>&nbsp;~&nbsp; <input size="1" class="input" name="max_age[{$vo.id}]" value="{$vo.max_age}"/></td>
              <td align="center"  width="60">
              <if condition="$vo.parent_id == 0">
                <a  href="{:U('typeUpdate',array('id'=>$vo['id']))}">修改</a> | 
                <a  href="{:U('productAdd',array('id'=>$vo['id']))}">添加产品</a> | 
                <a class="J_ajax_del" href="{:U('typeDelete',array('id'=>$vo['id']))}">删除</a>
              <else/>
                <a class="J_ajax_del" href="{:U('productDelete',array('id'=>$vo['id']))}">删除</a>
              </if>
              </td>
            </tr>
          </volist>
        </tbody
        <if condition="$car_card">
        <thead>
            <tr><td style="background: #72a8cf">车卡</td>
                <td style="background: #72a8cf"></td>
                <td style="background: #72a8cf"></td>
                <td style="background: #72a8cf"></td>
                <td style="background: #72a8cf"></td>
            <tr>
        </thead>
        <tbody>
          <volist name="car_card" id="vo">
            <tr>
              <td align="center"><input size="1" class="input" name="listorder[{$vo.id}]" value="{$vo.listorder}"/></td>
              <td align="center" style="<if condition="$vo.parent_id == 0">color:blue;</if>text-align: left"><if condition="$vo.parent_id != 0">|——</if>{$vo.card_name}</td>
                <td ><input size="1" class="input" name="num[{$vo.id}]" value="{$vo.max_active}"/></td>
                <td ><input size="1" class="input" name="min_age[{$vo.id}]" value="{$vo.min_age}"/>&nbsp;~&nbsp;<input size="1" class="input" name="max_age[{$vo.id}]" value="{$vo.max_age}"/></td>
              <td align="center"  width="60">
              <if condition="$vo.parent_id == 0">
                <a  href="{:U('typeUpdate',array('id'=>$vo['id']))}">修改</a> | 
                <a  href="{:U('productAdd',array('id'=>$vo['id']))}">添加产品</a> | 
                <a class="J_ajax_del" href="{:U('typeDelete',array('id'=>$vo['id']))}">删除</a>
              <else/>
                <a class="J_ajax_del" href="{:U('productDelete',array('id'=>$vo['id']))}">删除</a>
              </if>
              </td>
            </tr>
          </volist>
        </tbody>
        </if>
      </table>
      <div class="p10">
        <div class="pages"> {$Page} </div>
      </div>
      <div class="btn_wrap">
        <div class="btn_wrap_pd">
            <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit" data-action="{:U('listorder',array('str'=>'card_config'))}">排序</button>
            <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit" data-action="{:U('updateNum',array('str'=>'card_config'))}">修改卡单最大激活数</button>
            <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit" data-action="{:U('updateLimitAge',array('str'=>'card_config'))}">修改参保年龄范围</button>
        </div>
      </div>
    </div>
  </form>
</div>
<div class="show_img" style="position:fixed;top:20%;margin-left:30%;display:none;z-index:1000;"><img src="" style="max-width:250px;" /></div>
<script src="{$config_siteurl}statics/js/common.js"></script>
<script>
//鼠标悬停在列表食品缩略图上展示大图
$(function(){
	var img;
	$('.img').mouseover(function(){
		img = $(this).attr('src');
		$('.show_img img').attr('src',img);
		$('.show_img').show();
	})
	$('.img').mouseout(function(){
		$('.show_img').hide();
	})
        
        $('.upload').click(function(){
            if($('.uploadFile').hasClass('active')){
                $('<form method="post" action="{:U('upload')}" enctype="multipart/form-data"></form>').append($('.uploadFile')).submit()
            }else{
                $('.uploadFile').addClass('active')
                $('.uploadFile').css('display','')
            }
            
        })
        
        $('#card_type,#card_name,#status').change(function(){
            $('.search_form').submit()
        })
        
        $('.export').click(function(){
            if(!confirm('是否确认导出为excel?')){
                return false;
            }
            $('<form method="post" action="{:U('export')}"></form>').append($('.search_form').find('input,select').clone()).submit()
        })
        
//        $('.activeDo').click(function(re){
//            if(!confirm('是否确认激活？')){
//                return false;
//            }
//        })
        
})
</script>
</body>
</html>