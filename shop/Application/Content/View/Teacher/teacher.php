<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
  <Admintemplate file="Common/Nav"/>
  <form name="myform" class="J_ajaxForm" action="{:U('teacher')}" method="post">
  <input type="text" class="input length_2" name="teacher" style="width:200px;" value="{$_GET.teacher}" placeholder="根据名字搜索..." />
  <button class="btn  mr10" type="submit" data-actiom="{:U('teacher')}">搜索</button>
  <div class="table_list">
  <table width="100%" cellspacing="0">
        <thead>
          <tr>
            <td width="50"  align="center"><input type="checkbox" class="J_check_all" data-direction="x" data-checklist="J_check_x" onClick="selectall('tagid[]');">全选</td>
            <td width="50">排序</td>
            <td>教师名称</td>
            <td align="center" width="50">信息总数</td>
            <td align="center" width="50">点击次数</td>
            <td align="center" width="120">最后使用时间</td>
            <td align="center" width="120">最近访问时间</td>
            <td align="center" width="80">相关操作</td>
          </tr>
        </thead>
        <tbody>
        <volist name="teacher" id="vo">
          <tr>
            <td width="50"><input type="checkbox" value="{$vo.teacherid}" class="J_check" data-yid="J_check_y" data-xid="J_check_x" name="teacherid[]"></td>
            <td><input type="text" name="listorder[{$vo.teacherid}]" class="input" value="{$vo.listorder}" size="5" /></td>
            <td>{$vo.teacher}</td>
            <td align="center">{$vo.usetimes}</td>
            <td align="center">{$vo.hits }</td>
            <td align="center">{$vo.lastusetime|date="Y-m-d H:i:s",###}</td>
            <td align="center">{$vo.lasthittime|date="Y-m-d H:i:s",###}</td>
            <td align="center">
            <?php
			$op = array();
			if(\Libs\System\RBAC::authenticate('edit')){
				$op[] = '<a href="'.U('Teacher/edit',array('teacherid'=>$vo['teacherid'])).'">修改</a>';
			}
			if(\Libs\System\RBAC::authenticate('delete')){
				$op[] = '<a class="J_ajax_del" href="'.U('Teacher/delete',array('teacherid'=>$vo['teacherid'])).'">删除</a>';
			}
			echo implode(" | ",$op);
			?>
            </td>
          </tr>
        </volist>
        </tbody>
      </table>
      <div class="p10">
        <div class="pages" style="color:"> {$Page} </div>
      </div>
  </div>
  <div class="btn_wrap">
      <div class="btn_wrap_pd">             
      	<label class="mr20"><input type="checkbox" class="J_check_all" data-direction="y" data-checklist="J_check_y">全选</label>
        <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit" data-action="{:U('listorder')}">排序</button>
        <?php
		if(\Libs\System\RBAC::authenticate('delete')){
		?>
        <button class="btn  mr10 J_ajax_submit_btn" type="submit" data-actiom="{:U('delete')}">删除</button>
        <?php
		}
		?>
      </div>
    </div>
  </form>
</div>
<script src="{$config_siteurl}statics/js/common.js?v"></script>
</body>
</html>