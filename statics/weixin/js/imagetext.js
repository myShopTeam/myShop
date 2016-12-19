// JavaScript Document
$(function() {
	//鼠标移动到层上显示编辑和删除
	$(".addition_left_yl").on('mouseover',"*[name=article]", function() {
		//$(".dyc").hide();
		$(this).find(".dyc").show();
	});
	$(".addition_left_yl").on('mouseout',"*[name=article]", function() {
		$(".dyc").hide();
	});
	
	//点击删除按钮时
	$(".addition_left_yl").on('click',"*[name=delete]", function(evt) {
		var index = $("#editer").attr('data_index');
		$("*[name=article]").eq(index).find("*[name=info_intro]").val(UE.getEditor('info_intro').getContent());
		if (confirm('确认删除')) {
			var size = $("*[name=article]").size();
			var index = $("*[name=delete]").index($(this));
			if (size <= 2) {
				note_info('无法删除，多条图文至少2条消息。', 'yellow', evt);
				return false;
			} else {
				var id=$("*[name=id]").eq(index+1).val();
				if(id>0){
					$.get(delUrl+'&id='+id);
					}
				$("*[name=article]").eq(index + 1).remove();
				$("*[name=edit]").eq(0).click();
			}
		}
	});
	//编辑
	$(".addition_left_yl").on('click',"*[name=edit]", function() {
		var index = $("#editer").attr('data_index');
		$("*[name=article]").eq(index).find("*[name=info_intro]").val(UE.getEditor('info_intro').getContent());
	
		index = $("*[name=edit]").index($(this));
		if (index === 0) {
			$("#publisher_div").show();
			$("#account_name_div").show();
			$("#rule_div,#ruleType").show();
			$("#state_div").show();
			$("#editer").css('margin-top', '0px');
		} else {
			$("#publisher_div").hide();
			$("#account_name_div").hide();
			$("#rule_div,#ruleType").hide();
			$("#state_div").hide();
			$("#editer").css('margin-top', 140 + 90 * (index - 1) + 'px');
		}
		$("#editer").attr('data_index', index);
		upload_clear();
		//规则
		if (index === 0) {
			$("#rule").val($("*[name=article]").eq(index).find("*[name=rule]").val());
		}
		//标题
		var info_name = $("*[name=article]").eq(index).find("*[name=info_name]").val();
		if (info_name != '标题') {
			$("#info_name").val($("*[name=article]").eq(index).find("*[name=info_name]").val());
		}
		//连接
		$("#info_url").val($("*[name=article]").eq(index).find("*[name=info_url]").val());
		//描述
		UE.getEditor('info_intro').setContent($("*[name=article]").eq(index).find("*[name=info_intro]").val());
		//图片
		var info_pic = $("*[name=article]").eq(index).find("*[name=info_pic]").val();
		if (info_pic !== '') {
			
			//$("#editer_img").show();
			//$("#info_pic_url").attr('src', 'http://wecool.socialmedia.cn/upload/' + info_pic);
			$("#info_pic_value").val(info_pic);
		}
	});
	//添加新数据并初始化窗口
	$("#add").click(function(evt) {
		var index = $("#editer").attr('data_index');
		$("*[name=article]").eq(index).find("*[name=info_intro]").val(UE.getEditor('info_intro').getContent());
		if ($("*[name=article]").size() === 6) {
			note_info('最多可以加入4条图文消息', 'yellow', evt);
			return false;
		} else {
			$("#add").before('<dl name="article"><dd name="view_info_name" >标题</dd><dt><img name="info_pic_img" src="http://wecool.socialmedia.cn/public/wecool/images/thumbs.jpg" width="70" height="70" /></dt><div name="editlayer" style="display: none;" class="dyc"><a href="javascript:void(0);" name="edit" target="_Self">编辑</a><a href="javascript:void(0);" name="delete" target="_Self">删除</a></div><input name="info_name"type="hidden" ></input><input name="info_url" type="hidden" ></input><input name="info_pic" type="hidden" ></input><input name="info_intro" type="hidden" ></input> <input name="id" type="hidden" value=""></input></dl>');
		}
	});
	//图片
	//$("#info_pic_image img").load(function() {
//		var index = $("#editer").attr('data_index');
//		$("*[name=article]").eq(index).find("*[name=info_pic]").val($("#info_pic_value").val());
//		$("*[name=article]").eq(index).find("*[name=info_pic_img]").attr('src',$("#info_pic_url").attr('src'));
//	});
	//图片删除
//	$("#info_pic_delete").click(function() {
//		var index = $("#editer").attr('data_index');
//		$("*[name=article]").eq(index).find("*[name=info_pic_img]").attr('src','');
//	});
	//规则
	$(".addition_right").on('keyup',"#rule",function() {
		var index = $("#editer").attr('data_index');
		$("*[name=article]").eq(index).find("*[name=info_intro]").val(UE.getEditor('info_intro').getContent());
		$("*[name=article]").eq(index).find("*[name=rule]").val($("#rule").val());
	});
	//标题
	$(".addition_right").on('keyup',"*[name=info_name]", function() {
		var index = $("#editer").attr('data_index');
		$("*[name=article]").eq(index).find("*[name=info_intro]").val(UE.getEditor('info_intro').getContent());
		$("*[name=article]").eq(index).find("*[name=view_info_name]").html($(this).val());
		$("*[name=article]").eq(index).find("*[name=info_name]").val($("#info_name").val());

	});
	//外部链接
	$(".addition_right").on('keyup',"#info_url",function() {
		var index = $("#editer").attr('data_index');
		$("*[name=article]").eq(index).find("*[name=info_intro]").val(UE.getEditor('info_intro').getContent());
		//var index = $("#editer").attr('data_index');
		$("*[name=article]").eq(index).find("*[name=info_url]").val($("#info_url").val());
	});
//	//产品库
//	$("#import_product").click(function() {
//		$.ajax({
//			type: "POST",
//			url: "/client/interaction/single/product",
//			success: function(msg) {
//				$('#import_box').html(msg);
//			}
//		});
//	});
	//提交
	
	
});
function upload_clear() {//清除
	var index = $("#editer").attr('data_index');
	$("#info_pic_value").val('');
	//$("#info_pic_url").attr('src', '');
	if (index === 0) {
		$("*[name=article]").eq(index).find("*[name=info_pic]").attr('src', 'http://wecool.socialmedia.cn/public/images/empty.png');
	} else {
		$("*[name=article]").eq(index).find("*[name=info_pic]").attr('src', 'http://wecool.socialmedia.cn/public/images/thumbs.jpg');
	}
	//$("#editer_img").hide();
}
////导入
// function library_data(event) {
//	var index = $("#editer").attr('data_index');
//	var library 	= $("*[name=library_div_select]:visible").parents('*[name=library_div]');
//	var info_name 	= $(library).find('*[name=library_info_name]').val();
//	var info_pic 	= $(library).find('*[name=library_info_pic]').val();
//	var info_intro 	= $(library).find('*[name=library_info_intro]').val();
//	var info_url 	= $(library).find('*[name=library_info_url]').val();
//
//	$("#info_name").val(info_name);
//	$("#info_pic").val(info_pic);				
//	$("*[name=article]").eq(index).find("*[name=info_name]").val(info_name);
//	$("*[name=article]").eq(index).find("*[name=view_info_name]").html(info_name);
//
//	if (info_pic != '') {
//		$("*[name=article]").eq(index).find("*[name=info_pic_img]").attr('src', 'http://wecool.socialmedia.cn/upload/' + info_pic);
//		$("*[name=article]").eq(index).find("*[name=info_pic]").val(info_pic);
//		$("#view_info_pic").html("<img src='http://wecool.socialmedia.cn/upload/'"  + info_pic + "'>");
//		$("#info_pic_url").attr('src', 'http://wecool.socialmedia.cn/upload/' + info_pic);
//		$("#info_pic_image").show();
//		$("#info_pic_value").val(info_pic);
//	}
//
//	UE.getEditor('info_intro').setContent(info_intro);
//	$("*[name=article]").eq(index).find("*[name=info_intro]").val(UE.getEditor('info_intro').getContent());
//	
//	$("#info_url").val(info_url);
//	$("*[name=article]").eq(index).find("*[name=info_url]").val(info_url);
//}
