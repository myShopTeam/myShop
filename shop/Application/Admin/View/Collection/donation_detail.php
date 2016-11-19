<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
  <div class="nav">
    <ul class="cc">
        <li class="current"><a href="{:U('detail',array('number'=>$collection['number']))}">捐款明细&nbsp;&nbsp;<font color='green'>({$collection.title})</font></a></li>
      </ul>
  </div>

    <form class="search_form" method="post" action="{:U('donation_detail',array('id'=>$id))}">
    <div class="search_type cc mb10">
      <div class="mb10"> 
	      <span class="mr20">
                        捐款时间：
                        <input type="text" id="start_time" name="start_time" class="input length_2 J_datetime" value="{$post.start_time}">
                            -
                        <input type="text" id="end_time" class="input length_2 J_datetime" name="end_time" value="{$post.end_time}">
                        <input type='hidden' value='{$id}' name='id'>
                        <select name="status" class="select" id="status" >
                            <option value="0">状态</option>
                            <option value='1' <if condition="$post.status eq 1">selected</if>>待捐款</option>
                            <option value='2' <if condition="$post.status eq 2">selected</if>>已捐款</option>
                            <option value='3' <if condition="$post.status eq 3">selected</if>>未捐款</option>
                        </select> 
                        <button class="btn" >搜索</button>
                        &nbsp;&nbsp;&nbsp;&nbsp;<span style="color:green;font-size:16px;">项目名：{$collection.title}</span>
                        
       	  </span> 
       </div>
    </div>
  </form> 
  <form action="{:U('cardDelete')}" method="post" class="J_ajaxForm">
    <div class="table_list">
      <table width="100%" cellspacing="0">
        <thead>
          <tr>
            <td align="center">排序</td>
            <td align="center">捐款时间</td>
            <td align="center">捐款金额</td>
            <td align="center">捐款人姓名</td>
            <td align="center">捐款人捐款总次数</td>
            <td align="center">捐款人捐款失败总次数</td>
            <td align="center">捐款状态</td>
          </tr>
        </thead>
        <tbody>
          <volist name="donation" id="vo">
            <tr>
              <td align="center">{$i}</td>
              <td align="center"><if condition="$vo['status'] == 2">{$vo.donation_time|date='Y-m-d H:i:s',###}<else/>--</if></td>
              <td align="center">￥{$vo.donation_money}</td>
              <td align="center">张三丰</td>
              <td align="center">{$vo.total}</td>
              <td align="center">{$vo.faile}</td>
              <td align="center">
                <if condition="$vo.status eq 1"><font color="green">待捐款</font></if>
                <if condition="$vo.status eq 2">已捐款</if>
                <if condition="$vo.status eq 3"><font color="red">未捐款</font></if>
              </td>
<!--              <td align="center" width="60">
              <a href="{:U('detail',array('number'=>$vo[number]))}">查看</a>
              <a class="J_ajax_del" href="{:U('cardDelete',array('id'=>$vo['id']))}">删除</a>
              </td>-->
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