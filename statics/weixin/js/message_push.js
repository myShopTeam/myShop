// JavaScript Document
$(function(){
	var max_length=trim($(".restNum").html());
	$("textarea[name='content']").on('keyup',function(){
		var length=$(this).val().length;		
		$(".restNum").html(max_length-length);
		})
	$(".message-edit-hybrid").mouseover(function(){
		$(".message-hibrid-menu").show();		
		}).mouseout(function(){
			$(".message-hibrid-menu").mouseover(function(){
			$(this).show();
			}).mouseout(function(){
				$(this).hide();
				})
			$(".message-hibrid-menu").hide();
			})
	})