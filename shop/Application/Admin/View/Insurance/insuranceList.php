<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
  <Admintemplate file="Common/Nav"/>

  <form class="search_form" method="post" action="{:U('insuranceList')}">
    <div class="search_type cc mb10">
      <div class="mb10"> 
	      <span class="mr20">
                        证件号：<input class="input length_2 " value="{$post.cred_num}"  name="cred_num" placeholder="输入证件号"/>
                        真实姓名：<input class="input length_2 " value="{$post.realname}"  name="realname" placeholder="输入真实姓名"/>
		      	保险单号：
                        <input type="text" class="input length_2" name="insurance_num" style="width:160px;" value="{$post.insurance_num}" placeholder="输入保险单号...">
                        <button class="btn" >搜索</button>
                        <input type="button" class="btn export" value="导出" style="background:#1D83DB;color:#fff"/>
                        <input type="button"class="btn" onclick="javascript:window.location.href='{:U('export',array('type'=>tmp))}'" value="导入模板下载" />
       	  </span> 
       </div>
    </div>
  </form> 
  <form action="{:U('insuranceDelete')}" method="post" class="J_ajaxForm">
    <div class="table_list">
      <table width="100%" cellspacing="0">
        <thead>
          <tr>
            <td align="center" width="60"><input type="checkbox" class="J_check_all" data-direction="x" data-checklist="J_check_x">全选</td>
            <td align="center">ID</td>
            <td align="center">真实姓名</td>
            <td align="center">证件号</td>
            <td align="center">保险合同号码</td>
            <td align="center">保险生效日期</td>
            <td align="center">救援服务项目生效日期</td>
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
              <td align="center">{$vo.id}</td>
              <td align="center">{$vo.realname}</td>
              <td align="center">{$vo.cred_num}</td>
              <td align="center">{$vo.insurance_num}</td>
              <td align="center">{$vo.start_time}</td>
              <td align="center"><if condition="$vo.rescue_time">{$vo.rescue_time}<else/>以卡单激活时间为准</if></td>
              <td align="center" width="60">
              <a href="{:U('insuranceEdit',array('insurance_num'=>$vo[insurance_num]))}">修改</a>|
              <a class="J_ajax_del" href="{:U('insuranceDelete',array('id'=>$vo['id']))}">删除</a>
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
<!--                <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit" data-action="{:U('listorder',array('str'=>vip))}">排序</button>-->
                <input type="button" class="btn upload" style="background: #1b75b6;color:#ffffff !important" value="导入">
                <input class="uploadFile" type="file" name="file_stu" style="display:none;width:180px;height:20px;line-height:16px;" />
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