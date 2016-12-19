<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap">
  <Admintemplate file="Common/Nav"/>
  <div class="h_a">功能说明</div>
  <div class="prompt_text">
    <ul>
      <li>服务器接收到微信服务器发送来的数据，程序从<font color="#FF0000">最新->最旧</font>的顺序进行规则匹配。（注意：“<font color="#FF0000">*</font>”符号匹配优先）</li>
      <li>匹配到一条规则后，程序将<font color="#FF0000">不再</font>往下继续匹配。</li>
    </ul>
  </div>
  <?php
  if(D('Admin/Access')->isCompetence('Wechat/Wechat/add')){
  ?>
  <div class="btn_wrap_pd"><a href="{:U('Wechat/add')}" class="btn" title="添加新规则"><span class="add"></span>添加新规则</a>
  <?php
  }
  ?>
</div>
    <div class="table_list">
      <table width="100%">
        <colgroup>
        <col width="50">
        <col>
        <col width="100">
        <col width="100">
        <col width="140">
        <col width="60">
        <col width="120">
        </colgroup>
        <thead>
          <tr>
            <td align="center">编号</td>
            <td>匹配项</td>
            <td align="center">信息类型</td>
            <td align="center">匹配模式</td>
            <td align="center">时间</td>
            <td align="center">状态</td>
            <td align="center">操作</td>
          </tr>
        </thead>
        <volist name="list" id="vo">
          <tr>
            <td align="center">{$vo.id}</td>
            <td>{$vo.match}</td>
            <td align="center">
            <switch name="vo.type" >
            	<case value="text">文本消息</case>
                <case value="image">图片消息</case>
                <case value="voice">语音消息</case>
                <case value="video">视频消息</case>
                <case value="location">地理位置消息</case>
                <case value="link">链接消息</case>
                <case value="event">事件类消息</case>
            </switch>
            </td>
            <td align="center">
            <switch name="vo.pattern" >
            	<case value="1">相等匹配</case>
                <case value="2">包含</case>
                <case value="3">正则匹配</case>
            </switch>
            </td>
            <td align="center">{$vo.createtime|date='Y-m-d H:i:s',###}</td>
            <td align="center"><if condition="$vo['status']">正常<else /><font color="#FF0000">禁用</font></if></td>
            <td align="center"><a href="{:U('Wechat/edit',array('id'=>$vo['id']))}">编辑</a> | <if condition="$vo['status']"><a href="{:U('Wechat/status',array('id'=>$vo['id']))}">禁用</a><else /><font color="#FF0000"><a href="{:U('Wechat/status',array('id'=>$vo['id']))}">启用</a></font></if> | <a href="{:U('Wechat/delete',array('id'=>$vo['id']))}" class="J_ajax_del">删除</a></td>
          </tr>
        </volist>
      </table>
      <div class="p10">
        <div class="pages"> {$Page} </div>
      </div>
    </div>
</div>
<script src="{$config_siteurl}statics/js/common.js?v"></script>
</body>
</html>