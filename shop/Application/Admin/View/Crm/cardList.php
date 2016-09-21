<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
  <Admintemplate file="Common/Nav"/>

  <form class="search_form" method="post" action="{:U('cardList')}">
    <div class="search_type cc mb10">
      <div class="mb10"> 
	      <span class="mr20">
                        <input class="input length_2 "  name="card_type" placeholder="输入卡单类型"/>
                        <input class="input length_2 "  name="card_name" placeholder="输入产品名称"/>
                        
                        <select name="time_type" class="select" id="time" >
                            <option value='create_time' <if condition="$post.time_type eq 'create_time'">selected</if>>提交时间</option>
                            <option value='active_time' <if condition="$post.time_type eq 'active_time'">selected</if>>激活时间</option>
                        </select> 
                        
                        <input type="text" id="start_time" name="start_time" class="input length_2 J_date" value="{$post.start_time}">
                            -
                        <input type="text" id="end_time" class="input length_2 J_date" name="end_time" value="{$post.end_time}">
		      	卡号：
                        <input type="text" class="input length_2" name="card_num" style="width:160px;" value="{$post.card_num}" placeholder="请输入卡号...">
                        <select name="is_active" class="select" id="status" >
                            <option value="0">状态</option>
                            <option value='1' <if condition="$post.is_active eq 1">selected</if>>未激活</option>
                            <option value='2' <if condition="$post.is_active eq 2">selected</if>>已激活</option>
                        </select> 
                        <button class="btn" >搜索</button>
                        <input type="button" class="btn export" value="导出" style="background:#1D83DB;color:#fff"/>
                        <input type="button"class="btn" onclick="javascript:window.location.href='{:U('export',array('type'=>tmp))}'" value="导入模板下载" />
       	  </span> 
       </div>
    </div>
  </form> 
  <form action="{:U('cardDelete')}" method="post" class="J_ajaxForm">
    <div class="table_list">
      <table width="100%" cellspacing="0">
        <thead>
          <tr>
            <td align="center" width="60"><input type="checkbox" class="J_check_all" data-direction="x" data-checklist="J_check_x">全选</td>
            <td align="center" width="40">排序</td>
            <td align="center">ID</td>
            <td align="center">卡片名称</td>
            <td align="center">产品名称</td>
            <td align="center">卡号</td>
            <td align="center">校验码</td>
            <td align="center">激活日期</td>
            <td align="center">提交时间</td>
            <td align="center">状态</td>
            <td align="center">操作</td>
<!--            <td align="center">注册时间</td>
            <td align="center">状态</td>
            <td align="center">操作</td>-->
          </tr>
        </thead>
        <tbody>
          <volist name="vipList" id="vo">
            <tr>
              <td align="center" width="50"><input type="checkbox" value="{$vo.id}" class="J_check" data-yid="J_check_y" data-xid="J_check_x" name="id[]"></td>
              <td align="center"><input type="text" name="listorder[{$vo.id}]" class="input" value="{$vo.listorder}" size="1" /></td>
              <td align="center">{$vo.id}</td>
              <td align="center">{$vo.card_type}</td>
              <td align="center">{$vo.card_name}</td>
              <td align="center">{$vo.card_num}</td>
              <td align="center">{$vo.verif}</td>
              <td align="center"><if condition="$vo['is_active'] == 1">--<else/>{$vo.active_time|date='Y-m-d H:i:s',###}</if></td>
              <td align="center">{$vo.create_time|date='Y-m-d H:i:s',###}</td>
              <td align="center" <if condition="$vo['is_active'] == 1">style="color:red"</if>>{$config[is_active][$vo['is_active']]}</td>
              <td align="center" width="60">
              <a href="{:U('cardEdit',array('card_num'=>$vo[card_num]))}">修改</a>|
              <a class="J_ajax_del" href="{:U('cardDelete',array('id'=>$vo['id']))}">删除</a>
              </td>
            </tr>
          </volist>
        </tbody>
      </table>
      <div class="p10">
        <div class="pages"> {$Page} </div>
      </div>
    </div>
    <div class="btn_wrap">
      <div class="btn_wrap_pd">
        <label class="mr20"><input type="checkbox" class="J_check_all" data-direction="y" data-checklist="J_check_y">全选</label> 
                <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit" data-action="{:U('listorder',array('str'=>vip))}">排序</button>
                <input type="button" class="btn upload" style="background: #1b75b6;color:#ffffff !important" value="导入">
                <input class="uploadFile" type="file" name="file_stu" style="display:none;width:180px;height:20px;line-height:16px;" />
                <button class="activeDo btn btn_submit mr10 J_ajax_submit_btn" type="submit" data-action="{:U('cardActive')}">激活</button>
        <?php
		if(\Libs\System\RBAC::authenticate('delete')){
		?>
        <button class="btn  mr10 J_ajax_submit_btn" type="submit">删除</button>
        <?php
		}
		?> 
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