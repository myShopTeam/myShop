<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
  <Admintemplate file="Common/Nav"/>

  <form class="search_form" method="post" action="{:U('cardList')}">
    <div class="search_type cc mb10">
      <div class="mb10"> 
	      <span class="mr20">
                        <!--<input class="input length_2 " value="{$post.card_type}"  name="card_type" placeholder="输入卡单类型"/>-->
                        <select name="card_type" class="select" id="card_type">
                            <option value="">选择卡单类型</option>
                            <volist name="type" id="vo">
                            <option value="{$vo.card_name}">{$vo.card_name}</option>
                            </volist>
                        </select>
                        <select name="card_name" class="select" id="card_name">
                            <option value="">选择产品名称</option>
                        </select>
                        <!--<input class="input length_2 " value="{$post.card_name}" name="card_name" placeholder="输入产品名称"/>-->
                        <input type="hidden" name="user_id" value="{$user_id}">
                        <select name="time_type" class="select" id="time" >
                            <option value='create_time' <if condition="$post.time_type eq 'create_time'">selected</if>>提交时间</option>
                            <option value='active_time' <if condition="$post.time_type eq 'active_time'">selected</if>>激活时间</option>
                        </select> 
                        
                        <input type="text" id="start_time" name="start_time" class="input length_2 J_datetime" value="{$post.start_time}">
                            -
                        <input type="text" id="end_time" class="input length_2 J_datetime" name="end_time" value="{$post.end_time}">
		      	卡号：
                        <input type="text" class="input length_2" name="card_num" style="width:160px;" value="{$post.card_num}" placeholder="请输入卡号...">
                        <select name="is_active" class="select" id="status" >
                            <option value="0">状态</option>
                            <option value='1' <if condition="$post.is_active eq 1">selected</if>>未激活</option>
                            <option value='2' <if condition="$post.is_active eq 2">selected</if>>已激活</option>
                            <option value='3' <if condition="$post.is_active eq 3">selected</if>>激活失败</option>
                        </select> 
                        <button class="btn serach_btn" >搜索</button>
                        <input type="button" class="btn export" value="导出" style="background:#1D83DB;color:#fff"/>
                        <input type="button"class="btn" onclick="javascript:window.location.href='{:U('export',array('type'=>tmp))}'" value="导入模板下载" />
                        &nbsp&nbsp<span>姓名：<font color="blue" weight="bold" size="4px" >{$name}</font></span>
       	  </span> 

       </div>
        <if condition="$user_id == 1">
         <span class="mr30">
                <select name="area" onchange="selectAuto()" data-id='{$post.area}' class="selectArea" id="time" >
                    <option value="" >选择区域</option>
                    <volist name="role" id="vo">
                        <option value='{$vo.id}' <eq name="post.area" value="$vo.id">selected</eq>>{$vo.name}</option>
                    </volist>    
                </select> 
             <select name="section" onchange="selectAuto()" data-id="{$post.section}" class="selectSection" style="display: none" id="time" >
                    <option value="" >选择部门</option> 
                </select>
                <select name="stuff" onchange="selectAuto()" data-id="{$post.stuff}" class="selectStuff" style="display: none" id="time" >
                    <option value="" >选择职员</option> 
                </select> 
          </span>
        </if>
    </div>
  </form> 
  <form action="{:U('cardDelete')}" method="post" class="J_ajaxForm">
    <div class="table_list">
      <table width="100%" cellspacing="0">
        <thead>
          <tr>
            <td align="center" width="60"><input type="checkbox" class="J_check_all" data-direction="x" data-checklist="J_check_x">全选</td>
            <td align="center" width="40">排序</td>
            <td align="center">ID</td>
            <td align="center">卡片名称</td>
            <td align="center">产品名称</td>
            <td align="center">卡号</td>
            <td align="center">校验码</td>
            <td align="center">激活日期</td>
            <td align="center">提交时间</td>
            <td align="center">状态</td>
            <td align="center">操作</td>
<!--            <td align="center">注册时间</td>
            <td align="center">状态</td>
            <td align="center">操作</td>-->
          </tr>
        </thead>
        <tbody>
          <volist name="vipList" id="vo">
            <tr>
              <td align="center" width="50"><input type="checkbox" value="{$vo.id}" class="J_check" data-yid="J_check_y" data-xid="J_check_x" name="id[]"></td>
              <td align="center"><input type="text" name="listorder[{$vo.id}]" class="input" value="{$vo.listorder}" size="1" /></td>
              <td align="center">{$vo.id}</td>
              <td align="center">{$vo.card_type}</td>
              <td align="center">{$vo.card_name}</td>
              <td align="center">{$vo.card_num}</td>
              <td align="center">{$vo.verif}</td>
              <td align="center"><if condition="$vo['is_active'] == 1">--<else/>{$vo.active_time|date='Y-m-d H:i:s',###}</if></td>
              <td align="center">{$vo.create_time|date='Y-m-d H:i:s',###}</td>
              <td align="center" <if condition="$vo['is_active'] == 1 or $vo['is_active'] == 3">style="color:red"</if>>{$config[is_active][$vo['is_active']]}</td>
              <td align="center" width="60">
              <a href="{:U('cardEdit',array('card_num'=>$vo[card_num]))}">修改</a>|
              <a class="J_ajax_del" href="{:U('cardDelete',array('id'=>$vo['id']))}">删除</a>
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
                <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit" data-action="{:U('listorder',array('str'=>vip))}">排序</button>
                <input type="button" class="btn upload" style="background: #1b75b6;color:#ffffff !important;text-shadow:0 -1px 0 rgba(0, 0, 0, 0.25)" value="导入">
                <input class="uploadFile" type="file" name="file_stu" style="display:none;width:180px;height:20px;line-height:16px;" />
                <button class="activeDo btn btn_submit mr10 J_ajax_submit_btn" type="submit" data-action="{:U('cardActive')}">激活</button>
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
    <form method="post" action="{:U('upload')}" enctype="multipart/form-data" class="uploadFileForm">
        
    </form>
<div class="show_img" style="position:fixed;top:20%;margin-left:30%;display:none;z-index:1000;"><img src="" style="max-width:250px;" /></div>
<script src="{$config_siteurl}statics/js/common.js"></script>
<script>
//鼠标悬停在列表食品缩略图上展示大图
$(function(){
        $('#card_type').change(function(){
            $('.search_form').attr('action',"{:U('cardList')}")
            var url   = "{:U('ajaxGetProduct')}";
            var data  = 'card_type='+$(this).val()
            $.post(url,data,function(re){
                if(re.res == 'success'){
                    $('#card_name').html(re.data)
                }else{
                    //alert(re.msg);
                }
            },'json')
        })
        var card_name = "{$post.card_name}";
        var card_type = "{$post.card_type}";
        if(card_name && card_type){
           $('#card_type').val(card_type) 
           cardTypeChange(card_type,card_name)
        }else if(card_type){
           $('#card_type').val(card_type) 
        }
        
        function cardTypeChange(type,name){
            var url   = "{:U('ajaxGetProduct')}";
            var data  = 'card_type='+type+'&card_name='+name
            $.post(url,data,function(re){
                if(re.res == 'success'){
                    $('#card_name').html(re.data)
                }else{
                    //alert(re.msg);
                }
            },'json')
        }
        
        $('#status').change(function(){
            $('.search_form').attr('action',"{:U('cardList')}")
            $('.search_form').submit()
        })
    
        area_id = $('.selectArea').data('id')
        section_id = $('.selectSection').data('id')
        sutff_id = $('.selectStuff').data('id')
        if(sutff_id){
           selectArea(area_id,section_id,sutff_id);
        }else if(section_id){
            selectArea(area_id,section_id,sutff_id);
        }else if(area_id){
            selectArea(area_id,section_id,sutff_id);
        }else{
            selectArea(area_id,section_id,sutff_id)
        }
        
	var img;
	$('.img').mouseover(function(){
		img = $(this).attr('src');
		$('.show_img img').attr('src',img);
		$('.show_img').show();
	})
	$('.img').mouseout(function(){
		$('.show_img').hide();
	})
        
        $('.upload').click(function(){
            if($('.uploadFile').hasClass('active')){
                if(!confirm('请确认已将excel整体转换为宋体格式！')){
                    e.topPropagation();
                }
                $('.uploadFileForm').append($('.uploadFile'));
                $('.uploadFileForm').submit();
                //$('<form method="post" action="{:U('upload')}" enctype="multipart/form-data"></form>').append($('.uploadFile')).submit()
            }else{
                $('.uploadFile').addClass('active')
                $('.uploadFile').css('display','')
            }   
        })
        
        $('.export').click(function(){
            if(!confirm('是否确认导出为excel?')){
                return false;
            }
            $('.search_form').attr('action',"{:U('export')}").submit()
            
        })
        
        $('.serach_btn').click(function(){
            $('.search_form').attr('action',"{:U('cardList')}").submit()
        })
        
        function selectArea(area,section,stuff){ 
            
            $('.search_form').attr('action',"{:U('cardList')}")
            var url  = "{:U('ajaxSelectRole')}";
            var selectHtml = '<option value="" >选择部门</option>'
            if(area){
                $.ajax({
                    type:'post',
                    url:url,
                    data:'role='+area,
                    async:false,
                    dataType:'json',
                    success:function(re){
                        if(!re){
                            return false;
                        }
                        $.each(re,function(key,value){
                            if(section == value.id){
                               $('.selectStuff').css('display','')
                               selectHtml += "<option selected  value='" + value.id + "'>" + value.name + "</option>"
                            }else{
                               selectHtml += "<option value='" + value.id + "'>" + value.name + "</option>" 
                            }
                        })
                        $('.selectSection').css('display','')
                        $('.selectSection').html(selectHtml)
                    }
                })
            }
            if(section){
                var selectHtml = '<option value="" >选择职员</option>'
                $.post(url,'role='+section,function(re){
                 $.each(re,function(key,value){
                     if(stuff == value.id){
                        selectHtml += "<option selected  value='" + value.id + "'>" + value.name + "</option>"
                    }else{
                        selectHtml += "<option value='" + value.id + "'>" + value.name + "</option>" 
                    }
                 })
                 $('.selectStuff').html(selectHtml)
                },'json')
            }
        }
     
})

function selectAuto(){
    $('.search_form').attr('action',"{:U('cardList')}")
    $('.search_form').submit()
}

    
</script>
</body>
</html>