// JavaScript Document
$(function() {
	//鼠标移动到层上显示编辑和删除
	
	//编辑
	
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
	//提交
  $("#save").click(function(evt) {
		var index = $("#editer").attr('data_index');
		$("*[name=article]").eq(index).find("*[name=info_intro]").val(UE.getEditor('info_intro').getContent());
		var state = '';
		var rule = '';
		var data = '';
		var flg = true;
		$("*[name=article]").each(function(i) {
			if (!flg) {
				return false;
			}
			if (i == 0) {
				rule = $("*[name=article]").eq(i).find("*[name=rule]").val();
				/*if (rule == '') {
					note_info('关键词不能为空', 'yellow', evt);
					$("*[name=edit]").eq(i).click();
					flg = false;
					return false;
				}*/
				state = $("input[name='state']:checked").val();
			}

			var info_name = $("*[name=article]").eq(i).find("*[name=info_name]").val();
			if (info_name == '') {
				note_info('标题不能为空', 'yellow', evt);
				$("*[name=edit]").eq(i).click();
				flg = false;
				return false;
			}

			var id = $("*[name=article]").eq(i).find("*[name=id]").val();

			var info_pic = $("*[name=article]").eq(i).find("*[name=info_pic]").val();
			if (info_pic == '') {
				note_info('必须插入一张图片', 'yellow', evt);
				$("*[name=edit]").eq(i).click();
				flg = false;
				return false;
			}

			var info_intro = $("*[name=article]").eq(i).find("*[name=info_intro]").val();
			if (info_intro == '') {
				note_info('描述不能为空', 'yellow', evt);
				$("*[name=edit]").eq(i).click();
				flg = false;
				return false;
			}

			var info_url = $("*[name=article]").eq(i).find("*[name=info_url]").val();
			data = data + '<data' + i + '>' +
					'<id>' + encodeURI(id) + '</id>' +
					'<info_name>' + encodeURI(info_name) + '</info_name>' +
					'<info_pic>' + encodeURI(info_pic) + '</info_pic>' +
					'<info_intro>' + encodeURI(info_intro) + '</info_intro>' +
					'<info_url>' + encodeURI(info_url) + '</info_url>' +
					'</data' + i + '>';
		});
		data = "<?xml version='1.0'?><data>" + data + "</data>";
		if (!flg) {
			return false;
		}
		
		$.ajax({
			dataType:"json",
			type: "POST",
			url: SaveUrl,
			data: {
				'refer':$("#refer").val(),
				'info_id': $("input[name='MultiId']").val(),
				'rule': rule,
				'ruleType':$("input[name='ruleType']:checked").val(),
				'data': data
			},
			success: function(msg) {
				if (msg.info == "success") {
					if($("#refer").val()=='send'){
						window.location.href = referUrl+'/imageId/'+msg.data;
					}else{
						window.location.href = IndexUrl;
					}
				} else {
					note_info(msg, 'yellow', evt);
				}
			}
		});
	});
	
});
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
