<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
  <Admintemplate file="Common/Nav"/>

  <div class="h_a">订单详情
      <a href="{:U('order_delivery',array('oid'=>$oid))}"><button type="submit" <if condition="$order_status == 3">disabled</if> class="btn btn_submit mr10 J_ajax_submit_btn" style="margin-left: 40px;background: #00A1CB;color:#fff"><if condition="$order_status == 3">已</if>发货</button></a>
  </div>
    <div class="table_full">
      <table cellpadding="0" cellspacing="0" class="table_form" width="100%">
        <tbody>
          <tr>
            <th width="120" style="padding-top:3px;padding-bottom:2px">订单号：</th>
            <td width="270px">{$order_sn}</td>
            <th width="120">下单日期：</th>
            <td>{$addtime|date="Y-m-d H:i:s",###}</td>
          </tr>
          <tr>
            <th width="120" style="padding-top:3px;padding-bottom:2px">状 态：</th>
            <td width="270px" class="order_status">
              <if condition="$order_status eq 0">未付款</if>
              <if condition="$order_status eq 1">已完成</if>
              <if condition="$order_status eq 2">待发货</if>
              <if condition="$order_status eq 3">待收货</if>
              <if condition="$order_status eq 4">退货中</if>
              <if condition="$order_status eq 5">已取消</if>
              <if condition="$order_status eq 6">已关闭</if>
              <if condition="$order_status eq 7">已失效</if></td>
            <th width="120">付款状态：</th>
            <td><if condition="$pay_status eq 0">未付款<elseif condition="$pay_status eq 1" />已付款</if></td>
          </tr>
          <tr>
            <th width="80">下单人：</th>
            <td>{$username}</td>
            <th width="80">支付总金额：</th>
            <td>{$goods_amount}</td>
          </tr>
          <tr>
            <th width="80">送货方式：</th>
            <td>快递</td>
            <th width="80">运 费：</th>
            <td>{$shipping_fee}</td>
          </tr>
          <tr>
            <th width="80">物流单号：</th>
            <td>{$shipping_num}</td>
            <th width="80">发货时间：</th>
            <td>{$send_goods_time|date='Y-m-d H:i:s',###}</td>
          </tr>
        </tbody>
      </table>
      <div class="h_a">配送信息</div>
      <table cellpadding="0" cellspacing="0" class="table_form" width="100%">
        <tbody>
          <tr>
            <th width="120" style="padding-top:3px;padding-bottom:2px">收货人：</th>
            <td width="270px">{$consignee}</td>
            <th width="120">手机号：</th>
            <td>{$tel}</td>
          </tr>
          <tr>
            <th width="80">收货地址：</th>
            <td>{$province}&nbsp;&nbsp;{$city}&nbsp;&nbsp;{$area}</td>
            <th width="80">邮编：</th>
            <td>{$postal}</td>
          </tr>
        </tbody>
      </table>
      <div class="h_a">订购商品</div>
      <table cellpadding="0" cellspacing="0" class="table_form" width="100%">
        <tbody>
          <tr>
            <th width="78">商品图片</th>
            <th width="187">商品名</th>
            <th width="70">属性</th>
            <th width="120">单价（元）</th>
            <th width="120">数量</th>
            <th width="120">小计</th>
          </tr>
          <volist name="list" id="vo">
          <tr>
            <th><img src="{$vo.goods_thumb}" style="max-width:80px;max-height:100px;"></th>
            <th>{$vo.goods_name}</th>
            <th><if condition="$vo['sku_id'] eq ''">无<else/>{$vo.attr_key}：{$vo.attr_value}</if></td>
            <th><if condition="$vo['sku_id'] eq ''">{$vo.goods_price}<else/>{$vo.attr_price}</if></th>
            <th>{$vo.goods_number}</th>
            <th>{$vo.subtotal}</th>
          </tr>
          </volist>
          <tr>
            <th>商品总金额</th>
            <th colspan="5">{$goods_amount}</th>
          </tr>
        </tbody>
      </table>
    </div>
    <if condition="$order_status eq 2">
    <div class="btn_wrap">
      <div class="btn_wrap_pd">
        <button class="btn btn_submit mr10" type="submit">标记发货</button>
      </div>
    </div>
    </if>
</div>
<script src="{$config_siteurl}statics/js/common.js?v"></script>
<script>
  $('.btn_submit').click(function(){
      $_this = $(this);
      $oid = "{$_GET['oid']}";
      if($oid==0){
        return false;
      }
      $.post("{:U('delivery')}",{oid:$oid},function(res){
        if(res.status==1){
          $_this.removeClass('btn_submit');
          $_this.text('已发货');
          $('.order_status').text('待收货');
        }else{
          alert(res.msg);
        }
      },'json')
  })
</script>
</body>
</html>