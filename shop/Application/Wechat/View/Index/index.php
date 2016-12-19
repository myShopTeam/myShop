<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
  <Admintemplate file="Common/Nav"/>

  <div class="h_a">微信配置</div>
    <form method="post" action="{:U('wxinsert')}" class="J_ajaxForm" id="myform">
    <div class="table_full">
      <table cellpadding="0" cellspacing="0" class="table_form" width="100%">
        <tbody>
              <if condition="$list['appid'] neq ''">
                  <tr>
                      <th width="110">授权回调地址：</th>
                      <td>{$list.callback}</td>
                  </tr>
                  <tr>
                      <th width="110">URL(服务器地址)：</th>
                      <td>{$list.weixin_url}</td>
                  </tr>
                  <tr>
                      <th width="110">TOKEN：</th>
                      <td>{$list.token}</td>
                  </tr>
              </if>
          <tr>
            <th width="110">微信名称：</th>
            <td><input type="text" class="input" name="wxname" value="{$list.wxname}"></td>
          </tr>
          <tr>
            <th width="110">微信号：</th>
            <td><input type="text" class="input" name="weixin" value="{$list.weixin}"></td>
          </tr>
          <tr>
            <th width="110">AppID：</th>
            <td><input type="text" class="input" name="appid" value="{$list.appid}"></td>
          </tr>
          <tr>
            <th width="110">AppSecret：</th>
            <td><input type="text" class="input" name="appsecret" value="{$list.appsecret}"></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="btn_wrap" style="z-index:9999 !important;">
      <div class="btn_wrap_pd">
        <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit">保存</button>
      </div>
    </div>
    </form>
</div>
<script src="{$config_siteurl}statics/js/common.js?v"></script>
</body>
</html>