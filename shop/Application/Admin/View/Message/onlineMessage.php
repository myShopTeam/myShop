<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
  <Admintemplate file="Common/Nav"/>

  <form action="{:U('delect')}" method="post" class="J_ajaxForm">
    <div class="table_list">
      <table width="100%" cellspacing="0">
        <thead>
          <tr>
            <td align="center" width="60"><input type="checkbox" class="J_check_all" data-direction="x" data-checklist="J_check_x">全选</td>
            <td align="center" width="40">排序</td>
            <td align="center">公司名称</td>
            <td align="center">联系人</td>
            <td align="center">联系电话</td>
            <td align="center">QQ号</td>
            <td align="center">邮箱</td>
            <td align="center">地址</td>
            <td align="center">留言</td>
            <td align="center">IP地址</td>
            <td align="center">提交时间</td>
          </tr>
        </thead>
        <tbody>
          <volist name="data" id="vo">
            <tr>
              <td align="center" width="50"><input type="checkbox" value="{$vo.vip_id}" class="J_check" data-yid="J_check_y" data-xid="J_check_x" name="id[]"></td>
              <td align="center"><input type="text" name="listorder[{$vo.vip_id}]" class="input" value="{$vo.listorder}" size="1" /></td>
              <td align="center">{$vo.company}</td>
              <td align="center">{$vo.contacts}</td>
              <td align="center">{$vo.tel}</td>
              <td align="center">{$vo.qq}</td>
              <td align="center">{$vo.email}</td>
              <td align="center">{$vo.address}</td>
              <td align="center">{$vo.content}</td>
              <td align="center">{$vo.ip}</td>
              <td align="center">{$vo.created|date='Y-m-d H:i:s',###}</td>
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
                <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit" data-action="{:U('listorder', array('str' => 'online'))}">排序</button>
        <?php
		if(\Libs\System\RBAC::authenticate('delete')){
		?>
<!--        <button class="btn  mr10 J_ajax_submit_btn" type="submit">删除</button>-->
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
})
</script>
</body>
</html>