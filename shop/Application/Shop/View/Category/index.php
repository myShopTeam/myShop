<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
  <Admintemplate file="Common/Nav"/>

    <!-- <form method="post" action="{:U('goods_index')}">
    <div class="search_type cc mb10">
      <div class="mb10"> 
	      <span class="mr20">
		      	发布时间：
		      <input type="text" name="start_time" class="input length_2 J_date" value="{$_GET.start_uploadtime}">
		        -
		      <input type="text" class="input length_2 J_date" name="end_time" value="{$_GET.end_uploadtime}">
		      	联系电话：
		      <input type="text" class="input length_2" name="phone" style="width:200px;" value="{$_GET.name}" placeholder="请输入联系电话...">
		      <button class="btn">搜索</button>
       	  </span> 
       </div>
    </div>
  </form> -->
  <form action="{:U('category_delete')}" method="post" class="J_ajaxForm">
    <div class="table_list">
      <table width="100%" cellspacing="0">
        <thead>
          <tr>
            <td align="center" width="60"><input type="checkbox" class="J_check_all" data-direction="x" data-checklist="J_check_x">全选</td>
            <td align="center" width="40">排序</td>
            <td align="center" width="200">分类图片</td>
            <td align="center">分类名称</td>
            <td align="center">分类显示</td>
            <td align="center">操作</td>
          </tr>
        </thead>
        <tbody>
          <volist name="catList" id="vo">
            <tr>
              <td align="center" width="50"><input type="checkbox" value="{$vo.catid}" class="J_check" data-yid="J_check_y" data-xid="J_check_x" name="id[]"></td>
              <td align="center"><input type="text" name="listorder[{$vo.catid}]" class="input" value="{$vo.listorder}" size="1" /></td>
              <td align="center"><img class="img" src="{$vo.cat_img}" width="60" height="60"/></td>
              <td align="center">{$vo.cat_name}</td>
              <td align="center"><if condition="$vo['is_show'] eq 1">显示<else/>不显示</if></td>
              <td align="center" width="200">
              <if condition="$vo['parent_id'] eq 0"><a href="{:U('category_add',array('catid'=>$vo['catid']))}">添加子分类</a>|</if>
              <a href="{:U('category_edit',array('catid'=>$vo['catid']))}">修改</a>|
              <a class="J_ajax_del" href="{:U('category_delete',array('catid'=>$vo['catid']))}">删除</a>
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
                <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit" data-action="{:U('listorder')}">排序</button>
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
})
</script>
</body>
</html>