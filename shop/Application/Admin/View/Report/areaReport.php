<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
  <Admintemplate file="Common/Nav"/>

    <form method="post" class="search_form" action="{:U('areaReport')}">
    <div class="search_type cc mb10">
      <div class="mb10"> 
	      <span class="mr20">
		      部门：
          <input type="text" class="input" name="name" value="{$searchName}" placeholder="请输入部门名称">
          <if condition="$area">
          <select name="area_id" class="area_select">
              <option value="">请选择区域</option>
              <volist name="area" id="vo">
                  <option value="{$vo.id}" rel="{$area_id}" <if condition="$vo.id eq $area_id">selected</if>>{$vo.name}</option>
              </volist>
          </select>
          </if>
          <button class="btn">搜索</button>
          
       	  </span> 
          <span><font color="blue" weight="bold" size="4px" >{$area_name}</font></span>&nbsp&nbsp&nbsp&nbsp
          <span>区域员工数:&nbsp&nbsp<font color="blue" weight="bold" size="6px" >{$count|default=0}</font></span>
          &nbsp&nbsp&nbsp&nbsp
          <span>卡单添加数:&nbsp&nbsp<font color="blue" weight="bold" size="6px" >{$card_add_count|default=0}</font></span>
          &nbsp&nbsp&nbsp&nbsp
          <span>卡单激活数:&nbsp&nbsp<font color="blue" weight="bold" size="6px" >{$card_active_count|default=0}</font></span>
       </div>
    </div>
  </form>
  <form action="{:U('goods_delete')}" method="post" class="J_ajaxForm">
    <div class="table_list">
      <table width="100%" cellspacing="0">
        <thead>
          <tr>
            <td align="center" width="25%">部门</td>
            <td align="center" width="25%">添加卡单数</td>
            <td align="center" width="25%">已激活卡单数</td>
            <td align="center" width="25%">操作</td>
          </tr>
        </thead>
        <tbody>
          <volist name="section" id="vo">
            <tr>
                <td align="center">{$vo.name}</td>
              <td align="center">{$vo.card_add_num}</td>
              <td align="center">{$vo.card_add_num}</td>
              <td align="center" >
              <a href="{:U('sectionReport',array('id'=>$vo['id']))}">部门报表</a>
              </td>
            </tr>
          </volist>
        </tbody>
      </table>
      <div class="p10">
        <div class="pages"> {$Page} </div>
      </div>
    </div>
<!--    <div class="btn_wrap">
      <div class="btn_wrap_pd">
        <label class="mr20"><input type="checkbox" class="J_check_all" data-direction="y" data-checklist="J_check_y">全选</label> 
                <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit" data-action="{:U('listorder',array('str'=>goods))}">排序</button>
        <?php
		if(\Libs\System\RBAC::authenticate('delete')){
		?>
        <button class="btn  mr10 J_ajax_submit_btn" type="submit">删除</button>
        <?php
		}
		?> 
      </div>
    </div>-->
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
        
        $('.area_select').change(function(){
            $('.search_form').submit()
        })
})
</script>
</body>
</html>