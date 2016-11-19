<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
  <Admintemplate file="Common/Nav"/>

  <form class="search_form" method="post" action="{:U('index')}">
    <div class="search_type cc mb10">
      <div class="mb10"> 
	      <span class="mr20">
                        <input class="input length_2 " value="{$post.title}"  name="title" placeholder="输入募捐标题"/>
                        <select name="time_type" class="select" id="time" >
                            <option value='create_time' <if condition="$post.time_type eq 'issue_time'">selected</if>>发布时间</option>
                            <option value='active_time' <if condition="$post.time_type eq 'period'">selected</if>>募捐截止时间</option>
                        </select> 
                        
                        <input type="text" id="start_time" name="start_time" class="input length_2 J_datetime" value="{$post.start_time}">
                            -
                        <input type="text" id="end_time" class="input length_2 J_datetime" name="end_time" value="{$post.end_time}">
                        <select name="status" class="select" id="status" >
                            <option value="0">状态</option>
                            <option value='1' <if condition="$post.status eq 1">selected</if>>进行中</option>
                            <option value='2' <if condition="$post.status eq 2">selected</if>>已完成</option>
                            <option value='3' <if condition="$post.status eq 3">selected</if>>已失败</option>
                        </select> 
                        <button class="btn" >搜索</button>
                        
       	  </span> 
       </div>
    </div>
  </form> 
  <form action="{:U('cardDelete')}" method="post" class="J_ajaxForm">
    <div class="table_list">
      <table width="100%" cellspacing="0">
        <thead>
          <tr>
            <td align="center">ID</td>
            <td align="center">标题</td>
            <td align="center">募捐总金额</td>
            <td align="center">发布时间</td>
            <td align="center">募捐截止时间</td>
            <td align="center">募捐人数</td>
            <td align="center">人均捐款金额</td>
            <td align="center">已捐款人数</td>
            <td align="center">已捐款金额</td>
            <td align="center">募捐次数</td>
            <td align="center">捐款状态</td>
            <td align="center">操作</td>
          </tr>
        </thead>
        <tbody>
          <volist name="vipList" id="vo">
            <tr>
              <td align="center">{$vo.id}</td>
              <td align="center">{$vo.title}</td>
              <td align="center">￥{$vo.total_money}</td>
              <td align="center">{$vo.issue_time|date='Y-m-d H:i:s',###}</td>
              <td align="center">{$vo.period|date='Y-m-d H:i:s',###}</td>
              <td align="center">{$vo.member_num}</td>
              <td align="center">￥{$vo.aver_money}</td>
              <td align="center">{$vo.com_num}</td>
              <td align="center">￥{$vo[aver_money]*$vo[com_num]}</td>
              <td align="center">{$vo.times}</td>
              <td align="center">
                <if condition="$vo.status eq 1"><font color="green">进行中</font></if>
                <if condition="$vo.status eq 2">已完成</if>
                <if condition="$vo.status eq 3"><font color="red">已失败</font></if>
              </td>
              <td align="center" width="60">
              <a href="{:U('detail',array('number'=>$vo[number]))}">查看</a>
<!--              <a class="J_ajax_del" href="{:U('cardDelete',array('id'=>$vo['id']))}">删除</a>-->
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
<!--        <label class="mr20"><input type="checkbox" class="J_check_all" data-direction="y" data-checklist="J_check_y">全选</label> 
                <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit" data-action="{:U('listorder',array('str'=>vip))}">排序</button>
                <input type="button" class="btn upload" style="background: #1b75b6;color:#ffffff !important;text-shadow:0 -1px 0 rgba(0, 0, 0, 0.25)" value="导入">
                <input class="uploadFile" type="file" name="file_stu" style="display:none;width:180px;height:20px;line-height:16px;" />
                <button class="activeDo btn btn_submit mr10 J_ajax_submit_btn" type="submit" data-action="{:U('cardActive')}">激活</button>-->
<!--        <?php
		if(\Libs\System\RBAC::authenticate('delete')){
		?>
        <button class="btn  mr10 J_ajax_submit_btn" type="submit">删除</button>
        <?php
		}
		?> -->
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
        
        $('#status').change(function(){
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