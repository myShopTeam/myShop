<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap">
  <Admintemplate file="Common/Nav"/>
  <div class="h_a">搜索</div>
  <form method="get" action="/index.php">
  <input type="hidden" value="Wechat" name="g">
    <input type="hidden" value="Wechat" name="m">
    <input type="hidden" value="log" name="a">
  <div class="search_type cc mb10">
    <div class="mb10"> <span class="mr20">
    搜索类型：
      <select name="field">
        <option value='1' <if condition="$field eq 1 ">selected</if>>ID</option>
        <option value='2' <if condition="$field eq 2 ">selected</if>>接收方</option>
        <option value="3" <if condition="$field eq 3 ">selected</if>>发送方</option>
        <option value="4" <if condition="$field eq 4 ">selected</if>>执行插件</option>
      </select>
      <input type="text" class="input length_6" name="keyword" size='10' value="{$keyword}" placeholder="关键字">
      <button class="btn">搜索</button>
      <input type="button" class="button" name="del_log_4" value="删除一月前数据" onClick="location='{:U('Wechat/Wechat/log',array('act'=>'delete'))}'"  />
      </span> </div>
  </div>
  </form>
  <div class="table_list">
    <table width="100%">
      <colgroup>
      <col width="50">
      <col>
      <col width="150">
      <col width="150">
      <col width="80">
      <col width="100">
      <col width="140">
      </colgroup>
      <thead>
        <tr>
          <td align="center">编号</td>
          <td align="center">数据</td>
          <td align="center">接收方</td>
          <td align="center">发送方</td>
          <td align="center">信息类型</td>
          <td align="center">执行插件</td>
          <td align="center">时间</td>
        </tr>
      </thead>
      <volist name="data" id="vo">
        <tr>
          <td align="center"><if condition=" $vo['isserver'] "><font color="#FF0000">{$vo.id}</font><else/>{$vo.id}</if></td>
          <td><textarea style=" width:100%">{$vo.data|unserialize|print_r=###}</textarea></td>
          <td align="center">{$vo.tousername}</td>
          <td align="center"><if condition=" $vo['isserver'] "><font color="#FF0000">{$vo.fromusername}</font><else/>{$vo.fromusername}</if></td>
          <td align="center">{$vo.msgtype}</td>
          <td align="center">{$vo.addons}</td>
          <td align="center">{$vo.createtime|date='Y-m-d H:i:s',###}</td>
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