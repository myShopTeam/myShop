<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
  <div class="nav">
    <ul class="cc">
        <li class="current"><a href="{:U('index')}">募捐详情&nbsp;&nbsp;<font color='green'></font></a></li>
      </ul>
  </div>
  <volist name="col_arr" id="col">
      <div class="h_a"><font color="green">{$col.title}</font>&nbsp第&nbsp<font color="blue">{$col.times}</font>&nbsp次募捐详情
      <a href="{:U('donation_detail',array('id'=>$col['base_number']))}"><button type="submit" class="btn btn_submit mr10 J_ajax_submit_btn" style="margin-left: 40px;background: #00A1CB;color:#fff">查看捐款明细</button></a>
      <eq name="col_num" value="$i">
      <if condition="$col.status == 3">
      <a href="{:U('again_collection',array('id'=>$base64_num))}"><button type="submit" class="btn btn_submit mr10 J_ajax_submit_btn" style="margin-left: 40px;background: #00A1CB;color:#fff">再次发起募捐</button></a>
      </if>
      </eq>
  </div>
    <div class="table_full">
      <table cellpadding="0" cellspacing="0" class="table_form" width="100%">
        <tbody>
         <tr ">
            <th  width="120" style="padding-top:3px;padding-bottom:2px">募捐编号：</th>
            <td>{$col.number}</td>
            <th width="120">发布时间：</th>
            <td>{$col.issue_time|date='Y-m-d H:i:s',###}</td>
            <th width="120">捐款截止时间：</th>
            <td>{$col.period|date='Y-m-d H:i:s',###}</td>
          </tr>
          <tr>
            <th width="80">人均捐款金额(元)：</th>
            <td>￥{$col.aver_money}</td>
            <th width="80">计划捐款人数：</th>
            <td>{$col.member_num}</td>
            <th width="120">募捐总金额(元)：</th>
            <td>￥{$col.total_money}</td>
          </tr>
          <tr>
                <th width="120" style="padding-top:3px;padding-bottom:2px">状 态：</th>
                <td width="270px" class="order_status">
                  <if condition="$col.status eq 1"><font color="green">进行中</font></if>
                  <if condition="$col.status eq 2">已完成</if>
                  <if condition="$col.status eq 3"><font color="red">已失败</font></if>
                </td>
                <th width="80">已捐款人数：</th>
                <td>{$col.com_num}</td>
                <th width="80">已捐款总金额(元)：</th>
                <td style="color:red">￥{$col[com_num]*$col[aver_money]}</td>
          </tr>
          
          <tr>
                <th width="80">募捐缩略图：</th>
                <td><img style="width:60px;height:60px;" src="{$col.col_thumb}"></img>&nbsp;<a class="zhankai" style="cursor:pointer">展开募捐描述</a></td>
          </tr>
          <tr class="detail" style="display:none">
              <th width="80">募捐详情：</th>
                <td>{$col.content}</td>
          </tr>
        </tbody>
      </table>
    </div>
    </volist>
</div>
<script src="{$config_siteurl}statics/js/common.js?v"></script>
<script>
$('.zhankai').toggle(
        function(){
            $('.detail').show()
            $(this).text('收起募捐详情')
        },
        function(){
            $('.detail').hide()
            $(this).text('展开募捐详情')
        }
) 
//  $('.btn_submit').click(function(){
//      $_this = $(this);
//      $oid = "{$_GET['oid']}";
//      if($oid==0){
//        return false;
//      }
//      $.post("{:U('delivery')}",{oid:$oid},function(res){
//        if(res.status==1){
//          $_this.removeClass('btn_submit');
//          $_this.text('已发货');
//          $('.order_status').text('待收货');
//        }else{
//          alert(res.msg);
//        }
//      },'json')
//  })
</script>

</body>
</html>