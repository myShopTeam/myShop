<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
  <Admintemplate file="Common/Nav"/>

    <!-- <form method="post" action="{:U('goods_index')}">
    <div class="search_type cc mb10">
      <div class="mb10"> 
	      <span class="mr20">
		      	发布时间：
		      <input type="text" name="start_time" class="input length_2 J_date" value="{$_GET.start_uploadtime}">
		        -
		      <input type="text" class="input length_2 J_date" name="end_time" value="{$_GET.end_uploadtime}">
		      	联系电话：
		      <input type="text" class="input length_2" name="phone" style="width:200px;" value="{$_GET.name}" placeholder="请输入联系电话...">
		      <button class="btn">搜索</button>
       	  </span> 
       </div>
    </div>
  </form> -->
  <form action="{:U('supervise_del')}" method="post" class="J_ajaxForm">
    <div class="table_list">
      <table width="100%" cellspacing="0">
        <thead>
          <tr>
            <td align="center" width="60"><input type="checkbox" class="J_check_all" data-direction="x" data-checklist="J_check_x">全选</td>
            <td align="center" width="40">排序</td>
            <td align="center">校友名称</td>
            <td align="center">校友分类</td>
            <td align="center">操作</td>
          </tr>
        </thead>
        <tbody>
          <volist name="list" id="vo">
            <tr>
              <td align="center" width="50"><input type="checkbox" value="{$vo.id}" class="J_check" data-yid="J_check_y" data-xid="J_check_x" name="id[]"></td>
              <td align="center"><input type="text" name="listorder[{$vo.id}]" class="input" value="{$vo.listorder}" size="1" /></td>
              <td align="center">{$vo.alumni_name}</td>
              <td align="center">{$vo.school_name}</td>
              <td align="center" width="60">
              <a href="{:U('supervise_edit',array('sid'=>$vo['id']))}">修改</a>|
              <a class="J_ajax_del" href="{:U('supervise_del',array('sid'=>$vo['id']))}">删除</a>
              </td>
            </tr>
          </volist>
        </tbody>
      </table>
      <div class="p10">
        <div class="pages"> {$Page} </div>
      </div>
    </div>
    <div class="btn_wrap">
      <div class="btn_wrap_pd">
        <label class="mr20"><input type="checkbox" class="J_check_all" data-direction="y" data-checklist="J_check_y">全选</label> 
                <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit" data-action="{:U('listorder',array('str'=>school))}">排序</button>
        <?php
		if(\Libs\System\RBAC::authenticate('delete')){
		?>
        <button class="btn  mr10 J_ajax_submit_btn" type="submit">删除</button>
        <?php
		}
		?> 
      </div>
    </div>
  </form>
</div>
<div class="show_img" style="position:absolute;margin-top:-20%;margin-left:30%;display:none;z-index:1000;"><img src="" style="max-width:800px;" /></div>
<script src="{$config_siteurl}statics/js/common.js"></script>
</body>
</html>