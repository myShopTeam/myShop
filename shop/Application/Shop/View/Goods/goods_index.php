<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
  <Admintemplate file="Common/Nav"/>

    <form method="post" action="{:U('goods_index')}">
    <div class="search_type cc mb10">
      <div class="mb10"> 
	      <span class="mr20">
		      	商品名称：
          <input type="text" class="input" name="searchGoods" value="{$searchGoods}" placeholder="请输入商品名称">
            商品货号：
          <input type="text" class="input" name="searchSn" value="{$searchSn}" placeholder="请输入商品货号">
          <button class="btn">搜索</button>
       	  </span> 
       </div>
    </div>
  </form>
  <form action="{:U('goods_delete')}" method="post" class="J_ajaxForm">
    <div class="table_list">
      <table width="100%" cellspacing="0">
        <thead>
          <tr>
            <td align="center" width="10"><input type="checkbox" class="J_check_all" data-direction="x" data-checklist="J_check_x">全选</td>
            <td align="center" width="10">排序</td>
            <td align="center">商品图片</td>
            <td align="center">商品名称</td>
            <td align="center" width="180">商品货号</td>
            <td align="center" width="50">商品类型</td>
            <td align="center" width="50">商品售价</td>
            <td align="center" width="30">库存</td>
            <td align="center" width="30">是否上架</td>
            <td align="center" width="120">发布时间</td>
            <td align="center" width="120">操作</td>
          </tr>
        </thead>
        <tbody>
          <volist name="goodsList" id="vo">
            <tr>
              <td align="center" width="50"><input type="checkbox" value="{$vo.goods_id}" class="J_check" data-yid="J_check_y" data-xid="J_check_x" name="id[]"></td>
              <td align="center"><input type="text" name="listorder[{$vo.goods_id}]" class="input" value="{$vo.listorder}" size="1" /></td>
              <td align="center"><img class="img" src="{$vo.goods_img}" width="60" height="60"/></td>
              <td align="center">{$vo.goods_name}</td>
              <td align="center">{$vo.goods_sn}</td>
              <td align="center">{$vo.cat_name}</td>
              <td align="center">{$vo.shop_price}</td>
              <td align="center">{$vo.goods_num}</td>
              <td align="center">{$vo.is_show}<!--<button class="is_show btn">{$vo.is_show}</button>  --></td>
              <td align="center">{$vo.add_time|date='Y-m-d H:i:s',###}</td>
              <td align="center" width="200">
              <a href="{:U('viewComment',array('gid'=>$vo['goods_id']))}">查看评论</a>|
              <a href="{:U('goods_edit',array('goods_id'=>$vo['goods_id']))}">修改</a>|
              <a class="J_ajax_del" href="{:U('goods_delete',array('goods_id'=>$vo['goods_id']))}">删除</a>
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
                <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit" data-action="{:U('listorder',array('str'=>goods))}">排序</button>
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