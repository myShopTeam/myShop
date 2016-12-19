<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap">
  <Admintemplate file="Common/Nav"/>
  <div class="h_a">使用说明</div>
  <div class="prompt_text">
    <ul>
      <li>数据类型：指当服务器被动接收到微信服务器发送过来时信息类型。</li>
      <li>匹配方式:“相等匹配”表示接收的内容和“匹配内容”中填写的内容完全一样的；“包含”是只，接收的内容包含“匹配内容”中填写的关键字；“正则匹配”模式是使用“匹配内容”中填写的正则进行匹配接收的内容。</li>
    </ul>
  </div>
  <form class="J_ajaxForm" action="{:U('Wechat/edit')}" method="post">
    <div class="h_a">基本属性</div>
    <div class="table_full">
      <table width="100%" class="table_form contentWrap">
        <tbody>
          <tr>
            <th width="80">匹配内容</th>
            <td><input type="test" name="match" class="input length_6" id="match" value="{$info.match}">
              <span class="gray">输入匹配的内容，“<font color="#FF0000">*</font>”代表全部</span></td>
          </tr>
          <tr>
            <th>数据类型</th>
            <td><select name="type">
					<option value="text" <if condition="$info['type'] eq 'text' ">selected</if>>文本消息</option>
                    <option value="location" <if condition="$info['type'] eq 'location' ">selected</if>>地理位置消息</option>
                    <option value="link" <if condition="$info['type'] eq 'link' ">selected</if>>链接消息</option>
                    <option value="event-subscribe" <if condition="$info['type'] eq 'event-subscribe' ">selected</if>>订阅事件</option>
                    <option value="event-unsubscribe" <if condition="$info['type'] eq 'event-unsubscribe' ">selected</if>>取消订阅事件</option>
                    <option value="event-CLICK" <if condition="$info['type'] eq 'event-CLICK' ">selected</if>>菜单CLICK查询事件</option>
                </select>
                <span class="gray">接收微信服务器发送过来的信息类型</span></td>
          </tr>
          <tr>
            <th>匹配方式</th>
            <td><select name="pattern">
					<option value="1" <if condition="$info['pattern'] eq 1 ">selected</if>>相等匹配</option>
                    <option value="2" <if condition="$info['pattern'] eq 2 ">selected</if>>包含</option>
                    <option value="3" <if condition="$info['pattern'] eq 3 ">selected</if>>正则匹配</option>
                </select>
                <span class="gray">信息匹配方式</span></td>
          </tr>
          <tr>
            <th>执行插件</th>
            <td><select name="addons">
            	<option value="" <if condition="$info['pattern'] eq '' ">selected</if>>请选择执行插件</option>
            	<volist name="addonsList" id="vo">
					<option value="{$key}" <if condition="$info['addons'] eq $key ">selected</if>>{$vo.title}</option>
                </volist>
                </select>
                <span class="gray">执行对应的处理插件</span></td>
          </tr>
          <tr>
            <th>插件配置</th>
            <td><div id="setting"></div></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="btn_wrap">
      <div class="btn_wrap_pd">
        <input type="hidden" name="id" value="{$info.id}"/>
        <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit">编辑</button>
      </div>
    </div>
  </form>
</div>
<script type="text/javascript" src="{$config_siteurl}statics/js/common.js?v"></script>
<script type="text/javascript" src="{$config_siteurl}statics/js/content_addtop.js"></script>
<script type="text/javascript">
//获取对应插件setting配置信息
function getAddonsSetting(name){
	$.get("{:U('Wechat/public_setting')}",{
		name:name,
		id:'{$info.id}'
	},function(html){
		$('#setting').html(html);
	});
}
$(function(){
	//初始化
	getAddonsSetting('{$info.addons}');
	$('form.J_ajaxForm select[name="addons"]').click(function(){
		var name = $(this).val();
		if(name == ''){
			$('#setting').html('');
			return false;
		}
		getAddonsSetting(name);
	});
});
</script>
</body>
</html>