<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap jj">
  <div class="nav">
    <ul class="cc">
      <li class="current"><a href="{:U('Adminmanage/myinfo')}">销售业绩</a></li>
    </ul>
  </div>
  <!--====================用户编辑开始====================-->
  <form class="J_ajaxForm" id="J_bymobile_form" action="{:U("Adminmanage/myinfo")}" method="post">
    <input type="hidden" value="{$data.id}" name="id"/>
    <input type="hidden" value="{$data.username}" name="username"/>
    <div class="h_a">销售业绩</div>
    <div class="table_full">
      <table width="100%">
        <col class="th" />
        <col/>
        <tr>
          <th>姓名</th>
          <td style="color:green;font-weight: bold;font-size: 20px;">{$userName}</td>
          <th></th>
          <td style="color:green;font-weight: bold"></td>
        </tr>
        <tr>
          <th>卡单添加数:</th>
          <td style="color:green;font-weight: bold;font-size: 20px;">{$addNum}</td>
          <th>已激活卡单数:</th>
          <td style="color:green;font-weight: bold;font-size: 20px;">{$activeNum}</td>
        </tr>
      </table>
    </div>
  </form>
</div>
<script src="{$config_siteurl}statics/js/common.js?v"></script>
</body>
</html>