<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
  <Admintemplate file="Common/Nav"/>

    <form method="post" action="{:U('order_list')}">
    <div class="search_type cc mb10">
      <div class="mb10"> 
	      <span class="mr20">
            订单号：
            <input type="text" class="input" name="order_sn" value="{$order_sn}" placeholder="请输入订单号">
		      	订单状态：
		      <select name="order_status">
          <option value="all" <if condition="$order_status eq 'all'">selected</if>>全部</option>
          <option value="0" <if condition="$order_status eq '0'">selected</if>>待付款</option>  
          <option value="2" <if condition="$order_status eq 2">selected</if>>待发货</option>  
          <option value="3" <if condition="$order_status eq 3">selected</if>>待收货</option>  
          <option value="1" <if condition="$order_status eq 1">selected</if>>已完成</option>  
          <option value="5" <if condition="$order_status eq 5">selected</if>>已取消</option>  
          </select>
		      <button class="btn">搜索</button>
       	  </span> 
       </div>
    </div>
  </form
  <form action="{:U('order_delete')}" method="post" class="J_ajaxForm">
    <div class="table_list">
      <table width="100%" cellspacing="0">
        <thead>
          <tr>
            <td align="center" width="60"><input type="checkbox" class="J_check_all" data-direction="x" data-checklist="J_check_x">全选</td>
            <!-- <td align="center" width="40">排序</td> -->
            <td align="center">订单号</td>
            <td align="center">用户名</td>
            <td align="center">收件人</td>
            <td align="center">发货地区</td>
            <td align="center">总金额</td>
            <td align="center">日期</td>
            <td align="center">状态</td>
            <td align="center" width="100">操作</td>
          </tr>
        </thead>
        <tbody>
          <volist name="order_list" id="vo">
            <tr>
              <td align="center" width="50"><input type="checkbox" value="{$vo.goods_id}" class="J_check" data-yid="J_check_y" data-xid="J_check_x" name="id[]"></td>
              <!-- <td align="center"><input type="text" name="listorder[{$vo.goods_id}]" class="input" value="{$vo.listorder}" size="1" /></td> -->
              <td align="center">{$vo.order_sn}</td>
              <td align="center">{$vo.username}</td>
              <td align="center">{$vo.consignee}</td>
              <td align="center">{$vo.province}&nbsp;&nbsp;{$vo.city}</td>
              <td align="center">{$vo.goods_amount}</td>
              <td align="center">{$vo.addtime|date='Y-m-d H:i:s',###}</td>
              <td align="center">
              <if condition="$vo['order_status'] eq 0">未付款</if>
              <if condition="$vo['order_status'] eq 1">已完成</if>
              <if condition="$vo['order_status'] eq 2">待发货</if>
              <if condition="$vo['order_status'] eq 3">待收货</if>
              <if condition="$vo['order_status'] eq 4">退货中</if>
              <if condition="$vo['order_status'] eq 5">已取消</if>
              <if condition="$vo['order_status'] eq 6">已关闭</if>
              <if condition="$vo['order_status'] eq 7">已失效</if></td>
              <td align="center" width="60">
              <if condition="$vo['order_status'] eq 2"><a href="javascript:;" class="delivery" data-oid="{$vo.order_id}">发货</a>|</if>
              <a href="{:U('order_detail',array('oid'=>$vo['order_id']))}">详情</a>
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
                <!-- <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit" data-action="{:U('listorder',array('str'=>goods))}">排序</button> -->
        <?php
		if(\Libs\System\RBAC::authenticate('delete')){
		?>
        <!-- <button class="btn  mr10 J_ajax_submit_btn" type="submit">删除</button> -->
        <?php
		}
		?> 
      </div>
    </div>
  </form>
</div>
<div class="show_img" style="position:fixed;top:-20%;margin-left:30%;display:none;z-index:1000;"><img src="" style="max-width:800px;" /></div>
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
  $('.delivery').click(function(){
      $_this = $(this);
      $oid = $_this.attr('data-oid');
      if($oid==0){
        return false;
      }
      $.post("{:U('delivery')}",{oid:$oid},function(res){
        if(res.status==1){
          $_this.attr('data-oid',0);
          $_this.text('已发货');
          $_this.parents('tr').children('td').eq(7).text('待收货');
        }else{
          alert(res.msg);
        }
      },'json')
  })
})
</script>
</body>
</html>