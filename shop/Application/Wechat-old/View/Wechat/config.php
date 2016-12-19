<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<style>
.pop_nav{
	padding: 0px;
}
.pop_nav ul{
	border-bottom:1px solid #266AAE;
	padding:0 5px;
	height:25px;
	clear:both;
}
.pop_nav ul li.current a{
	border:1px solid #266AAE;
	border-bottom:0 none;
	color:#333;
	font-weight:700;
	background:#F3F3F3;
	position:relative;
	border-radius:2px;
	margin-bottom:-1px;
}

</style>
<div class="wrap J_check_wrap">
  <Admintemplate file="Common/Nav"/>
  <div class="h_a">温馨提示</div>
  <div class="prompt_text">
    <p>需要正常使用功能，请先到 <a href="https://mp.weixin.qq.com" target="_blank">微信公众平台</a> 申请接口。</p>
    <p><font color="#FF0000">注意事项：</font></p>
    <p>1、测试时可以使用 <a href="http://mp.weixin.qq.com/debug/cgi-bin/sandbox?t=sandbox/login" target="_blank">接口体验测试号</a> 进行调试。</p>
    <p>2、有的功能无法使用，受限于接口权限。</p>
  </div>
  <div class="pop_nav">
    <ul class="J_tabs_nav">
      <li class="current"><a href="javascript:;;">基本设置</a></li>
      <li><a href="javascript:;;">默认消息设置</a></li>
    </ul>
  </div>
  <form name="myform" action="{:U('Wechat/config')}" method="post" class="J_ajaxForm">
  <div class="J_tabs_contents">
    <div class="table_full">
      <div class="h_a">基本属性</div>
      <table width="100%" class="table_form">
        <tr>
          <th width="100">接口URL:</th>
          <td><input type="text" name="config[api_url]" class="input length_6" value="{$config.api_url}">
          <span class="gray"> 请将此地址复制到<a href="https://mp.weixin.qq.com" target="_blank">微信公众平台</a>接口URL项</span></td>
        </tr>
        <tr>
          <th>微信Token:</th>
          <td><input type="text" name="config[token]" class="input length_4" value="{$config.token}">
          <span class="gray"> 请与<a href="https://mp.weixin.qq.com" target="_blank">微信公众平台</a>Token保持一致</span></td>
        </tr>
        <tr>
          <th>AppId:</th>
          <td><input type="text" name="config[appid]" class="input length_4" value="{$config.appid}">
          <span class="gray"> 请与<a href="https://mp.weixin.qq.com" target="_blank">微信公众平台</a>开发者凭据AppId保持一致，没有随便填写</span></td>
        </tr>
        <tr>
          <th>AppSecret:</th>
          <td><input type="text" name="config[appsecret]" class="input length_4" value="{$config.appsecret}">
          <span class="gray"> 请与<a href="https://mp.weixin.qq.com" target="_blank">微信公众平台</a>开发者凭据AppSecret保持一致，没有随便填写</span></td>
        </tr>
      </table>
    </div>
    <div style="display:none;" class="table_full">
      <div class="h_a">默认消息设置</div>
      <table width="100%" class="table_form">
        <tr>
          <th width="100">默认回复消息:</th>
          <td>
          <textarea name="config[defaultreply]" style="width:400px; height:100px;">{$config.defaultreply}</textarea>
          <span class="gray"> 默认回复，只支持纯文本回复</span></td>
        </tr>
      </table>
    </div>
  </div>
  <div class="">
      <div class="btn_wrap_pd">             
        <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit">提交</button>
      </div>
    </div>
  </form>
</div>
<script src="{$config_siteurl}statics/js/common.js?v"></script>
</body>
</html>