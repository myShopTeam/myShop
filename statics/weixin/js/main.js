// JavaScript Document

$(function(){
	if($(".selected").length>0){
		n = $(".selected").attr("id");
		setTab(n);
	}
	$(".parent_child a").click(function(){
		var obj=$(this).parents('li');
		if(obj.children(".child").is(":hidden")){
			$(this).find(".fa-angle-down").addClass("text-active").siblings().removeClass("text-active");
		}else{
			$(this).find(".fa-angle-up").addClass("text-active").siblings().removeClass("text-active");
		}
		obj.children(".child").slideToggle(500);
		obj.siblings("li").children(".child").slideUp(500);
		});
});

function setTab(idstr){
	n = idstr.substring(2);
	imgsrc = $("#tm"+n).find("img").attr("src");
	txt = $("#tm"+n).find("span").html();
	$(".top").find("img").attr("src",imgsrc);
	$(".top").find("a").html(txt);
	
	$(".TwoMenu div").hide();
	$("#TwoMenu-0"+n).show();
	
	$(".ThreeMenu div").hide();
	$("#con-0"+n).show();
	
	$("#confrm").attr("src",n+".html");
}