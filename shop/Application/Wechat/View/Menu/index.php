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
    <p>1、自定义菜单需要有 <a href="http://mp.weixin.qq.com/wiki/index.php?title=%E8%87%AA%E5%AE%9A%E4%B9%89%E8%8F%9C%E5%8D%95%E5%88%9B%E5%BB%BA%E6%8E%A5%E5%8F%A3" target="_blank">会话界面自定义菜单</a> 没有该权限将无法使用。</p>
    <p>2、自定义菜单最多包括3个一级菜单，每个一级菜单最多包含5个二级菜单。一级菜单最多4个汉字，二级菜单最多7个汉字，多出来的部分将会以“...”代替。</p>
    <p>3、创建自定义菜单后，由于微信客户端缓存，需要24小时微信客户端才会展现出来。（测试是否生效可以取消关注后再进行关注）</p>
  </div>
  <form name="myform" action="{:U('Wechat/Menu/index')}" method="post" class="J_ajaxForm">
    <div class="table_full">
      <div class="h_a">菜单设置</div>
      <table width="100%">
        <tr>
          <td width="150" align="left" valign="middle">一级菜单：<input type="text" name="button[0][name]" class="input" style="width:80px;" value="{$button[0][name]}" maxlength="4"></td>
          <td width="168" align="left" valign="middle">类型：
            <select name="button[0][type]">
              <option value="">请选择</option>
              <option value="view" <if condition=" $button[0][type] eq 'view' ">selected</if>>链接</option>
              <option value="click" <if condition=" $button[0][type] eq 'click' ">selected</if>>Click点击事件</option>
              <option value="media_id" <if condition=" $button[0][type] eq 'media_id' ">selected</if>>图文</option>
            </select>
          </td>
          <td width="150"></td>
          <td width="150" align="left" valign="middle">标识：<input type="text" name="button[0][key]" class="input" style="width:80px;" value="{$button[0][key]}"></td>
          <td align="left" valign="middle">URL地址：<input type="text" name="button[0][url]" class="input length_6" value="{$button[0][url]}"></td>
        </tr>
        <tr>
          <td width="150" align="center" valign="middle">┗</td>
          <td width="150" align="left" valign="middle">二级菜单：
          <input type="text" name="button[0][sub_button][0][name]" class="input" style="width:80px;" value="{$button[0][sub_button][0][name]}" maxlength="4"></td>
          <td width="150" align="left" valign="middle">类型：
            <select name="button[0][sub_button][0][type]">
              <option value="">请选择</option>
              <option value="view" <if condition=" $button[0][sub_button][0][type] eq 'view' ">selected</if>>链接</option>
              <option value="click" <if condition=" $button[0][sub_button][0][type] eq 'click' ">selected</if>>Click点击事件</option>
              <option value="media_id" <if condition=" $button[0][sub_button][0][type] eq 'media_id' ">selected</if>>图文</option>
            </select>
          </td>
          <td width="150" align="left" valign="middle">标识：<input type="text" name="button[0][sub_button][0][key]" class="input" style="width:80px;" value="{$button[0][sub_button][0][key]}"></td>
          <td align="left" valign="middle">URL地址：<input type="text" name="button[0][sub_button][0][url]" class="input length_6" value="{$button[0][sub_button][0][url]}"></td>
        </tr>
        <tr>
          <td width="150" align="center" valign="middle">┗</td>
          <td width="150" align="left" valign="middle">二级菜单：
          <input type="text" name="button[0][sub_button][1][name]" class="input" style="width:80px;" value="{$button[0][sub_button][1][name]}" maxlength="4"></td>
          <td width="150" align="left" valign="middle">类型：
            <select name="button[0][sub_button][1][type]">
              <option value="">请选择</option>
              <option value="view" <if condition=" $button[0][sub_button][0][type] eq 'view' ">selected</if>>链接</option>
              <option value="click" <if condition=" $button[0][sub_button][0][type] eq 'click' ">selected</if>>Click点击事件</option>
              <option value="media_id" <if condition=" $button[0][sub_button][0][type] eq 'media_id' ">selected</if>>图文</option>
            </select>
          </td>
          <td width="150" align="left" valign="middle">标识：<input type="text" name="button[0][sub_button][1][key]" class="input" style="width:80px;" value="{$button[0][sub_button][1][key]}"></td>
          <td align="left" valign="middle">URL地址：<input type="text" name="button[0][sub_button][1][url]" class="input length_6" value="{$button[0][sub_button][1][url]}"></td>
        </tr>
        <tr>
          <td width="150" align="center" valign="middle">┗</td>
          <td width="150" align="left" valign="middle">二级菜单：
          <input type="text" name="button[0][sub_button][2][name]" class="input" style="width:80px;" value="{$button[0][sub_button][2][name]}" maxlength="4"></td>
          <td width="150" align="left" valign="middle">类型：
            <select name="button[0][sub_button][2][type]">
              <option value="">请选择</option>
              <option value="view" <if condition=" $button[0][sub_button][0][type] eq 'view' ">selected</if>>链接</option>
              <option value="click" <if condition=" $button[0][sub_button][0][type] eq 'click' ">selected</if>>Click点击事件</option>
              <option value="media_id" <if condition=" $button[0][sub_button][0][type] eq 'media_id' ">selected</if>>图文</option>
            </select>
          </td>
          <td width="150" align="left" valign="middle">标识：<input type="text" name="button[0][sub_button][2][key]" class="input" style="width:80px;" value="{$button[0][sub_button][2][key]}"></td>
          <td align="left" valign="middle">URL地址：<input type="text" name="button[0][sub_button][2][url]" class="input length_6" value="{$button[0][sub_button][2][url]}"></td>
        </tr>
        <tr>
          <td width="150" align="center" valign="middle">┗</td>
          <td width="150" align="left" valign="middle">二级菜单：
          <input type="text" name="button[0][sub_button][3][name]" class="input" style="width:80px;" value="{$button[0][sub_button][3][name]}" maxlength="4"></td>
          <td width="150" align="left" valign="middle">类型：
            <select name="button[0][sub_button][3][type]">
              <option value="">请选择</option>
              <option value="view" <if condition=" $button[0][sub_button][0][type] eq 'view' ">selected</if>>链接</option>
              <option value="click" <if condition=" $button[0][sub_button][0][type] eq 'click' ">selected</if>>Click点击事件</option>
              <option value="media_id" <if condition=" $button[0][sub_button][0][type] eq 'media_id' ">selected</if>>图文</option>
            </select>
          </td>
          <td width="150" align="left" valign="middle">标识：<input type="text" name="button[0][sub_button][3][key]" class="input" style="width:80px;" value="{$button[0][sub_button][3][key]}"></td>
          <td align="left" valign="middle">URL地址：<input type="text" name="button[0][sub_button][3][url]" class="input length_6" value="{$button[0][sub_button][3][url]}"></td>
        </tr>
        <tr>
          <td width="150" align="center" valign="middle">┗</td>
          <td width="150" align="left" valign="middle">二级菜单：
          <input type="text" name="button[0][sub_button][4][name]" class="input" style="width:80px;" value="{$button[0][sub_button][4][name]}" maxlength="4"></td>
          <td width="150" align="left" valign="middle">类型：
            <select name="button[0][sub_button][4][type]">
              <option value="">请选择</option>
              <option value="view" <if condition=" $button[0][sub_button][0][type] eq 'view' ">selected</if>>链接</option>
              <option value="click" <if condition=" $button[0][sub_button][0][type] eq 'click' ">selected</if>>Click点击事件</option>
              <option value="media_id" <if condition=" $button[0][sub_button][0][type] eq 'media_id' ">selected</if>>图文</option>
            </select>
          </td>
          <td width="150" align="left" valign="middle">标识：<input type="text" name="button[0][sub_button][4][key]" class="input" style="width:80px;" value="{$button[0][sub_button][4][key]}"></td>
          <td align="left" valign="middle">URL地址：<input type="text" name="button[0][sub_button][4][url]" class="input length_6" value="{$button[0][sub_button][4][url]}"></td>
        </tr>
        
        <tr>
          <td width="150" align="left" valign="middle">一级菜单：<input type="text" name="button[1][name]" class="input" style="width:80px;" value="{$button[1][name]}" maxlength="4"></td>
          <td width="168" align="left" valign="middle">类型：
            <select name="button[1][type]">
              <option value="">请选择</option>
              <option value="view" <if condition=" $button[1][type] eq 'view' ">selected</if>>链接</option>
              <option value="click" <if condition=" $button[1][type] eq 'click' ">selected</if>>Click点击事件</option>
              <option value="media_id" <if condition=" $button[1][type] eq 'media_id' ">selected</if>>图文</option>
            </select>
          </td>
          <td width="150"></td>
          <td width="150" align="left" valign="middle">标识：<input type="text" name="button[1][key]" class="input" style="width:80px;" value="{$button[1][key]}"></td>
          <td align="left" valign="middle">URL地址：<input type="text" name="button[1][url]" class="input length_6" value="{$button[1][url]}"></td>
        </tr>
        <tr>
          <td width="150" align="center" valign="middle">┗</td>
          <td width="150" align="left" valign="middle">二级菜单：
          <input type="text" name="button[1][sub_button][0][name]" class="input" style="width:80px;" value="{$button[1][sub_button][0][name]}" maxlength="4"></td>
          <td width="150" align="left" valign="middle">类型：
            <select name="button[1][sub_button][0][type]">
              <option value="">请选择</option>
              <option value="view" <if condition=" $button[1][sub_button][0][type] eq 'view' ">selected</if>>链接</option>
              <option value="click" <if condition=" $button[1][sub_button][0][type] eq 'click' ">selected</if>>Click点击事件</option>
              <option value="media_id" <if condition=" $button[1][sub_button][0][type] eq 'media_id' ">selected</if>>图文</option>
            </select></td>
          <td width="150" align="left" valign="middle">标识：<input type="text" name="button[1][sub_button][0][key]" class="input" style="width:80px;" value="{$button[1][sub_button][0][key]}"></td>
          <td align="left" valign="middle">URL地址：<input type="text" name="button[1][sub_button][0][url]" class="input length_6" value="{$button[1][sub_button][0][url]}"></td>
        </tr>
        <tr>
          <td width="150" align="center" valign="middle">┗</td>
          <td width="150" align="left" valign="middle">二级菜单：
          <input type="text" name="button[1][sub_button][1][name]" class="input" style="width:80px;" value="{$button[1][sub_button][1][name]}" maxlength="4"></td>
          <td width="150" align="left" valign="middle">类型：
            <select name="button[1][sub_button][1][type]">
              <option value="">请选择</option>
              <option value="view" <if condition=" $button[1][sub_button][0][type] eq 'view' ">selected</if>>链接</option>
              <option value="click" <if condition=" $button[1][sub_button][0][type] eq 'click' ">selected</if>>Click点击事件</option>
              <option value="media_id" <if condition=" $button[1][sub_button][0][type] eq 'media_id' ">selected</if>>图文</option>
            </select>
          </td>
          <td width="150" align="left" valign="middle">标识：<input type="text" name="button[1][sub_button][1][key]" class="input" style="width:80px;" value="{$button[1][sub_button][1][key]}"></td>
          <td align="left" valign="middle">URL地址：<input type="text" name="button[1][sub_button][1][url]" class="input length_6" value="{$button[1][sub_button][1][url]}"></td>
        </tr>
        <tr>
          <td width="150" align="center" valign="middle">┗</td>
          <td width="150" align="left" valign="middle">二级菜单：
          <input type="text" name="button[1][sub_button][2][name]" class="input" style="width:80px;" value="{$button[1][sub_button][2][name]}" maxlength="4"></td>
          <td width="150" align="left" valign="middle">类型：
            <select name="button[1][sub_button][2][type]">
              <option value="">请选择</option>
              <option value="view" <if condition=" $button[1][sub_button][0][type] eq 'view' ">selected</if>>链接</option>
              <option value="click" <if condition=" $button[1][sub_button][0][type] eq 'click' ">selected</if>>Click点击事件</option>
              <option value="media_id" <if condition=" $button[1][sub_button][0][type] eq 'media_id' ">selected</if>>图文</option>
            </select>
          </td>
          <td width="150" align="left" valign="middle">标识：<input type="text" name="button[1][sub_button][2][key]" class="input" style="width:80px;" value="{$button[1][sub_button][2][key]}"></td>
          <td align="left" valign="middle">URL地址：<input type="text" name="button[1][sub_button][2][url]" class="input length_6" value="{$button[1][sub_button][2][url]}"></td>
        </tr>
        <tr>
          <td width="150" align="center" valign="middle">┗</td>
          <td width="150" align="left" valign="middle">二级菜单：
          <input type="text" name="button[1][sub_button][3][name]" class="input" style="width:80px;" value="{$button[1][sub_button][3][name]}" maxlength="4"></td>
          <td width="150" align="left" valign="middle">类型：
            <select name="button[1][sub_button][3][type]">
              <option value="">请选择</option>
              <option value="view" <if condition=" $button[1][sub_button][0][type] eq 'view' ">selected</if>>链接</option>
              <option value="click" <if condition=" $button[1][sub_button][0][type] eq 'click' ">selected</if>>Click点击事件</option>
              <option value="media_id" <if condition=" $button[1][sub_button][0][type] eq 'media_id' ">selected</if>>图文</option>
            </select>
          </td>
          <td width="150" align="left" valign="middle">标识：<input type="text" name="button[1][sub_button][3][key]" class="input" style="width:80px;" value="{$button[1][sub_button][3][key]}"></td>
          <td align="left" valign="middle">URL地址：<input type="text" name="button[1][sub_button][3][url]" class="input length_6" value="{$button[1][sub_button][3][url]}"></td>
        </tr>
        <tr>
          <td width="150" align="center" valign="middle">┗</td>
          <td width="150" align="left" valign="middle">二级菜单：
          <input type="text" name="button[1][sub_button][4][name]" class="input" style="width:80px;" value="{$button[1][sub_button][4][name]}" maxlength="4"></td>
          <td width="150" align="left" valign="middle">类型：
            <select name="button[1][sub_button][4][type]">
              <option value="">请选择</option>
              <option value="view" <if condition=" $button[1][sub_button][0][type] eq 'view' ">selected</if>>链接</option>
              <option value="click" <if condition=" $button[1][sub_button][0][type] eq 'click' ">selected</if>>Click点击事件</option>
              <option value="media_id" <if condition=" $button[1][sub_button][0][type] eq 'media_id' ">selected</if>>图文</option>
            </select>
          </td>
          <td width="150" align="left" valign="middle">标识：<input type="text" name="button[1][sub_button][4][key]" class="input" style="width:80px;" value="{$button[1][sub_button][4][key]}"></td>
          <td align="left" valign="middle">URL地址：<input type="text" name="button[1][sub_button][4][url]" class="input length_6" value="{$button[1][sub_button][4][url]}"></td>
        </tr>
        
        <tr>
          <td width="150" align="left" valign="middle">一级菜单：<input type="text" name="button[2][name]" class="input" style="width:80px;" value="{$button[2][name]}" maxlength="4"></td>
          <td width="168" align="left" valign="middle">类型：
            <select name="button[2][type]">
              <option value="">请选择</option>
              <option value="view" <if condition=" $button[2][type] eq 'view' ">selected</if>>链接</option>
              <option value="click" <if condition=" $button[2][type] eq 'click' ">selected</if>>Click点击事件</option>
              <option value="media_id" <if condition=" $button[2][type] eq 'media_id' ">selected</if>>图文</option>
            </select>
          </td>
          <td width="150"></td>
          <td width="150" align="left" valign="middle">标识：<input type="text" name="button[2][key]" class="input" style="width:80px;" value="{$button[2][key]}"></td>
          <td align="left" valign="middle">URL地址：<input type="text" name="button[2][url]" class="input length_6" value="{$button[2][url]}"></td>
        </tr>
        <tr>
          <td width="150" align="center" valign="middle">┗</td>
          <td width="150" align="left" valign="middle">二级菜单：
          <input type="text" name="button[2][sub_button][0][name]" class="input" style="width:80px;" value="{$button[2][sub_button][0][name]}" maxlength="4"></td>
          <td width="150" align="left" valign="middle">类型：
            <select name="button[2][sub_button][0][type]">
              <option value="">请选择</option>
              <option value="view" <if condition=" $button[2][sub_button][0][type] eq 'view' ">selected</if>>链接</option>
              <option value="click" <if condition=" $button[2][sub_button][0][type] eq 'click' ">selected</if>>Click点击事件</option>
              <option value="media_id" <if condition=" $button[2][sub_button][0][type] eq 'media_id' ">selected</if>>图文</option>
            </select>
          </td>
          <td width="150" align="left" valign="middle">标识：<input type="text" name="button[2][sub_button][0][key]" class="input" style="width:80px;" value="{$button[2][sub_button][0][key]}"></td>
          <td align="left" valign="middle">URL地址：<input type="text" name="button[2][sub_button][0][url]" class="input length_6" value="{$button[2][sub_button][0][url]}"></td>
        </tr>
        <tr>
          <td width="150" align="center" valign="middle">┗</td>
          <td width="150" align="left" valign="middle">二级菜单：
          <input type="text" name="button[2][sub_button][1][name]" class="input" style="width:80px;" value="{$button[2][sub_button][1][name]}" maxlength="4"></td>
          <td width="150" align="left" valign="middle">类型：
            <select name="button[2][sub_button][1][type]">
              <option value="">请选择</option>
              <option value="view" <if condition=" $button[2][sub_button][0][type] eq 'view' ">selected</if>>链接</option>
              <option value="click" <if condition=" $button[2][sub_button][0][type] eq 'click' ">selected</if>>Click点击事件</option>
              <option value="media_id" <if condition=" $button[2][sub_button][0][type] eq 'media_id' ">selected</if>>图文</option>
            </select>
          </td>
          <td width="150" align="left" valign="middle">标识：<input type="text" name="button[2][sub_button][1][key]" class="input" style="width:80px;" value="{$button[2][sub_button][1][key]}"></td>
          <td align="left" valign="middle">URL地址：<input type="text" name="button[2][sub_button][1][url]" class="input length_6" value="{$button[2][sub_button][1][url]}"></td>
        </tr>
        <tr>
          <td width="150" align="center" valign="middle">┗</td>
          <td width="150" align="left" valign="middle">二级菜单：
          <input type="text" name="button[2][sub_button][2][name]" class="input" style="width:80px;" value="{$button[2][sub_button][2][name]}" maxlength="4"></td>
          <td width="150" align="left" valign="middle">类型：
            <select name="button[2][sub_button][2][type]">
              <option value="">请选择</option>
              <option value="view" <if condition=" $button[2][sub_button][0][type] eq 'view' ">selected</if>>链接</option>
              <option value="click" <if condition=" $button[2][sub_button][0][type] eq 'click' ">selected</if>>Click点击事件</option>
              <option value="media_id" <if condition=" $button[2][sub_button][0][type] eq 'media_id' ">selected</if>>图文</option>
            </select>
          </td>
          <td width="150" align="left" valign="middle">标识：<input type="text" name="button[2][sub_button][2][key]" class="input" style="width:80px;" value="{$button[2][sub_button][2][key]}"></td>
          <td align="left" valign="middle">URL地址：<input type="text" name="button[2][sub_button][2][url]" class="input length_6" value="{$button[2][sub_button][2][url]}"></td>
        </tr>
        <tr>
          <td width="150" align="center" valign="middle">┗</td>
          <td width="150" align="left" valign="middle">二级菜单：
          <input type="text" name="button[2][sub_button][3][name]" class="input" style="width:80px;" value="{$button[2][sub_button][3][name]}" maxlength="4"></td>
          <td width="150" align="left" valign="middle">类型：
            <select name="button[2][sub_button][3][type]">
              <option value="">请选择</option>
              <option value="view" <if condition=" $button[2][sub_button][0][type] eq 'view' ">selected</if>>链接</option>
              <option value="click" <if condition=" $button[2][sub_button][0][type] eq 'click' ">selected</if>>Click点击事件</option>
              <option value="media_id" <if condition=" $button[2][sub_button][0][type] eq 'media_id' ">selected</if>>图文</option>
            </select>
          </td>
          <td width="150" align="left" valign="middle">标识：<input type="text" name="button[2][sub_button][3][key]" class="input" style="width:80px;" value="{$button[2][sub_button][3][key]}"></td>
          <td align="left" valign="middle">URL地址：<input type="text" name="button[2][sub_button][3][url]" class="input length_6" value="{$button[2][sub_button][3][url]}"></td>
        </tr>
        <tr>
          <td width="150" align="center" valign="middle">┗</td>
          <td width="150" align="left" valign="middle">二级菜单：
          <input type="text" name="button[2][sub_button][4][name]" class="input" style="width:80px;" value="{$button[2][sub_button][4][name]}" maxlength="4"></td>
          <td width="150" align="left" valign="middle">类型：
            <select name="button[2][sub_button][4][type]">
              <option value="">请选择</option>
              <option value="view" <if condition=" $button[2][sub_button][0][type] eq 'view' ">selected</if>>链接</option>
              <option value="click" <if condition=" $button[2][sub_button][0][type] eq 'click' ">selected</if>>Click点击事件</option>
              <option value="media_id" <if condition=" $button[2][sub_button][0][type] eq 'media_id' ">selected</if>>图文</option>
            </select>
          </td>
          <td width="150" align="left" valign="middle">标识：<input type="text" name="button[2][sub_button][4][key]" class="input" style="width:80px;" value="{$button[2][sub_button][4][key]}"></td>
          <td align="left" valign="middle">URL地址：<input type="text" name="button[2][sub_button][4][url]" class="input length_6" value="{$button[2][sub_button][4][url]}"></td>
        </tr>
      </table>
    </div>
    <div class="btn_wrap">
      <div class="btn_wrap_pd">             
        <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit">提交</button>
      </div>
    </div>
  </form>
</div>
<script src="{$config_siteurl}statics/js/common.js?v"></script>
</body>
</html>