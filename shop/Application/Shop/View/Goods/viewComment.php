<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
  <Admintemplate file="Common/Nav"/>
    <div class="table_full">
      <div class="h_a">商品详情</div>
      <table cellpadding="0" cellspacing="0" class="table_form" width="100%">
        <tbody>
          <tr>
            <th width="78">商品图片</th>
            <th width="187">商品名</th>
            <th width="70">市场价</th>
            <th width="120">实际价格</th>
            <th width="120">添加时间</th>
          </tr>
          <tr>
            <th><img src="{$goods_thumb}" style="max-width:80px;max-height:100px;"></th>
            <th>{$goods_name}</th>
            <th>{$market_price}</th>
            <th>{$goods_price}</th>
            <th>{$add_time|date="Y-m-d H:i:s",###}</th>
          </tr>
        </tbody>
      </table><br/>
      <div class="h_a">用户评论</div>
      <table cellpadding="0" cellspacing="0" class="table_form" width="100%">
        <tbody>
          <tr>
            <th width="78">用户头像</th>
            <th width="80">用户名</th>
            <th width="50">商品打分</th>
            <th width="300">评论内容</th>
            <th width="120">评论时间</th>
            <th width="120">IP地址</th>
          </tr>
          <volist name="list" id="vo">
            <tr>
              <th><img src="{$vo.headpic}" style="max-width:80px;max-height:100px;"></th>
              <th>{$vo.nickname}</th>
              <th>{$vo.score}</th>
              <th>{$vo.comment|default="好评！"}</th>
              <th>{$vo.createtime|date="Y-m-d H:i:s",###}</th>
              <th>{$vo.ip}</th>
          </tr>
          </volist>
        </tbody>
      </table>
      <div class="p10">
        <div class="pages"> {$Page} </div>
      </div>
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